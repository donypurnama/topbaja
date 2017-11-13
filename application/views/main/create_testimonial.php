<div id="content">
    <div class="container">

        <div class="col-sm-12">
            <ul class="breadcrumb">

                <li><a href="Home">Home</a>
                </li>
                <li>Testimonial</li>
            </ul>
        </div>

        <!-- *** LEFT COLUMN ***
		     _________________________________________________________ -->

        <div class="col-sm-9" id="blog-listing">

            <div class="box">
                <h3>Testimonial Anda :</h3>
                <div class="content">
                    <form method="POST" action="testimonials/requests" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Testimonial</label>
                                    <textarea name="testimonials_quote" class="form-control border-input" placeholder="Masukkan Testimonial" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" name="testimonials_customers" class="form-control border-input" placeholder="Masukkan Nama Pelanggan" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="testimonials_email" class="form-control border-input" placeholder="Masukkan Alamat Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="testimonials_website" class="form-control border-input" placeholder="Masukkan Website">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Gunakan Foto atau Logo</label>
                                  <input type="file" name="testimonials_image" class="form-control border-input" >
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <input type="text" name="testimonials_status" id="inactive" value="0"/>
                            <a href="testimonials" class="btn  btn-fill btn-wd btn-back">Batal</a>
                            <input type="submit" class="btn btn-success btn-fill btn-wd" value="Simpan">
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>



        </div>
        <div class="col-md-3">
            <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                    <h3 class="panel-title">Halaman penting</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                      <li>
                          <a href="about-us">Tentang Kami</a>
                      </li>
                        <li>
                            <a href="frequently-asked-questions">Pertanyaan Umum</a>
                        </li>
                        <li>
                            <a href="policy">Kebijakan Pengunjung</a>
                        </li>
                        <li>
                            <a href="terms-and-conditions">Syarat dan Ketentuan</a>
                        </li>
                        <li>
                            <a href="contact-us">Kontak Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
