<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tambah Banner</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="banner/insert" enctype="multipart/form-data">
                          <?php echo "<span class='text-danger'>".$this->session->flashdata('error_upload')."</span>";?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Banner</label>
                                      <input type="file" name="banner_image" class="form-control border-input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-12">
                                        <label>Banner URL</label>
                                        <textarea name="banner_url" class="form-control border-input" placeholder="Masukkan URL" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="funkyradio">
                                            <div class="funkyradio-default">
                                                <input type="radio" name="banner_status" id="inactive" value="0" checked/>
                                                <label for="inactive">Inactive</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="banner_status" id="active" value="1" />
                                                <label for="active">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="banner/" class="btn  btn-fill btn-wd btn-back">Batal</a>
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
