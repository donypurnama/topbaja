<div id="content">
    <div class="container">
      <!--untuk error message-->
      <?php if ($this->session->flashdata("front_login_wishlist") || $this->session->flashdata("front_login_cart") || $this->session->flashdata("front_login_redirect")){?>
      <div class="col-md-offset-3 col-md-6">
        <div class="box text-center">
          <?php
          echo $this->session->flashdata("front_login_redirect");
          echo $this->session->flashdata("front_login_wishlist");
          echo $this->session->flashdata("front_login_cart");
          ?>
        </div>
      </div>
      <?php } ?>

      <div class="col-md-offset-3 col-md-6">
          <div class="box">
              <h1>Login</h1>
              <p class="text-muted">Belum terdaftar? Silahkan melakukan <a href="register">registrasi disini</a></p>
              <hr>

              <form action="login/validate_login" method="post">
                  <div class="form-group">
                      <label for="email">Email *</label>
                      <input type="email" name="customer_email_address" placeholder="Masukkan email Anda" class="form-control" value="<?php echo $data["customer_email_address"];?>" required>
                  </div>
                  <div class="form-group">
                      <label for="password">Password *</label>
                      <input type="password" name="customer_passcode" placeholder="Masukkan password Anda" class="form-control" value="<?php echo $data["customer_passcode"]; ?>" required>
                  </div>
                  <div class="form-group text-danger">
                    <?php
                    echo $this->session->flashdata("front_login_err");
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
