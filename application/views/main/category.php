<div id="content">
    <div class="container">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="home">Home</a>
          </li>
          <?php
          if ($type) {
          ?>
          <li><a href="category/<?php echo $category['category_url'];?>"><?php echo $category['category_name'];?></a></li>
          <li><?php echo $type['type_name'];?></li>
          <?php
          } else if ($category && !$type) {
          ?>
          <li><?php echo $category['category_name'];?></li>
          <?php
          }
          ?>
        </ul>
      </div>
      <div class="col-md-3">
          <div class="panel panel-default sidebar-menu hidden-xs">

              <div class="panel-heading">
                  <h3 class="panel-title">Kategori</h3>
              </div>

              <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked category-menu">
                    <?php foreach($side_categories as $key => $value ){?>
                      <li class="<?php if ($value["category_name"] == $category["category_name"]) echo "active"; ?>">
                            <a href="category/<?php echo $value['category_url']?>">
                              <?php echo $value["category_name"]; ?>
                              <?php if ($type == null && $category['category_name'] == $value['category_name']) {?>
                                <i class="fa fa-check text-white"></i>
                              <?php } ?>
                            </a>
                          <ul class="sub-category-menu">
                            <?php foreach($value["side_type"] as $key2 => $value2){?>
                              <li class="<?php if ($type['type_name'] == $value2['type_name']) echo "active";?>">
                                <a href="category/<?php echo $value['category_url'] . '/' . $value2['type_url']; ?>">
                                  <?php echo $value2["type_name"]; ?>
                                  <?php if ($type['type_name'] == $value2['type_name']) {?>
                                    <i class="fa fa-check text-primary"></i>
                                  <?php } ?>
                                </a>
                              </li>
                            <?php } ?>
                          </ul>
                      </li>
                    <?php } ?>
                  </ul>

              </div>
          </div>

          <div class="panel panel-default sidebar-menu">

              <div class="panel-heading">
                  <h3 class="panel-title">Filter</h3>
              </div>

              <div class="panel-body">
                  <form method="get" action="">
                      <div class="form-group">
                        <div class="products-sort-by">
                            <label>Urutkan</label>
                            <?php
                            //sorting using post method
                            $cheapest = $latest = $discount = "";
                            if (isset($_GET["sort"])) {
                              if ($_GET["sort"] == "cheapest") $cheapest = "selected";
                              else if ($_GET["sort"] == "discount") $discount = "selected";
                              else $latest = "selected";
                            } else $latest = "selected";
                            ?>
                            <select name="sort" id="sort" class="form-control">
                                <option <?php echo $latest; ?> value="latest">Produk Terbaru</option>
                                <option <?php echo $cheapest; ?> value="cheapest">Produk Termurah</option>
                                <option <?php echo $discount; ?> value="discount">Diskon Terbesar</option>
                            </select>
                            <!-- <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-refresh"></i> Terapkan</button> -->
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Brand</label>
                          <?php
                          foreach ($side_brands as $key=>$value) {
                          ?>
                          <div class="checkbox"><label><input type="checkbox" <?php if (isset($value["checked"])) echo $value["checked"];?> name="brands[]" value="<?php echo $value["brand_id"]; ?>"><?php echo $value["brand_name"];?></label>
                          </div>
                          <?php
                          }
                          ?>
                      </div>
                      <div class="buttons">
                        <button type="button" id="btnResetFilter" class="btn btn-default btn-sm btn-danger" style="width:49%;">Reset</button>
                        <button type="button" id="btnFilter" class="btn btn-default btn-sm btn-primary pull-right" style="width:49%;">Apply</button>
                      </div>
                  </form>

              </div>
          </div>
          <!-- *** MENUS AND FILTERS END *** -->
      </div>
      <div class="col-md-9">
        <div class="box">
          <h1><?php echo isset($type) ? $type["type_name"] : $category["category_name"]; ?></h1>
          <p><?php echo isset($type) ? $type["type_description"] : $category["category_description"]; ?></p>
        </div>
        <?php
        if (count($products) == 0) {
        ?>
        <div class="box">
          <h1 class="text-center"><i class="fa fa-meh-o fa-3x"></i></h1>
          <h4 class="text-center">Maaf, produk untuk kategori ini belum tersedia.</h4>
        </div>
        <?php
        } else {
        ?>
        <div class="row products">
          <?php foreach ($products as $key => $value) { ?>
            <div class="col-lg-3 col-sm-4 col-xs-6">
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
