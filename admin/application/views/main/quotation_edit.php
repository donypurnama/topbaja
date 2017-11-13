<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php
            if ($data) {
                foreach ($data as $key=>$result) {
            ?>
            <div class="col-md-offset-1 col-md-10">
                <div class="card">
                    <div class="header">
                        <div class="col-md-12">
                          <h4 class="title"><strong><?php echo $result['quotation_title']?></strong></h4>
                          <p class="text-order">Tanggal Transaksi: <?php echo date("d-M-Y", strtotime($result["quotation_created_time"]));?></strong></p>
                          <hr>
                        </div>
                    </div>
                    <div class="content">
                      <form method="POST" action="quotation/update">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Kategori Permintaan</label>
                                      <select name="quotation_category" class="form-control border-input">
                                        <option value="" disabled="">-- Pilih Kategori --</option>
                                        <option value="CCTV" <?php if ($result['quotation_category']=="CCTV") echo "selected"?>> CCTV </option>
                                        <option value="Jaringan" <?php if ($result['quotation_category']=="Jaringan") echo "selected"?>> Jaringan </option>
                                        <option value="Internet" <?php if ($result['quotation_category']=="Internet") echo "selected"?>> Internet </option>
                                        <option value="Maintenance" <?php if ($result['quotation_category']=="Maintenance") echo "selected"?>> Maintenance </option>
                                        <<option value="Lainnya" <?php if ($result['quotation_category']=="Lainnya") echo "selected"?>> Lainnya </option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Nama Pelanggan</label>
                                      <input type="text" name="quotation_person_name" class="form-control border-input" placeholder="Masukkan Nama Pemesan" required value="<?php echo $result["customer_first_name"]." ".$result["customer_last_name"]; ?>">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Telepon</label>
                                      <input type="text" name="quotation_person_phone" class="form-control border-input" placeholder="Masukkan Telepon Pemesan" required value="<?php echo $result["quotation_person_phone"]; ?>">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Email</label>
                                      <input type="text" name="quotation_person_email" class="form-control border-input" placeholder="Masukkan Telepon Pemesan" required value="<?php echo $result["quotation_person_email"]; ?>">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Nama Perusahaan</label>
                                      <input type="text" name="quotation_company_name" class="form-control border-input" placeholder="Masukkan Nama Perusahaan" required value="<?php echo $result["quotation_company_name"]; ?>">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Description</label>
                                      <textarea name="quotation_description" class="form-control border-input" placeholder="Masukkan Jawaban" required><?php echo $result["quotation_description"]; ?></textarea>
                                  </div>
                              </div>
                          </div>
                          <div class="text-right">
                              <a href="quotation/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                              <input type="hidden" name="quotation_id" value="<?php echo $result["quotation_id"]; ?>"/>
                              <input type="submit" data-target="#confirm-save" class="btn btn-success btn-fill btn-wd" value="Simpan">
                              
                          </div>
                          <div class="clearfix"></div>
                      </form>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
            ?>
            <div class="col-md-offset-1 col-md-10">
              <div class="card">
                <h5>Tidak ada Data</h5>
              </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
