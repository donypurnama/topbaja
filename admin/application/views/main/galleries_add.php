<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tambah Galleries</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="galleries/insert" enctype="multipart/form-data">
                          <?php echo "<span class='text-danger'>".$this->session->flashdata('error_upload')."</span>";?>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Galleries</label>
                                      <input type="file" name="gallery_image" class="form-control border-input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-12">
                                        <label>Judul</label>
                                        <input type="text" name="gallery_title" class="form-control border-input" placeholder="Masukkan Judul Gallery" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-12">
                                        <label>Deksripsi</label>
                                        <textarea name="gallery_description" class="form-control border-input" placeholder="Masukkan Deskripsi"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-12">
                                        <label>URL</label>
                                        <textarea name="gallery_url" class="form-control border-input" placeholder="Masukkan URL"></textarea>
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
                                              echo "<option value=". $result['gallery_category_id'].">". $result['gallery_category_name']. "</option> ";
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
                                                <input type="radio" name="gallery_status" id="inactive" value="0" checked/>
                                                <label for="inactive">Inactive</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="gallery_status" id="active" value="1" />
                                                <label for="active">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="galleries/" class="btn  btn-fill btn-wd btn-back">Batal</a>
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
