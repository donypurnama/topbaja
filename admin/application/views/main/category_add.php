<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tambah Kategori</h4>
                    </div>
                    <div class="content">
                        <?php echo form_open_multipart('category/validate'); ?>
                        <?php echo "<span class='text-danger'>".$this->session->flashdata('error_upload')."</span>";?>
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-12">
                                        <label>Kategori</label> <?php echo "<strong><span class='text-danger pull-right'>".form_error('category_name')."</span></strong>"; ?>
                                        <input type="text" name="category_name" class="form-control border-input" placeholder="Masukkan Nama kategori" maxlength="100" value="<?php echo set_value('category_name'); ?>"required >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Gambar Kategori</label>
                                      <input type="file" name="category_image" class="form-control border-input" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="category_description" class="form-control border-input" placeholder="Masukkan Deskripsi Kategori" maxlength="100" required><?php echo set_value('category_description'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="category/" class="btn  btn-fill btn-wd btn-back">Batal</a>
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
