<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Masuk &mdash; {{ config('app.name') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/stisla/dist') }}/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/stisla/dist') }}/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('/stisla/dist') }}/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/stisla/dist') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/stisla/dist') }}/assets/css/components.css">

    <link rel="stylesheet" href="{{ asset('/stisla/dist') }}/assets/modules/izitoast/css/iziToast.min.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row justify-content-center">
                    <!-- Column -->
                    <div class="col-lg-6 col-xlg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('pemas.register') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="nik"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            type="number" maxlength="16" class="form-control" placeholder="NIK"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="username" placeholder="Username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="telp" placeholder="No. Telp" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="alamat" class="form-control" placeholder="Alamat" class="alamat" rows="4">{{ old('alamat') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">REGISTER</button>
                                    <a href="{{ route('pemas.index') }}" class="btn btn-warning text-white mt-3" style="width: 100%">Kembali ke
                                        Halaman Utama</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('/stisla/dist') }}/assets/modules/jquery.min.js"></script>
    <script src="{{ asset('/stisla/dist') }}/assets/modules/popper.js"></script>
    <script src="{{ asset('/stisla/dist') }}/assets/modules/tooltip.js"></script>
    <script src="{{ asset('/stisla/dist') }}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('/stisla/dist') }}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('/stisla/dist') }}/assets/modules/moment.min.js"></script>
    <script src="{{ asset('/stisla/dist') }}/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('/stisla/dist') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('/stisla/dist') }}/assets/js/custom.js"></script>

    <!-- JS Libraies -->
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
        @endif ;
    </script>
</body>

</html>
