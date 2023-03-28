<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ config('app.name') }} | Beranda</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('/frontend') }}/assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('/frontend') }}/css/styles.css" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('/stisla/dist') }}/assets/modules/izitoast/css/iziToast.min.css">
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
            <div class="container px-5">
                <a class="navbar-brand fw-bold" href="#page-top">{{ config('app.name') }}</a>
            </div>
        </nav>
        <!-- Mashead header-->
        <header class="masthead">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <!-- Mashead text and app badges-->
                        <div class="mb-5 mb-lg-0 text-center text-lg-start">
                            <h1 class="display-1 lh-1 mb-3">{{ config('app.name') }}</h1>
                            <p class="lead fw-normal text-muted mb-5">Laporkan keluhan Anda kepihak yang berwenang</p>

                            <div class="d-flex flex-column flex-lg-row align-items-center">
                                <a class="me-lg-3 mb-4 mb-lg-0 btn  bg-gradient-primary-to-secondary text-white" href="{{ route('pemas.loginView', []) }}">Masuk</a>
                                <a href="{{ route('pemas.formRegister') }}" class="btn  bg-gradient-primary-to-secondary text-white">Daftar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Masthead device mockup feature-->
                        <div class="masthead-device-mockup">
                            <img src="{{ asset('/images/logo1.png') }}" alt="Logo" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section id="features">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-header">
                                <h4>Panduan {{ config('app.name') }}</h4>
                            </div>
                            <div class="card-body">
                                <ol>
                                    <li>
                                        Lakukan Pendaftaran Jika Belum Mempunyai Akun:
                                        <ul>
                                            <li>Pastikan Isi Data Diri Dengan Benar</li>
                                        </ul>
                                    </li>
                                    <li>
                                        Setelah Membuat Akun Kalian Bisa Masuk Dan Melakukan Pengaduan
                                    </li>
                                    <li>
                                        Tunggu Hingga Petugas Menanggapi Laporan Yang Kalian Berikan
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Quote/testimonial aside-->
        <aside class="text-center bg-gradient-primary-to-secondary">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xl-6">
                        <div class="h2 fs-1 text-white mb-4">Jumlah Pengaduan Sekarang</div>
                        <div class="h3 fs-1 text-white">{{ $pengaduan }}</div>
                    </div>
                    <div class="col-xl-6">
                        <div class="h2 fs-1 text-white mb-4">Jumlah Tanggapan Sekarang</div>
                        <div class="h3 fs-1 text-white">{{ $tanggapan }}</div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Footer-->
        <footer class="bg-black text-center py-5">
            <div class="container px-5">
                <div class="text-white-50 small">
                    <div class="mb-2">&copy; {{ config('app.name') }} {{ date('Y') }}. All Rights Reserved.</div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="{{ asset('/stisla/dist') }}/assets/modules/izitoast/js/iziToast.min.js"></script>

        <script>
          @if (Session::has('success'))
            iziToast.success({
            title: 'Sukses',
            message: "{{ session('success') }}",
            position: 'topRight'
          })
          @elseif (Session::has('error'))
              iziToast.error({
                title: 'Error!',
              message: "{{ session('error') }}",
              position: 'topRight'
          })
          @elseif (Session::has('info'))
              iziToast.info({
              title: 'Info',
              message: "{{ session('info') }}",
              position: 'topRight'
              })
          @endif;
      </script>
    </body>
</html>
