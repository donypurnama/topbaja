<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tambah Kategori</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="category/update" enctype="multipart/form-data">
                          <?php echo "<span class='text-danger'>".$this->session->flashdata('error_upload')."</span>";?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <input type="text" name="category_name" class="form-control border-input" placeholder="Masukkan Nama kategori" value="<?php echo $data["category_name"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Gambar Kategori</label>
                                      <img src="../file_assets/categories/<?php echo $data["category_image"];?>" alt="<?php echo $data["category_name"];?>" class="img-responsive"/>
                                      <input type="file" name="category_image" class="form-control border-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="category_description" class="form-control border-input" placeholder="Masukkan Deskripsi Kategori" maxlength="100"required><?php echo $data["category_description"];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="category/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                                <input type="hidden" name="category_id" value="<?php echo $data["category_id"]; ?>"/>
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
