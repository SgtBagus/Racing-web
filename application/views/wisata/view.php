<div class="row">
    <div class="col-md-12">
        <h3 class="box-title" align="center">Wisata</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <img class="img-detail" src="<?= $file['url'] ?>">
            <div class="box-body">
                <h3 align="center">
                    <?= $tbl_wisata['title'] ?>
                </h3>
                <div class="row">
                    <div class="col-xs-12" align="center">
                        <p>
                            Wisata Dimulai :
                            <br>
                            <?php if ((!$tbl_wisata['tglwisataStart']) || (!$tbl_wisata['tglwisataEnd'])) { ?>
                                <b>Coming Soon</b>
                            <?php  } else { ?>
                                <?= date('d M Y', strtotime($tbl_wisata['tglwisataStart'])) . ' <b> s/d </b> ' . date('d M Y', strtotime($tbl_wisata['tglwisataEnd'])) ?>
                            <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="https://api.whatsapp.com/send?phone=628122223827&text=Perkenalkan Saya <?= $this->session->userdata('name') ?>. Saya ingin menanyakan tentang..." target="_black">
            <button class="btn btn-lg btn-block btn-success" style="margin-bottom: 15px">
                <img src="<?= base_url('assets/flaticon/whatsapp.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /> Hubungi Admin
            </button>
        </a>
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <?= $tbl_wisata['desk'] ?>
            </div>
        </div>
    </div>
</div>