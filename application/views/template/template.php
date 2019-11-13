<?php
$title = "NSO Project - Say Never Old";
?>
<!DOCTYPE html>
<html lang="en">
<script>
  if (screen.width <= 1081) {
    window.location = "https://m.nsoproject.com";
  }
</script>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>custom_css.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
  <link rel="icon" href="<?= base_url('assets/') ?>img/logo.jpg">
  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="<?= base_url() ?>" class="navbar-brand">
          <img style="height:40px" src="<?= base_url('assets/img/') ?>logo2.jpg"></a>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?= base_url('event') ?>" class="nav-link">
                <img src="<?= base_url('assets/flaticon/sidebar_star.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                Event
              </a>
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
            <li class="nav-item">
              <a href="<?= base_url('kebijakanprivasi') ?>" class="nav-link">
                <img src="<?= base_url('assets/flaticon/sidebar_list.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                <span>Kebijakan & Privasi</span>
              </a>
            </li>
          </ul>
        </div>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <?php if ($this->session->userdata('id')) {
            $rider = $this->mymodel->selectDataone('tbl_raider', array('id' => $this->session->userdata('id')));
            $photo = $this->mymodel->selectDataone('file', array('table' => 'tbl_raider', 'table_id' => $this->session->userdata('id')));
            ?>
            <li class="dropdown user user-menu" style="margin-top:5px">
              <a href="#" data-toggle="dropdown" aria-expanded="false" style="color:white">
                <img src="<?= $photo['url'] ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $rider['name'] ?></span>
              </a>
              <ul class="dropdown-menu" style="margin-top: 20px;">
                <li class="user-header">
                  <img src="<?= $photo['url'] ?>" class="img-circle" alt="User Image">
                  <p>
                    <?= $rider['name'] ?>
                    <?php if ($rider['verificacion'] == 'ENABLE') {
                        echo '<img src="' . base_url('assets/flaticon/verified.png') . '" style=" width: 20px; height: 20px; margin-bottom: 5px;">';
                      } ?>
                    <small>Telah Mengikuti <b> <?= $rider['eventikut'] ?> Event </b></small>
                  </p>
                  <div class="row">
                    <div class="col-md-6">
                      <a href="<?= base_url('dashboard') ?>" class="btn btn-primary btn-block">
                        <img src="<?= base_url('assets/flaticon/sidebar_user.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                        Profile
                      </a>
                    </div>
                    <div class="col-md-6">
                      <a href="<?= base_url('login/logoutRider') ?>" class="btn btn-danger btn-block">
                        <img src="<?= base_url('assets/flaticon/sidebar_logout.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                        Logout
                      </a>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          <?php } else { ?>
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
          <?php } ?>
        </ul>
      </div>
    </nav>
    <div class="content-wrapper" style="">
      <div class="content-header">
        <div class="row mb-2" style="margin-top: 30px;">
        </div>
      </div>
      <div class="col-md-12" style="margin-top:25px;">
        <?= $contents ?>
      </div>
      <marquee><?= MARQUEE ?></marquee>
    </div>
    <footer class="main-footer">
      <div class="container" style="margin-top: 15px">
        <div class="row">
          <div class="col-md-12 text-center">
            <img style="height:150px" src="<?= base_url('assets/img/') ?>logo2.jpg"></a>
          </div>
          <div class="col-md-12 text-center" style="margin-top:15px;">
            <p>Download On</p>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <a class="btn btn-social-icon btn-facebook round" style="margin: 2px">
                  <img src="<?= base_url('assets/play-store.png') ?>" style="height: 80px; margin-bottom: 5px;">
                </a>
                <a class="btn btn-social-icon btn-instagram round" style="margin: 2px">
                  <img src="<?= base_url('assets/app-store.png') ?>" style="height: 80px; margin-bottom: 5px;">
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-12 text-center" style="margin-top:0px;">
            <p>Follow NSO Project</p>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <a href="https://www.facebook.com/MalangAdventureTrail/" class="btn btn-social-icon btn-facebook round" style="margin: 2px">
                  <img src="<?= base_url('assets/flaticon/facebook.png') ?>" style=" width: 50px; height: 50px; margin-bottom: 5px;">
                </a>
                <a href="https://www.instagram.com/malangadventuretrail/?hl=en" class="btn btn-social-icon btn-instagram round" style="margin: 2px">
                  <img src="<?= base_url('assets/flaticon/instagram.png') ?>" style=" width: 50px; height: 50px; margin-bottom: 5px;">
                </a>
                <a href="http://www.youtube.com/c/EDIKAMPANG" class="btn btn-social-icon btn-youtube round" style="margin: 2px">
                  <img src="<?= base_url('assets/flaticon/youtube.png') ?>" style=" width: 50px; height: 50px; margin-bottom: 5px;">
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-12 text-center" style="margin-top:0px;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <p>
                  | <a href="<?= base_url() ?>" style="color: white; padding:0px 5px;"> Home </a> |
                  <a href="<?= base_url('event') ?>" style="color: white; padding:0px 5px;"> Event </a> |
                  <a href="<?= base_url('kebijakan-dan-privasi') ?>" style="color: white; padding:0px 5px;"> Verified Rider </a> |
                  <a href="<?= base_url('kebijakan-dan-privasi') ?>" style="color: white; padding:0px 5px;"> Verified Team </a> |
                  <a href="<?= base_url('wisata') ?>" style="color: white; padding:0px 5px;"> Wisata </a> |
                  <a href="<?= base_url('blogs') ?>" style="color: white; padding:0px 5px;"> News </a> |
                  <a href="<?= base_url('gallery') ?>" style="color: white; padding:0px 5px;">Gallery</a> |
                  <a href="<?= base_url('merchandise') ?>" style="color: white; padding:0px 5px;"> Merchandise </a> |
                  <a href="<?= base_url('kebijakan-dan-privasi') ?>" style="color: white; padding:0px 5px;"> Kebijakan Dan Privasi </a> |
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-12 text-center" style="margin-top:0px;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <p>
                  Copyright © 2019 by <a style="color:#fff;" href="<?= base_url() ?>">NSO Project - Never Say Old</a> All Right Reserved
                </p>
              </div>
            </div>
          </div>
        </div>
    </footer>
  </div>
