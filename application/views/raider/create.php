<div class="row">
    <div class="col-md-12">
        <h3 class="box-title" align="center">Tambah Rider</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form role="form" action="<?= base_url('raider/store') ?>" method="POST" id="sumbit">
            <div class="show_error"></div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="dt[name]" class="form-control">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="dt[alamat]" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Kota</label>
                <input type="text" name="dt[kota]" class="form-control">
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="dt[tgllahir]" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Nomor Start</label>
                        <input type="number" name="dt[nostart]" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Nama di Jersey</label>
                <input type="text" name="dt[namajersey]" class="form-control">
            </div>
            <div class="form-group">
                <label>Ukuran Jersey</label>
                <div class="form-group">
                    <label>
                        <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="S" checked>
                        S
                    </label>
                    <label>
                        <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="M">
                        M
                    </label>
                    <label>
                        <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="L">
                        L
                    </label>
                    <label>
                        <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="XL">
                        XL
                    </label>
                    <label>
                        <input type="radio" name="dt[ukuran_jersey]" class="minimal" value="XXL">
                        XXL
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Nomor Wa</label>
                        <input type="text" name="dt[nowa]" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Nama Motor</label>
                        <select class="form-control" name="dt[motor_id]">
                            <?php
                            $master_motor = $this->mymodel->selectData("master_motor");
                            foreach ($master_motor as $key => $value) {
                                ?>
                                <option value="<?= $value['id'] ?>"><?= $value['value'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label>Gol. Darah</label>
                        <input type="text" name="dt[goldarah]" class="form-control">
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="dt[email]" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <div class="input-group" id="preview_image">
                    <button type="button" class="btn btn-lg btn-primary" id="btnFile">Pilih Gambar</button>
                    <input name="file" type="file" class="file" id="imageFile" style="display: none;" name="file" accept="image/x-png,image/jpeg,image/jpg" />
                </div>
                <p class="help-block">Foto yang diupload disarankan memiliki format PNG, JPG, atau JPEG</p>
            </div>
            <div class="show_error"></div>
            <div class="form-group">
                <button type="submit" class="btn btn-send btn-lg btn-block btn-primary">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
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
                        location.href = '<?= base_url("raider") ?>';
                        $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Simpan').attr('disabled', false);
                    } else {
                        form.find(".show_error").hide().html(response).slideDown("fast");
                        $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Simpan').attr('disabled', false);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Simpan').attr('disabled', false);
                    form.find(".show_error").hide().html(xhr).slideDown("fast");
                }
            });
            return false;
        });
    });
</script>