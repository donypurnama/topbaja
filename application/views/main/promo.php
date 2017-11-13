<div id="content">
    <div class="container">

        <div class="col-sm-12">
            <ul class="breadcrumb">

                <li><a href="Home">Home</a>
                </li>
                <li>Hot Promo</li>
            </ul>
        </div>

        <!-- *** LEFT COLUMN ***
		     _________________________________________________________ -->

        <div class="col-sm-12" id="blog-listing">

            <div class="box">
                <h3>Promo Partner TOP BAJA</h3>
                <p class="text-muted" style="letter-spacing:0.5px;">Promo periode bulan ini</p>
            </div>

            <?php foreach($promo as $key => $value ){?>
            <div class="post">
                <p class="img-responsive"><?php echo $value["promo_content"]; ?></p>
                <!-- <p class="img-responsive"><?php echo $value["promo_content"]; ?></p> -->
                <!-- <h2><a href="promo/<?php echo $value['promo_url']; ?>"><?php echo $value["promo_title"]; ?></a></h2> -->
                <!-- <hr> -->
                <!-- <p class="date-comments">
                    <a href="promo/<?php echo $value['promo_url']; ?>"><i class="fa fa-calendar-o"></i> <?php echo $value["promo_created_time"]; ?></a>
                </p> -->
                <?php
                // if ($value["promo_image"]) {
                ?>
                <!-- <div class="image">
                    <a href="promo/<?php echo $value['promo_url']; ?>">
                        <img src="http://placehold.it/400x400" class="img-responsive" alt="Example blog post alt">
                    </a>
                </div> -->
                <?php
                // }
                ?>
                <!-- <p class="intro"><?php echo $value["promo_content"]; ?></p> -->
                <!-- <p class="read-more"><a href="promo/<?php echo $value['promo_url']; ?>" class="btn btn-primary">Continue reading</a> -->
                </p>
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
        <!-- <div class="col-md-3">
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
        </div> -->
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
