<div class="content">
  <div class="container">
    <div class="box">
      <div class="box-body">
        <form action="<?= base_url('login/act_login_rider') ?>" method="POST" id="login_form">
          <h1 align="center" style="margin-bottom: 30px;">Masuk Sebagai Rider</h1>
          <div class="show_error" id="error_input"></div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group" style="margin-top: 30px;">
            <button type="submit" class="btn btn-block btn-primary">
              Masuk
            </button>
          </div>
          <p class="help-block pull-right">Tidak Punya Akun Rider ? <a href="<?= base_url('login/registerrider') ?>">Daftar Disini </a></p>
        </form>
      </div>
    </div>
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