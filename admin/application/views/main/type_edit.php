<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Tipe</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="type/update">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <input type="text" name="type_name" class="form-control border-input" placeholder="Masukkan Nama Tipe" value="<?php echo $data["type_name"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Kategori</label>
                                      <select name="category_id" class="form-control border-input">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="type_description" class="form-control border-input" placeholder="Masukkan Deskripsi Tipe" maxlength="100"required><?php echo $data["type_description"]?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="faq/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                                <input type="hidden" name="type_id" value="<?php echo $data["type_id"]; ?>"/>
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
