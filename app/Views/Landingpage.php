<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Portal | PT Tumbakmas Niagasakti</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* Global CSS Variables */
        :root {
            --primary-color: #0d6efd;
            --primary-hover: #0b5ed7;
            --dark-bg: #0f172a;
            --surface: #ffffff;
            --surface-soft: #f8fafc;
            --text: #172033;
            --muted: #64748b;
            --border: #e2e8f0;
            --radius: 16px;
            --shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
            --shadow-hover: 0 18px 45px rgba(15, 23, 42, 0.13);
            --font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }

        body {
            font-family: var(--font-family);
            color: var(--text);
            background-color: #ffffff;
            overflow-x: hidden;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        section {
            scroll-margin-top: 80px;
        }

        /* Helper Classes */
        .fw-extrabold { font-weight: 800; }
        .max-w-700 { max-width: 700px; }
        .tracking-wider { letter-spacing: 0.08em; }
        .leading-relaxed { line-height: 1.7; }
        .extra-small { font-size: 0.75rem; }

        /* Fluid Typography untuk Judul */
        h1, .hero-title {
            font-size: clamp(1.85rem, 3vw + 0.5rem, 3.25rem) !important;
            line-height: 1.25;
        }
        h2, .section-title {
            font-size: clamp(1.4rem, 2vw + 0.5rem, 2.2rem) !important;
            line-height: 1.3;
        }
        h3 { 
            font-size: clamp(1.15rem, 1.2vw + 0.5rem, 1.65rem); 
        }

        /* =========================================================
           NAVBAR STYLING & RESPONSIVE FIXES
           ========================================================= */
        .navbar {
            min-height: 70px;
            transition: all 0.25s ease;
            background-color: #ffffff;
        }

        .navbar-brand {
            white-space: nowrap;
            font-size: clamp(1rem, 1.2vw, 1.25rem);
            flex-shrink: 0;
        }

        .navbar-nav {
            gap: 0.25rem;
        }

        .nav-link {
            position: relative;
            padding: 0.45rem 0.65rem !important;
            color: #475569 !important;
            font-size: clamp(0.825rem, 0.85vw, 0.925rem) !important;
            white-space: nowrap;
            transition: color 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        .nav-link.active::after {
            content: "";
            position: absolute;
            left: 0.65rem;
            right: 0.65rem;
            bottom: 0;
            height: 2px;
            border-radius: 10px;
            background: var(--primary-color);
        }

        #authNavButtons {
            flex-shrink: 0;
        }

        #authNavButtons .btn {
            font-size: clamp(0.78rem, 0.8vw, 0.875rem);
            padding: 0.45rem 1rem;
            white-space: nowrap;
        }

        /* Hero Section */
        .hero-section {
            padding: 4rem 0;
            background: 
                radial-gradient(circle at 85% 20%, rgba(13, 110, 253, 0.12), transparent 35%),
                linear-gradient(135deg, #f8fbff 0%, #edf4ff 55%, #f8fafc 100%);
        }

        .hero-image-wrapper {
            position: relative;
            max-width: 100%;
            margin: 0 auto;
        }

        .hero-image-wrapper img {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            border-radius: var(--radius);
        }

        .floating-card {
            border: 1px solid rgba(226, 232, 240, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.12) !important;
            z-index: 2;
        }

        /* Cards */
        .card, .value-card, .job-card {
            border: 1px solid var(--border) !important;
            border-radius: var(--radius);
        }

        .value-card, .job-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .value-card:hover, .job-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover) !important;
            border-color: rgba(13, 110, 253, 0.3) !important;
        }

        /* Search Panel */
        .job-search-panel {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1rem;
            box-shadow: var(--shadow);
        }

        .job-search-panel .form-control, 
        .job-search-panel .form-select {
            min-height: 44px;
            border-color: #e2e8f0;
            font-size: 0.9rem;
        }

        .job-empty {
            display: none;
            padding: 35px;
            text-align: center;
            color: var(--muted);
        }

        /* Modals & Divider */
        .divider-text {
            border-bottom: 1px solid #e2e8f0;
            line-height: 0.1em;
        }

        .divider-text span {
            background: #fff;
            padding: 0 10px;
            font-size: 0.8rem;
        }

        .btn-google {
            border: 1px solid #dadce0;
            background-color: #ffffff;
            color: #3c4043;
            transition: background-color 0.2s, box-shadow 0.2s;
        }

        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #d2e3fc;
            color: #202124;
            box-shadow: 0 1px 3px rgba(60,64,67,0.15);
        }

        /* Media Queries Responsif Laptop & Mobile */
        @media (min-width: 992px) {
            .floating-card {
                position: absolute;
                bottom: -20px;
                left: -20px;
                margin: 0;
            }
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                padding: 1rem 0;
            }
            .nav-link {
                padding: 0.5rem 0 !important;
            }
            .nav-link.active::after {
                display: none;
            }
            #authNavButtons {
                width: 100%;
                padding-top: 12px;
                margin-top: 8px;
                border-top: 1px solid var(--border);
            }
            #authNavButtons .btn {
                flex: 1;
            }
            .floating-card {
                position: relative;
                margin-top: -30px;
                margin-left: auto;
                margin-right: auto;
                max-width: 90%;
            }
        }

        @media (max-width: 767.98px) {
            .hero-section {
                padding: 2.5rem 0 !important;
            }
            .hero-image-wrapper img {
                max-height: 280px;
            }
            .py-5 {
                padding-top: 2.5rem !important;
                padding-bottom: 2.5rem !important;
            }
        }

        /* Shared readable type scale for desktop, tablet, and mobile. */
        body { font-size: 0.9375rem; line-height: 1.6; }
        h1, h2, h3, h4, h5, h6 { line-height: 1.3; overflow-wrap: anywhere; }
        .navbar { min-height: 64px; }
        .navbar-brand { font-size: 1rem; line-height: 1.25; }
        .nav-link { font-size: 0.875rem !important; line-height: 1.35; }
        .hero-section .lead { font-size: 0.9375rem !important; line-height: 1.65; }
        .section-title, h2 { font-size: clamp(1.35rem, 1.6vw + .65rem, 2rem) !important; }
        .job-card h5, .value-card h5 { font-size: 1rem; line-height: 1.35; }
        .job-card p, .value-card p, .job-search-panel, .form-label, .form-control, .form-select, .btn { font-size: 0.875rem; line-height: 1.45; }
        .extra-small { font-size: 0.75rem; line-height: 1.45; }
        .job-search-panel .form-control, .job-search-panel .form-select { min-height: 42px; }
        .modal-title { font-size: 1.05rem; }
        .modal-body { font-size: 0.875rem; }
        .modal .form-control { min-height: 42px; }
        @media (min-width: 768px) and (max-width: 1199px) {
            .container { width: min(100% - 32px, 1000px); }
            .navbar-nav { gap: 0; }
            .nav-link { padding-left: 0.5rem !important; padding-right: 0.5rem !important; font-size: 0.8125rem !important; }
            .hero-section { padding: 3.25rem 0; }
        }
        @media (max-width: 767.98px) {
            body { font-size: 0.90625rem; }
            .container { width: min(100% - 24px, 680px); }
            .hero-section { padding: 2.75rem 0 !important; }
            .hero-section .lead { font-size: 0.875rem !important; }
            .hero-section .btn, .job-search-panel .btn { min-height: 42px; white-space: normal; }
            .floating-card { font-size: 0.8125rem; }
            .navbar-brand { max-width: 72%; font-size: 0.9375rem; }
        }
        @media (max-width: 420px) {
            .container { width: min(100% - 16px, 390px); }
            .hero-title, h1 { font-size: 1.75rem !important; }
            .section-title, h2 { font-size: 1.35rem !important; }
            .job-card h5, .value-card h5 { font-size: 0.9375rem; }
            .job-card p, .value-card p, .job-search-panel, .form-label, .form-control, .form-select, .btn { font-size: 0.8125rem; }
            .modal-body { font-size: 0.8125rem; }
            .modal-dialog { margin: 0.75rem; }
        }
    </style>
    <link rel="stylesheet" href="<?= esc(site_url('recruitment/landing.css')) ?>">
