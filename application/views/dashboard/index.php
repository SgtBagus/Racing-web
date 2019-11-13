<?php
if ($this->session->userdata('session_sop') == "") {
    header('Location: ' . base_url());
}
?>
<div class="content-wrapper">
    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <h1><?= $title ?> </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12" align="center">
                                    <img src="<?= $file['url'] ?>" class="img-circle" alt="User Image" width="100px" height="100px">
                                    <br>
                                    <h4>
                                        <?= $raider['name'] ?>
                                        <?php if ($raider['verificacion'] == 'ENABLE') {
                                            echo '<img src="' . base_url('assets/flaticon/verified.png') . '" style=" width: 20px; height: 20px; margin-bottom: 5px;">';
                                        } ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?= base_url('/dashboard/account') ?>">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-edit"></i> Ubah Profil</button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <ul class="list-group list-group-unbordered">
                                        <a href="<?= base_url('dashboard') ?>">
                                            <li class="list-group-item a_black" style="margin-bottom: 5px;" id="dashboard">
                                                <img src="<?= base_url('assets/flaticon/sidebar_house.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                                                <span>Dashboard</span>
                                            </li>
                                        </a>
                                        <a href="<?= base_url('dashboard/monitoreventrider') ?>">
                                            <li class="list-group-item a_black" style="margin-bottom: 5px;" id="invest">
                                                <img src="<?= base_url('assets/flaticon/sidebar_smartphone.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                                                <span>Monitoring Event</span>
                                            </li>
                                        </a>
                                        <a href="<?= base_url('dashboard/account') ?>">
                                            <li class="list-group-item a_black" style="margin-bottom: 5px;" id="account">
                                                <img src="<?= base_url('assets/flaticon/sidebar_user.png') ?>" style=" width: 15px; height: 15px; margin-bottom: 5px;">
                                                <span>Akun Saya</span>
                                            </li>
                                        </a>
                                    </ul>
                                    <a href="<?= base_url('login/logoutRider') ?>"><button type="button" class="btn btn-block btn-danger btn-md"><i class="fa fa-sign-out"></i> Logout</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <?php
                    $data['raider'] = $raider;
                    $data['file'] = $file;
                    if ($content == 'dashboard') {
                        $dashboard['invest_approve'] = $invest_approve;
                        $dashboard['total_harga'] = $total_harga;
                        $dashboard['total_project'] = $total_project;
                        $this->load->view('dashboard/dashboard', $dashboard);
                    } else if ($content == 'monitoreventrider') {
                        $tbl_event_register['invest'] = $tbl_event_register;
                        $this->load->view('dashboard/monitoreventrider', $invest);
                    } else if ($content == 'account') {
                        $this->load->view('dashboard/account');
                    } else {
                        $this->load->view('errors/html/error_404.php');
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ('<?= $content ?>' == 'dashboard') {
            $("#dashboard").addClass("active");
        } else if ('<?= $content ?>' == 'monitoreventrider') {
            $("#invest").addClass("active");
        } else if ('<?= $content ?>' == 'account') {
            $("#account").addClass("active");
        }
    });
</script>