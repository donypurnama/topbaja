<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ubah Gallery</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="galleries/update" enctype="multipart/form-data">
                          <?php echo "<span class='text-danger'>".$this->session->flashdata('error_upload')."</span>";?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Banner</label>
                                      <img src="../file_assets/galleries/<?php echo $data["gallery_image"];?>" alt="<?php echo $data["gallery_url"];?>" class="img-responsive"/>
                                      <input type="file" name="gallery_image" class="form-control border-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" name="gallery_title" class="form-control border-input" placeholder="Masukkan Judul" value="<?php echo $data["gallery_title"]; ?>"readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deksripsi</label>
                                        <textarea name="gallery_description" class="form-control border-input" placeholder="Masukkan URL "><?php echo $data["gallery_description"];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>URL</label>
                                        <textarea name="gallery_url" class="form-control border-input" placeholder="Masukkan URL "><?php echo $data["gallery_url"];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                  <div class="col-md-12">
                                        <label>Kategori Galleries</label>
                                        <select name="gallery_category_id" class="form-control border-input" id="category">
                                          <option selected disabled>--Pilih Kategori--</option>
                                          <?php
                                          if ($galleries_category) {
                                              foreach ($galleries_category as $key=>$result) {
                                          ?>
                                            <option value="<?php echo $result["gallery_category_id"]?>" <?php if ($data["gallery_category_id"] == $result["gallery_category_id"]) echo 'selected';?>><?php echo $result["gallery_category_name"]?></option>
                                          <?php

                                            }
                                          }
                                          ?>
                                        </select>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="funkyradio">
                                            <div class="funkyradio-default">
                                                <input type="radio" name="gallery_status" id="inactive" value="0" <?php if ($data['gallery_status'] == "0") echo 'Checked';?> checked/>
                                                <label for="inactive">Inactive</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="gallery_status" id="active" value="1" <?php if ($data['gallery_status'] == "1") echo 'Checked';?>/>
                                                <label for="active">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="galleries/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                                <input type="hidden" name="gallery_id" value="<?php echo $data["gallery_id"]; ?>"/>
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
