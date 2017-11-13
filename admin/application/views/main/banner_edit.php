<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ubah Banner</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="banner/update" enctype="multipart/form-data">
                          <?php echo "<span class='text-danger'>".$this->session->flashdata('error_upload')."</span>";?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Banner</label>
                                      <img src="../file_assets/banners/<?php echo $data["banner_image"];?>" alt="<?php echo $data["banner_url"];?>" class="img-responsive"/>
                                      <input type="file" name="banner_image" class="form-control border-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>URL</label>
                                        <textarea name="banner_url" class="form-control border-input" placeholder="Masukkan URL " required><?php echo $data["banner_url"];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="funkyradio">
                                            <div class="funkyradio-default">
                                                <input type="radio" name="banner_status" id="inactive" value="0" <?php if ($data['banner_status'] == "0") echo 'Checked';?> checked/>
                                                <label for="inactive">Inactive</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="banner_status" id="active" value="1" <?php if ($data['banner_status'] == "1") echo 'Checked';?>/>
                                                <label for="active">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="banner/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                                <input type="hidden" name="banner_id" value="<?php echo $data["banner_id"]; ?>"/>
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
