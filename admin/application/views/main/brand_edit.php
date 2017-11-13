<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ubah Brand</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="brand/update" enctype="multipart/form-data">
                            <?php echo "<span class='text-danger'>".$this->session->flashdata('error_upload')."</span>";?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input type="text" name="brand_name" class="form-control border-input" placeholder="Masukkan Nama Brand" value="<?php echo $data["brand_name"]; ?>"readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Gambar Brand</label>
                                      <img src="../file_assets/brands/<?php echo $data["brand_image"];?>" alt="<?php echo $data["brand_name"];?>" class="img-responsive"/>
                                      <input type="file" name="brand_image" class="form-control border-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="brand_description" class="form-control border-input" placeholder="Masukkan Deskripsi Brand" maxlength="100" required><?php echo $data["brand_description"];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="brand/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                                <input type="hidden" name="brand_id" value="<?php echo $data["brand_id"]; ?>"/>
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
