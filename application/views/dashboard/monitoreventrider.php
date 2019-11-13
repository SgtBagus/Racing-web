<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid round">
                    <div class="box-body">
                        <div class="row" align="center">
                            <h3><b>Data Ikut Serta Event</b></h3>
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