</head>
<body>

    <!-- NAVBAR HEADER -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="brand-icon bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="fa-solid fa-briefcase fs-6"></i>
                </div>
                <span class="fw-bold text-dark">Tumbakmas<span class="text-primary">Career</span></span>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-semibold">
                    <li class="nav-item"><a class="nav-link active" href="#hero">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#values">Nilai Perusahaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#development">Pengembangan Karir</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jobs">Lowongan Kerja</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2" id="authNavButtons">
                    <button class="btn btn-outline-primary rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modalLogin">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk
                    </button>
                    <button class="btn btn-primary rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modalRegister">
                        <i class="fa-solid fa-user-plus me-1"></i> Buat Akun
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="hero" class="hero-section position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill mb-3 d-inline-block">
                        <i class="fa-solid fa-rocket me-1"></i> Mulai Perjalanan Karirmu
                    </span>
                    <h1 class="fw-extrabold text-dark mb-3">
                        Bangun Masa Depan Bermakna Bersama <span class="text-primary">Tumbakmas Group</span>
                    </h1>
                    <p class="lead text-muted mb-4 fs-6">
                        Temukan ruang bertumbuh, wujudkan ide inovatif, dan kembangkan potensi terbaikmu dalam lingkungan kerja yang kolaboratif dan dinamis.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#jobs" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                            <i class="fa-solid fa-magnifying-glass me-2"></i> Jelajahi Lowongan
                        </a>
                        <button class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalRegister">
                            Daftar Sekarang
                        </button>
                    </div>
                    <!-- Stat Bar -->
                    <div class="row mt-4 pt-3 border-top g-3">
                        <div class="col-4">
                            <h3 class="fw-bold text-dark mb-0">15+</h3>
                            <p class="text-muted small mb-0">Cabang Penjualan</p>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold text-dark mb-0">1.000+</h3>
                            <p class="text-muted small mb-0">Talenta Hebat</p>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold text-dark mb-0">100%</h3>
                            <p class="text-muted small mb-0">Komitmen Karir</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="Tim Tumbakmas" class="img-fluid rounded-4 shadow">
                        <div class="floating-card bg-white p-3 rounded-3 d-flex align-items-center gap-3">
                            <div class="icon-circle bg-success text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fa-solid fa-chart-line fs-6"></i>
                            </div>
                            <div class="text-start">
                                <span class="fw-bold d-block text-dark small">Fast Track Program</span>
                                <span class="text-muted extra-small">Akselerasi Karir Berkelanjutan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VISI & MISI SECTION -->
    <section id="about" class="py-5 bg-light">
        <div class="container py-2">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="text-primary fw-bold text-uppercase small tracking-wider">Mengenal Perusahaan</span>
                <h2 class="fw-bold text-dark mt-2">Visi &amp; Misi Perusahaan</h2>
                <p class="text-muted">Landasan dan dorongan utama kami dalam memberikan nilai terbaik bagi mitra, pelanggan, dan seluruh talenta perusahaan.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 rounded-4 p-4 shadow-sm h-100 bg-white">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="p-3 bg-primary text-white rounded-3 fs-4 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-eye fs-5"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-0 fs-5">Visi Kami</h4>
                        </div>
                        <p class="text-muted leading-relaxed mb-0 small">
                            Menjadi perusahaan distribusi dan perdagangan terkemuka di Indonesia yang tepercaya, terintegrasi secara digital, serta berkelanjutan dengan standar operasional kelas dunia.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 rounded-4 p-4 shadow-sm h-100 bg-white">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="p-3 bg-success text-white rounded-3 fs-4 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-bullseye fs-5"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-0 fs-5">Misi Kami</h4>
                        </div>
                        <ul class="text-muted leading-relaxed mb-0 ps-3 small">
                            <li class="mb-2">Menyediakan rantai pasok dan layanan distribusi produk berkualitas secara efisien dan merata.</li>
                            <li class="mb-2">Mengembangkan kapabilitas SDM yang profesional, adaptif, dan berintegritas tinggi.</li>
                            <li>Mengoptimalkan inovasi teknologi informasi dalam setiap proses operasional.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CORE VALUES SECTION -->
    <section id="values" class="py-5">
        <div class="container py-2">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="text-primary fw-bold text-uppercase small tracking-wider">Budaya Kerja</span>
                <h2 class="fw-bold text-dark mt-2">Nilai-Nilai Utama (Core Values)</h2>
                <p class="text-muted">Prinsip dasar yang menuntun pola pikir dan cara kerja setiap individu di PT Tumbakmas Niagasakti.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="value-card p-4 rounded-4 border bg-white text-center h-100">
                        <div class="icon-wrapper mb-3 text-primary fs-2"><i class="fa-solid fa-handshake-simple"></i></div>
                        <h5 class="fw-bold text-dark mb-2 fs-5">Integrity</h5>
                        <p class="text-muted small mb-0">Jujur, transparan, dan memegang teguh etika bisnis profesional dalam setiap tindakan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card p-4 rounded-4 border bg-white text-center h-100">
                        <div class="icon-wrapper mb-3 text-success fs-2"><i class="fa-solid fa-lightbulb"></i></div>
                        <h5 class="fw-bold text-dark mb-2 fs-5">Innovation</h5>
                        <p class="text-muted small mb-0">Berani mencoba gagasan baru, adaptif terhadap perkembangan teknologi, dan solutif.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card p-4 rounded-4 border bg-white text-center h-100">
                        <div class="icon-wrapper mb-3 text-warning fs-2"><i class="fa-solid fa-users"></i></div>
                        <h5 class="fw-bold text-dark mb-2 fs-5">Teamwork</h5>
                        <p class="text-muted small mb-0">Saling mendampingi, menghargai keberagaman, dan bekerja sama mencapai target bersama.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PEOPLE DEVELOPMENT -->
    <section id="development" class="py-5 bg-dark text-white">
        <div class="container py-2">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-5">
                    <span class="text-info fw-bold text-uppercase small tracking-wider">People Development</span>
                    <h2 class="fw-bold mt-2 text-white">Kenapa Harus Mengembangkan Karir Bersama Kami?</h2>
                    <p class="text-light-50 fs-6 mt-3">
                        Kami percaya bahwa kemajuan perusahaan berawal dari pertumbuhan setiap individunya. Melalui <em>Training Needs Analysis</em> yang terstruktur, kami mendampingi setiap perjalanan karier Anda.
                    </p>
                    <div class="d-flex flex-column gap-3 mt-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-primary rounded text-white mt-1 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="fa-solid fa-graduation-cap fs-6"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Pelatihan &amp; Sertifikasi Berkelanjutan</h6>
                                <p class="small text-light-50 mb-0">Program pembekalan manajerial, teknis K3, serta kompetensi fungsional.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-success rounded text-white mt-1 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="fa-solid fa-sitemap fs-6"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Jalur Karir Transparan (Career Path)</h6>
                                <p class="small text-light-50 mb-0">Evaluasi performa berbasis KPI &amp; 9-Box Matrix untuk kepastian promosi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 h-100">
                                <div class="fs-3 text-info mb-2"><i class="fa-solid fa-seedling"></i></div>
                                <h5 class="fw-bold text-white fs-6">Fresh Graduate Pathway</h5>
                                <p class="small text-light-50 mb-0">Program pendampingan bagi lulusan baru untuk siap menjadi calon pemimpin masa depan.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 h-100">
                                <div class="fs-3 text-warning mb-2"><i class="fa-solid fa-briefcase"></i></div>
                                <h5 class="fw-bold text-white fs-6">Professional Track</h5>
                                <p class="small text-light-50 mb-0">Wadah bagi tenaga berpengalaman untuk mengakselerasi ide dan kompetensi spesifik.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 h-100">
                                <div class="fs-3 text-success mb-2"><i class="fa-solid fa-user-tie"></i></div>
                                <h5 class="fw-bold text-white fs-6">Leadership Academy</h5>
                                <p class="small text-light-50 mb-0">Sertifikasi dan pelatihan kepemimpinan untuk menduduki jenjang Supervisor &amp; Managerial.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 h-100">
                                <div class="fs-3 text-danger mb-2"><i class="fa-solid fa-heart"></i></div>
                                <h5 class="fw-bold text-white fs-6">Work-Life Balance</h5>
                                <p class="small text-light-50 mb-0">Aktivitas kebersamaan, apresiasi kinerja, serta lingkungan kerja yang sehat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LOWONGAN KERJA AKTIF -->
    <section id="jobs" class="py-5 bg-light">
        <div class="container py-2">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4 gap-3">
                <div>
                    <span class="text-primary fw-bold text-uppercase small tracking-wider">Peluang Karir</span>
                    <h2 class="fw-bold text-dark mb-0">Lowongan Kerja Terkini</h2>
                </div>
                <!-- Search & Filter Panel -->
                <div class="job-search-panel w-100 w-lg-auto">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                                </span>
                                <input type="text" id="searchJobInput" class="form-control border-start-0 rounded-end-pill" placeholder="Cari posisi atau kata kunci..." oninput="filterJobs()">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <select id="departmentFilter" class="form-select rounded-pill" onchange="filterJobs()">
                                <option value="">Semua Departemen</option>
                                <option value="sales">Sales &amp; Marketing</option>
                                <option value="logistik">Logistik &amp; Gudang</option>
                                <option value="human">Human Capital</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <select id="locationFilter" class="form-select rounded-pill" onchange="filterJobs()">
                                <option value="">Semua Lokasi</option>
                                <option value="madiun">Madiun</option>
                                <option value="sidoarjo">Sidoarjo</option>
                                <option value="semarang">Semarang</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-2">
                            <button class="btn btn-light border rounded-pill w-100 fw-semibold" onclick="resetJobFilters()">
                                <i class="fa-solid fa-rotate-left me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Cards Grid -->
            <div class="row g-4" id="jobGrid">
                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4 job-item" data-title="Area Sales Supervisor" data-location="Madiun" data-department="sales">
                    <div class="card border-0 rounded-4 p-4 shadow-sm h-100 job-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill">Sales &amp; Marketing</span>
                            <small class="text-muted"><i class="fa-solid fa-clock me-1"></i>Aktif</small>
                        </div>
                        <h5 class="fw-bold text-dark mb-1 fs-5">Area Sales Supervisor</h5>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> Sales Office Madiun</p>
                        <p class="text-secondary small mb-4">Bertanggung jawab atas pencapaian target penjualan area, supervisi tim lapangan, dan penetrasi pasar regional.</p>
                        <div class="mt-auto d-flex align-items-center justify-content-between border-top pt-3">
                            <span class="fw-semibold text-dark small">Full-time</span>
                            <button class="btn btn-sm btn-primary rounded-pill px-3 fw-bold" onclick="handleApplyJob(null, 'Area Sales Supervisor')">Lamar Posisi</button>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4 job-item" data-title="Warehouse Supervisor" data-location="Sidoarjo" data-department="logistik">
                    <div class="card border-0 rounded-4 p-4 shadow-sm h-100 job-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-success-subtle text-success fw-bold px-3 py-2 rounded-pill">Logistik &amp; Gudang</span>
                            <small class="text-muted"><i class="fa-solid fa-clock me-1"></i>Aktif</small>
                        </div>
                        <h5 class="fw-bold text-dark mb-1 fs-5">Warehouse Supervisor</h5>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> Sub-Cabang Sidoarjo</p>
                        <p class="text-secondary small mb-4">Mengelola inventaris, kontrol stok opname, penerapan budaya 5R gudang, serta ketaatan standar K3.</p>
                        <div class="mt-auto d-flex align-items-center justify-content-between border-top pt-3">
                            <span class="fw-semibold text-dark small">Full-time</span>
                            <button class="btn btn-sm btn-primary rounded-pill px-3 fw-bold" onclick="handleApplyJob(null, 'Warehouse Supervisor')">Lamar Posisi</button>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4 job-item" data-title="HRGA Officer" data-location="Semarang" data-department="human">
                    <div class="card border-0 rounded-4 p-4 shadow-sm h-100 job-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-warning-subtle text-warning-emphasis fw-bold px-3 py-2 rounded-pill">Human Capital</span>
                            <small class="text-muted"><i class="fa-solid fa-clock me-1"></i>Aktif</small>
                        </div>
                        <h5 class="fw-bold text-dark mb-1 fs-5">HRGA Officer</h5>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> Area Semarang</p>
                        <p class="text-secondary small mb-4">Menangani rekrutmen end-to-end, pengelolaan fasilitas kantor, serta hubungan industrial karyawan.</p>
                        <div class="mt-auto d-flex align-items-center justify-content-between border-top pt-3">
                            <span class="fw-semibold text-dark small">Full-time</span>
                            <button class="btn btn-sm btn-primary rounded-pill px-3 fw-bold" onclick="handleApplyJob(null, 'HRGA Officer')">Lamar Posisi</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="jobEmpty" class="job-empty bg-white rounded-4 border mt-4">
                <i class="fa-solid fa-magnifying-glass fs-2 mb-3 text-muted"></i>
                <h5 class="fw-bold text-dark">Lowongan tidak ditemukan</h5>
                <p class="small mb-3">Coba ubah kata kunci atau filter pencarian Anda.</p>
                <button class="btn btn-primary rounded-pill px-4" onclick="resetJobFilters()">Tampilkan Semua Lowongan</button>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-4 border-top border-secondary">
        <div class="container text-center">
            <p class="small text-muted mb-0">© 2026 PT Tumbakmas Niagasakti. Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </footer>

    <!-- ================= MODAL AUTENTIKASI ================= -->

    <!-- 1. MODAL LOGIN -->
    <div class="modal fade" id="modalLogin" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 p-3 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Masuk ke Akun Karir</h5>
                        <p class="text-muted small mb-0">Silakan masuk untuk melanjutkan lamaran Anda</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Google / Gmail SSO Login Button -->
                    <button class="btn btn-google w-100 rounded-pill py-2 mb-3 fw-semibold d-flex align-items-center justify-content-center gap-2" onclick="loginWithGoogle()">
                        <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
                        Lanjutkan dengan Gmail
                    </button>
                    
                    <div class="text-center text-muted small my-3 position-relative divider-text">
                        <span>atau masuk via email</span>
                    </div>
                    
                    <form id="loginForm" onsubmit="submitLogin(event)">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label small fw-semibold mb-1">Email / Gmail</label>
                            <input type="email" class="form-control rounded-pill px-3" id="loginEmail" placeholder="nama@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label small fw-semibold mb-1">Kata Sandi</label>
                            <input type="password" class="form-control rounded-pill px-3" id="loginPassword" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm">Masuk Sekarang</button>
                    </form>

                    <div class="text-center mt-3 pt-2 border-top">
                        <span class="small text-muted">Belum punya akun? </span>
                        <a href="#" class="small fw-bold text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalRegister" data-bs-dismiss="modal">Buat Akun di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MODAL REGISTER (BUAT AKUN GMAIL / EMAIL) -->
    <div class="modal fade" id="modalRegister" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 p-3 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Buat Akun Karir Baru</h5>
                        <p class="text-muted small mb-0">Daftar untuk mulai melamar pekerjaan di Tumbakmas</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Google / Gmail SSO Register Button -->
                    <button class="btn btn-google w-100 rounded-pill py-2 mb-3 fw-semibold d-flex align-items-center justify-content-center gap-2" onclick="registerWithGoogle()">
                        <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
                        Daftar dengan Google / Gmail
                    </button>

                    <div class="text-center text-muted small my-3 position-relative divider-text">
                        <span>atau buat akun manual</span>
                    </div>

                    <form id="registerForm" onsubmit="submitRegister(event)">
                        <div class="mb-2">
                            <label for="regName" class="form-label small fw-semibold mb-1">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-pill px-3" id="regName" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        <div class="mb-2">
                            <label for="regEmail" class="form-label small fw-semibold mb-1">Alamat Email / Gmail</label>
                            <input type="email" class="form-control rounded-pill px-3" id="regEmail" placeholder="nama@gmail.com" required>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label for="regPassword" class="form-label small fw-semibold mb-1">Kata Sandi</label>
                                <input type="password" class="form-control rounded-pill px-3" id="regPassword" placeholder="Min. 8 karakter" required minlength="8">
                            </div>
                            <div class="col-6">
                                <label for="regPasswordConfirm" class="form-label small fw-semibold mb-1">Konfirmasi Sandi</label>
                                <input type="password" class="form-control rounded-pill px-3" id="regPasswordConfirm" placeholder="Ulangi kata sandi" required>
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                            <label class="form-check-label extra-small text-muted" for="termsCheck">
                                Saya menyetujui <a href="#" class="text-primary text-decoration-none">Syarat &amp; Ketentuan</a> serta Kebijakan Privasi PT Tumbakmas Niagasakti.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm">Daftar Akun Sekarang</button>
                    </form>

                    <div class="text-center mt-3 pt-2 border-top">
                        <span class="small text-muted">Sudah memiliki akun? </span>
                        <a href="#" class="small fw-bold text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalLogin" data-bs-dismiss="modal">Masuk di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const careerUrl = path => new URL(path, document.baseURI).toString();
        const careerApi = { csrf: careerUrl('career/csrf-token'), jobs: careerUrl('api/recruitment/jobs'), login: careerUrl('career/login'), register: careerUrl('career/register'), portal: careerUrl('career/portal') };

        async function postCareer(url, payload) {
            const token = (await (await fetch(careerApi.csrf, { credentials: 'same-origin' })).json()).token;
            const response = await fetch(url, { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, Accept: 'application/json' }, body: JSON.stringify(payload) });
            const result = await response.json();
            if (!response.ok) throw new Error(result.message || Object.values(result.errors || {}).flat()[0] || 'Permintaan tidak dapat diproses.');
            return result;
        }

        async function loadPublishedJobs() {
            try {
                const response = await fetch(careerApi.jobs, { headers: { Accept: 'application/json' } });
                if (!response.ok) return;
                const jobs = await response.json();
                const grid = document.getElementById('jobGrid');
                if (!grid || !jobs.length) return;
                grid.innerHTML = jobs.map(job => `<div class="col-md-6 col-lg-4 job-item" data-title="${escapeHtml(job.title)}" data-location="${escapeHtml(job.location || '')}" data-department="${escapeHtml((job.department || '').toLowerCase())}"><div class="card border-0 rounded-4 p-4 shadow-sm h-100 job-card"><div class="d-flex justify-content-between align-items-start mb-3"><span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill">${escapeHtml(job.department || 'Career')}</span><small class="text-muted"><i class="fa-solid fa-clock me-1"></i>Aktif</small></div><h5 class="fw-bold text-dark mb-1 fs-5">${escapeHtml(job.title)}</h5><p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i>${escapeHtml(job.location || 'Indonesia')}</p><p class="text-secondary small mb-4">${escapeHtml(job.description || 'Kesempatan karier bersama Tumbakmas Group.')}</p><div class="mt-auto d-flex align-items-center justify-content-between border-top pt-3"><span class="fw-semibold text-dark small">${escapeHtml((job.employment_type || 'full_time').replace('_', '-'))}</span><button class="btn btn-sm btn-primary rounded-pill px-3 fw-bold" onclick="handleApplyJob(${job.id || 'null'}, '${escapeJs(job.title)}')">Lamar Posisi</button></div></div></div>`).join('');
                filterJobs();
            } catch (error) { console.warn('Lowongan live belum tersedia:', error.message); }
        }

        function escapeHtml(value) { return String(value ?? '').replace(/[&<>"']/g, char => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[char])); }
        function escapeJs(value) { return String(value ?? '').replace(/\\/g, '\\\\').replace(/'/g, "\\'"); }

        // Filter Lowongan Kerja
        function filterJobs() {
            const searchVal = document.getElementById('searchJobInput').value.toLowerCase();
            const deptVal = document.getElementById('departmentFilter').value.toLowerCase();
            const locVal = document.getElementById('locationFilter').value.toLowerCase();
            
            const items = document.querySelectorAll('.job-item');
            let visibleCount = 0;

            items.forEach(item => {
                const title = item.getAttribute('data-title').toLowerCase();
                const dept = item.getAttribute('data-department').toLowerCase();
                const loc = item.getAttribute('data-location').toLowerCase();

                const matchesSearch = title.includes(searchVal);
                const matchesDept = deptVal === '' || dept.includes(deptVal);
                const matchesLoc = locVal === '' || loc.includes(locVal);

                if (matchesSearch && matchesDept && matchesLoc) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            document.getElementById('jobEmpty').style.display = visibleCount === 0 ? 'block' : 'none';
        }

        function resetJobFilters() {
            document.getElementById('searchJobInput').value = '';
            document.getElementById('departmentFilter').value = '';
            document.getElementById('locationFilter').value = '';
            filterJobs();
        }

        function handleApplyJob(jobId, title) {
            if (!jobId) {
                new bootstrap.Modal(document.getElementById('modalLogin')).show();
                return;
            }
            window.location.href = careerApi.portal + '?job=' + encodeURIComponent(jobId);
        }

        // Fungsi Autentikasi Google / Gmail
        function loginWithGoogle() {
            alert('Google OAuth belum dikonfigurasi. Gunakan login email untuk sementara.');
        }

        function registerWithGoogle() {
            alert('Google OAuth belum dikonfigurasi. Gunakan pendaftaran email untuk sementara.');
        }

        function submitLogin(e) {
            e.preventDefault();
            postCareer(careerApi.login, { email: document.getElementById('loginEmail').value, password: document.getElementById('loginPassword').value }).then(result => { window.location.href = careerUrl(result.redirect); }).catch(error => alert(error.message));
        }

        function submitRegister(e) {
            e.preventDefault();
            const pass = document.getElementById('regPassword').value;
            const confirmPass = document.getElementById('regPasswordConfirm').value;

            if (pass !== confirmPass) {
                alert('Konfirmasi kata sandi tidak cocok!');
                return;
            }

            postCareer(careerApi.register, { name: document.getElementById('regName').value, email: document.getElementById('regEmail').value, password: pass, password_confirmation: confirmPass }).then(result => { window.location.href = careerUrl(result.redirect); }).catch(error => alert(error.message));
        }

        loadPublishedJobs();
    </script>
</body>
</html>