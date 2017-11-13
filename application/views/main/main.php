<div id="content">
    <div class="container">
        <div class="col-md-12">
            <div id="main-slider">
                <?php
                foreach($main_banners as $key => $value){
                ?>
                <div class="item">
                    <a href="<?php echo $value['banner_url'];?>"><img class="img-responsive" src="file_assets/banners/<?php echo $value["banner_image"];?>" alt=""></a>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- *** ADVANTAGES HOMEPAGE ***
_________________________________________________________ -->
    <!-- <div id="advantages">
        <div class="container">
            <div class="same-height-row">
                <div class="col-sm-4">
                    <div class="box same-height clickable">
                        <div class="icon"><i class="fa fa-heart"></i>
                        </div>
                        <h3><a href="home">We love our customers</a></h3>
                        <p>We are known to provide best possible service ever</p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="box same-height clickable">
                        <div class="icon"><i class="fa fa-tags"></i>
                        </div>
                        <h3><a href="home">Best prices</a></h3>
                        <p>You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="box same-height clickable">
                        <div class="icon"><i class="fa fa-thumbs-up"></i>
                        </div>
                        <h3><a href="home">100% satisfaction guaranteed</a></h3>
                        <p>Free returns on everything for 3 months.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Produk Pilihan -->
    <div id="hot">
      <div class="container">
        <h1 class="text-center header-ribbon">
          <strong class="header-ribbon-content">Produk Pilihan</strong>
        </h1>
        <div class="product-slider">
          <?php foreach ($main_selections as $key => $value) { ?>
            <div class="item">
              <div class="product">
                <div class="flip-container">
                  <div class="flipper">
                    <div class="front">
                      <a href="product/<?php echo $value['product_url']; ?>">
                        <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']; ?>" class="img-responsive">
                      </a>
                    </div>
                    <div class="back">
                      <a href="product/<?php echo $value['product_url']; ?>">
                        <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']; ?>" class="img-responsive">
                      </a>
                    </div>
                  </div>
                </div>
                <a href="product/<?php echo $value['product_url']; ?>" class="invisible">
                  <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']; ?>" class="img-responsive">
                </a>
                <div class="text">
                  <h3><a href="product/<?php echo $value['product_url']; ?>"><?php echo $value["product_name"];?></a></h3>
                  <p class="price">
                    <small>
                      <?php if ($value["product_discount"] > 0) { ?>
                        <del>Rp <?php echo number_format($value["product_price"],0,',','.'); ?></del>
                      <?php } ?>
                    </small>
                    <br>
                    Rp <?php echo $value["product_discount"] > 0 ? number_format($value["product_price"] - ($value["product_price"] * $value["product_discount"] / 100),0,',','.') : number_format($value["product_price"],0,',','.');?>
                  </p>
                  <p class="buttons">
                    <a href="cart/add/<?php echo $value['product_url']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Beli produk</a>
                  </p>
                </div>
                <?php if ($value["product_discount"] > 0) { ?>
                  <div class="ribbon sale">
                    <div class="theribbon">-<?php echo $value["product_discount"];?>%</div>
                    <div class="ribbon-background"></div>
                  </div>
                <?php } ?>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <!-- Produk Terlaris -->
    <div id="hot">
      <div class="container">
        <h1 class="text-center header-ribbon">
          <strong class="header-ribbon-content">Produk Terlaris</strong>
        </h1>
        <div class="product-slider">
          <?php foreach ($main_topselling as $key => $value) { ?>
            <div class="item">
              <div class="product">
                <div class="flip-container">
                  <div class="flipper">
                    <div class="front">
                      <a href="product/<?php echo $value['product_url']; ?>">
                        <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']; ?>" class="img-responsive">
                      </a>
                    </div>
                    <div class="back">
                      <a href="product/<?php echo $value['product_url']; ?>">
                        <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']; ?>" class="img-responsive">
                      </a>
                    </div>
                  </div>
                </div>
                <a href="product/<?php echo $value['product_url']; ?>" class="invisible">
                  <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']; ?>" class="img-responsive">
                </a>
                <div class="text">
                  <h3><a href="product/<?php echo $value['product_url']; ?>"><?php echo $value["product_name"];?></a></h3>
                  <p class="price">
                    <small>
                      <?php if ($value["product_discount"] > 0) { ?>
                        <del>Rp <?php echo number_format($value["product_price"],0,',','.'); ?></del>
                      <?php } ?>
                    </small>
                    <br>
                    Rp <?php echo $value["product_discount"] > 0 ? number_format($value["product_price"] - ($value["product_price"] * $value["product_discount"] / 100),0,',','.') : number_format($value["product_price"],0,',','.');?>
                  </p>
                  <p class="buttons">
                    <a href="cart/add/<?php echo $value['product_url']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Beli produk</a>
                  </p>
                </div>
                <?php if ($value["product_discount"] > 0) { ?>
                  <div class="ribbon sale">
                    <div class="theribbon">-<?php echo $value["product_discount"];?>%</div>
                    <div class="ribbon-background"></div>
                  </div>
                <?php } ?>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <!-- Produk Diskon -->
    <div   class="container">
      <h1 class="text-center header-ribbon">
        <strong class="header-ribbon-content">Produk Diskon</strong>
      </h1>
      <div class="row products">
        <?php foreach ($main_discountproduct as $key => $value) { ?>
          <div class="col-lg-2 col-sm-3 col-xs-6">
            <div class="product">
                <div class="flip-container">
                  <div class="flipper">
                    <div class="front">
                      <a href="product/<?php echo $value['product_url']; ?>">
                        <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']; ?>" class="img-responsive">
                      </a>
                    </div>
                    <div class="back">
                      <a href="product/<?php echo $value['product_url']; ?>">
                        <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']; ?>" class="img-responsive">
                      </a>
                    </div>
                  </div>
                </div>
                <a href="product/<?php echo $value['product_url']; ?>" class="invisible">
                  <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']; ?>" class="img-responsive">
                </a>
                <div class="text">
                  <h3><a href="product/<?php echo $value['product_url']; ?>"><?php echo $value["product_name"];?></a></h3>
                  <p class="price">
                    <small>
                      <?php if ($value["product_discount"] > 0) { ?>
                        <del>Rp <?php echo number_format($value["product_price"],0,',','.'); ?></del>
                      <?php } ?>
                    </small>
                    <br>
                    Rp <?php echo $value["product_discount"] > 0 ? number_format($value["product_price"] - ($value["product_price"] * $value["product_discount"] / 100),0,',','.') : number_format($value["product_price"],0,',','.');?>
                  </p>
                  <p class="buttons">
                    <a href="cart/add/<?php echo $value['product_url']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Beli produk</a>
                  </p>
                </div>
                <?php if ($value["product_discount"] > 0) { ?>
                  <div class="ribbon sale">
                    <div class="theribbon">-<?php echo $value["product_discount"];?>%</div>
                    <div class="ribbon-background"></div>
                  </div>
                <?php } ?>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

      <!-- Brands -->
      <div   class="container">
        <h1 class="text-center header-ribbon">
          <strong class="header-ribbon-content">Brand</strong>
        </h1>
        <div class="row products">
          <?php foreach ($main_brands as $key => $value) { ?>
            <div class="col-md-2 col-xs-4">
              <div class="product" style="padding:20px;">
                  <div class="flip-container">
                    <div class="flipper">
                      <div class="front">
                        <a href="brand/<?php echo $value['brand_url']; ?>">
                          <img src="file_assets/brands/<?php echo $value['brand_image'];?>" alt="<?php echo $value['brand_name']; ?>" class="img-responsive">
                        </a>
                      </div>
                      <div class="back">
                        <a href="brand/<?php echo $value['brand_url']; ?>">
                          <img src="file_assets/brands/<?php echo $value['brand_image'];?>" alt="<?php echo $value['brand_name']; ?>" class="img-responsive">
                        </a>
                      </div>
                    </div>
                  </div>
                  <a href="brand/<?php echo $value['brand_url']; ?>" class="invisible">
                    <img src="file_assets/brands/<?php echo $value['brand_image'];?>" alt="<?php echo $value['brand_name']; ?>" class="img-responsive">
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
    </div> <!--  End Products -->

    <!-- *** BLOG HOMEPAGE ***
_________________________________________________________ -->

    <div class="box text-center">
        <div class="container">
            <div class="col-md-12">
                <h3 class="text-uppercase">Informasi Terbaru Dari Kami</h3>

                <p class="lead"><a href="blog">Lihat selengkapnya</a>
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12">
            <div id="blog-homepage" class="row">
                <?php
                foreach($main_blogs as $key => $value)
                {
                ?>
                <div class="col-sm-6 col-xs-12">
                    <div class="post">
                        <h4><a href="blog/<?php echo $value['article_url'];?>"><?php echo $value["article_title"];?></a></h4>
                        <hr>
                        <p class="intro"><?php echo $value["article_content"];?></p>
                        <p class="read-more"><a href="blog/<?php echo $value['article_url'];?>" class="btn btn-primary">Lanjutkan membaca</a>
                        </p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <!-- /#blog-homepage -->
        </div>
    </div>
    <!-- *** BLOG HOMEPAGE END *** -->
</div>
<!-- /#content -->
