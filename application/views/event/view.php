<div class="row">
    <div class="col-md-12">
        <h3 class="box-title" align="center">Event</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <img class="img-detail" src="<?= $file['url'] ?>">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 align="center"><?= $tbl_event['title'] ?></h4>
                        <div class="row" align="center">
                            <?php
                            if ($tbl_event['statusEvent'] == 'BERJALAN') {
                                echo '<span class="label bg-yellow round right" style="margin-left:5px">BERJALAN</span>';
                            } else if ($tbl_event['statusEvent'] == 'SELESAI') {
                                echo '<span class="label bg-green round right" style="margin-left:5px">SELESAI</span>';
                            } else if ($tbl_event['statusEvent'] == 'BATAL') {
                                echo '<span class="label bg-red round right" style="margin-left:5px">DIBATALKAN</span>';
                            } else {
                                echo '<span class="label bg-blue round right" style="margin-left:5px">DIBUKA</span>';
                            }
                            ?>
                        </div>
                        <div class="col-md-12" style="padding:0px 10px;">
                            <p style="text-align:center;">
                                <!--<i class="fa fa-globe"></i> <?= $tbl_event['kota'] ?><br>-->
                                <?= $tbl_event['alamat'] ?>
                            </p>
                            <!-- <a href="https://maps.google.com/?q=<?= $tbl_event['alamat'] ?>">
                            <button class="btn btn-md btn-block btn-info"> <i></i> Lihat Peta Di Google Maps</button>
                        </a> -->
                        </div>
                    </div>
                </div>
                <hr style="margin-top:5px; margin-bottom: 5px;">
                <div class="row">
                    <div class="col-xs-6">
                        Tanggal Event :
                        <br>
                        <small>
                            <?php if ((!$tbl_event['tgleventStart']) || (!$tbl_event['tgleventEnd'])) { ?>
                                <b>Coming Soon</b>
                            <?php  } else { ?>
                                <?= date('d M Y', strtotime($tbl_event['tgleventStart'])) . "<b> s/d </b>" . date('d M Y', strtotime($tbl_event['tgleventEnd'])) ?>
                            <?php } ?>
                        </small>
                    </div>
                    <div class="col-xs-6" align="right">
                        Pendaftar :
                        <br>
                        <b>
                            <img src="<?= base_url('assets/flaticon/icon_rider.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /><?= $rowraider[0]['rowraider'] ?>
                            <img src="<?= base_url('assets/flaticon/icon_team.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /><?= $rowteam[0]['rowteam'] ?>
                        </b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="https://api.whatsapp.com/send?phone=<?= $tbl_event['phone'] ?>&text=Perkenalkan Saya <?= $this->session->userdata('name') ?>. Saya ingin menanyakan tentang..." target="_black">
    <button class="btn btn-lg btn-block btn-success" style="margin-bottom: 15px">
        <img src="<?= base_url('assets/flaticon/whatsapp.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /> Hubungi Admin
    </button>
