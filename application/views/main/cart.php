<div id="content">
    <div class="container">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="home">Home</a>
                </li>
                <li>Keranjang Belanja</li>
            </ul>
        </div>
        <?php if ($cart_count["count_item"]){?>
        <div class="col-md-12" id="basket">
          <div class="box">
                  <h1>Keranjang Belanja</h1>
                  <p class="text-muted">Terdapat <?php echo $cart_count["count_item"]; ?> barang di keranjang Anda.</p>
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th colspan="2">Produk</th>
                                  <th>Jumlah</th>
                                  <th>Harga Satuan</th>
                                  <th>Diskon</th>
                                  <th colspan="2">Total</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach ($cart as $key => $value) {
                            ?>
                            <tr>
                                <td>
                                    <a href="product/<?php echo $value['product_url']; ?>">
                                        <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']?>">
                                    </a>
                                </td>
                                <td><a href="product/<?php echo $value['product_url']; ?>"><?php echo $value['product_name']?></a>
                                </td>
                                <td>
                                  <form action="cart/add/<?php echo $value['product_url']; ?>" method="post">
                                    <input type="number" min="1" name="product_qty" value="<?php echo $value['product_qty']; ?>" class="form-control submitOnEnter" required min="0">
                                  </form>
                                </td>
                                <td>Rp <?php echo number_format($value["product_price"],0,',','.'); ?></td>
                                <td><?php echo $value['product_discount']; ?>%</td>
                                <td>Rp <?php echo number_format($value["subtotal"],0,',','.'); ?></td>
                                <td><a href="cart/delete/<?php echo $value['product_url'];?>"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                          <tfoot>
                              <tr>
                                  <th colspan="5">Total</th>
                                  <th colspan="2">Rp <?php echo number_format($total,0,',','.'); ?></th>
                              </tr>
                              <tr>
                                  <td colspan="3" class="text-muted" style="font-size: 14px; vertical-align:middle;">
                                    <img class="img-responsive" src="coin-muted.png" style="display:inline-block;width:18px;"> Poin Anda Rp <?php echo number_format($customer_point,0,',','.'); ?>
                                    <form action="cart" method="post" style="margin-top:4px;">
                                      <div class="input-group input-group-sm">
                                        <input class="form-control" type="number" min="0"; style="width:120px;" name="used_point" min="0" value="<?php echo $used_point;?>" max="<?php echo $customer_point;?>" required>
                                        <span class="input-group-btn">
                                          <button type="submit" class="btn btn-secondary btn-success">Gunakan Poin</button>
                                        </span>
                                      </div>
                                    </form>
                                  </td>
                                  <td colspan="2" style="vertical-align:middle;font-size:14px;" class="text-success text-right">
                                    <?php if ($total_with_discount > 0) {?>Setelah Potongan Rp <?php echo number_format($used_point,0,',','.'); }?>
                                  </td>
                                  <th colspan="2" style="vertical-align:middle;" class="text-success"><?php if ($total_with_discount > 0) {?>Rp <?php echo number_format($total_with_discount,0,',','.'); }?></th>
                              </tr>
                              <tr>
                                  <td colspan="7" class="text-muted text-right text-small">Dapatkan cashback poin Rp <strong><?php echo number_format($cashback_point,0,',','.'); ?></strong> dari transaksi ini</td>
                              </tr>
                          </tfoot>
                      </table>
                  </div>
                  <!-- /.table-responsive -->
                  <p class="text-right <?php echo ($this->session->flashdata('front_add_cart_failed')) ? 'text-danger' : 'text-success';?>">
                  <?php
                  echo $this->session->flashdata("front_add_cart_failed");
                  echo $this->session->flashdata("front_add_cart_success");
                  ?>
                  </p>
                  <div class="box-footer">
                      <div class="pull-left xs-full-width">
                          <a href="home" class="btn btn-default xs-full-width"><i class="fa fa-chevron-left"></i> Lanjutkan Berbelanja</a>
                      </div>
                      <div class="pull-right xs-full-width">
                          <a href="cart/checkout" data-submit="Anda yaking akan melakukan Checkout?" type="button" class="btn btn-primary xs-full-width">Checkout <i class="fa fa-chevron-right"></i>
                          </a>
                      </div>
                  </div>
            </div>
            <!-- /.box -->
        </div>
        <?php
        } else {
        ?>
        <h3 class="text-center">Tidak ada barang di keranjang Anda.</h3>
        <?php
        }
        ?>
        <!-- /.col-md-3 -->

    </div>
    <!-- /.container -->
</div>
