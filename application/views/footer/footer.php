<!-- *** FOOTER ***
_________________________________________________________ -->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <h5>TELUSURI KAMI</h5>
                <ul>
                  <li><a href="how-to">Cara Pemesanan</a>
                  </li>
                  <li><a href="policy">Kebijakan Pengunjung</a>
                  </li>
                  <li><a href="terms-and-conditions">Syarat dan Ketentuan</a>
                  </li>
                  <li><a href="contact-us">Kontak Kami</a>
                  </li>
                </ul>
            </div>
            <!-- /.col-md-3 -->

            <div class="col-md-3 col-sm-3">
                <h5>TOP CATEGORIES</h5>

                <ul>
                    <?php foreach ($footer_categories as $key => $value) { ?>
                      <li>
                        <strong><?php echo $value["category_name"];?></strong>
                        <ul>
                          <?php foreach ($value["types"] as $key2 => $value2) {?>
                          <li>
                              <a href="category/<?php echo $value['category_url'] . '/' . $value2['type_url']; ?>"><?php echo $value2["type_name"];?></a>
                          </li>
                          <?php } ?>
                        </ul>
                      </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h5>TEMUKAN KAMI</h5>
                <img src="logo-tokopedia.png" alt="TOP BAJA Tokopedia" style="height:52px;width:auto;">
                <br>
                <br>
                <img src="logo-instagram.png" alt="TOP BAJA Instagram" style="height:42px;width:auto;">


            </div>
            <div class="col-md-3 col-sm-6">
                <h5>TERHUBUNG DENGAN KAMI</h5>
                <p class="social">
                    <a href="https://www.facebook.com/topbaja" class="facebook external"><i class="fa fa-facebook"></i></a>
                    <a href="mailto:admin@topbaja.com" class="email external"><i class="fa fa-envelope"></i></a>
                </p>
                <p>
                  <strong>TOP BAJA</strong><br>
                  <strong><i class="fa fa-map-marker"></i></strong>
                    Jl. Parakan Pamulang II
                    <br>Pondok Benda - Tangerang Selatan,
                    <br>Indonesia
                    <br>
                    <strong><i class="fa fa-phone"></i></strong> +6221-290-42173
                </p>
                <hr class="hidden-md hidden-lg">
            </div>
            <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
<!-- /#footer -->

<!-- *** FOOTER END *** -->




<!-- *** COPYRIGHT ***
_________________________________________________________ -->
<div id="copyright">
    <div class="container">
        <div class="col-md-6">
            <p class="pull-left">© 2017 TOP BAJA</p>

        </div>
    </div>
</div>
<!-- *** COPYRIGHT END *** -->
