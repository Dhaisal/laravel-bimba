<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bimba Pat || @yield('title')</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo-biMBA_.jpg') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed" >
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="index.php" class="text-nowrap logo-img">
            <img src="{{ asset('assets/images/logos/logobimbaaiueo-small.jpg') }}" style="height: 50px;" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">Menu Utama</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">Data Agenda</span>
            </li>
 
            <li class="sidebar-item">
              <a class="sidebar-link" href="agenda.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="mdi:calendar" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Agenda Pengajaran</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="agendalain.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="mdi:calendar" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Kegiatan Lainnya</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="laporan.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:text-field-focus-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Print Laporan Harian</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6" class="fs-6"></iconify-icon>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#logoutmodal">
                <span>
                  <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu" >Logout</span>
              </a>
            </li>
          </ul>
        </nav>

        
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
              <li class="nav-item">
    <div class="d-flex align-items-center" style="margin: 20px;">
      <iconify-icon icon="solar:home-2-bold-duotone" style="font-size: 24px;"></iconify-icon>
      <h4 class="mb-0 ms-2">Halaman @yield('title')</h4>
    </div>
  </li>

            
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="profil-card.php" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Profil Saya</p>
                    </a>
                    <a href="profil-card.php" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">Ganti Password</p>
                    </a>
                    <a href="agenda.php" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">Agenda Pengajaran</p>
                    </a>
                    <a href="#" class="btn btn-outline-primary mx-3 mt-2 d-block" data-bs-toggle="modal" data-bs-target="#logoutmodal">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <div class="container-fluid">

        <!-- Card Selamat Datang -->
  <div class="card mb-1">
    <div class="card-body">
      <div class="row">
        <div class="col-sm-6">
          <h5>Selamat Datang, <b class="text-danger">Dhai</b></h5>
        </div>
        <div class="col-sm-6 text-end">
          <h5>Hari ini: <?php echo date("d F Y"); ?></h5>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Logout -->
<div class="modal fade text-center" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="logoutmodallabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Logout Akun</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="mt-4">
              <div class="modal-body">
                  <p class="text text-warning" style="font-size: 100px"><i class="fa fa-exclamation-triangle">
                  </i></p>
                  <h3>Apakah Anda Yakin akan Logout?</h3>
                  <p></p>
                  <br>
              </div>
              <div class="modal-footer" style="justify-content: center;">
                <form action="" method="POST">
                  <button type="submit" name="logout" id="logout" value="logout" class="btn btn-danger">Logout</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </form>
              </div>
          </div>
      </div>
  </div>
</div>
      <!--  Header End -->

  <main id="main" class="main">
    <!-- Alert -->
    {{-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}
    @yield('content')
    </main>

     <!--footer start -->


              <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Projek Pendafataran Bimba oleh <strong>Dhaisal Cahya Zakaria</strong> </p>
        </div>
  <script src="{{ asset ('assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset ('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset ('assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{ asset ('assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{ asset ('assets/js/sidebarmenu.js')}}"></script>
  <script src="{{ asset ('assets/js/app.min.js')}}"></script>
  <script src="{{ asset ('assets/js/dashboard.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  
</body>

</html>

     <!--footer end -->
