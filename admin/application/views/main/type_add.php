<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tambah Tipe</h4>
                    </div>
                    <div class="content">
                        <?php echo form_open_multipart('type/validate'); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tipe</label> <?php echo "<strong><span class='text-danger pull-right'>".form_error('type_name')."</span></strong>"; ?>
                                        <input type="text" name="type_name" class="form-control border-input" placeholder="Masukkan Nama Tipe" value="<?php echo set_value('type_name'); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Kategori</label>
                                      <select name="category_id" class="form-control border-input">
                                      <?php
                                      if ($data) {
                                          foreach ($data as $key=>$result) {
                                      ?>
                                        <option value="<?php echo $result["category_id"]?>" <?php if($result["category_id"] == set_value('category_id')) echo "selected";?>> <?php echo $result["category_name"];?></option>
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
                                        <textarea name="type_description" class="form-control border-input" placeholder="Masukkan Deskripsi Tipe" maxlength="100"required><?php echo set_value('type_description'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="faq/" class="btn  btn-fill btn-wd btn-back">Batal</a>
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
