<div id="content">
    <div class="container">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                  <a href="home">Home</a>
                </li>
                <li>Kontak Kami</li>
            </ul>

        </div>

        <div class="col-md-9">
          <div class="box">
              <h3>Kontak Kami</h3>
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <form action="contact-us/request" method="post">
                      <div class="form-group">
                          <label for="title">Subjek *</label>
                          <input type="text" class="form-control" id="title" maxlength="100" value="<?php echo $data["contact_title"]; ?>" name="contact_title" required placeholder="Masukkan judul pertanyaan/subjek">
                      </div>
                      <div class="form-group">
                          <label for="company_name">Nama Perusahaan (Jika Ada)</label>
                          <input type="text" class="form-control" id="company_name" maxlength="100" value="<?php echo $data["contact_company_name"]; ?>" name="contact_company_name" placeholder="Masukkan nama perusahaan (Jika ada)">
                      </div>
                      <div class="form-group">
                          <label for="name">Nama Lengkap *</label>
                          <input type="text" class="form-control" id="name" maxlength="100" value="<?php echo $data["contact_person_name"]; ?>" name="contact_person_name" required placeholder="Masukkan nama lengkap orang yang dapat dihubungi">
                      </div>
                      <div class="form-group">
                          <label for="phone">Nomor Telepon *</label>
                          <input type="number" class="form-control" maxlength="20" value="<?php echo $data["contact_person_phone"]; ?>" name="contact_person_phone" id="phone" required placeholder="Masukkan nomor Telepon/HP yang dapat dihubungi">
                      </div>
                      <div class="form-group">
                          <label for="email_address">Email *</label>
                          <input type="email" class="form-control" id="email_address" value="<?php echo $data['contact_person_email']; ?>" name="contact_person_email" required placeholder="Masukkan email aktif yang dapat dihubungi">
                      </div>
                      <div class="form-group">
                          <label for="description">Keterangan *</label>
                          <textarea class="form-control" style="resize:none;" rows="10" value="" name="contact_description" required placeholder="Masukkan keterangan pertanyaan atau permasalahan Anda"><?php echo $data["contact_description"]; ?></textarea>
                      </div>
                      <div class="form-group text-left">
                        <span style="color:red;" id="error_msg"><?php echo validation_errors(); ?></span>
                        <br>
                      </div>
                      <div class="form-group text-right">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-comment-o"></i>Kirim Pertanyaan</button>
                      </div>
                      <!-- <div class="form-group">
                        <div class="g-recaptcha" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;" data-badge="inline" data-sitekey="6LcnBR4UAAAAAFG_8ARjlHICicGcet21IH19-oSc" data-bind="recaptcha-submit" data-callback="submitForm">
                        </div>
                      </div> -->
                  </form>
                </div>
              </div>
          </div>
        </div>
        <!-- /.col-md-9 -->
        <div class="col-md-3">
            <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                    <h3 class="panel-title">Halaman penting</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                      <li class="active">
                          <a href="#">Cara Pemesanan</a>
                      </li>
                        <li>
                            <a href="policy">Kebijakan Pengunjung</a>
                        </li>
                        <li>
                            <a href="terms-and-conditions">Syarat dan Ketentuan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
