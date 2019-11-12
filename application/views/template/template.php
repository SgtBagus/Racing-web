<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>AdminLTE 3 | Top Navigation</title>
  <link rel="stylesheet" href="<?=base_url('assets/')?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>custom_css.css">
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

  <script src="<?= base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="index3.html" class="navbar-brand">
          <img style="height:40px" src="<?= base_url('assets/img/') ?>logo2.jpg"></a>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?= base_url() ?>" class="nav-link">
                <img src="<?= base_url('assets/flaticon/sidebar_house.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                <span>Home</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                <img src="<?= base_url('assets/flaticon/sidebar_star.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                Event
              </a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li>
                  <a href="<?= base_url('event') ?>" class="dropdown-item">
                    <img src="<?= base_url('assets/flaticon/research.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                    Cari Event
                  </a>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                  <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item">
                    <img src="<?= base_url('assets/flaticon/research.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                    Verified
                  </a>
                  <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                    <li>
                      <a href="<?= base_url('verifteam') ?>" class="dropdown-item">
                        <img src="<?= base_url('assets/flaticon/sidebar_team.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                        Verified Team
                      </a>
                    </li>
                    <li>
                      <a href="<?= base_url('verifraider') ?>" class="dropdown-item">
                        <img src="<?= base_url('assets/flaticon/sidebar_rider.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                        Verified Rider
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('wisata') ?>" class="nav-link">
                <img src="<?= base_url('assets/flaticon/sidebar_wisata.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                <span>Wisata</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('blogs') ?>" class="nav-link">
                <img src="<?= base_url('assets/flaticon/sidebar_text-lines.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                <span>News</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('gallery') ?>" class="nav-link">
                <img src="<?= base_url('assets/flaticon/sidebar_picture.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                <span>Gallery</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('merchandise') ?>" class="nav-link">
                <img src="<?= base_url('assets/flaticon/sidebar_shipment.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                <span>Merchandise</span>
              </a>
            </li>
          </ul>
        </div>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item">
            <a href="<?= base_url('login/rider') ?>" class="nav-link">
              <img src="<?= base_url('assets/flaticon/sidebar_locked.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
              <span>Login</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('login/registerrider') ?>" class="nav-link">
              <img src="<?= base_url('assets/flaticon/sidebar_rider.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
              <span>Register</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <div class="row mb-2" style="margin-top: 75px;">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"> Top Navigation <small>Example 3.0</small></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                <li class="breadcrumb-item active">Top Navigation</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <?= $contents ?>
      <marquee><?= MARQUEE ?></marquee>
    </div>
    <aside class="control-sidebar control-sidebar-dark">
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <footer class="main-footer" style="position: unset;">
      <div class="container" align="center">
        <strong style="font-size:14px;">
          Copyright © 2019 by <a href="#">Never Say Old</a> All Right Reserved
        </strong>
      </div>
    </footer>
  </div>
</body>
<script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url('assets/')?>dist/js/adminlte.min.js"></script>
</html>
