<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ubah Testimonial</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="testimonials/update" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Testimonial</label>
                                        <textarea name="testimonials_quote" class="form-control border-input" placeholder="Masukkan Testimonial" required><?php echo $data["testimonials_quote"]; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" name="testimonials_customers" class="form-control border-input" placeholder="Masukkan Nama Pelanggan" required value="<?php echo $data["testimonials_customers"]; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="testimonials_email" class="form-control border-input" placeholder="Masukkan Alamat Email" value="<?php echo $data["testimonials_email"]; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" name="testimonials_website" class="form-control border-input" placeholder="Masukkan Website" value="<?php echo $data["testimonials_website"]; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Gambar Foto atau Logo</label>
                                      <br><img src="../file_assets/testimonials/<?php echo $data["testimonials_image"];?>" alt="<?php echo $data["testimonials_customers"];?>" class="col-md-6 img-responsive"/>
                                      <input type="file" name="testimonials_image" class="form-control border-input" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="funkyradio">
                                            <div class="funkyradio-default">
                                                <input type="radio" name="testimonials_status" id="inactive" value="0" <?php if($data['testimonials_status']==0) echo "checked";?>/>
                                                <label for="inactive">inActive</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="testimonials_status" id="active" value="1" <?php if($data['testimonials_status']==1) echo "checked";?>/>
                                                <label for="active">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="testimonials/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                                <input type="hidden" name="testimonials_id" value="<?php echo $data["testimonials_id"]; ?>"/>
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
