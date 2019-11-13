<div class="row">
  <div class="col-md-12">
    <form action="<?= base_url('login/act_login') ?>" method="POST" id="login_form">
      <h3 align="center" style="margin-bottom: 30px;">Masuk Sebagai Tim</h3>
      <div class="show_error" id="error_input"></div>
      <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
        <!-- <p class="help-block"><a href="<?= base_url('login/password') ?>"> Lupa Password ? </a></p> -->
      </div>
      <div class="form-group" style="margin-top: 30px;">
        <button type="submit" class="btn btn-block btn-primary">
            Masuk
        </button>
      </div>
      <p class="help-block pull-right">Tidak Punya Akun ? <a href="<?= base_url('login/register') ?>">Daftar Disini </a></p>
    </form>
  </div>
</div>
<script type="text/javascript">
  $("#login_form").submit(function() {
    var mydata = new FormData(this);
    var form = $(this);
    $.ajax({
      type: "POST",
      url: form.attr("action"),
      data: mydata,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response, textStatus, xhr) {
        var str = response;
        if (str.indexOf("success") != -1) {
          window.location.href = "<?= base_url() ?>";
        } else {
          $("#error_input").hide().html(response).slideDown("fast");
        }
      },
    });
    return false;
  });
</script>
