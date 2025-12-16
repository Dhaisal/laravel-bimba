
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bimba Pat || Login </title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo-biMBA_.jpg') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"

    style="background-image: url('{{ asset('assets/images/backgrounds/bimba.jpg') }}'); background-size: cover;">
      <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
          <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
              <div class="card mb-0">
                <div class="card-header">
                  <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                      <img src="{{ asset('assets/images/logos/logobimbaaiueo-small.jpg') }}" style="height: 50px;" alt="">
                  </a>
                  <h5 class="text-center">Aplikasi Pendaftaran Siswa</h5>
                  <h6 class="text-center" style="color: gray;">Bimba AIUEO Cab. Pataruman</h6>
                  <p class="text-center">Komplek Pesona Prima Pataruman 2 Blok B1, No. 10, RT.01/12, Kel. Pataruman, Kec. Cihampelas, Kab. Bandung Barat, Prov. Jawa Barat</p>
                  <p class="text-center">Email. coninieyani@gmail.com <a href="mailto:coninieyani@gmail.com"></a></p>                
                  
                </div>
                <div class="card-body">
                  <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                    </div>
                    <div class="mb-4">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                    </div>
                    

                    <button type="submit" name="login" class="btn btn-primary w-100 mb-3">
                                Masuk
                    </button>
                   
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  </body>

</html>