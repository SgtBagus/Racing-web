<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid round">
                    <div class="box-body">
                        <ul class="nav nav-pills p-2">
                            <li class="nav-item active"><a class="nav-link active" href="#tab_info" data-toggle="tab">Data Rider</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_password" data-toggle="tab">Password</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_image" data-toggle="tab">Photo</a></li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_info">
                                    <form action="<?= base_url('dashboard/editaccount') ?>" method="post" enctype="multipart/form-data" id="editaccount">
                                        <div class="show_error_account"></div>
                                        <input type="hidden" name="id" class="form-control" value="<?= $raider['id'] ?>">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="dt[name]" class="form-control" value="<?= $raider['name'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="dt[alamat]" class="form-control" rows="5"><?= $raider['alamat'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Kota</label>
                                            <input type="text" name="dt[kota]" class="form-control" value="<?= $raider['kota'] ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="date" name="dt[tgllahir]" class="form-control" value="<?= $raider['tgllahir'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Start</label>
                                                    <input type="number" name="dt[nostart]" class="form-control" value="<?= $raider['nostart'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama di Jersey</label>
                                            <input type="text" name="dt[namajersey]" class="form-control" value="<?= $raider['namajersey'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Ukuran Jersey</label>
                                            <div class="form-group">
                                                <label>
                                                    <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="S" <?php if ($raider['ukuran_jersey'] == 'S') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                                    S
                                                </label>
                                                <label>
                                                    <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="M" <?php if ($raider['ukuran_jersey'] == 'M') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                                    M
                                                </label>
                                                <label>
                                                    <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="L" <?php if ($raider['ukuran_jersey'] == 'L') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                                    L
                                                </label>
                                                <label>
                                                    <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="XL" <?php if ($raider['ukuran_jersey'] == 'XL') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                                    XL
                                                </label>
                                                <label>
                                                    <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="XXL" <?php if ($raider['ukuran_jersey'] == 'XXL') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                                    XXL
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Wa</label>
                                                    <input type="text" name="dt[nowa]" class="form-control" value="<?= $raider['nowa'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama Motor</label>
                                                    <select class="form-control" name="dt[motor_id]">
                                                        <?php
                                                        $master_motor = $this->mymodel->selectData("master_motor");
                                                        foreach ($master_motor as $key => $value) {
                                                            ?>
                                                            <option value="<?= $value['id'] ?>" <?php if ($raider['motor_id'] == $value['id']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?= $value['value'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gol. Darah</label>
                                                    <input type="text" name="dt[goldarah]" class="form-control" value="<?= $raider['goldarah'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="dt[email]" class="form-control" value="<?= $raider['email'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-send btn-lg btn-block btn-primary">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_password">
                                    <form role="form" action="<?= base_url('riderpassword/editpassword') ?>" method="POST" id="sumbit">
                                        <div class="show_error"></div>
                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input type="password" name="newpassword" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Konfrimasi Password Baru</label>
                                            <input type="password" name="conf_newpassword" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Password Lama</label>
                                            <input type="password" name="lastpassword" class="form-control">
                                        </div>
                                        <div class="show_error"></div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-send btn-lg btn-block btn-primary">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_image">
                                    <form action="<?= base_url('dashboard/editphoto') ?>" method="post" enctype="multipart/form-data" id="editphoto">
                                        <input type="hidden" name="id" class="form-control" value="<?= $raider['id'] ?>">
                                        <div class="show_error_image"></div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Foto Profil</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div align="center">
                                                        <?php if ($file != NULL) { ?>
                                                            <img class="img-circle" alt="User Image" src="<?= $file['url'] ?>" alt="Third slide" height="250px" width="250px" style="margin-bottom: 10px" id="preview">
                                                        <?php } else { ?>
                                                            <img class="img-circle" alt="User Image" src="<?= base_url('webfiles/raider/raider_default.png') ?>" alt="Third slide" height="250px" width="250px" style="margin-bottom: 10px" id="preview">
                                                        <?php } ?>
                                                        <div class="input-group" id="preview_image">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary" id="btnFile">Pilih Gambar</button>
                                                    <input name="file" type="file" class="file" id="imageFile" style="display: none;" name="file" accept="image/x-png,image/jpeg,image/jpg" />
                                                    <p class="help-block">Foto yang diupload disarankan memiliki format PNG, JPG, atau JPEG</p>
                                                    <div class="row" align="right">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn-send btn btn-primary btn-send"><i class="fa fa-edit"></i> Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#editaccount").submit(function() {
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
                $(".btn-send").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Processing...").attr('disabled', true);
                form.find(".show_error_account").slideUp().html("");
            },

            success: function(response, textStatus, xhr) {
                var str = response;
                if (str.indexOf("success") != -1) {
                    form.find(".show_error_account").hide().html(response).slideDown("fast");
                    setTimeout(function() {

                    }, 1000);

                    $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                } else {
                    form.find(".show_error_account").hide().html(response).slideDown("fast");
                    $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr);
                $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                form.find(".show_error_account").hide().html(xhr).slideDown("fast");
            }
        });
        return false;
    });


    $("#editpassword").submit(function() {
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
                $(".btn-send").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Processing...").attr('disabled', true);
                form.find(".show_error_password").slideUp().html("");
            },

            success: function(response, textStatus, xhr) {
                var str = response;
                if (str.indexOf("success") != -1) {
                    form.find(".show_error_password").hide().html(response).slideDown("fast");
                    setTimeout(function() {

                    }, 1000);

                    $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                } else {
                    form.find(".show_error_password").hide().html(response).slideDown("fast");
                    $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr);
                $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                form.find(".show_error_password").hide().html(xhr).slideDown("fast");
            }
        });
        return false;
    });

    $("#editphoto").submit(function() {
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
                $(".btn-send").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Processing...").attr('disabled', true);
                form.find(".show_error_image").slideUp().html("");
            },

            success: function(response, textStatus, xhr) {
                var str = response;
                if (str.indexOf("success") != -1) {
                    form.find(".show_error_image").hide().html(response).slideDown("fast");
                    setTimeout(function() {

                    }, 1000);

                    $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                } else {
                    form.find(".show_error_image").hide().html(response).slideDown("fast");
                    $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr);
                $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                form.find(".show_error_image").hide().html(xhr).slideDown("fast");
            }
        });
        return false;
    });
</script>