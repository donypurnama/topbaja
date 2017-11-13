<div id="content">
    <div class="container">
      <!--untuk error message-->
      <?php if ($this->session->flashdata("back_login_redirect")){?>
      <div class="col-md-offset-3 col-md-6">
        <div class="box text-center">
          <?php
          echo $this->session->flashdata("back_login_redirect");
          ?>
        </div>
      </div>
      <?php } ?>

      <div class="col-md-offset-3 col-md-6">
          <div class="box text-center" style="margin-top:20%;">
              <img src="../logo.png" class="img-responsive" style="width:300px; margin:0 auto;"/>
              <h4 style="margin:0;padding:0;color:#999;">Dashboard</h4>
              <hr>
              <form action="login/validate_login" method="post" class="text-left">
                  <div class="form-group">
                      <label for="email">Username *</label>
                      <input type="text" name="user_name" placeholder="Masukkan User Name Anda" class="form-control" value="<?php echo $data["user_name"];?>" required>
                  </div>
                  <div class="form-group">
                      <label for="password">Password *</label>
                      <input type="password" name="user_passcode" placeholder="Masukkan password Anda" class="form-control" value="<?php echo $data["user_passcode"]; ?>" required>
                  </div>
                  <div class="form-group text-danger">
                    <?php
                    echo $this->session->flashdata("back_login_err");
                    ?>
                  </div>
                  <div class="text-right">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
</div>
<script>
  function submitForm() {
      document.getElementById("registrationForm").submit();
  }
</script>
