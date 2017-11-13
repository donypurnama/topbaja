<div id="content">
    <div class="container">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="home">Home</a>
          </li>
          <li>
            Search
          </li>
        </ul>
      </div>

      <div class="col-md-12">
        <?php
        if (count($products) <= 0) {
        ?>
        <div class="box">
          <h1 class="text-center"><i class="fa fa-meh-o fa-3x"></i></h1>
          <h4 class="text-center">Maaf, produk yang dicari tidak tersedia.</h4>
        </div>
        <?php
        } else {
        ?>
        <div class="row products">
          <?php foreach ($products as $key => $value) { ?>
            <div class="col-lg-2 col-sm-4 col-xs-6">
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
        <?php
        }
        ?>
        </div>
        <!-- /.col-md-9 -->
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
<script>

</script>
