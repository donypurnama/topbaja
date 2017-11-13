<div id="content">
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <div class="box">
                <h3>Akun Baru</h3>
                <p class="text-muted" style="letter-spacing:0.5px;">Sudah terdaftar? Silahkan <a href="login">login disini</a></p>
                <p class="text-muted" style="letter-spacing:0.5px;">Setelah registrasi anda dapat berbelanja segala jenis produk kami dengan berbagai penawaran menarik!</p>
                <hr>
                <form action="register/validate" method="post" id="registrationForm">
                  <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Nama Depan *</label>
                        <input type="text" class="form-control" name="customer_first_name" maxlength="100" value="<?php echo $data["customer_first_name"]; ?>" required placeholder="Masukkan nama depan Anda">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="last_name">Nama Belakang *</label>
                        <input type="text" class="form-control" name="customer_last_name" maxlength="100" value="<?php echo $data["customer_last_name"]; ?>"required placeholder="Masukkan nama belakang Anda">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email_address">Email *</label>
                        <input type="email" class="form-control" name="customer_email_address" maxlength="100" value="<?php echo $data["customer_email_address"]; ?>" required placeholder="Masukkan alamat email Anda">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="phone">Nomor HP/Telepon *</label>
                        <input type="number" class="form-control" id="phone" name="customer_phone" min="0" maxlength="15" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $data["customer_phone"]; ?>" required placeholder="Masukkan nomor telepon Anda">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="gender">Jenis Kelamin *</label>
                        <?php
                        $male = $female = "";
                        if ($data["customer_gender"] == "2") $female = "selected";
                        else $male = "selected";
                        ?>
                        <select class="form-control" name="customer_gender" required>
                            <option <?php echo $male; ?> value="1">Pria</option>
                            <option <?php echo $female; ?> value="2">Wanita</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="last_name">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="customer_company_name" maxlength="100" placeholder="(Optional)" value="<?php echo $data["customer_company_name"]; ?>" placeholder="Masukkan nama perusahaan (Jika ada)">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="passcode">Password (8 sampai 20 karakter)*</label>
                        <input type="password" class="form-control" id="reg_passcode" minlength="8" maxlength="20" name="customer_passcode" value="<?php echo $data["customer_passcode"]; ?>" required placeholder="Masukkan password Anda">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="passcode">Konfirmasi Password *</label>
                        <input type="password" class="form-control" id="reg_verify_passcode" minlength="8" maxlength="20" name="customer_passconf" value="<?php echo $data["customer_passconf"]; ?>" required placeholder="Masukkan kembali password Anda">
                    </div>
                    <div class="col-sm-12 text-left">
                      <span style="text-danger" id="error_msg"><?php echo validation_errors(); ?></span>
                      <br>
                    </div>
                    <div class="col-sm-12 text-right" style="padding-top:20px;">
                      <button type="submit" class="btn btn-primary btn-md" id="btnRegistration"><i class="fa fa-user-md"></i> Daftar sekarang</button>
                    </div>
                    <!-- <div class="col-sm-12">
                      <hr>
                      <div class="g-recaptcha" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;" data-badge="inline" data-sitekey="6LcnBR4UAAAAAFG_8ARjlHICicGcet21IH19-oSc" data-bind="recaptcha-submit" data-callback="submitForm">
                      </div>
                    </div> -->
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
