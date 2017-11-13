<div id="content">
    <div class="container">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="Home">Home</a>
                </li>
                <li><a href="category/<?php echo $product['category_url'];?>"><?php echo $product["category_name"];?></a>
                </li>
                <li><a href="category/<?php echo $product['category_url'] . '/' . $product['type_url']; ?>"><?php echo $product["type_name"]; ?></a>
                </li>
                <li><?php echo $product["product_name"]; ?></li>
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
                        <li class="<?php if ($value["category_name"] == $product["category_name"]) echo "active"; ?>">
                              <a href="category/<?php echo $value['category_url']?>">
                                <?php echo $value["category_name"]; ?>
                                <?php if ($product['type_url'] == null && $product['category_name'] == $value['category_name']) {?>
                                  <i class="fa fa-check text-white"></i>
                                <?php } ?>
                              </a>
                            <ul class="sub-category-menu">
                              <?php foreach($value["side_type"] as $key2 => $value2){?>
                                <li class="<?php if ($product['type_name'] == $value2['type_name']) echo "active";?>">
                                  <a href="category/<?php echo $value['category_url'] . '/' . $value2['type_url']; ?>">
                                    <?php echo $value2["type_name"]; ?>
                                    <?php if ($product['type_name'] == $value2['type_name']) {?>
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
        </div>
        <div class="col-md-9">
            <div class="row" id="productMain">
                <div class="col-sm-12">
                    <div class="box">
                      <div class="row same-height-row">
                        <div class="col-sm-6">
                          <div id="mainImage">
                              <img src="file_assets/products/<?php echo $product['product_primary_image'];?>" alt="<?php echo $product['product_name']; ?>" class="img-responsive">
                          </div>
                          <br>
                          <div class="row" id="thumbs">
                            <div class="col-xs-3 img-thumb">
                                <a href="file_assets/products/<?php echo $product['product_primary_image'];?>" class="thumb">
                                    <img src="file_assets/products/<?php echo $product['product_primary_image'];?>" alt="Cover" class="img-responsive">
                                </a>
                            </div>
                            <?php foreach($product_images as $key => $value){?>
                            <div class="col-xs-3 img-thumb">
                                <a href="file_assets/products/<?php echo $value['product_image'];?>" class="thumb">
                                    <img src="file_assets/products/<?php echo $value['product_image'];?>" alt="<?php echo $value["product_image_description"]; ?>" class="img-responsive">
                                </a>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <h2 class="text-center detail-product-title"><?php echo $product["product_name"]; ?></h2>
                          <p class="goToDescription"><a href="#details" class="scroll-to">Keterangan &amp; detail produk</a>
                          </p>
                          <?php if ($product["product_discount"] > 0) { ?>
                            <div class="non-semantic-protector">
                               <h1 class="discount-ribbon">
                                 <strong class="discount-ribbon-content">Diskon <?php echo $product["product_discount"];?>%</strong>
                               </h1>
                            </div>
                          <?php
                          }
                          ?>
                          <p class="price detail-price">
                            <small>
                              <?php if ($product["product_discount"] > 0) { ?>
                                <del style="color:#999;">Rp <?php echo number_format($product["product_price"],0,',','.'); ?></del>
                              <?php } ?>
                            </small>
                            <br>
                            Rp <?php echo $product["product_discount"] > 0 ? number_format($product["product_price"] - ($product["product_price"] * $product["product_discount"] / 100),0,',','.') : number_format($product["product_price"],0,',','.');?>
                          </p>

                          <p class="text-center detail-product-button-group buttons">
                              <a href="cart/add/<?php echo $product['product_url'];?>" class="btn btn-primary btn-lg"><i class="fa fa-shopping-cart"></i> Beli</a>
                              <a href="wishlist/add/<?php echo $product['product_url'];?>" class="btn btn-default btn-lg"><i class="fa fa-heart"></i>Wishlist</a>
                          </p>
                        </div>
                        <div class="col-sm-12" id="details">
                          <hr>
                          <h4>Spesifikasi Produk</h4>
                          <table class="table table-product-spec">
                            <tbody>
                              <tr>
                                <td>
                                  Nama Produk
                                </td>
                                <td>
                                  <?php echo $product["product_name"];?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Brand
                                </td>
                                <td>
                                  <a href="brand/<?php echo $brand['brand_url']; ?>"><img class="img-responsive" style="height:30px;" title="<?php echo $brand['brand_name'];?>" alt="<?php echo $brand['brand_name'];?>" src="file_assets/brands/<?php echo $brand["brand_image"];?>"/>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  SKU
                                </td>
                                <td>
                                  <?php echo $product["product_sku"];?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Kategori
                                </td>
                                <td>
                                  <?php echo $product["category_name"] . " - " . $product["type_name"];?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Dimensi
                                </td>
                                <td>
                                  <ul style="list-style:none;padding:0;margin:0;">
                                    <li>Panjang: <?php echo $product["product_length"];?>cm</li>
                                    <li>Lebar: <?php echo $product["product_width"]; ?>cm</li>
                                    <li>Tinggi: <?php echo $product["product_height"];?>cm</li>
                                  </ul>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Berat pengiriman
                                </td>
                                <td>
                                  <?php echo $product["product_weight"]/1000;?>kg
                                </td>
                              </tr>
                              <?php if($product["product_courier"] == '1') { ?>
                              <tr>
                                <td colspan="2">
                                    <strong>Gratis Biaya Kirim</strong>
                                    <?php
                                    if(in_array("ina", $exp_product_free_courier_id)) {
                                      echo "<button type='button' class='btn btn-warning btn-sm'>Seluruh Indonesia</button> &nbsp;";
                                    }
                                    if(in_array("jkt", $exp_product_free_courier_id)) {
                                      echo "<button type='button' class='btn btn-warning btn-sm'>JABODETABEK</button> &nbsp;";
                                    }
                                    if(in_array("java", $exp_product_free_courier_id)) {
                                      echo "<button type='button' class='btn btn-warning btn-sm'>Seluruh Jawa</button> &nbsp;";
                                    }
                                    ?>

                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                          <br>
                          <h4>Detail Produk</h4>
                          <hr>
                          <p><?php echo $product["product_description"]; ?></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="box">
              <h4>Produk Sejenis</h4>
            </div>
            <div class="row same-height-row">
                <?php foreach($related_products as $key => $value){?>
                <div class="col-md-3 col-sm-6">
                    <div class="product same-height">
                        <div class="flip-container">
                            <div class="flipper">
                              <?php if ($value["product_discount"] > 0) { ?>
                                <div class="ribbon sale">
                                  <div class="theribbon">-<?php echo $value["product_discount"];?>%</div>
                                  <div class="ribbon-background"></div>
                                </div>
                              <?php } ?>
                                <div class="front">
                                    <a href="product/<?php echo $value["product_url"];?>">
                                        <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value["product_name"];?>" class="img-responsive">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="product/<?php echo $value["product_url"];?>">
                                        <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value["product_name"];?>" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="product/<?php echo $value["product_url"];?>" class="invisible">
                            <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value["product_name"];?>" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3><a href="product/<?php echo $value['product_url']; ?>"><?php echo $value["product_name"]; ?></a></h3>
                            <p class="price"><?php if ($value["product_discount"] > 0) { ?>
                              <del style="color:#999;">Rp <?php echo number_format($value["product_price"],0,',','.'); ?></del>
                            <?php } ?><br/>
                            Rp <?php echo $value["product_discount"] > 0 ? number_format($value["product_price"] - ($value["product_price"] * $value["product_discount"] / 100),0,',','.') : number_format($value["product_price"],0,',','.');?>
                          </p>
                        </div>
                    </div>
                    <!-- /.product -->
                </div>
                <?php } ?>
            </div>

        </div>
        <!-- /.col-md-9 -->
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
