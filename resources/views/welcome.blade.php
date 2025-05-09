<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Lucky Mini Soccer - Booking Lapangan Mini Soccer Online</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('images/dmp-futsal-icon.png') }}">
        <link rel="shortcut icon" type="image/ico" href="{{ asset('images/dmp-futsal-icon.ico') }}">

        <style>
            :root {
                --primary-color: #1a73e8;
                --secondary-color: #1557b0;
                --accent-color: #0d47a1;
                --text-color: #333;
                --light-bg: #f8f9fa;
            }

            body {
                font-family: 'Poppins', sans-serif;
                background-color: var(--light-bg);
                color: var(--text-color);
            }

            /* Navbar Styles */
            .navbar {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                padding: 1rem 0;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            }

            .navbar-brand {
                font-size: 1.5rem;
                font-weight: 700;
                letter-spacing: 1px;
            }

            .nav-link {
                font-weight: 500;
                text-transform: uppercase;
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
                margin: 0 0.2rem;
                border-radius: 5px;
                transition: all 0.3s ease;
            }

            .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.1);
                transform: translateY(-2px);
            }

            /* Card Styles */
            .card {
                border: none;
                border-radius: 15px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
                overflow: hidden;
                margin-bottom: 2rem;
            }

            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            }

            .card-header {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                font-weight: 600;
                padding: 1rem 1.5rem;
                border-bottom: none;
            }

            .card-img-top {
                height: 250px;
                object-fit: cover;
                transition: transform 0.5s ease;
            }

            .card:hover .card-img-top {
                transform: scale(1.1);
            }

            .card-body {
                padding: 2rem;
            }

            .card-title {
                font-weight: 600;
                margin-bottom: 1rem;
                color: var(--primary-color);
            }

            /* Button Styles */
            .btn-primary {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                border: none;
                padding: 0.8rem 2rem;
                border-radius: 50px;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 1px;
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            /* Calendar Styles */
            .fc-content {
                padding: 0.5rem;
                border-radius: 5px;
            }

            .fc-title {
                font-size: 0.85rem;
                font-weight: 500;
            }

            .fc-event {
                border-radius: 5px;
                border: none;
                padding: 2px;
                margin: 2px 0;
                background: var(--primary-color);
            }

            /* Footer Styles */
            .footer {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                padding: 4rem 0 2rem;
            }

            .footer h5 {
                font-weight: 600;
                margin-bottom: 1.5rem;
                position: relative;
            }

            .footer h5::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: -10px;
                width: 50px;
                height: 2px;
                background: white;
            }

            .footer p {
                font-size: 0.9rem;
                line-height: 1.8;
            }

            .footer a {
                color: white;
                margin: 0 1rem;
                font-size: 1.2rem;
                transition: all 0.3s ease;
            }

            .footer a:hover {
                color: rgba(255, 255, 255, 0.8);
                transform: translateY(-3px);
            }

            /* Map Styles */
            #map-wrapper {
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            /* Responsive Adjustments */
            @media (max-width: 768px) {
                .card {
                    margin: 1rem 0;
                }
                
                .footer {
                    text-align: center;
                }

                .footer h5::after {
                    left: 50%;
                    transform: translateX(-50%);
                }
            }

            /* Hero Section Styles */
            .hero-section {
                background: linear-gradient(rgba(26, 115, 232, 0.9), rgba(13, 71, 161, 0.9)), url('path_to_soccer_field_image.jpg');
                background-size: cover;
                background-position: center;
                color: white;
                padding: 6rem 0;
                position: relative;
                overflow: hidden;
            }

            .hero-title {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
                margin-bottom: 2rem;
            }

            .animated-text {
                min-height: 50px;
                margin-top: 2rem;
                font-size: 1.5rem;
                font-weight: 500;
                color: rgba(255, 255, 255, 0.9);
            }

            .text-slide {
                display: none;
                animation: fadeInOut 5s ease-in-out;
            }

            .text-slide.active {
                display: block;
            }

            @keyframes fadeInOut {
                0% {
                    opacity: 0;
                    transform: translateY(20px);
                }
                20% {
                    opacity: 1;
                    transform: translateY(0);
                }
                80% {
                    opacity: 1;
                    transform: translateY(0);
                }
                100% {
                    opacity: 0;
                    transform: translateY(-20px);
                }
            }

            /* Additional Styles */
            .feature-icon {
                font-size: 3rem;
                color: var(--primary-color);
                margin-bottom: 1.5rem;
            }

            .pricing-card {
                transition: all 0.3s ease;
            }

            .pricing-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .feature-item {
                padding: 1.5rem;
                border-radius: 10px;
                transition: all 0.3s ease;
            }

            .feature-item:hover {
                background-color: rgba(26, 115, 232, 0.05);
            }

            .testimonial-card {
                padding: 2rem;
            }

            .testimonial-card .quote {
                font-size: 1.1rem;
                font-style: italic;
                margin-bottom: 1.5rem;
            }

            .membership-card {
                border: 2px solid var(--primary-color);
                border-radius: 15px;
                overflow: hidden;
            }

            .membership-card .card-header {
                background: var(--primary-color);
                color: white;
                text-align: center;
                padding: 1.5rem;
            }

            .membership-price {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--primary-color);
            }

            .membership-feature {
                padding: 0.5rem 0;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .membership-feature:last-child {
                border-bottom: none;
            }

            /* Modal Styles */
            .modal-content {
                border: none;
                border-radius: 15px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .modal-header {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                border-bottom: none;
            }

            .modal-header .close {
                color: white;
                opacity: 0.8;
                transition: all 0.3s ease;
            }

            .modal-header .close:hover {
                opacity: 1;
            }

            .modal-body {
                padding: 2rem;
            }

            .form-group label {
                font-weight: 500;
                color: var(--text-color);
            }

            .form-control {
                border-radius: 8px;
                padding: 0.75rem 1rem;
                border: 1px solid rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(26, 115, 232, 0.25);
            }

            .modal .btn-primary {
                padding: 0.75rem 2rem;
                font-weight: 500;
                letter-spacing: 0.5px;
                margin-top: 1rem;
            }

            .invalid-feedback {
                font-size: 0.85rem;
                margin-top: 0.5rem;
            }

            /* Booking Modal Styles */
            #bookingModal .modal-content {
                border: none;
                border-radius: 15px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            #bookingModal .modal-header {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                border-bottom: none;
            }

            #bookingModal .modal-body {
                padding: 2rem;
            }

            #bookingModal .form-group {
                margin-bottom: 1.5rem;
            }

            #bookingModal .form-control {
                border-radius: 8px;
                padding: 0.75rem 1rem;
                border: 1px solid rgba(0, 0, 0, 0.1);
            }

            #bookingModal .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(26, 115, 232, 0.25);
            }

            #bookingModal .btn-primary {
                padding: 0.75rem 2rem;
                font-weight: 500;
                letter-spacing: 0.5px;
                margin-top: 1rem;
            }

            /* Datetimepicker Styles */
            .bootstrap-datetimepicker-widget.dropdown-menu {
                width: auto;
                padding: 10px;
                margin: 2px 0;
            }

            .bootstrap-datetimepicker-widget table td.active, 
            .bootstrap-datetimepicker-widget table td.active:hover {
                background-color: var(--primary-color);
                color: #fff;
                text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
            }

            .bootstrap-datetimepicker-widget table td {
                border-radius: 0;
                height: 32px;
                line-height: 32px;
            }

            .bootstrap-datetimepicker-widget .timepicker-hour,
            .bootstrap-datetimepicker-widget .timepicker-minute {
                margin: 0;
                padding: 0;
                font-size: 1.2em;
            }

            .bootstrap-datetimepicker-widget button[data-action] {
                padding: 6px;
            }
        </style>
         </head>
    <body class="antialiased">
        @if(session('success'))
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            }
        </script>
        @endif

        @if(session('error'))
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#1a73e8'
                });
            }
        </script>
        @endif

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-futbol mr-2"></i>
                    Lucky Mini Soccer
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#registerModal">
                                    <i class="fas fa-user-plus mr-1"></i> Register
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">
                                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                                </a>
                            </li>
                        @endguest
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
                                <i class="fas fa-user-circle mr-1"></i> {{ auth()->user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Register</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="hero-title">Selamat Datang di Lucky Mini Soccer</h1>
                        <p class="hero-subtitle">Temukan dan booking lapangan mini soccer favorit Anda dengan mudah dan cepat.</p>
                        <div class="animated-text">
                            <div class="text-slide">🏆 "Lapangan Berstandar Internasional"</div>
                            <div class="text-slide">⚽ "Rasakan Sensasi Bermain Seperti di Liga Champions"</div>
                            <div class="text-slide">🌟 "Tempat Lahirnya Bakat-Bakat Muda Sepakbola"</div>
                            <div class="text-slide">🎯 "Booking Sekarang, Mainnya Kapan Saja!"</div>
                            <div class="text-slide">🔥 "Fasilitas Lengkap, Pengalaman Maksimal"</div>
                            <div class="text-slide">🗿 "Venue Liga Champions 2045"</div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Arena Cards Section -->
        <div class="container my-5">
            <h2 class="text-center mb-5">Pilihan Lapangan</h2>
            <div class="row">
                @foreach($arenas as $arena)      
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                        @if($arena->photo)
                                <img src="{{ $arena->photo->getUrl() }}" class="card-img-top" alt="Lapangan {{ $arena->number }}">
                        @endif
                            <div class="card-body text-center">
                                <h5 class="card-title">Lapangan {{ $arena->number }}</h5>
                                <p class="card-text h5 text-primary mb-4">Rp{{ number_format($arena->price,2,',','.') }} / Jam</p>
                                @auth
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookingModal" data-arena="{{ $arena->number }}" data-arenaid="{{ $arena->id }}">
                                    <i class="fas fa-calendar-check mr-2"></i>Booking Sekarang
                                    </button>
                                @else
                                    <button onclick="showLoginAlert()" class="btn btn-primary">
                                        <i class="fas fa-calendar-check mr-2"></i>Booking Sekarang
                                    </button>
                                @endauth
                        </div>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="container my-5">    
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Jadwal Booking Lapangan
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
        
        <!-- Facilities Section -->
        <div class="container my-5">
            <h2 class="text-center mb-5">Fasilitas Unggulan</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-shower fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Ruang Ganti & Shower</h5>
                            <p class="card-text">Dilengkapi dengan ruang ganti dan shower yang bersih dan nyaman untuk para pemain.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-parking fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Area Parkir Luas</h5>
                            <p class="card-text">Tersedia area parkir yang luas dan aman untuk kendaraan Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-coffee fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Kantin & Tempat Tunggu</h5>
                            <p class="card-text">Nikmati berbagai makanan dan minuman di kantin kami sambil menunggu jadwal bermain.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="container my-5">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-star mr-2"></i>
                    Mengapa Memilih Kami?
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-futbol text-primary fa-2x mr-3 mt-1"></i>
                                <div>
                                    <h5>Lapangan Berkualitas</h5>
                                    <p>Lapangan dengan rumput sintetis berkualitas tinggi yang terawat dengan baik.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-clock text-primary fa-2x mr-3 mt-1"></i>
                                <div>
                                    <h5>Jam Operasional Fleksibel</h5>
                                    <p>Buka dari pagi hingga malam untuk mengakomodasi jadwal Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-shield-alt text-primary fa-2x mr-3 mt-1"></i>
                                <div>
                                    <h5>Keamanan Terjamin</h5>
                                    <p>Dilengkapi dengan sistem keamanan 24 jam dan petugas yang siaga.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-medal text-primary fa-2x mr-3 mt-1"></i>
                                <div>
                                    <h5>Turnamen Regular</h5>
                                    <p>Kami mengadakan turnamen regular untuk komunitas sepak bola mini.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan Section -->
        <div class="container my-5">
            <h2 class="text-center mb-5">Informasi Penting</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-clock text-primary mr-2"></i>Jam Operasional</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">Senin - Jumat: 08:00 - 23:00</li>
                                <li class="mb-2">Sabtu - Minggu: 07:00 - 00:00</li>
                                <li class="mb-2">Hari Libur Nasional: 07:00 - 00:00</li>
                            </ul>
                            </div>
                                </div>
                            </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-info-circle text-primary mr-2"></i>Ketentuan Booking</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">Minimal booking 1 jam</li>
                                <li class="mb-2">Pembatalan maksimal H-1 dari jadwal booking</li>
                                <li class="mb-2">Datang 15 menit sebelum jadwal mulai</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peraturan dan Kebijakan Section -->
        <div class="container my-5">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-clipboard-list mr-2"></i>
                    Peraturan dan Kebijakan
                </div>
                        <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h5><i class="fas fa-exclamation-triangle text-warning mr-2"></i>Peraturan Lapangan</h5>
                            <ul>
                                <li>Dilarang merokok di area lapangan</li>
                                <li>Gunakan sepatu bola yang sesuai</li>
                                <li>Jaga kebersihan dan kerapihan lapangan</li>
                                <li>Dilarang membawa makanan/minuman ke lapangan</li>
                            </ul>
                            </div>
                        <div class="col-md-6 mb-4">
                            <h5><i class="fas fa-shield-alt text-primary mr-2"></i>Kebijakan Pembatalan</h5>
                            <ul>
                                <li>Pembatalan H-1: Refund 75%</li>
                                <li>Pembatalan H-2: Refund 90%</li>
                                <li>Pembatalan H-3 atau lebih: Refund 100%</li>
                                <li>Tidak hadir tanpa pemberitahuan: Tidak ada refund</li>
                            </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                <div class="col-md-4 mb-4">
                        <h5>Lucky Mini Soccer</h5>
                        <p>Tempat bermain Mini Soccer terbaik dengan fasilitas modern dan lapangan berkualitas untuk pengalaman bermain yang maksimal.</p>
                            </div>
                    <div class="col-md-4 mb-4">
                        <h5>Lokasi</h5>
                        <p><i class="fas fa-map-marker-alt mr-2"></i>Jl. Batu Alam Jaya No.35 7, RT.7/RW.3, Batu Ampar, Kec. Kramat jati, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13520</p>
                        <p><i class="fas fa-phone mr-2"></i>+62 831223434</p>
                        <p><i class="fas fa-envelope mr-2"></i>info@luckyminisoccer.com</p>
                                </div>
                    <div class="col-md-4 mb-4">
                        <h5>Jam Buka</h5>
                        <p><i class="fas fa-clock mr-2"></i>Senin - Jumat: 08:00 - 23:00</p>
                        <p><i class="fas fa-clock mr-2"></i>Sabtu - Minggu: 07:00 - 00:00</p>
                        <div class="social-links mt-3">
                            <a href="#"><i class="fab fa-whatsapp"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-tiktok"></i></a>
                            </div>
                        </div>
                    </div>
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="mb-0">&copy; 2024 Lucky Mini Soccer. Developed by Lucky Mini Soccer Team</p>
                </div>
            </div>
        </div>
        </footer>

        <!-- Booking Modal -->
        <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Booking Lapangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                    <div class="modal-body">
                        <form id="bookingForm">
                            @csrf
                            <div class="form-group">
                                <label for="arena_id">Nomor Lapangan</label>
                                <input type="text" class="form-control" id="arena_number" readonly>
                                <input type="hidden" name="arena_id" id="arena_id">
                                </div>
                            <div class="form-group">
                                <label for="time_from">Jam Mulai</label>
                                <div class="input-group date" id="time_from" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#time_from" name="time_from" required/>
                                    <div class="input-group-append" data-target="#time_from" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                </div>
                                    <div class="invalid-feedback"></div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="time_to">Jam Berakhir</label>
                                <div class="input-group date" id="time_to" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#time_to" name="time_to" required/>
                                    <div class="input-group-append" data-target="#time_to" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Booking</button>
                        </form>
                        </div>
                                </div>
                                </div>
                            </div>

        <!-- Booking Success Modal -->
        <div class="modal fade" id="bookingSuccessModal" tabindex="-1" role="dialog" aria-labelledby="bookingSuccessModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="bookingSuccessModalLabel">
                            <i class="fas fa-check-circle mr-2"></i>Upload Bukti Pembayaran
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    <div class="modal-body">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="font-weight-bold mb-0">Batas Pembayaran</h6>
                                    <span class="badge badge-info" id="paymentDueDate"></span>
                    </div>
                                <hr>
                                <div class="text-center mb-4">
                                    <h5 class="text-gray-800">Detail Booking</h5>
                                    <p class="mb-1">Nama: <span id="bookingUserName"></span></p>
                                    <p class="mb-1">Nomor Lapangan: <span id="bookingArenaNumber"></span></p>
                </div>
                                <a href="#" id="whatsappLink" class="btn btn-success btn-block">
                                    <i class="fab fa-whatsapp mr-2"></i>Kirim Bukti Pembayaran
                                </a>
            </div>
        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                        </div>
                    </div>
                </div>

        <!-- Event Detail Modal -->
        <div class="modal fade" id="eventDetailModal" tabindex="-1" role="dialog" aria-labelledby="eventDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventDetailModalLabel">Detail Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border-0">
                            <div class="card-body">
                                <h6 class="font-weight-bold" id="eventTitle"></h6>
                                <hr>
                                <p class="mb-1">Waktu: <span id="eventTime"></span></p>
                                <p class="mb-1">Durasi: <span id="eventDuration"></span></p>
                                <p class="mb-0">Status: <span id="eventStatus" class="badge badge-info">Aktif</span></p>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>

        @if(session('login_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Selamat Datang!',
                    text: 'Anda berhasil login',
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            });
        </script>
        @endif

        <script>
            $(document).ready(function() {
                // Setup CSRF token untuk AJAX
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Booking Modal
                $('#bookingModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var arenaNumber = button.data('arena');
                    var arenaId = button.data('arenaid');
                    var modal = $(this);
                    modal.find('#arena_number').val('Lapangan ' + arenaNumber);
                    modal.find('#arena_id').val(arenaId);
                });

                // Initialize datetimepicker
                $('#time_from').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm',
                    stepping: 60,
                    minDate: moment(),
                    sideBySide: true,
                    icons: {
                        time: 'far fa-clock',
                        date: 'far fa-calendar',
                        up: 'fas fa-chevron-up',
                        down: 'fas fa-chevron-down',
                        previous: 'fas fa-chevron-left',
                        next: 'fas fa-chevron-right',
                        today: 'far fa-calendar-check',
                        clear: 'fas fa-trash',
                        close: 'fas fa-times'
                    },
                    buttons: {
                        showToday: true,
                        showClear: true,
                        showClose: true
                    }
                });

                $('#time_to').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm',
                    stepping: 60,
                    minDate: moment(),
                    sideBySide: true,
                    icons: {
                        time: 'far fa-clock',
                        date: 'far fa-calendar',
                        up: 'fas fa-chevron-up',
                        down: 'fas fa-chevron-down',
                        previous: 'fas fa-chevron-left',
                        next: 'fas fa-chevron-right',
                        today: 'far fa-calendar-check',
                        clear: 'fas fa-trash',
                        close: 'fas fa-times'
                    },
                    buttons: {
                        showToday: true,
                        showClear: true,
                        showClose: true
                    }
                });

                // Link the two datetimepickers
                $("#time_from").on("change.datetimepicker", function (e) {
                    $('#time_to').datetimepicker('minDate', e.date);
                });
                $("#time_to").on("change.datetimepicker", function (e) {
                    $('#time_from').datetimepicker('maxDate', e.date);
                });

                // Handle booking form submission
                $('#bookingForm').on('submit', function(e) {
                    e.preventDefault();
                    
                    // Reset previous errors
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').empty();
                    
                    $.ajax({
                        url: '{{ route("booking.store") }}',
                        method: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            $('#bookingModal').modal('hide');
                            
                            // Set data untuk modal sukses
                            $('#paymentDueDate').text(moment(response.payment_due).format('D MMMM YYYY, HH:mm:ss'));
                            $('#bookingUserName').text(response.user_name);
                            $('#bookingArenaNumber').text('Lapangan ' + response.arena_number);
                            
                            // Set link WhatsApp
                            var whatsappText = 'Konfirmasi%20Pemesanan%0ANama%20:%20' + 
                                             response.user_name + 
                                             '%0ANomor%20Lapangan%20:%20' + 
                                             response.arena_number + 
                                             '%0A%0A(Mohon%20Lampirkan%20Bukti%20Pembayaran)';
                            $('#whatsappLink').attr('href', 'https://api.whatsapp.com/send?phone=6285814550896&text=' + whatsappText);
                            
                            // Update calendar with new bookings
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('addEventSource', response.bookings);
                            $('#calendar').fullCalendar('rerenderEvents');
                            
                            // Tampilkan modal sukses
                            $('#bookingSuccessModal').modal('show');

                            // Tampilkan alert sukses
                            Swal.fire({
                                title: 'Sukses!',
                                text: response.message,
                                icon: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key).addClass('is-invalid')
                                             .siblings('.invalid-feedback')
                                             .html(value[0]);
                                });
                            } else if (xhr.status === 401) {
                                $('#bookingModal').modal('hide');
                                Swal.fire({
                                    title: 'Perhatian!',
                                    text: xhr.responseJSON.message,
                                    icon: 'warning',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                $('#bookingModal').modal('hide');
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat melakukan booking',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                });

                // Calendar initialization
                var bookings = {!! json_encode($bookings) !!};
                console.log('Raw booking data:', bookings);

                $('#calendar').fullCalendar('destroy'); // Destroy any existing calendar
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    defaultView: 'month',
                    events: bookings,
                    eventRender: function(event, element) {
                        // Untuk tampilan month, week, dan day
                        if (event.title.length > 20) {
                            var shortTitle = event.title.substring(0, 20) + '...';
                            element.find('.fc-title').html(shortTitle);
                        } else {
                            element.find('.fc-title').html(event.title);
                        }
                        
                        // Tambahkan tooltip
                        element.attr('title', event.title);
                    },
                    eventClick: function(event, jsEvent, view) {
                        // Format waktu untuk ditampilkan
                        var startTime = moment(event.start).format('DD MMMM YYYY, HH:mm');
                        var endTime = moment(event.end).format('DD MMMM YYYY, HH:mm');
                        
                        // Hitung durasi dalam jam
                        var duration = moment.duration(moment(event.end).diff(moment(event.start)));
                        var hours = Math.floor(duration.asHours());
                        var minutes = Math.floor(duration.asMinutes()) % 60;
                        var durationText = hours + ' jam ' + (minutes > 0 ? minutes + ' menit' : '');

                        // Update modal content
                        $('#eventTitle').text(event.title);
                        $('#eventTime').text(startTime + ' - ' + endTime);
                        $('#eventDuration').text(durationText);

                        // Tampilkan modal
                        $('#eventDetailModal').modal('show');
                    },
                    eventAfterAllRender: function(view) {
                        console.log('All events rendered:', view);
                    },
                    loading: function(isLoading) {
                        console.log('Calendar loading:', isLoading);
                    },
                    eventColor: '#1a73e8',
                    eventTextColor: '#fff',
                    timeFormat: 'HH:mm',
                    slotLabelFormat: 'HH:mm',
                    displayEventEnd: true,
                    eventLimit: true,
                    views: {
                        month: {
                            eventLimit: 3
                        },
                        agendaWeek: {
                            slotDuration: '01:00:00',
                            minTime: '07:00:00',
                            maxTime: '23:00:00',
                            slotLabelFormat: 'HH:mm',
                            timeFormat: 'HH:mm'
                        },
                        agendaDay: {
                            slotDuration: '01:00:00',
                            minTime: '07:00:00',
                            maxTime: '23:00:00',
                            slotLabelFormat: 'HH:mm',
                            timeFormat: 'HH:mm'
                        }
                    },
                    viewRender: function(view, element) {
                        console.log('View rendered:', view.title);
                        var now = moment();
                        var end = moment().add(2, 'months');
                        var start = moment().subtract(2, 'months');
                        
                        $('.fc-prev-button').prop('disabled', view.start < start);
                        $('.fc-next-button').prop('disabled', view.end > end);
                    },
                    timezone: 'local',
                    defaultTimedEventDuration: '01:00:00',
                    allDaySlot: false,
                    height: 'auto',
                    contentHeight: 'auto',
                    nowIndicator: true,
                    slotEventOverlap: false,
                    slotDuration: '01:00:00',
                    snapDuration: '01:00:00',
                    firstDay: 1,
                    handleWindowResize: true,
                    eventOverlap: false
                });

                // Refresh calendar when modal is closed
                $('#bookingSuccessModal').on('hidden.bs.modal', function () {
                    $('#calendar').fullCalendar('refetchEvents');
                });

                // Text Slider Animation
                let currentSlide = 0;
                const slides = $('.text-slide');
                const slideCount = slides.length;

                function showNextSlide() {
                    slides.removeClass('active');
                    slides.eq(currentSlide).addClass('active');
                    currentSlide = (currentSlide + 1) % slideCount;
                }

                // Show first slide immediately
                showNextSlide();

                // Change slide every 5 seconds
                setInterval(showNextSlide, 5000);
            });

            function showLoginAlert() {
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Silahkan login terlebih dahulu untuk melakukan booking',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#1a73e8'
                });
            }
        </script>
    </body>
</html>
