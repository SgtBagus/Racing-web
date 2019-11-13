<div class="row">
    <div class="col-md-12">
        <h3 class="box-title" align="center">Event</h3>
    </div>
</div>
<form action="<?= base_url('event/addregister') ?>" method="POST" id="sumbit">
    <input type="hidden" name="team_id" value='<?= $this->session->userdata['id'] ?>'>
    <input type="hidden" name="event_id" value='<?= $tbl_event['id'] ?>'>
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
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <label>Pilih Rider</label>
                        <select class="form-control" data-placeholder="Select a State" style="width: 100%;" id="raiderSelect">
                            <option value="0" selected="">Pilih Rider</option>
                            <?php foreach ($raider as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" align="center" id="raiderList">
            <p class="help-block" id="raiderEmpty">Silakan Memilih Radier yang ingin diikut sertakan</p>
            <input type="hidden" id="teamvalue" value='0'>
        </div>
    </div>
    <div class="show_error"></div>
    <?php if ($tbl_event['status'] == 'ENABLE') { ?>
        <button id="buttonSubmit" class="btn btn-lg btn-block btn-primary btn-send">Kirim Pendaftaran</button>
    <?php } else { ?>
        <button class="btn btn-block btn-primary btn-send" disabled> Event ini telah di tutup</button>
    <?php } ?>
</form>
<script type="text/javascript">
    var array = 1;

    $(function() {
        $("#sumbit").submit(function() {
            var form = $(this);
            var mydata = new FormData(this);
            $.ajax({
                type: "POST",
                url: form.attr("action"),
                data: mydata,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".btn-send").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Memperoses...").attr('disabled', true);
                    form.find(".show_error").slideUp().html("");
                },

                success: function(response, textStatus, xhr) {
                    var str = response;
                    if (str.indexOf("success") != -1) {
                        form.find(".show_error").hide().html(response).slideDown("fast");
                        // location.href = '<?= base_url("monitorevent") ?>';
                        $(".btn-send").removeClass("disabled").html('Kirim Pendaftaran').attr('disabled', false);
                    } else {
                        form.find(".show_error").hide().html(response).slideDown("fast");
                        $(".btn-send").removeClass("disabled").html('Kirim Pendaftaran').attr('disabled', false);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    $(".btn-send").removeClass("disabled").html('Kirim Pendaftaran').attr('disabled', false);
                    form.find(".show_error").hide().html(xhr).slideDown("fast");
                }
            });
            return false;
        });
    });

    $("#buttonSubmit").attr("disabled", true);

    $(function() {
        $('#raiderSelect').change(function() {
            if ($('#raiderSelect').val() != '0') {
                $('#raiderEmpty').html('<p class="help-block" id="raiderEmpty">Radier yang di daftarkan !</p>');
                get_raider($('#raiderSelect').val());
            }
        });
    });

    function get_raider(id) {
        $.ajax({
            url: "<?= base_url() ?>event/get_raider/" + id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $.each(data, function(key, value) {
                    addRaider(value.id, value.name, value.alamat, value.url);
                });
            }
        });
    }

    function addRaider(id, name, alamat, img_url) {
        var value_team = parseInt($('#teamvalue').val()) + 1;

        $('#raiderList').append('<div class="box" id="raiderSelected_' + id + '">' +
            '<div class="box-body">' +
            '<div class="col-xs-5">' +
            '<img src="' + img_url + '" class="img-circle" alt="User Image" height="100px" width="100px">' +
            '</div>' +
            '<div class="col-xs-7">' +
            '<h4>' + name + '<br>' +
            '<small><img src="<?= base_url('assets/flaticon/worldwide.png') ?>" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" /> ' + alamat + '</small>' +
            '</h4>' +
            // '<button type="button" class="btn btn-sm btn-block btn-danger" onclick="deleteRaider(' + id + ')"> Hapus</button>' +
            '</div>' +
            '</div>' +
            '</div>');

        $('#buttonSubmit').before('<input type="hidden" id="raider_id-' + id + '" name="raiderarray[' + value_team + ']" value=' + id + '>')
        $("#buttonSubmit").attr("disabled", false);

        $("#raiderSelect option[value='" + id + "']").remove();
        $('#teamvalue').val(value_team);

        if ($('#teamvalue').val() == <?= $tbl_event['maxraider'] ?>) {
            $("#raiderSelect").attr("disabled", true);
        }

        if ($('#teamvalue').val() < <?= $tbl_event['minraider'] ?>) {
            $("#buttonSubmit").attr("disabled", true);
        }
    }

    function deleteRaider(value) {
        $("#raiderSelect").append("<option value='" + value + "'>" + value + "</option>");
        $("#raiderSelected_" + value).remove();
        $("#raider_id-" + value).remove();

        var value_team = parseInt($('#teamvalue').val()) - 1;
        $('#teamvalue').val(value_team);

        if ($('#teamvalue').val() < <?= $tbl_event['maxraider'] ?>) {
            $("#raiderSelect").attr("disabled", false);
        }

        if ($('#teamvalue').val() == 0) {
            $("#buttonSubmit").attr("disabled", true);
        }

        if ($('#teamvalue').val() < <?= $tbl_event['minraider'] ?>) {
            $("#buttonSubmit").attr("disabled", true);
        }
    }
</script>