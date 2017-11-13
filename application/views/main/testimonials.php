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
                <h3>Testimonial</h3>
                <p class="text-muted" style="letter-spacing:0.5px;"> Anda dapat mengirimkan testimoni kepada kami melalui
                  <a href="testimonials/create" class="interweave"> form </a> ini.
                  Testimoni yang anda kirimkan tidak langsung ditampilkan, akan kami lakukan proses moderasi sesuai dengan batasan-batasan yang telah kami tentukan
                  </p>
            </div>

            <?php foreach($testimonials as $key => $value ){?>
            <div class="post">

              <div class="row">
                <div class="col-sm-4"><img src="file_assets/testimonials/<?php echo $value["testimonials_image"];?>" alt="<?php echo $value["testimonials_customers"];?>" class="img-thumbnail img-responsive"/></div>
                <div class="col-sm-8">
                  <p><blockquote><?php echo $value["testimonials_quote"];?></blockquote></p>
                  <span style="text-align:right !important">
                    <p> <span style="font-weight:bold;"><?php echo $value["testimonials_customers"];?></span>
                      <br>
                    <span style=""><?php echo $value["testimonials_website"];?></span></p>
                  </span>

                </div>
              </div>

            </div>
            <?php } ?>


            <div class="box info-bar">
              <div class="row">
                <div class="col-sm-4 col-xs-3">
                  <?php
                  if ($pagination["current_page"] > 1) {
                  ?>
                  <button class="btn btn-primary" id="btnPrevPage" value="<?php echo $pagination["current_page"]-1; ?>"><i class="fa fa-arrow-circle-o-left"></i><span class="hidden-xs">Sebelumnya</span></button>
                  <?php
                  }
                  ?>
                </div>
                <div class="col-sm-4 col-xs-6 products-showing text-center">
                    Halaman <strong><?php echo $pagination["current_page"]; ?></strong> / <strong><?php echo $pagination["total_page"]; ?></strong>
                </div>
                <div class="col-sm-4 col-xs-3">
                  <?php
                  if ($pagination["current_page"] < $pagination["total_page"]) {
                  ?>
                  <button class="btn btn-primary pull-right" id="btnNextPage" value="<?php echo $pagination["current_page"]+1; ?>"><span class="hidden-xs">Berikutnya</span><i class="fa fa-arrow-circle-o-right"></i></button>
                  <?php
                  }
                  ?>
                </div>
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
                      <li class="active">
                          <a href="#">Cara Pemesanan</a>
                      </li>
                        <li>
                            <a href="policy">Kebijakan Pengunjung</a>
                        </li>
                        <li>
                            <a href="terms-and-conditions">Syarat dan Ketentuan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
