<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Portal Karir | PT Tumbakmas Niagasakti</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #0d6efd;
            --primary-hover: #0b5ed7;
            --bg-light: #f4f6f9;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        /* Sidebar Styling (Sesuai Layout Gambar) */
        .sidebar {
            background-color: #ffffff;
            border-right: 1px solid var(--border-color);
            min-height: 100vh;
            padding: 1.25rem 1rem;
        }

        .sidebar-title {
            font-size: 0.75rem;
            font-weight: 800;
            color: #94a3b8;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }

        .nav-menu-btn {
            width: 100%;
            text-align: left;
            padding: 0.65rem 1rem;
            border-radius: var(--radius-md);
            border: none;
            background: transparent;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 0.35rem;
            transition: all 0.2s ease;
        }

        .nav-menu-btn:hover {
            background-color: #f1f5f9;
            color: var(--primary-blue);
        }

        .nav-menu-btn.active {
            background-color: var(--primary-blue);
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }

        /* Submenu Styling */
        .submenu-list {
            list-style: none;
            padding-left: 1.75rem;
            margin-bottom: 0.75rem;
        }

        .submenu-item a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.75rem;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.2s;
        }

        .submenu-item a:hover, .submenu-item a.active {
            color: var(--primary-blue);
            background-color: #eff6ff;
            font-weight: 600;
        }

        /* Content Area */
        .main-content {
            padding: 1.75rem 2rem;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 1.75rem;
            margin-bottom: 1.5rem;
        }

        /* Section Banner */
        .welcome-banner {
            background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);
            color: #ffffff;
            border-radius: var(--radius-lg);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            right: -30px;
            bottom: -30px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        /* Values Grid */
        .value-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            height: 100%;
            transition: all 0.25s ease;
            position: relative;
            top: 0;
        }

        .value-card:hover {
            top: -4px;
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.1);
            border-color: rgba(13, 110, 253, 0.4);
        }

        .value-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        /* Floating Widget Tanya TARA */
        .tara-widget {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background-color: var(--primary-blue);
            color: #ffffff;
            border-radius: 50px;
            padding: 0.65rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.35);
            cursor: pointer;
            z-index: 1000;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .tara-widget:hover {
            background-color: var(--primary-hover);
            transform: scale(1.03);
            color: #ffffff;
        }

        .tara-avatar {
            width: 32px;
            height: 32px;
            background: #ffffff;
            color: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .tara-chat-box {
            display: none;
            position: fixed;
            right: 24px;
            bottom: 84px;
            width: min(360px, calc(100vw - 32px));
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: 0 12px 35px rgba(15, 23, 42, 0.18);
            overflow: hidden;
            z-index: 1001;
        }

        .tara-chat-header {
            background: var(--primary-blue);
            color: #ffffff;
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .tara-chat-body {
            height: 260px;
            padding: 1rem;
            overflow-y: auto;
            background: #f8fafc;
        }

        .tara-message {
            max-width: 86%;
            padding: 0.55rem 0.75rem;
            margin-bottom: 0.6rem;
            border-radius: 12px;
            font-size: 0.82rem;
        }

        .tara-message.bot { background: #ffffff; border: 1px solid var(--border-color); }
        .tara-message.user { margin-left: auto; background: #e7f0ff; color: #174ea6; }

        .tara-chat-footer { display: flex; gap: 0.5rem; padding: 0.75rem; border-top: 1px solid var(--border-color); }

        @media (max-width: 768px) {
            .sidebar { min-height: auto; }
            .main-content { padding: 1rem; }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <!-- SIDEBAR NAVIGATION (Sesuai Gambar) -->
        <aside class="col-lg-2 col-md-3 sidebar">
            <div class="sidebar-title text-uppercase">Menu Utama</div>
            
            <!-- 1. Menu Dashboard / Utama (Active) -->
            <button class="nav-menu-btn active" data-tab="dashboard" onclick="switchTab('dashboard')">
                <i class="fa-solid fa-house-chimney"></i> Beranda &amp; Budaya
            </button>

            <!-- 2. Menu Biodata Diri Accordion -->
            <button class="nav-menu-btn" data-bs-toggle="collapse" data-bs-target="#biodataSubmenu" aria-expanded="true" type="button">
                <i class="fa-solid fa-id-card"></i> Menu Biodata Diri
            </button>
            <div class="collapse show" id="biodataSubmenu">
                <ul class="submenu-list">
                    <li class="submenu-item"><a href="#" data-tab="data-diri" onclick="switchTab('data-diri'); return false;"><i class="fa-solid fa-user me-1"></i> Data Diri</a></li>
                    <li class="submenu-item"><a href="#" data-tab="data-pendukung" onclick="switchTab('data-pendukung'); return false;"><i class="fa-solid fa-folder me-1"></i> Data Pendukung</a></li>
                    <li class="submenu-item"><a href="#" data-tab="pengalaman" onclick="switchTab('pengalaman'); return false;"><i class="fa-solid fa-briefcase me-1"></i> Pengalaman</a></li>
                    <li class="submenu-item"><a href="#" data-tab="upload" onclick="switchTab('upload'); return false;"><i class="fa-solid fa-cloud-arrow-up me-1"></i> Upload Dokumen</a></li>
                </ul>
            </div>

            <!-- 3. Histori Lamaran -->
            <button class="nav-menu-btn" data-tab="histori" onclick="switchTab('histori')" type="button">
                <i class="fa-solid fa-clock-rotate-left"></i> Histori Lamaran
            </button>

            <!-- 4. Lowongan Kerja Terkini -->
            <button class="nav-menu-btn" data-tab="lowongan" onclick="switchTab('lowongan')" type="button">
                <i class="fa-solid fa-bullhorn"></i> Lowongan Kerja
            </button>

            <!-- 5. Keluar dari Portal -->
            <button class="nav-menu-btn text-danger" type="button" onclick="logoutCandidate()">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </button>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="col-lg-10 col-md-9 main-content">
            <section id="tab-dashboard" class="candidate-tab">
            
            <!-- SECTION 1: WELCOME BANNER -->
            <div class="welcome-banner mb-4">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-primary fw-bold px-3 py-2 rounded-pill mb-2">
                            <i class="fa-solid fa-shield-halved me-1"></i> Part of Rodamas Group
                        </span>
                        <h2 class="fw-bold text-white mb-2">Selamat Datang di Portal Karir PT Tumbakmas Niagasakti</h2>
                        <p class="text-white-50 mb-0 fs-6">
                            Wadah pertumbuhan profesional tempat Anda dapat mengeksplorasi potensi, bertumbuh secara berkelanjutan, dan memberikan dampak nyata bagi masyarakat Indonesia.
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end d-none d-lg-block">
                        <i class="fa-solid fa-chart-line text-white opacity-25" style="font-size: 7rem;"></i>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: BAGAIMANA TUMBAKMAS TEAM MENGEMBANGKAN DIRI -->
            <div class="card-custom">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="p-3 bg-primary-subtle text-primary rounded-3">
                        <i class="fa-solid fa-seedling fs-4"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">Pengembangan Diri Tumbakmas Team</h4>
                        <p class="text-muted small mb-0">Pendekatan holistik dalam membentuk talenta tangguh dan berdaya saing tinggi</p>
                    </div>
                </div>
                <hr class="my-3 border-light-subtle">
                <p class="text-secondary leading-relaxed">
                    Di <strong>PT Tumbakmas Niagasakti</strong>, kami meyakini bahwa keberhasilan bisnis berbanding lurus dengan kualitas sumber daya manusianya. Pengembangan diri bukan sekadar program tahunan, melainkan **budaya harian** yang tercermin dalam 3 pilar utama:
                </p>
                <div class="row g-3 mt-1">
                    <div class="col-md-4">
                        <div class="p-3 rounded-3 bg-light border">
                            <h6 class="fw-bold text-primary mb-1"><i class="fa-solid fa-graduation-cap me-2"></i>Structured Training</h6>
                            <p class="extra-small text-muted mb-0">Program pembekalan teknis fungsional, pelatihan K3, hingga sertifikasi kepemimpinan berbasis skala kompetensi.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded-3 bg-light border">
                            <h6 class="fw-bold text-success mb-1"><i class="fa-solid fa-user-group me-2"></i>Mentorship &amp; Feedback</h6>
                            <p class="extra-small text-muted mb-0">Bimbingan intensif dari atasan (*on-the-job coaching*) dan evaluasi berbasis KPI &amp; 9-Box Talent Matrix.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded-3 bg-light border">
                            <h6 class="fw-bold text-warning-emphasis mb-1"><i class="fa-solid fa-diagram-project me-2"></i>Continuous Innovation</h6>
                            <p class="extra-small text-muted mb-0">Peluang memimpin proyek strategis, digitalisasi proses, dan simplifikasi rantai distribusi barang.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: 7 VALUE RODAMAS GROUP -->
            <div class="card-custom">
                <div class="mb-4">
                    <span class="text-primary fw-bold text-uppercase small tracking-wider">Pondasi Budaya Perusahaan</span>
                    <h4 class="fw-bold text-dark mb-1">7 Values Rodamas Group &amp; Implementasinya</h4>
                    <p class="text-muted small mb-0">Setiap insan Tumbakmas menerapkan 7 nilai utama ini dalam proses belajar dan bekerja sehari-hari:</p>
                </div>

                <div class="row g-3">
                    
                    <!-- Value 1: Integritas -->
                    <div class="col-md-6 col-lg-4">
                        <div class="value-card">
                            <div class="value-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-handshake-angle"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">1. Integritas</h6>
                            <p class="small text-muted mb-0">
                                Mengutamakan kejujuran, etika tinggi, dan konsistensi antara perkataan dengan tindakan dalam seluruh proses kerja dan pembelajaran.
                            </p>
                        </div>
                    </div>

                    <!-- Value 2: Rendah Hati -->
                    <div class="col-md-6 col-lg-4">
                        <div class="value-card">
                            <div class="value-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-heart me-0"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">2. Rendah Hati</h6>
                            <p class="small text-muted mb-0">
                                Selalu haus akan ilmu baru, siap menerima masukan (*constructive feedback*), serta mau belajar dari siapa saja tanpa merasa paling tahu.
                            </p>
                        </div>
                    </div>

                    <!-- Value 3: Komitmen -->
                    <div class="col-md-6 col-lg-4">
                        <div class="value-card">
                            <div class="value-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">3. Komitmen</h6>
                            <p class="small text-muted mb-0">
                                Berdedikasi penuh terhadap tugas, menyelesaikan tanggung jawab hingga tuntas, dan berorientasi pada pencapaian target kerja.
                            </p>
                        </div>
                    </div>

                    <!-- Value 4: Kerja Tim -->
                    <div class="col-md-6 col-lg-4">
                        <div class="value-card">
                            <div class="value-icon bg-warning-subtle text-warning-emphasis">
                                <i class="fa-solid fa-people-group"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">4. Kerja Tim</h6>
                            <p class="small text-muted mb-0">
                                Menyampingkan ego pribadi demi tujuan bersama, saling membantu lintas departemen, dan bertumbuh dalam harmoni.
                            </p>
                        </div>
                    </div>

                    <!-- Value 5: Semangat -->
                    <div class="col-md-6 col-lg-4">
                        <div class="value-card">
                            <div class="value-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-fire"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">5. Semangat</h6>
                            <p class="small text-muted mb-0">
                                Memiliki antusiasme pantang menyerah, energi positif dalam menghadapi tantangan, dan daya juang tinggi meraih keunggulan.
                            </p>
                        </div>
                    </div>

                    <!-- Value 6: Inovasi -->
                    <div class="col-md-6 col-lg-4">
                        <div class="value-card">
                            <div class="value-icon bg-purple-subtle text-purple" style="background:#f3e8ff; color:#9333ea;">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">6. Inovasi</h6>
                            <p class="small text-muted mb-0">
                                Berani mengeksplorasi cara-cara baru yang lebih efisien, memanfaatkan teknologi digital, serta terbiasa melakukan perbaikan terus-menerus.
                            </p>
                        </div>
                    </div>

                    <!-- Value 7: Pertumbuhan -->
                    <div class="col-md-12">
                        <div class="value-card bg-primary-subtle border-primary-subtle">
                            <div class="d-flex align-items-start gap-3">
                                <div class="value-icon bg-primary text-white mb-0" style="min-width: 44px;">
                                    <i class="fa-solid fa-chart-line"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">7. Pertumbuhan (Growth)</h6>
                                    <p class="small text-muted mb-0">
                                        Mendorong peningkatan kapabilitas diri secara berkelanjutan (*growth mindset*), baik secara personal maupun profesional, guna memberikan kontribusi terbaik bagi kemajuan bisnis Tumbakmas dan Rodamas Group.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </section>

            <section id="tab-data-diri" class="candidate-tab d-none">
                <div class="card-custom">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <span class="text-primary fw-bold text-uppercase small">Profil Kandidat</span>
                            <h4 class="fw-bold text-dark mb-1">Data Diri</h4>
                            <p class="text-muted small mb-0">Lengkapi informasi utama untuk proses rekrutmen.</p>
                        </div>
                        <span id="profileStatus" class="badge bg-success-subtle text-success">Tersimpan</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-12"><label class="form-label fw-semibold">Nama Lengkap</label><input id="profileName" data-profile-field="full_name" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Nomor KTP (NIK)</label><input data-profile-field="nik" class="form-control" maxlength="16"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Nomor KK</label><input data-profile-field="kk" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Tempat Lahir</label><input data-profile-field="birth_place" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Tanggal Lahir</label><input data-profile-field="birth_date" type="date" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Jenis Kelamin</label><select data-profile-field="gender" class="form-select"><option value="">Pilih Jenis Kelamin</option><option>Laki-laki</option><option>Perempuan</option></select></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">No. Telepon / WhatsApp</label><input data-profile-field="phone" type="tel" class="form-control"></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Tinggi Badan (cm)</label><input data-profile-field="height" type="number" min="1" class="form-control"></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Berat Badan (kg)</label><input data-profile-field="weight" type="number" min="1" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Golongan Darah</label><select data-profile-field="blood_type" class="form-select"><option value="">Pilih Golongan Darah</option><option>A</option><option>B</option><option>AB</option><option>O</option></select></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Status Pernikahan</label><select id="maritalStatus" data-profile-field="marital_status" class="form-select" onchange="updateFamilyVisibility()"><option value="">Pilih Status</option><option>Single</option><option>Belum Menikah</option><option>Menikah</option><option>Janda</option><option>Duda</option></select></div>
                        <div class="col-md-12"><label class="form-label fw-semibold">Alamat</label><textarea data-profile-field="address" class="form-control" rows="3"></textarea></div>
                    </div>
                    <div class="mt-4 d-flex justify-content-end"><button class="btn btn-primary px-4" type="button" onclick="saveCandidateProfile()"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Data Diri</button></div>
                </div>
            </section>

            <section id="tab-data-pendukung" class="candidate-tab d-none">
                <div class="card-custom">
                    <h4 class="fw-bold text-primary mb-1"><i class="fa-solid fa-folder me-2"></i>Data Pendukung</h4>
                    <p class="text-muted small mb-4">Simpan riwayat pendidikan dan informasi administrasi Anda.</p>
                    <div id="educationList" data-profile-collection="education">
                        <div class="education-entry border rounded-3 p-3 mb-3">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label fw-semibold">Pendidikan Terakhir</label><select data-profile-field="education_level" class="form-select"><option value="">Pilih Pendidikan</option><option>SMA/SMK</option><option>D3</option><option>S1</option><option>S2</option></select></div>
                                <div class="col-md-6"><label class="form-label fw-semibold">Jurusan</label><input data-profile-field="major" class="form-control"></div>
                                <div class="col-md-6"><label class="form-label fw-semibold">Institusi</label><input data-profile-field="institution" class="form-control"></div>
                                <div class="col-md-6"><label class="form-label fw-semibold">Tahun Lulus</label><input data-profile-field="graduation_year" type="number" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm mb-3" type="button" onclick="addEducation()"><i class="fa-solid fa-plus me-1"></i>Tambahkan Pendidikan</button>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label fw-semibold">Nama Bank</label><input data-profile-field="bank_name" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Nomor Rekening</label><input data-profile-field="bank_account" class="form-control"></div>
                    </div>
                    <hr class="my-4">
                    <h6 class="fw-bold text-secondary mb-3">Informasi Keluarga</h6>
                    <details class="border rounded-3 p-3 mb-3" open>
                        <summary class="fw-semibold text-primary">Orang Tua Kandung <span class="text-danger">*</span></summary>
                        <div class="row g-3 mt-1">
                            <div class="col-md-6"><label class="form-label fw-semibold">Nama Ibu Kandung</label><input data-profile-field="mother_name" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Nama Ayah Kandung</label><input data-profile-field="father_name" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Tanggal Lahir Ayah</label><input data-profile-field="father_birth_date" type="date" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Tanggal Lahir Ibu</label><input data-profile-field="mother_birth_date" type="date" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Tempat Lahir Ayah</label><input data-profile-field="father_birth_place" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label fw-semibold">Tempat Lahir Ibu</label><input data-profile-field="mother_birth_place" class="form-control"></div>
                            <div class="col-md-12"><label class="form-label fw-semibold">Alamat Domisili / Sesuai Kartu Keluarga</label><textarea data-profile-field="family_address" class="form-control" rows="3"></textarea></div>
                        </div>
                    </details>
                    <div id="familyMembersSection" class="d-none">
                        <details class="border rounded-3 p-3" open>
                            <summary class="fw-semibold text-primary">Pasangan dan Anak</summary>
                            <p class="text-muted small mt-2 mb-3">Tambahkan pasangan atau anak sesuai kondisi keluarga.</p>
                            <div id="familyMembersList" data-profile-collection="family_members"></div>
                            <button class="btn btn-outline-primary btn-sm" type="button" onclick="addFamilyMember()"><i class="fa-solid fa-plus me-1"></i>Tambahkan Anggota Keluarga</button>
                        </details>
                    </div>
                    <div class="mt-4 d-flex justify-content-end"><button class="btn btn-primary px-4" type="button" onclick="saveCandidateProfile()"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Data Pendukung</button></div>
                </div>
            </section>

            <section id="tab-pengalaman" class="candidate-tab d-none">
                <div class="card-custom">
                    <h4 class="fw-bold text-primary mb-1"><i class="fa-solid fa-briefcase me-2"></i>Pengalaman</h4>
                    <p class="text-muted small mb-4">Tambahkan pengalaman kerja dan kompetensi yang relevan.</p>
                    <div id="experienceList" data-profile-collection="experience">
                        <div class="experience-entry border rounded-3 p-3 mb-3">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label fw-semibold">Nama Perusahaan</label><input data-profile-field="last_company" class="form-control"></div>
                                <div class="col-md-6"><label class="form-label fw-semibold">Posisi / Jabatan</label><input data-profile-field="last_position" class="form-control"></div>
                                <div class="col-md-6"><label class="form-label fw-semibold">Periode</label><input data-profile-field="work_period" class="form-control" placeholder="Contoh: 2022 - 2025"></div>
                                <div class="col-md-6"><label class="form-label fw-semibold">Keterangan</label><input data-profile-field="work_description" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm mb-3" type="button" onclick="addExperience()"><i class="fa-solid fa-plus me-1"></i>Tambahkan Pengalaman</button>
                    <div class="mt-4 d-flex justify-content-end"><button class="btn btn-primary px-4" type="button" onclick="saveCandidateProfile()"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Pengalaman</button></div>
                </div>
            </section>

            <section id="tab-upload" class="candidate-tab d-none">
                <div class="card-custom">
                    <h4 class="fw-bold text-primary mb-1"><i class="fa-solid fa-cloud-arrow-up me-2"></i>Upload Dokumen</h4>
                    <p class="text-muted small mb-4">CV digunakan saat mengirim lamaran pada lowongan yang dipilih.</p>
                    <label class="form-label fw-semibold">CV / Resume (PDF atau DOCX, maksimal 5 MB)</label>
                    <input id="candidateCv" type="file" class="form-control" accept=".pdf,.docx">
                    <div class="mt-4 d-flex justify-content-end"><button class="btn btn-success px-4" type="button" onclick="saveCandidateCv()"><i class="fa-solid fa-upload me-2"></i>Simpan Dokumen</button></div>
                </div>
            </section>

            <section id="tab-histori" class="candidate-tab d-none">
                <div class="card-custom">
                    <h4 class="fw-bold text-primary mb-1"><i class="fa-solid fa-clock-rotate-left me-2"></i>Histori Lamaran</h4>
                    <p class="text-muted small mb-4">Pantau posisi dan status lamaran Anda.</p>
                    <div class="table-responsive"><table class="table table-hover align-middle"><thead class="table-light"><tr><th>No</th><th>Posisi</th><th>Tanggal</th><th>Lokasi</th><th>Status</th></tr></thead><tbody id="applicationHistoryBody"><tr><td colspan="5" class="text-center text-muted">Memuat histori...</td></tr></tbody></table></div>
                </div>
            </section>

            <section id="tab-lowongan" class="candidate-tab d-none">
                <div class="card-custom">
                    <h4 class="fw-bold text-primary mb-1"><i class="fa-solid fa-bullhorn me-2"></i>Lowongan Kerja Terkini</h4>
                    <p class="text-muted small mb-4">Pilih posisi yang sesuai dan kirim CV Anda.</p>
                    <div class="row g-2 mb-4">
                        <div class="col-12 col-md-5"><input id="candidateJobSearch" type="search" class="form-control" placeholder="Cari posisi atau kata kunci..." oninput="filterCandidateJobs()"></div>
                        <div class="col-12 col-md-3"><select id="candidateDepartmentFilter" class="form-select" onchange="filterCandidateJobs()"><option value="">Semua Departemen</option></select></div>
                        <div class="col-12 col-md-3"><select id="candidateLocationFilter" class="form-select" onchange="filterCandidateJobs()"><option value="">Semua Lokasi</option></select></div>
                        <div class="col-12 col-md-1"><button class="btn btn-light border w-100" type="button" onclick="resetCandidateJobFilters()" title="Reset filter"><i class="fa-solid fa-rotate-left"></i></button></div>
                    </div>
                    <div id="candidateJobList" class="row g-3"><div class="col-12 text-muted">Memuat lowongan...</div></div>
                    <div id="candidateJobEmpty" class="text-center text-muted py-4 d-none">Lowongan tidak ditemukan.</div>
                </div>
            </section>

        </main>
    </div>
</div>

<!-- FLOATING BUTTON TANYA TARA (Sesuai Gambar) -->
<a href="#" class="tara-widget" onclick="toggleTaraChat(); return false;">
    <div class="tara-avatar">
        <i class="fa-solid fa-robot"></i>
    </div>
    <span class="fw-bold fs-7">Tanya TARA</span>
</a>

<section class="tara-chat-box" id="taraChatBox" aria-label="Chat TARA">
    <div class="tara-chat-header">
        <strong><i class="fa-solid fa-robot me-2"></i>TARA Virtual Assistant</strong>
        <button type="button" class="btn-close btn-close-white" aria-label="Tutup" onclick="toggleTaraChat()"></button>
    </div>
    <div class="tara-chat-body" id="taraChatBody">
        <div class="tara-message bot">Halo, saya TARA. Saya dapat membantu informasi profil, dokumen, lowongan, dan status lamaran.</div>
    </div>
    <form class="tara-chat-footer" onsubmit="sendTaraMessage(event)">
        <input id="taraChatInput" class="form-control form-control-sm" placeholder="Tulis pertanyaan..." autocomplete="off">
        <button class="btn btn-primary btn-sm" type="submit" aria-label="Kirim"><i class="fa-solid fa-paper-plane"></i></button>
    </form>
</section>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const candidateUrl = path => new URL(path, document.baseURI).toString();
    const candidateApi = {
        csrf: '<?= esc($candidateApiUrls['csrf']) ?>',
        profile: '<?= esc($candidateApiUrls['profile']) ?>',
        applications: '<?= esc($candidateApiUrls['applications']) ?>',
        jobs: '<?= esc($candidateApiUrls['jobs']) ?>',
        logout: '<?= esc($candidateApiUrls['logout']) ?>'
    };
    const candidateHome = '<?= esc($candidateApiUrls['home']) ?>';

    let candidateProfile = {};
    let candidateJobs = [];

    function switchTab(tabName) {
        document.querySelectorAll('.candidate-tab').forEach(panel => panel.classList.add('d-none'));
        const panel = document.getElementById('tab-' + tabName);
        if (panel) panel.classList.remove('d-none');
        document.querySelectorAll('[data-tab]').forEach(item => item.classList.toggle('active', item.dataset.tab === tabName));
        if (tabName === 'histori') loadApplications();
        if (tabName === 'lowongan') loadJobs();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function toggleTaraChat() {
        const chat = document.getElementById('taraChatBox');
        const isOpen = chat.style.display === 'block';
        chat.style.display = isOpen ? 'none' : 'block';
        if (!isOpen) document.getElementById('taraChatInput').focus();
    }

    function taraReply(message) {
        const text = message.toLowerCase();
        if (text.includes('lowongan') || text.includes('loker') || text.includes('pekerjaan')) { switchTab('lowongan'); return 'Saya membuka menu Lowongan Kerja. Pilih posisi yang sesuai untuk mengirim lamaran.'; }
        if (text.includes('lamaran') || text.includes('status') || text.includes('histori')) { switchTab('histori'); return 'Saya membuka Histori Lamaran agar Anda dapat melihat status pengajuan.'; }
        if (text.includes('cv') || text.includes('dokumen') || text.includes('upload')) { switchTab('upload'); return 'Saya membuka menu Upload Dokumen. CV harus PDF atau DOCX dan maksimal 5 MB.'; }
        if (text.includes('data diri') || text.includes('profil') || text.includes('biodata')) { switchTab('data-diri'); return 'Saya membuka Data Diri. Lengkapi informasi Anda lalu simpan.'; }
        if (text.includes('keluarga') || text.includes('ayah') || text.includes('ibu')) { switchTab('data-pendukung'); return 'Data keluarga tersedia di Data Pendukung. Nama ibu dan ayah kandung wajib diisi.'; }
        if (text.includes('pengalaman')) { switchTab('pengalaman'); return 'Saya membuka menu Pengalaman. Anda dapat menambahkan beberapa pengalaman kerja.'; }
        if (text.includes('halo') || text.includes('hai')) return 'Halo. Saya siap membantu navigasi portal karir Anda.';
        return 'Saya dapat membantu Data Diri, Data Pendukung, Pengalaman, Upload Dokumen, Lowongan, dan Histori Lamaran.';
    }

    function sendTaraMessage(event) {
        event.preventDefault();
        const input = document.getElementById('taraChatInput');
        const message = input.value.trim();
        if (!message) return;
        const body = document.getElementById('taraChatBody');
        body.insertAdjacentHTML('beforeend', '<div class="tara-message user">' + escapeCandidate(message) + '</div>');
        input.value = '';
        window.setTimeout(() => {
            body.insertAdjacentHTML('beforeend', '<div class="tara-message bot">' + escapeCandidate(taraReply(message)) + '</div>');
            body.scrollTop = body.scrollHeight;
        }, 250);
        body.scrollTop = body.scrollHeight;
    }

    function readProfileFields() {
        const values = { ...candidateProfile };
        document.querySelectorAll('[data-profile-field]').forEach(field => {
            if (!field.closest('[data-profile-collection]')) values[field.dataset.profileField] = field.value;
        });
        document.querySelectorAll('[data-profile-collection]').forEach(collection => {
            values[collection.dataset.profileCollection] = Array.from(collection.querySelectorAll('.' + collection.dataset.profileCollection + '-entry')).map(entry => {
                const item = {};
                entry.querySelectorAll('[data-profile-field]').forEach(field => { item[field.dataset.profileField] = field.value; });
                return item;
            });
        });
        return values;
    }

    function applyProfileFields(values) {
        candidateProfile = values || {};
        document.querySelectorAll('[data-profile-field]').forEach(field => {
            if (!field.closest('[data-profile-collection]') && Object.prototype.hasOwnProperty.call(candidateProfile, field.dataset.profileField)) field.value = candidateProfile[field.dataset.profileField] || '';
        });
        applyCollection('education', candidateProfile.education || []);
        applyCollection('experience', candidateProfile.experience || []);
        applyCollection('family_members', candidateProfile.family_members || []);
        updateFamilyVisibility();
    }

    function applyCollection(name, values) {
        const list = document.getElementById(name + 'List');
        if (!list || !Array.isArray(values) || !values.length) return;
        while (list.querySelectorAll('.' + name + '-entry').length < values.length) {
            if (name === 'education') addEducation();
            if (name === 'experience') addExperience();
            if (name === 'family_members') addFamilyMember();
        }
        values.forEach((value, index) => {
            const entry = list.querySelectorAll('.' + name + '-entry')[index];
            if (!entry) return;
            entry.querySelectorAll('[data-profile-field]').forEach(field => { field.value = value[field.dataset.profileField] || ''; });
        });
    }

    function addFamilyMember(type) {
        const list = document.getElementById('familyMembersList');
        const entry = document.createElement('div');
        entry.className = 'family_members-entry border rounded-3 p-3 mb-3';
        entry.innerHTML = '<div class="row g-3"><div class="col-md-4"><label class="form-label fw-semibold">Hubungan</label><select data-profile-field="relation" class="form-select"><option value="Pasangan">Pasangan</option><option value="Anak">Anak</option><option value="Anggota Keluarga Lain">Anggota Keluarga Lain</option></select></div><div class="col-md-8"><label class="form-label fw-semibold">Nama Lengkap</label><input data-profile-field="name" class="form-control"></div><div class="col-md-4"><label class="form-label fw-semibold">Jenis Kelamin</label><select data-profile-field="gender" class="form-select"><option value="">Pilih</option><option>Laki-laki</option><option>Perempuan</option></select></div><div class="col-md-4"><label class="form-label fw-semibold">Tempat Lahir</label><input data-profile-field="birth_place" class="form-control"></div><div class="col-md-4"><label class="form-label fw-semibold">Tanggal Lahir</label><input data-profile-field="birth_date" type="date" class="form-control"></div><div class="col-12 text-end"><button class="btn btn-outline-danger btn-sm" type="button" onclick="this.closest(\'.family_members-entry\').remove()"><i class="fa-solid fa-trash me-1"></i>Hapus Anggota</button></div></div>';
        list.appendChild(entry);
        if (type) entry.querySelector('[data-profile-field="relation"]').value = type;
    }

    function updateFamilyVisibility() {
        const status = document.getElementById('maritalStatus').value;
        const section = document.getElementById('familyMembersSection');
        const list = document.getElementById('familyMembersList');
        const active = ['Menikah', 'Duda', 'Janda'].includes(status);
        section.classList.toggle('d-none', !active);
        if (!active || list.querySelector('.family_members-entry')) return;
        if (status === 'Menikah') addFamilyMember('Pasangan');
        addFamilyMember('Anak');
        addFamilyMember('Anak');
    }

    function addEducation() {
        const list = document.getElementById('educationList');
        const entry = document.createElement('div');
        entry.className = 'education-entry border rounded-3 p-3 mb-3';
        entry.innerHTML = '<div class="row g-3"><div class="col-md-6"><label class="form-label fw-semibold">Pendidikan</label><select data-profile-field="education_level" class="form-select"><option value="">Pilih Pendidikan</option><option>SMA/SMK</option><option>D3</option><option>S1</option><option>S2</option></select></div><div class="col-md-6"><label class="form-label fw-semibold">Jurusan</label><input data-profile-field="major" class="form-control"></div><div class="col-md-6"><label class="form-label fw-semibold">Institusi</label><input data-profile-field="institution" class="form-control"></div><div class="col-md-6"><label class="form-label fw-semibold">Tahun Lulus</label><input data-profile-field="graduation_year" type="number" class="form-control"></div><div class="col-12 text-end"><button class="btn btn-outline-danger btn-sm" type="button" onclick="this.closest(\'.education-entry\').remove()"><i class="fa-solid fa-trash me-1"></i>Hapus</button></div></div>';
        list.appendChild(entry);
    }

    function addExperience() {
        const list = document.getElementById('experienceList');
        const entry = document.createElement('div');
        entry.className = 'experience-entry border rounded-3 p-3 mb-3';
        entry.innerHTML = '<div class="row g-3"><div class="col-md-6"><label class="form-label fw-semibold">Nama Perusahaan</label><input data-profile-field="last_company" class="form-control"></div><div class="col-md-6"><label class="form-label fw-semibold">Posisi / Jabatan</label><input data-profile-field="last_position" class="form-control"></div><div class="col-md-6"><label class="form-label fw-semibold">Periode</label><input data-profile-field="work_period" class="form-control"></div><div class="col-md-6"><label class="form-label fw-semibold">Keterangan</label><input data-profile-field="work_description" class="form-control"></div><div class="col-12 text-end"><button class="btn btn-outline-danger btn-sm" type="button" onclick="this.closest(\'.experience-entry\').remove()"><i class="fa-solid fa-trash me-1"></i>Hapus</button></div></div>';
        list.appendChild(entry);
    }

    async function readCandidateResponse(response) {
        const text = await response.text();
        try { return JSON.parse(text); } catch (error) {
            if (text.includes('Forbidden') || response.status === 403) throw new Error('Sesi keamanan kedaluwarsa. Muat ulang halaman lalu coba lagi.');
            throw new Error('Server mengembalikan respons yang tidak valid (' + response.status + ').');
        }
    }

    async function saveCandidateProfile() {
        const name = document.getElementById('profileName').value.trim();
        if (!name) { document.getElementById('profileName').focus(); alert('Nama lengkap wajib diisi.'); return; }
        if (!confirm('Simpan perubahan data kandidat ke database?')) return;
        try {
            const form = new FormData();
            form.append('full_name', name);
            form.append('profile', JSON.stringify(readProfileFields()));
            const response = await fetch(candidateApi.profile, { method: 'POST', credentials: 'same-origin', headers: { Accept: 'application/json' }, body: form });
            const result = await readCandidateResponse(response);
            if (!response.ok) throw new Error((result.message || 'Data kandidat gagal disimpan.') + (result.detail ? ' Detail: ' + result.detail : ' HTTP ' + response.status));
            document.getElementById('profileStatus').textContent = 'Tersimpan';
            alert(result.message || 'Data kandidat berhasil disimpan.');
        } catch (error) { alert(error.message); }
    }

    async function saveCandidateCv() {
        const file = document.getElementById('candidateCv').files[0];
        if (!file) { alert('Pilih CV terlebih dahulu.'); return; }
        if (file.size > 5 * 1024 * 1024 || !['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'].includes(file.type)) { alert('CV wajib berformat PDF/DOCX dan maksimal 5 MB.'); return; }
        if (!confirm('Simpan dan unggah CV ini ke database?')) return;
        try {
            const form = new FormData();
            form.append('full_name', document.getElementById('profileName').value.trim());
            form.append('profile', JSON.stringify(readProfileFields()));
            form.append('cv', file);
            const response = await fetch(candidateApi.profile, { method: 'POST', credentials: 'same-origin', headers: { Accept: 'application/json' }, body: form });
            const result = await readCandidateResponse(response);
            if (!response.ok) throw new Error(result.message || 'CV gagal disimpan.');
            alert(result.message || 'CV berhasil disimpan.');
        } catch (error) { alert(error.message); }
    }

    async function loadApplications() {
        const body = document.getElementById('applicationHistoryBody');
        try {
            const response = await fetch(candidateApi.applications, { credentials: 'same-origin', headers: { Accept: 'application/json' } });
            if (!response.ok) throw new Error('Histori tidak tersedia.');
            const applications = await readCandidateResponse(response);
            body.innerHTML = applications.length ? applications.map((item, index) => '<tr><td>' + (index + 1) + '</td><td class="fw-semibold">' + escapeCandidate(item.title) + '</td><td>' + new Date(item.created_at).toLocaleDateString('id-ID') + '</td><td>' + escapeCandidate(item.location || '-') + '</td><td><span class="badge bg-warning text-dark">' + escapeCandidate(item.status) + '</span></td></tr>').join('') : '<tr><td colspan="5" class="text-center text-muted">Belum ada lamaran tersimpan.</td></tr>';
        } catch (error) { body.innerHTML = '<tr><td colspan="5" class="text-center text-muted">' + escapeCandidate(error.message) + '</td></tr>'; }
    }

    async function loadJobs() {
        const grid = document.getElementById('candidateJobList');
        try {
            const response = await fetch(candidateApi.jobs, { headers: { Accept: 'application/json' } });
            if (!response.ok) throw new Error('Lowongan tidak tersedia.');
            candidateJobs = await readCandidateResponse(response);
            populateCandidateJobFilters();
            filterCandidateJobs();
        } catch (error) { grid.innerHTML = '<div class="col-12 text-muted">' + escapeCandidate(error.message) + '</div>'; }
    }

    function populateCandidateJobFilters() {
        const department = document.getElementById('candidateDepartmentFilter');
        const location = document.getElementById('candidateLocationFilter');
        const departments = [...new Set(candidateJobs.map(job => job.department).filter(Boolean))].sort();
        const locations = [...new Set(candidateJobs.map(job => job.location).filter(Boolean))].sort();
        department.innerHTML = '<option value="">Semua Departemen</option>' + departments.map(value => '<option value="' + escapeCandidate(value) + '">' + escapeCandidate(value) + '</option>').join('');
        location.innerHTML = '<option value="">Semua Lokasi</option>' + locations.map(value => '<option value="' + escapeCandidate(value) + '">' + escapeCandidate(value) + '</option>').join('');
    }

    function filterCandidateJobs() {
        const search = document.getElementById('candidateJobSearch').value.toLowerCase().trim();
        const department = document.getElementById('candidateDepartmentFilter').value.toLowerCase();
        const location = document.getElementById('candidateLocationFilter').value.toLowerCase();
        const filtered = candidateJobs.filter(job => {
            const text = [job.title, job.description, job.department, job.location].join(' ').toLowerCase();
            return text.includes(search) && (!department || String(job.department).toLowerCase() === department) && (!location || String(job.location).toLowerCase() === location);
        });
        const grid = document.getElementById('candidateJobList');
        const empty = document.getElementById('candidateJobEmpty');
        grid.innerHTML = filtered.map(job => '<div class="col-md-6"><div class="value-card"><span class="badge bg-primary-subtle text-primary mb-2">' + escapeCandidate(job.department || 'Career') + '</span><h6 class="fw-bold text-dark">' + escapeCandidate(job.title) + '</h6><p class="small text-muted mb-2"><i class="fa-solid fa-location-dot me-1 text-danger"></i>' + escapeCandidate(job.location || 'Indonesia') + '</p><p class="small text-muted">' + escapeCandidate(job.description || '') + '</p><button class="btn btn-primary btn-sm" type="button" onclick="applyCandidateJob(' + Number(job.id) + ', \'' + escapeCandidate(job.title).replace(/'/g, "\\'") + '\')">Lamar Posisi</button></div></div>').join('');
        empty.classList.toggle('d-none', filtered.length > 0);
    }

    function resetCandidateJobFilters() {
        document.getElementById('candidateJobSearch').value = '';
        document.getElementById('candidateDepartmentFilter').value = '';
        document.getElementById('candidateLocationFilter').value = '';
        filterCandidateJobs();
    }

    function applyCandidateJob(jobId, title) {
        const fileInput = document.getElementById('candidateCv');
        const form = new FormData(); form.append('job_id', jobId);
        if (fileInput.files[0]) form.append('cv', fileInput.files[0]);
        if (!confirm('Kirim lamaran untuk posisi ' + title + (fileInput.files[0] ? ' menggunakan CV yang dipilih?' : ' menggunakan CV tersimpan?'))) return;
        fetch(candidateApi.applications, { method: 'POST', credentials: 'same-origin', headers: { Accept: 'application/json' }, body: form }).then(async response => { const result = await readCandidateResponse(response); if (!response.ok) throw new Error(result.message || 'Lamaran gagal dikirim.'); alert(result.message); switchTab('histori'); }).catch(error => alert(error.message));
    }

    async function logoutCandidate() {
        if (!confirm('Yakin ingin keluar dari portal kandidat?')) return;
        const response = await fetch(candidateApi.logout, { method: 'POST', credentials: 'same-origin', headers: { Accept: 'application/json' } });
        await readCandidateResponse(response); window.location.href = candidateHome;
    }

    function escapeCandidate(value) { return String(value ?? '').replace(/[&<>"']/g, char => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[char])); }

    fetch(candidateApi.profile, { credentials: 'same-origin', headers: { Accept: 'application/json' } }).then(async response => { if (response.status === 401) { window.location.href = candidateHome; return; } const profile = await response.json(); document.getElementById('profileName').value = profile.full_name || ''; try { applyProfileFields(JSON.parse(profile.profile || '{}')); } catch (error) { applyProfileFields({}); } }).catch(() => { window.location.href = candidateHome; });
</script>

</body>
</html>