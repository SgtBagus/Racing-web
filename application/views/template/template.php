<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Never Say Old - Web</title>
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>custom_css.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
  <link rel="icon" href="<?= base_url('assets/') ?>img/logo.jpg">

  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
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
        <div class="row mb-2" style="margin-top: 30px;">
        </div>
      </div>
      <?= $contents ?>
      <marquee><?= MARQUEE ?></marquee>
    </div>
    <footer class="main-footer">
      <div class="container" style="margin-top: 15px">
        <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12 text-center">
            <img style="height:150px" src="<?= base_url('assets/img/') ?>logo2.jpg"></a>
            <p>Copyright <i class="fa fa-copyright"></i> 2019</p>
          </div>
          <div class="col-lg-4 text-center">
            <h2><b>NEVER SAY OLD</b></h2>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="<?= base_url() ?>" style="color: white">Home</a>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="<?= base_url('event') ?>" style="color: white" target="_blank">Event</a>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="<?= base_url('wisata') ?>" style="color: white">Wisata</a>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="<?= base_url('blogs') ?>" style="color: white">News</a>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="<?= base_url('gallery') ?>" style="color: white">Gallery</a>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="<?= base_url('merchandise') ?>" style="color: white">Merchandise</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 text-center">
            <h2><b>IKUTI KAMI</b></h2>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <a class="btn btn-social-icon btn-facebook round" style="margin: 2px">
                  <img src="<?= base_url('assets/flaticon/facebook.png') ?>" style=" width: 30px; height: 30px; margin-bottom: 5px;">
                </a>
                <a class="btn btn-social-icon btn-instagram round" style="margin: 2px">
                  <img src="<?= base_url('assets/flaticon/instagram.png') ?>" style=" width: 30px; height: 30px; margin-bottom: 5px;">
                </a>
                <a class="btn btn-social-icon btn-twitter round" style="margin: 2px">
                  <img src="<?= base_url('assets/flaticon/twitter.png') ?>" style=" width: 30px; height: 30px; margin-bottom: 5px;">
                </a>
                <a class="btn btn-social-icon btn-youtube round" style="margin: 2px">
                  <img src="<?= base_url('assets/flaticon/youtube.png') ?>" style=" width: 30px; height: 30px; margin-bottom: 5px;">
                </a>
              </div>
            </div>
          </div>
        </div>
    </footer>
  </div>
</body>
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>

</html>