</a>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Syarat Pendaftaran </h3>
            </div>
            <div class="box-body" align="center">
                <table style="width: 100%">
                    <tr>
                        <td align="right">Harga Pendaftaran</td>
                        <td>:</td>
                        <td align="left">
                            <b>Rp. <?= number_format($tbl_event['harga'], 0, ',', '.') ?>,- </b>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Rider per Team</td>
                        <td>:</td>
                        <td align="left">
                            <b><?= $tbl_event['minraider'] ?> s/d <?= $tbl_event['maxraider'] ?></b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <div class="box">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Deskripsi</h3>
                    </div>
                    <div class="box-body">
                        <?= $tbl_event['deskripsi'] ?>
                        <br>
                        <?php if ($rule) { ?>
                            <a href="<?= base_url('download/downloadPDFEvent/') . $rule['id'] ?>">
                                <button class="btn btn-lg btn-block btn-info" style="margin-bottom: 15px">
                                    <img src="<?= base_url('assets/flaticon/download.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /> Download Peraturan Event
                                </button>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12" align="center">
        <h3 class="box-title">Data Event </h3>
        <a href="<?= base_url('verifteam/view/') . $tbl_event['id'] ?>" class="a_black">
            <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                <div class="box" style=" width: 100px; height: 100px;">
                    <div class="box-body" align="center">
                        <img src="<?= base_url('assets/flaticon/team.png') ?>" style=" width: 80px; height: 80px; ">
                    </div>
                </div>
            </div>
        </a>
        <a href="<?= base_url('verifraider/view/') . $tbl_event['id'] ?>" class="a_black">
            <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                <div class="box" style=" width: 100px; height: 100px;">
                    <div class="box-body" align="center">
                        <img src="<?= base_url('assets/flaticon/rider.png') ?>" style=" width: 80px; height: 80px; ">
                    </div>
                </div>
            </div>
        </a>
        <?php if ($tbl_event['statusEvent'] == 'BERJALAN' || $tbl_event['statusEvent'] == 'SELESAI') { ?>
            <a href="<?= base_url('event/rank/') . $tbl_event['id'] ?>">
                <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                    <div class="box" style=" width: 100px; height: 100px;">
                        <div class="box-body" align="center">
                            <img src="<?= base_url('assets/flaticon/ranking.png') ?>" style=" width: 80px; height: 80px; ">
                        </div>
                    </div>
                </div>
            </a>
        <?php } else { ?>
            <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                <div class="box" style=" width: 100px; height: 100px;">
                    <div class="box-body" align="center">
                        <img src="<?= base_url('assets/flaticon/ranking_disable.png') ?>" style=" width: 80px; height: 80px; ">
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($tbl_event['live_url']) { ?>
            <a href="<?= $tbl_event['live_url'] ?>">
                <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                    <div class="box" style=" width: 100px; height: 100px;">
                        <div class="box-body" align="center">
                            <img src="<?= base_url('assets/flaticon/live-streaming.png') ?>" style=" width: 80px; height: 80px; ">
                        </div>
                    </div>
                </div>
            </a>
        <?php } else { ?>
            <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                <div class="box" style=" width: 100px; height: 100px;">
                    <div class="box-body" align="center">
                        <img src="<?= base_url('assets/flaticon/live-streaming_disable.png') ?>" style=" width: 80px; height: 80px; ">
                    </div>
                </div>
            </div>
        <?php } ?>
        <a href="<?= base_url('event/gallery/') . $tbl_event['id'] ?>">
            <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                <div class="box" style=" width: 100px; height: 100px;">
                    <div class="box-body" align="center">
                        <img src="<?= base_url('assets/flaticon/dokumentasi.png') ?>" style=" width: 80px; height: 80px; ">
                    </div>
                </div>
            </div>
        </a>
        <?php if ($tbl_event['status'] == 'ENABLE') { ?>
            <?php if ($tbl_event['statusEvent'] == 'STARTED') {
                    if ($this->session->userdata('id') != NULL) {
                        if ($this->session->userdata('role') == 'Team') { ?>
                        <a href="<?= base_url('event/register/') . $tbl_event['id'] ?>">
                            <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                                <div class="box" style=" width: 100px; height: 100px;">
                                    <div class="box-body" align="center">
                                        <img src="<?= base_url('assets/flaticon/register.png') ?>" style=" width: 80px; height: 80px; ">
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } else { ?>
                        <a href="<?= base_url('event/registerrider/') . $tbl_event['id'] ?>">
                            <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                                <div class="box" style=" width: 100px; height: 100px;">
                                    <div class="box-body" align="center">
                                        <img src="<?= base_url('assets/flaticon/register.png') ?>" style=" width: 80px; height: 80px; ">
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php }
                            } else { ?>
                    <a href="<?= base_url('login/rider/') ?>">
                        <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                            <div class="box" style=" width: 100px; height: 100px;">
                                <div class="box-body" align="center">
                                    <img src="<?= base_url('assets/flaticon/register.png') ?>" style=" width: 80px; height: 80px; ">
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            <?php } else if ($tbl_event['statusEvent'] == 'BERJALAN') { ?>
                <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                    <div class="box" style=" width: 100px; height: 100px;">
                        <div class="box-body" align="center">
                            <img src="<?= base_url('assets/flaticon/register_disable.png') ?>" style=" width: 80px; height: 80px; ">
                        </div>
                    </div>
                </div>
            <?php } else if ($tbl_event['statusEvent'] == 'SELESAI') { ?>
                <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                    <div class="box" style=" width: 100px; height: 100px;">
                        <div class="box-body" align="center">
                            <img src="<?= base_url('assets/flaticon/register_disable.png') ?>" style=" width: 80px; height: 80px; ">
                        </div>
                    </div>
                </div>
            <?php } else if ($tbl_event['statusEvent'] == 'BATAL') { ?>
                <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                    <div class="box" style=" width: 100px; height: 100px;">
                        <div class="box-body" align="center">
                            <img src="<?= base_url('assets/flaticon/register_disable.png') ?>" style=" width: 80px; height: 80px; ">
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px">
                <div class="box" style=" width: 100px; height: 100px;">
                    <div class="box-body" align="center">
                        <img src="<?= base_url('assets/flaticon/register_disable.png') ?>" style=" width: 80px; height: 80px; ">
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>