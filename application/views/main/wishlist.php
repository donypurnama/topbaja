<div id="content">
    <div class="container">

        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="home">Home</a>
                </li>
                <li>My wishlist</li>
            </ul>

        </div>

        <div class="col-md-3">
            <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                    <h3 class="panel-title">Menu pengguna</h3>
                </div>

                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="<?php echo $menu["account"]; ?>">
                          <a href="account/profile"><i class="fa fa-user"></i> Profil</a>
                        </li>
                        <li class="<?php echo $menu["order"]; ?>">
                            <a href="account/order"><i class="fa fa-list"></i> Pembelian</a>
                        </li>
                        <li class="<?php echo $menu["wishlist"]; ?>">
                            <a href="wishlist"><i class="fa fa-heart"></i> Wishlist</a>
                        </li>
                        <li>
                            <a href="account/logout"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- /.col-md-3 -->

            <!-- *** CUSTOMER MENU END *** -->
        </div>


        <div class="col-md-9" id="wishlist">
            <div class="box">
                <h1>My wishlist</h1>
                <p class="lead">Menampilkan barang favorit Anda.</p>
                <?php
                 echo $this->session->flashdata("err_delete_wishlist");
                 echo $this->session->flashdata("double_add_wishlist");
                 ?>
            </div>

            <div class="row products">
              <?php
              if (count($wishlist) == 0){
              ?>
              <div class="box">
                <h1 class="text-center"><i class="fa fa-meh-o fa-3x"></i></h1>
                <h4 class="text-center">Wishlist Anda kosong.</h4>
              </div>
              <?php
              } else { ?>
              <?php foreach ($wishlist as $key => $value) {
              ?>
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
                        <p class="buttons">
                          <a href="wishlist/delete/<?php echo $value['product_url']; ?>" class="btn btn-primary"><i class="fa fa-trash-o"></i>Hapus produk</a>
                        </p>
                      </div>
                  </div>
                  <!-- /.product -->
            </div>
            <?php } ?>
            <!-- /.products -->
            <?php } ?>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