</body>
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  $(function() {
    $('#datatable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": false,
      "scrollX": false,
      "scrollY": true,
      "language": {
        "search": "<b> Pencarian : </b>",
        "zeroRecords": function() {
          return "<img src='https://icon-library.net/images/no-data-icon/no-data-icon-20.jpg' width='100px' height='100px'><p><b>Tidak Ada Data</b><p>";
        },
        "paginate": {
          "previous": "<i class='fa fa-arrow-left'></i>",
          "next": "<i class='fa fa-arrow-right'></i>"
        },
        "lengthMenu": '<label>Tampilkan <select name="datatable_length" aria-controls="datatable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> Data</label>'
      },
    });
  });

  $("#btnFile").click(function() {
    document.getElementById('imageFile').click();
  });

  $("#imageFile").change(function() {
    imagePreview(this);
    $('#preview').remove();
  });

  function imagePreview(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#preview_image').before('<br>' +
          '<div align="center">' +
          '<img class="img-circle" alt="User Image" src="' + e.target.result + '" alt="Third slide" height="250px" width="250px" style="margin-bottom: 10px" id="preview">' +
          '</div>');
      }

      reader.readAsDataURL(input.files[0]);
    }
  };
  
  function lazzy_loader(limit) {
      var output = '<div class="row">' +
        '<div class="col-xs-12" align="center">' +
        '<h4> Memuat Data !</h4>' +
        '</div>' +
        '</div>';
      $('#load_data_message').html(output);
    }
</script>

</html>