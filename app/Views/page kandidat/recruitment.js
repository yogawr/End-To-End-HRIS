(function () {
    'use strict';

    const DB_NAME = 'hr-recruitment-db';
    const DB_VERSION = 1;
    let profileKey = 'candidate-profile-uninitialized';
    const channel = 'BroadcastChannel' in window ? new BroadcastChannel('hr-recruitment-sync') : null;
    const apiUrl = document.body && document.body.dataset.recruitmentApi;
    const careerUrl = function (path) { return new URL(path, document.baseURI).toString(); };
    const candidateApi = { profile: careerUrl('api/candidate/profile'), applications: careerUrl('api/candidate/applications'), apply: careerUrl('api/candidate/applications'), csrf: careerUrl('career/csrf-token') };
    let database;

    function openDatabase() {
        return new Promise(function (resolve, reject) {
            const request = indexedDB.open(DB_NAME, DB_VERSION);
            request.onupgradeneeded = function () {
                const db = request.result;
                if (!db.objectStoreNames.contains('profiles')) db.createObjectStore('profiles', { keyPath: 'id' });
                if (!db.objectStoreNames.contains('applications')) {
                    const store = db.createObjectStore('applications', { keyPath: 'id' });
                    store.createIndex('createdAt', 'createdAt');
                }
                if (!db.objectStoreNames.contains('messages')) {
                    const store = db.createObjectStore('messages', { keyPath: 'id' });
                    store.createIndex('createdAt', 'createdAt');
                }
            };
            request.onsuccess = function () { resolve(request.result); };
            request.onerror = function () { reject(request.error); };
        });
    }

    function transaction(storeName, mode, operation) {
        return new Promise(function (resolve, reject) {
            const request = database.transaction(storeName, mode).objectStore(storeName);
            const result = operation(request);
            result.onsuccess = function () { resolve(result.result); };
            result.onerror = function () { reject(result.error); };
        });
    }

    function fields() {
        return Array.from(document.querySelectorAll('#content-biodata-parent input, #content-biodata-parent select, #content-biodata-parent textarea'));
    }

    function fieldKey(field, index) {
        if (!field.dataset.field) field.dataset.field = 'field-' + index;
        return field.dataset.field;
    }

    function readProfile() {
        const profile = { id: profileKey, updatedAt: new Date().toISOString(), values: {}, files: {} };
        fields().forEach(function (field, index) {
            const key = fieldKey(field, index);
            if (field.type === 'file') {
                profile.files[key] = field.files && field.files[0] ? {
                    name: field.files[0].name,
                    type: field.files[0].type,
                    size: field.files[0].size
                } : null;
            } else {
                profile.values[key] = field.value;
            }
        });
        return profile;
    }

    function updateCompletion() {
        const profileFields = fields().filter(function (field) { return field.type !== 'file'; });
        const completed = profileFields.filter(function (field) { return field.value.trim() !== ''; }).length;
        const output = document.getElementById('profileCompletion');
        if (output) output.textContent = (profileFields.length ? Math.round((completed / profileFields.length) * 100) : 0) + '%';
    }

    function applyProfile(profile) {
        if (!profile) return;
        fields().forEach(function (field, index) {
            const key = fieldKey(field, index);
            if (field.type !== 'file' && profile.values && Object.prototype.hasOwnProperty.call(profile.values, key)) {
                field.value = profile.values[key];
            }
        });
    }

    async function saveProfile(showMessage) {
        const profile = readProfile();
        await transaction('profiles', 'readwrite', function (store) { return store.put(profile); });
        const nameField = document.querySelector('#content-biodata-parent input[required]');
        if (nameField && nameField.value.trim()) {
            try {
                const token = (await (await fetch(candidateApi.csrf, { credentials: 'same-origin' })).json()).token;
                await fetch(candidateApi.profile, { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, Accept: 'application/json' }, body: JSON.stringify({ full_name: nameField.value.trim(), profile: profile.values }) });
            } catch (error) { console.info('Profil lokal tersimpan; sinkronisasi server tertunda:', error.message); }
        }
        setStatus('Tersimpan ' + new Date().toLocaleTimeString('id-ID'));
        if (channel) channel.postMessage({ type: 'profile-updated', profile: profile });
        if (showMessage) alert('Biodata berhasil disimpan ke database perangkat ini.');
    }

    function setStatus(message) {
        const status = document.getElementById('syncStatus');
        if (status) status.textContent = message;
    }

    async function loadApplications() {
        try {
            const response = await fetch(candidateApi.applications, { credentials: 'same-origin', headers: { Accept: 'application/json' } });
            if (response.ok) {
                const applications = await response.json();
                const body = document.getElementById('applicationHistoryBody');
                if (body) {
                    body.innerHTML = applications.length ? applications.map(function (item, index) {
                        return '<tr><td>' + (index + 1) + '</td><td class="fw-semibold">' + escapeHtml(item.title) + '</td><td>' + new Date(item.created_at).toLocaleDateString('id-ID') + '</td><td>' + escapeHtml(item.location || '-') + '</td><td><span class="badge bg-warning text-dark">' + escapeHtml(item.status) + '</span></td></tr>';
                    }).join('') : '<tr><td colspan="5" class="text-center text-muted">Belum ada lamaran tersimpan.</td></tr>';
                }
                return;
            }
        } catch (error) {
            console.error('Riwayat lamaran tidak dapat dimuat:', error);
        }
        const body = document.getElementById('applicationHistoryBody');
        if (body) body.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Riwayat belum dapat dimuat.</td></tr>';
    }

    window.saveApplication = async function () {
        const required = document.querySelector('#content-biodata-parent input[required]');
        if (required && !required.value.trim()) {
            required.focus();
            alert('Nama lengkap wajib diisi.');
            return;
        }
        const cv = document.querySelector('[data-document="cv"]');
        if (!cv || !cv.files[0]) {
            alert('CV wajib diunggah sebelum biodata diselesaikan.');
            return;
        }
        if (cv.files[0].size > 5 * 1024 * 1024 || !['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'].includes(cv.files[0].type)) {
            cv.focus();
            alert('CV wajib berformat PDF/DOCX dan maksimal 5 MB.');
            return;
        }
        if (!window.confirm('Simpan biodata dan dokumen kandidat sekarang?')) return;
        await saveProfile(true);
    };

    window.logoutCandidate = async function () {
        if (!window.confirm('Yakin ingin keluar dari portal kandidat?')) return;
        try {
            const token = (await (await fetch(candidateApi.csrf, { credentials: 'same-origin' })).json()).token;
            const response = await fetch(careerUrl('career/logout'), { method: 'POST', credentials: 'same-origin', headers: { 'X-CSRF-TOKEN': token, Accept: 'application/json' } });
            const result = await response.json();
            window.location.href = careerUrl(result.redirect);
        } catch (error) { alert('Logout gagal. Silakan refresh halaman.'); }
    };

    window.applyJob = async function (position, location) {
        const jobId = arguments[2];
        if (!jobId) {
            alert('Lowongan ini belum tersinkron dengan HRIS. Silakan refresh halaman dari portal karier.');
            return;
        }
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = '.pdf,.docx';
        fileInput.click();
        fileInput.onchange = async function () {
            if (!fileInput.files[0]) return;
            if (fileInput.files[0].size > 5 * 1024 * 1024) { alert('CV maksimal 5 MB.'); return; }
            if (!window.confirm('Kirim lamaran untuk posisi ' + position + '?')) return;
            try {
                const token = (await (await fetch(candidateApi.csrf, { credentials: 'same-origin' })).json()).token;
                const form = new FormData();
                form.append('job_id', jobId);
                form.append('cv', fileInput.files[0]);
                const response = await fetch(candidateApi.apply, { method: 'POST', credentials: 'same-origin', headers: { 'X-CSRF-TOKEN': token, Accept: 'application/json' }, body: form });
                const result = await response.json();
                if (!response.ok) throw new Error(result.message || 'Lamaran gagal dikirim.');
                await loadApplications();
                alert(result.message);
            } catch (error) { alert(error.message); }
        };
        return;
        /* Local fallback remains below for offline-only preview. */
        /* istanbul ignore next */
        await saveProfile(false);
        const application = {
            id: 'application-' + Date.now(),
            position: position,
            location: location,
            status: 'Menunggu seleksi',
            createdAt: new Date().toISOString()
        };
        await transaction('applications', 'readwrite', function (store) { return store.add(application); });
        if (channel) channel.postMessage({ type: 'application-added', application: application });
        await loadApplications();
        alert('Lamaran untuk posisi ' + position + ' berhasil disimpan.');
    };

    window.exportData = async function () {
        const messages = await transaction('messages', 'readonly', function (store) { return store.getAll(); });
        const data = {
            version: 1,
            exportedAt: new Date().toISOString(),
            profile: await transaction('profiles', 'readonly', function (store) { return store.get(profileKey); }),
            applications: [],
            messages: messages.filter(function (item) { return item.id.indexOf(profileKey + '-message-') === 0; })
        };
        const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'backup-rekrutmen-' + new Date().toISOString().slice(0, 10) + '.json';
        link.click();
        URL.revokeObjectURL(link.href);
    };

    window.importData = async function (event) {
        const file = event.target.files[0];
        if (!file) return;
        try {
            const data = JSON.parse(await file.text());
            if (!data || data.version !== 1 || !data.profile || !Array.isArray(data.messages)) throw new Error('Format backup tidak valid.');
            await transaction('profiles', 'readwrite', function (store) { return store.put(data.profile); });
            for (const item of data.messages) {
                if (item.id.indexOf(profileKey + '-message-') === 0) {
                    await transaction('messages', 'readwrite', function (store) { return store.put(item); });
                }
            }
            applyProfile(data.profile);
            await loadApplications();
            setStatus('Restore berhasil');
            alert('Data berhasil dipulihkan.');
        } catch (error) {
            alert('Restore gagal: ' + error.message);
        } finally {
            event.target.value = '';
        }
    };

    window.switchSubTab = function (subTabId) {
        const parent = document.getElementById('menu-biodata');
        const trigger = document.getElementById(subTabId);
        if (parent && trigger && window.bootstrap) {
            bootstrap.Tab.getOrCreateInstance(parent).show();
            bootstrap.Tab.getOrCreateInstance(trigger).show();
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    window.toggleCandidateSubmenu = function (event) {
        if (event.target.closest('.nav-link') !== event.currentTarget) return;
        const submenu = document.getElementById('sub-biodata-tabs');
        const trigger = event.currentTarget;
        if (!submenu) return;
        submenu.classList.toggle('show');
        trigger.setAttribute('aria-expanded', submenu.classList.contains('show') ? 'true' : 'false');
    };

    window.toggleTaraChat = function () {
        const box = document.getElementById('taraChatBox');
        box.style.display = box.style.display === 'flex' ? 'none' : 'flex';
        if (box.style.display === 'flex') document.getElementById('chatInput').focus();
    };

    window.handleKeyPress = function (event) { if (event.key === 'Enter') window.sendChatMessage(); };
    window.sendChatMessage = async function () {
        const input = document.getElementById('chatInput');
        const text = input.value.trim();
        if (!text) return;
        const body = document.getElementById('chatBody');
        body.insertAdjacentHTML('beforeend', '<div class="chat-bubble-user">' + escapeHtml(text) + '</div>');
        input.value = '';
        const message = { id: profileKey + '-message-' + Date.now(), text: text, createdAt: new Date().toISOString() };
        await transaction('messages', 'readwrite', function (store) { return store.add(message); });
        if (channel) channel.postMessage({ type: 'message-added', message: message });
        body.insertAdjacentHTML('beforeend', '<div class="chat-bubble-tara">' + getSmartReply(text) + '</div>');
        body.scrollTop = body.scrollHeight;
    };

    function getSmartReply(query) {
        const q = query.toLowerCase();
        if (/\b(halo|hai|selamat)\b/.test(q)) return 'Halo! Saya TARA. Ada yang bisa saya bantu?';
        if (/\b(loker|lowongan|posisi)\b/.test(q)) return 'Silakan buka menu Lowongan Kerja Terkini untuk melihat posisi yang tersedia.';
        if (/\b(dokumen|cv|ijazah|ktp|upload|unggah)\b/.test(q)) return 'Unggah CV dan ijazah dalam PDF, sedangkan KTP dan pas foto dalam JPG/PNG.';
        if (/\b(status|lamaran|interview|seleksi)\b/.test(q)) return 'Status lamaran dapat dilihat pada menu Histori Lamaran.';
        return 'Pertanyaan Anda sudah dicatat. Admin HRGA akan menindaklanjutinya.';
    }

    async function loadPublicJobs() {
        if (!apiUrl) return;
        try {
            const response = await fetch(careerUrl(apiUrl), { headers: { Accept: 'application/json' } });
            if (!response.ok) return;
            const jobs = await response.json();
            const grid = document.getElementById('jobListingGrid');
            if (!grid || !jobs.length) return;
            grid.innerHTML = jobs.map(function (job) {
                return '<div class="col-md-6"><div class="card job-card p-3 h-100"><h5 class="fw-bold text-dark mb-1">' + escapeHtml(job.title) + '</h5><p class="text-muted small mb-2"><i class="fa-solid fa-location-dot me-1 text-danger"></i>' + escapeHtml(job.location || 'Indonesia') + '</p><p class="small text-secondary mb-3">' + escapeHtml(job.description || 'Kesempatan karier bersama PT Tumbakmas Niagasakti.') + '</p><div class="mt-auto d-flex justify-content-between align-items-center"><span class="badge bg-info text-dark">' + escapeHtml((job.employment_type || 'full_time').replace('_', '-')) + '</span><button class="btn btn-sm btn-primary px-3" onclick="applyJob(\'' + escapeHtml(job.title).replace(/'/g, "\\'") + '\', \'' + escapeHtml(job.location || 'Indonesia').replace(/'/g, "\\'") + '\', ' + job.id + ')">Apply Sekarang</button></div></div></div>';
            }).join('');
        } catch (error) {
            console.info('Portal memakai daftar lowongan cadangan:', error.message);
        }
    }

    async function loadCandidateSession() {
        try {
            const response = await fetch(candidateApi.profile, { credentials: 'same-origin', headers: { Accept: 'application/json' } });
            if (response.status === 401) { window.location.href = careerUrl('career'); return; }
            if (!response.ok) return;
            const profile = await response.json();
            profileKey = 'candidate-profile-' + profile.id;
            let storedValues = {};
            try { storedValues = profile.profile ? JSON.parse(profile.profile) : {}; } catch (error) { storedValues = {}; }
            applyProfile({ values: storedValues });
            const nameField = document.querySelector('#content-biodata-parent input[required]');
            if (nameField && profile.full_name) nameField.value = profile.full_name;
            updateCompletion();
            await loadApplications();
        } catch (error) {
            window.location.href = careerUrl('career');
        }
    }

    function escapeHtml(text) {
        return String(text).replace(/[&<>"']/g, function (match) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[match];
        });
    }

    document.addEventListener('DOMContentLoaded', async function () {
        try {
            database = await openDatabase();
            const profile = await transaction('profiles', 'readonly', function (store) { return store.get(profileKey); });
            applyProfile(profile);
            await loadApplications();
            fields().forEach(function (field) { field.addEventListener('change', function () { saveProfile(false); }); });
            fields().forEach(function (field) { field.addEventListener('input', updateCompletion); });
            updateCompletion();
            loadPublicJobs();
            loadCandidateSession();
            setStatus('Database siap dan tersinkron');
        } catch (error) {
            setStatus('Database gagal: ' + error.message);
            console.error(error);
        }
    });

    if (channel) channel.onmessage = function (event) {
        if (event.data && event.data.type === 'profile-updated') {
            applyProfile(event.data.profile);
            setStatus('Tersinkron dari tab lain');
        }
        if (event.data && event.data.type === 'application-added') {
            loadApplications();
            setStatus('Lamaran tersinkron dari tab lain');
        }
    };
})();
