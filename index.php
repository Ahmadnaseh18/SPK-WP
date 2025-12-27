<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Hybrid | AHP - WP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #003d99 100%);
            color: white;
            padding: 100px 0;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0% 100%);
        }
        .card-method {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
            height: 100%;
        }
        .card-method:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .icon-box {
            width: 70px;
            height: 70px;
            background: #e7f1ff;
            color: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 20px;
        }
        .btn-login {
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .navbar {
            background: rgba(13, 110, 253, 0.95) !important;
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fas fa-brain me-2"></i> SPK HYBRID</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-login" href="auth/login.php">
                            <i class="fas fa-sign-in-alt me-2"></i> Masuk Sistem
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Sistem Pendukung Keputusan Multi-Kriteria</h1>
                    <p class="lead mb-5 opacity-75">Implementasi Metode Hybrid <strong>Analytical Hierarchy Process (AHP)</strong> untuk pembobotan kriteria dan <strong>Weighted Product (WP)</strong> untuk perankingan alternatif secara akurat.</p>
                    <a href="#tentang" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold text-primary shadow">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </header>

    <section id="tentang" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Metodologi Yang Digunakan</h2>
                <div class="mx-auto bg-primary" style="height: 3px; width: 80px;"></div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card card-method shadow-sm p-4">
                        <div class="icon-box">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h4 class="fw-bold">AHP (Analytic Hierarchy Process)</h4>
                        <p class="text-muted">Metode yang digunakan untuk memecahkan situasi yang kompleks tidak terstruktur ke dalam bagian-bagian komponennya. Pada sistem ini, AHP bertugas untuk mencari <strong>bobot prioritas</strong> antar kriteria melalui perbandingan berpasangan.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-method shadow-sm p-4">
                        <div class="icon-box">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="fw-bold">WP (Weighted Product)</h4>
                        <p class="text-muted">Metode penyelesaian dengan menggunakan perkalian untuk menghubungkan rating atribut. Pada sistem ini, WP bertugas melakukan <strong>perankingan alternatif</strong> berdasarkan bobot yang telah dihasilkan oleh metode AHP.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 shadow" alt="Dashboard Preview">
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h2 class="fw-bold mb-4">Kenapa Menggunakan SPK Hybrid?</h2>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3"><i class="fas fa-check-circle fa-2x"></i></div>
                        <div>
                            <h5 class="fw-bold">Objektivitas Tinggi</h5>
                            <p class="text-muted">Pembobotan kriteria dihitung secara matematis melalui uji konsistensi AHP.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3"><i class="fas fa-bolt fa-2x"></i></div>
                        <div>
                            <h5 class="fw-bold">Proses Cepat</h5>
                            <p class="text-muted">Perhitungan perankingan WP dilakukan secara otomatis oleh sistem.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="text-primary me-3"><i class="fas fa-shield-alt fa-2x"></i></div>
                        <div>
                            <h5 class="fw-bold">Hasil Akurat</h5>
                            <p class="text-muted">Kombinasi dua metode memastikan hasil akhir yang lebih valid dan terpercaya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Sistem Pendukung Keputusan Kelompok 7</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>