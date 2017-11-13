<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tambah Brand</h4>
                    </div>
                    <div class="content">
                      <?php echo form_open_multipart('brand/validate'); ?>
                            <?php echo "<span class='text-danger'>".$this->session->flashdata('error_upload')."</span>";?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Brand</label>      <?php echo "<strong><span class='text-danger pull-right'>".form_error('brand_name')."</span></strong>"; ?>
                                        <input type="text" name="brand_name" class="form-control border-input" placeholder="Masukkan Nama Brand" value="<?php echo set_value('brand_name'); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Gambar Brand</label>
                                      <input type="file" name="brand_image" class="form-control border-input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>  <?php echo "<strong><span class='text-danger pull-right'>".form_error('brand_description')."</span></strong>"; ?>
                                        <textarea name="brand_description" class="form-control border-input" placeholder="Masukkan Deskripsi Brand" maxlength="100" required><?php echo set_value('brand_description'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="brand/" class="btn  btn-fill btn-wd btn-back">Batal</a>
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
