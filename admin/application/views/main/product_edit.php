<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Produk</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="product/update" enctype="multipart/form-data">
                          <?php echo "<span class='text-danger'>".$this->session->flashdata('error_upload')."</span>";?>
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-12">
                                        <label>Nama Produk</label>
                                        <input type="text" name="product_name" class="form-control border-input" placeholder="Masukkan Nama Produk" maxlength="150" value="<?php echo $data['product_name']?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-12">
                                        <label>Produk SKU</label>
                                        <input type="text" name="product_sku" class="form-control border-input" placeholder="Masukkan Produk SKU" maxlength="20"value="<?php echo $data['product_sku']?>" required >
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                  <div class="col-md-12">
                                        <label>Kategori</label>
                                        <select name="category_id" class="form-control border-input" id="category">
                                          <option selected disabled>--Pilih Kategori--</option>
                                          <?php
                                          if ($categories) {
                                              foreach ($categories as $key=>$result) {
                                          ?>
                                            <option value="<?php echo $result["category_id"]?>" <?php if ($data["category_id"] == $result["category_id"]) echo 'selected';?>><?php echo $result["category_name"]?></option>
                                          <?php

                                            }
                                          }
                                          ?>
                                        </select>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-12">
                                      <label>Tipe</label>
                                      <select name="type_id" class="form-control border-input" id="type">
                                        <option selected disabled>--Pilih Tipe--</option>
                                        <?php
                                        if ($types) {
                                            foreach ($types as $key=>$result) {
                                        ?>
                                          <option value="<?php echo $result["type_id"]?>" <?php if ($data["type_id"] == $result["type_id"]) echo 'selected';?>><?php echo $result["type_name"]?></option>
                                        <?php
                                          }
                                        }
                                        ?>
                                        </select>
                                      </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-12">
                                      <label>Brand</label>
                                      <select name="brand_id" class="form-control border-input" id="brand">
                                        <option selected disabled>--Pilih Brand--</option>
                                        <?php
                                        if ($brands) {
                                            foreach ($brands as $key=>$result) {
                                        ?>
                                          <option value="<?php echo $result["brand_id"]?>" <?php if ($data["brand_id"] == $result["brand_id"]) echo 'selected';?>><?php echo $result["brand_name"]?></option>
                                        <?php
                                          }
                                        }
                                        ?>
                                      </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                  <div class="col-md-3">
                                      <label>Panjang</label> <span class="text-scale"> (cm)</span>
                                      <input type="text" name="product_length" class="form-control border-input" pattern="[0-9.]*" placeholder="0" maxlength="10" min="0" value="<?php echo $data['product_length'];?>" required >
                                  </div>
                                  <div class="col-md-3">
                                      <label>Lebar</label> <span class="text-scale"> (cm)</span>
                                      <input type="text" name="product_width" class="form-control border-input" pattern="[0-9.]*" placeholder="0" maxlength="10" min="0"value="<?php echo $data['product_width'];?>" required >
                                  </div>
                                  <div class="col-md-3">
                                      <label>Tinggi</label> <span class="text-scale"> (cm)</span>
                                      <input type="text" name="product_height" class="form-control border-input" pattern="[0-9.]*" placeholder="0" maxlength="10" min="0" value="<?php echo $data['product_height'];?>" required >
                                  </div>
                                  <div class="col-md-3">
                                      <label>Berat</label><span class="text-scale"> (g)</span>
                                      <input type="text" name="product_weight" class="form-control border-input" pattern="[0-9.]*" placeholder="0" maxlength="10" min="0" value="<?php echo $data['product_weight'];?>"required >
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                      <label>Harga</label>
                                      <input type="text" name="product_price" class="form-control border-input number" pattern="[0-9.]*" maxlength="10" min="0" placeholder="0" value="<?php echo $data['product_price'];?>"required >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Discount</label> <span class="text-scale"> (%)</span>
                                      <input type="text" name="product_discount" class="form-control border-input" pattern="[0-9,$]*" maxlength="10" min="0" max="100" step="5" placeholder="0" value="<?php echo $data['product_discount'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Gambar Produk</label>
                                      <br><img src="../file_assets/products/<?php echo $data["product_primary_image"];?>" alt="<?php echo $data["product_name"];?>" class="col-md-6 img-responsive"/>
                                      <input type="file" name="product_image" class="form-control border-input" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="product_description" class="form-control border-input" placeholder="Masukkan Deskripsi Produk" maxlength="200" required><?php echo $data['product_description'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                  <div class="col-md-12">
                                      <label>Keywords</label>
                                      <input type="text" name="product_meta_description" class="form-control border-input" placeholder="Keywords Produk pisahkan dengan tanda ," maxlength="160" value="<?php echo $data['product_meta_description'];?>"required >
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" name="product_courier" id="0" value="1" <?php if($data['product_courier']==1) echo "checked";?>/> <label for="0">Gratis Biaya Kirim (pilih daerah)</label>
                                        <p class="text-date">*Jika tidak di check maka akan menggunakan jasa pengiriman dari RAJA ONGKIR</p>

                                        <!-- <div class="funkyradio"> -->
                                          <!-- <div class="funkyradio-default"> -->
                                            <!-- <?php
                                            if ($freecourier) {
                                                $i=1;
                                                foreach ($freecourier as $key=>$result) { ?>
                                                  <input type="checkbox" name="product_free_courier_id[]" value="<?php echo $result["free_courier_name"]?>" id="checkbox<?php echo $i;?>"/>
                                                  <label for="checkbox<?php echo $i;?>"><?php echo $result["free_courier_desc"]?></label>
                                            <?php
                                                  $i++;
                                              }
                                            }
                                            ?> -->
                                          <!-- </div> -->
                                        <!-- </div> -->
                                      <div class="funkyradio">
                                          <div class="funkyradio-default">
                                              <input type="checkbox" name="product_free_courier_id[]" value="ina" id="checkbox1"
                                              <?php
                                                if(in_array("ina", $exp_product_free_courier_id)) { echo "checked"; }
                                              ?>/>
                                              <label for="checkbox1">Seluruh Indonesia</label>
                                          </div>
                                          <div class="funkyradio-primary">
                                              <input type="checkbox" name="product_free_courier_id[]" value="jkt" id="checkbox2"
                                              <?php
                                                if(in_array("jkt", $exp_product_free_courier_id)) { echo "checked"; }
                                              ?>/>
                                              <label for="checkbox2">Jabodetabek</label>
                                          </div>
                                          <div class="funkyradio-success">
                                              <input type="checkbox" name="product_free_courier_id[]" value="java" id="checkbox3"
                                              <?php
                                              if(in_array("java", $exp_product_free_courier_id)) { echo "checked"; }
                                              ?>/>
                                              <label for="checkbox3">Pulau Jawa</label>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="funkyradio">
                                            <div class="funkyradio-default">
                                                <input type="radio" name="product_status" id="inactive" value="0" <?php if($data['product_status']==0) echo "checked";?>/>
                                                <label for="inactive">inActive</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="product_status" id="active" value="1" <?php if($data['product_status']==1) echo "checked";?>/>
                                                <label for="active">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="product/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                                <input type="hidden" name="product_id" value="<?php echo $data['product_id']?>"/>
                                <input type="submit" class="btn btn-success btn-fill btn-wd" value="Simpan">
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
