<div class="row">
  <div class="cover1">
  </div>
</div>
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12" align="center">
        <h5><b>Event Terbaru</b></h5>
      </div>
      <div class="col-lg-6">
        <div class="row" align="center">
          <div class="col-lg-12">
            <a href="<?= base_url('event/view/') . $tbl_event['0']['id'] ?>" class="a_black">
              <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <?php
                      if ($tbl_event['0']['statusEvent'] == 'BERJALAN') {
                        echo '<span class="label_status bg-yellow round right" style="margin-left:5px">BERJALAN</span>';
                      } else if ($tbl_event['0']['statusEvent'] == 'SELESAI') {
                        echo '<span class="label_status bg-green round right" style="margin-left:5px">SELESAI</span>';
                      } else if ($tbl_event['0']['statusEvent'] == 'BATAL') {
                        echo '<span class="label_status bg-red round right" style="margin-left:5px">DIBATALKAN</span>';
                      } else {
                        echo '<span class="label_status bg-blue round right" style="margin-left:5px">DIBUKA</span>';
                      }
                      ?>
                      <img src="<?= $mainPhoto['url'] ?>" class="main-event">
                    </div>
                    <div class="col-lg-12">
                      <h4><b><?= strlen($tbl_event['0']["title"]) > 25 ? substr($tbl_event['0']["title"], 0, 25) . "..." : $tbl_event['0']["title"] ?></b></h4>
                      <?= $tbl_event['0']['alamat'] ?>
                      <br>
                      <small>
                        <?php if ((!$tbl_event['0']['tgleventStart']) || (!$tbl_event['0']['tgleventEnd'])) { ?>
                          <b>Coming Soon</b>
                        <?php  } else { ?>
                          <?= date('d M Y', strtotime($tbl_event['0']['tgleventStart'])) . "<b> s/d </b>" . date('d M Y', strtotime($tbl_event['0']['tgleventEnd'])) ?>
                        <?php } ?>
                      </small>
                      <br>
                      <b>
                        <img src="<?= base_url('assets/flaticon/icon_rider.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /><?= $rowraidermain[0]['rowraider'] ?>
                        <img src="<?= base_url('assets/flaticon/icon_team.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /><?= $rowteammain[0]['rowteam'] ?>
                      </b>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row">
          <?php foreach ($tbl_event as $row) {
            $photo = $this->mymodel->selectDataone('file', array('table_id' => $row['id'], 'table' => 'tbl_event'));
            $register_id = $this->mymodel->selectDataone('tbl_event_register', array('event_id' => $row['id']));
            $rowteam = $this->mymodel->selectWithQuery("SELECT count(team_id) as rowteam from tbl_event_register WHERE event_id = '" . $row['id'] . "' AND approve = 'APPROVE' AND team_id NOT LIKE '0'");
            $rowraider = $this->mymodel->selectWithQuery("SELECT count(a.id) as rowraider from tbl_event_register_raider a INNER JOIN tbl_event_register b ON a.event_register_id = b.id WHERE b.event_id = " . $row['id'] . " AND b.approve = 'APPROVE' ");
            ?>
            <div class="col-lg-12">
              <a href="<?= base_url('event/view/') . $row['id'] ?>" class="a_black">
                <div class="box">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <?php
                          if ($row['statusEvent'] == 'BERJALAN') {
                            echo '<span class="label_status bg-yellow round right" style="margin-left:5px">BERJALAN</span>';
                          } else if ($row['statusEvent'] == 'SELESAI') {
                            echo '<span class="label_status bg-green round right" style="margin-left:5px">SELESAI</span>';
                          } else if ($row['statusEvent'] == 'BATAL') {
                            echo '<span class="label_status bg-red round right" style="margin-left:5px">DIBATALKAN</span>';
                          } else {
                            echo '<span class="label_status bg-blue round right" style="margin-left:5px">DIBUKA</span>';
                          }
                          ?>
                        <img class="index-event" src="<?= $photo['url'] ?>">
                      </div>
                      <div class="col-lg-8">
                        <h4><b><?= strlen($row["title"]) > 25 ? substr($row["title"], 0, 25) . "..." : $row["title"] ?></b></h4>
                        <?= $row['alamat'] ?>
                        <br>
                        <small>
                          <?php if ((!$row['tgleventStart']) || (!$row['tgleventEnd'])) { ?>
                            <b>Coming Soon</b>
                          <?php  } else { ?>
                            <?= date('d M Y', strtotime($row['tgleventStart'])) . "<b> s/d </b>" . date('d M Y', strtotime($row['tgleventEnd'])) ?>
                          <?php } ?>
                        </small>
                        <br>
                        <div class="col-xs-12" style="color: black">
                          <b>
                            <img src="<?= base_url('assets/flaticon/icon_rider.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /><?= $rowraider[0]['rowraider'] ?>
                            <img src="<?= base_url('assets/flaticon/icon_team.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /><?= $rowteam[0]['rowteam'] ?>
                          </b>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="col-lg-12" align="center">
        <a href="<?= base_url('event') ?>">
          <button class="btn btn-primary btn-lg btn-blog" style="background-color: #72c02c;">Lihat Semua Event</button>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="cover2">
  </div>
</div>
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-6" align="center">
        <h5><b>News</b></h5>
        <?php foreach ($tbl_blog as $row) {
          $photo = $this->mymodel->selectDataone('file', array('table_id' => $row['id'], 'table' => 'tbl_blog')); ?>
          <div class="col-lg-12">
            <a href="<?= base_url('blogs/view/') . $row['id'] ?>" class="a_black">
              <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <img class="index-event" src="<?= $photo['url'] ?>">
                    </div>
                    <div class="col-lg-8">
                      <h4><b><?= strlen($row["title"]) > 25 ? substr($row["title"], 0, 25) . "..." : $row["title"] ?></b></h4>
                      <?= strlen($row["deskripsi"]) > 100 ? substr($row["deskripsi"], 0, 100) . "..." : $row["deskripsi"] ?>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php } ?>
        <div class="row" align="center">
          <div class="col-lg-12">
            <a href="<?= base_url('blogs') ?>">
              <button class="btn btn-primary btn-lg btn-blog" style="background-color: #72c02c;">Lihat Semua News</button>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6" align="center">
        <h5><b>Merchandise</b></h5>
        <div class="row">
          <?php foreach ($tbl_merchandise as $row) {
            $photo = $this->mymodel->selectDataone('file', array('table_id' => $row['id'], 'table' => 'tbl_merchandise')); ?>
            <div class="col-lg-6">
              <a href="<?= base_url('merchandise/view/') . $row['id'] ?>" class="a_black">
                <div class="box">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <?php
                          if ($row['status'] == 'ENABLE') {
                            echo '<span class="label_status bg-green round right" style="margin-left:5px">Stok Tersedia</span>';
                          } else {
                            echo '<span class="label_status bg-red round right" style="margin-left:5px">Stok Habis</span>';
                          }
                          ?>
                        <img src="<?= $photo['url'] ?>" class="mech-img">
                      </div>
                      <div class="col-lg-12">
                        <p>
                          <b class="title"><?= $row['title'] ?></b>
                          <br>
                          <small><b>Rp. <?= number_format($row['harga'], 0, ',', '.') ?>,- </b></small>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>
        <div class="row" align="center">
          <div class="col-lg-12">
            <a href="<?= base_url('merchandise') ?>">
              <button class="btn btn-primary btn-lg btn-blog" style="background-color: #72c02c;">Lihat Semua Merchandise</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>