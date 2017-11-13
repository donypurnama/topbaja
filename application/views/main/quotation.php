<div id="content">
    <div class="container">
        <div class="col-md-offset-1 col-md-10">
            <div class="box">
                <h3>Penawaran / Permintaan</h3>

                <p class="text-muted" style="letter-spacing:0.5px;">Butuh Maintenance atau Pembelian Besar? Atau ingin mengajukan penawaran?</p>
                <p class="text-muted" style="letter-spacing:0.5px;">Silahkan isi form dibawah. Jika terdapat pertanyaan, anda dapat menghubungi melalui <a href="contact-us">Kontak Kami</a>, atau menggunakan fitur live chat dibawah. Customer Service kami siap melayani anda.</p>

                <hr>

                <form action="quotation/request" method="post">
                    <div class="form-group">
                        <label for="title">Judul *</label>
                        <input type="text" class="form-control" id="title" maxlength="100" value="<?php echo $data["quotation_title"]; ?>" name="quotation_title" required placeholder="Masukkan judul Penawaran/Permintaan (Cth: Pasang CCTV di kantor)">
                    </div>
                    <div class="form-group">
                        <label for="company_name">Nama Perusahaan (Jika Ada)</label>
                        <input type="text" class="form-control" id="company_name" maxlength="100" value="<?php echo $data["quotation_company_name"]; ?>" name="quotation_company_name" placeholder="Masukkan nama perusahaan (Jika ada)">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Lengkap *</label>
                        <input type="text" class="form-control" id="name" maxlength="100" value="<?php echo $data["quotation_person_name"]; ?>" name="quotation_person_name" required placeholder="Masukkan nama lengkap orang yang dapat dihubungi">
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori *</label>
                        <?php
                        $CCTV = $Jaringan = $Internet = $Maintenance = $Lainnya = "";
                        if ($data["quotation_category"] == "CCTV") $CCTV = "selected";
                        else if ($data["quotation_category"] == "Jaringan") $Jaringan = "selected";
                        else if ($data["quotation_category"] == "Internet") $Internet = "selected";
                        else if ($data["quotation_category"] == "Maintenance") $Maintenance = "selected";
                        else if ($data["quotation_category"] == "Lainnya") $Lainnya = "selected";
                        ?>
                        <select class="form-control" name="quotation_category" required>
                          <option <?php echo $CCTV; ?> value="CCTV">CCTV</option>
                          <option <?php echo $Jaringan; ?> value="Jaringan">Jaringan</option>
                          <option <?php echo $Internet; ?> value="Internet">Internet</option>
                          <option <?php echo $Maintenance; ?> value="Maintenance">Maintenance</option>
                          <option <?php echo $Lainnya; ?> value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon *</label>
                        <input type="number" class="form-control" maxlength="20" value="<?php echo $data["quotation_person_phone"]; ?>" name="quotation_person_phone" id="phone" required placeholder="Masukkan nomor Telepon/HP yang dapat dihubungi">
                    </div>
                    <div class="form-group">
                        <label for="email_address">Email *</label>
                        <input type="email" class="form-control" id="email_address" value="<?php echo $data['quotation_person_email']; ?>" name="quotation_person_email" required placeholder="Masukkan email aktif yang dapat dihubungi">
                    </div>
                    <div class="form-group">
                        <label for="description">Keterangan *</label>
                        <textarea class="form-control" style="resize:none;" rows="10" value="" name="quotation_description" required placeholder="Masukkan keterangan Permintaan/Penawaran Anda"><?php echo $data["quotation_description"]; ?></textarea>
                    </div>
                    <div class="form-group text-left">
                      <span style="color:red;" id="error_msg"><?php echo validation_errors(); ?></span>
                      <br>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i>Ajukan</button>
                    </div>
                    <!-- <div class="form-group">
                      <hr>
                      <div class="g-recaptcha" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;" data-badge="inline" data-sitekey="6LcnBR4UAAAAAFG_8ARjlHICicGcet21IH19-oSc" data-bind="recaptcha-submit" data-callback="submitForm">
                      </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>
