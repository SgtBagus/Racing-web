<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-solid round">
                    <div class="box-body">
                        <div class="row">
                            <?php if ($team) { ?>
                                <div class="col-md-4" align="center">
                                    <?php if ($file_team) { ?>
                                        <img src="<?= $file_team['url'] ?>" class="img-circle" alt="User Image" width="75px" height="75px">
                                    <?php } else { ?>
                                        <img src="<?= base_url('webfiles/team/team_default.png') ?>" class="img-circle" alt="User Image" width="75px" height="75px">
                                    <?php } ?>
                                </div>
                                <div class="col-md-8">
                                    Bergabung Pada Team
                                    <h4><b><?= $team['name'] ?></b></h4>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-12" align="center">
                                    Belum Terdaftar Tergabung Dengan Team
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-solid round">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4" align="center">
                                <img src="<?= base_url('assets/flaticon/racing-flag.png') ?>" class="img-circle" alt="User Image" width="75px" height="75px">
                            </div>
                            <div class="col-md-8">
                                Ikut Serta Dalam Event
                                <h4><b><?= $rider['eventikut'] ?></b></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid round">
                    <div class="box-body">
                        <div class="row" align="center">
                            <h3><b>Data Ikut Serta Event </b><small>(APPROVED)</small></small>
                        </div>
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Mendaftar</th>
                                    <th>Judul Event</th>
                                    <th>Catatan Admin</th>
                                    <th>Status Pendaftaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($tbl_event_register as $row) {
                                    $event =  $this->mymodel->selectDataOne('tbl_event', array('id' => $row['event_id']));
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><b><?= $row['created_at'] ?></b></td>
                                        <td><?= $event['title'] ?></td>
                                        <td><?= $row['note'] ?></td>
                                        <td>
                                            <?php
                                                if ($row['approve'] == 'WAITING') {
                                                    $approve = '<small class="label bg-yellow"><i class="fa fa-warning"> </i> Menunggu Dikonfirmasi </small>';
                                                } else if ($row['approve'] == "APPROVE") {
                                                    $approve = '<small class="label bg-green"><i class="fa fa-check"> </i> Pendaftaran Di Terima </small>';
                                                } else if ($row['approve'] == "REJECT") {
                                                    $approve = '<small class="label bg-red"><i class="fa fa-ban"> </i> Pendaftaran Di Tolak </small>';
                                                }
                                                ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>