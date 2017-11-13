<div id="content">
    <div class="container">

        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="home">Home</a>
                </li>
                <li><a href="account/order">Pembelian</a>
                </li>
                <li><?php echo $order["order_ref"];?></li>
            </ul>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default sidebar-menu">

                <div class="panel-heading">
                    <h3 class="panel-title">Menu pengguna</h3>
                </div>

                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                          <a href="account/profile"><i class="fa fa-user"></i> Profil</a>
                        </li>
                        <li class="active">
                            <a href="account/order"><i class="fa fa-list"></i> Pembelian</a>
                        </li>
                        <li>
                            <a href="wishlist"><i class="fa fa-heart"></i> Wishlist</a>
                        </li>
                        <li>
                            <a href="account/logout"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9" id="customer-order">
            <div class="box">
                <h3><?php echo $order["order_ref"];?></h3>
                <p class="lead" style="font-size:14px;">Dibuat pada <strong><?php echo $order["order_created_time"]; ?></strong> dengan status saat ini <strong><?php echo $order["order_status_text"]; ?></strong>.</p>
                <?php
                if ($order["order_ship_date"] && $order["order_ship_resi"]) {
                ?>
                <p class="lead" style="font-size:14px;">Tanggal pengiriman: <strong><?php echo $order["order_ship_date"]; ?></strong> | Nomor Resi: <strong><?php echo $order["order_ship_resi"]; ?></strong>.</p>
                <?php
                }
                ?>
                <?php
                if ($order["order_status"] == 0) {
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <a href="account/cancelOrder/<?php echo $order['order_ref']; ?>" data-submit="Membatalkan pesanan? Rp <?php echo number_format($order["order_used_point"],0,',','.'); ?> poin akan kembali ke saldo Anda." class="btn btn-md btn-danger pull-right">Batalkan Pesanan</a>
                  </div>
                </div>
                <?php
                }
                ?>
                <hr>
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
                          foreach ($order_detail as $key => $value) {
                          ?>
                          <tr>
                              <td>
                                <img src="file_assets/products/<?php echo $value['product_primary_image'];?>" alt="<?php echo $value['product_name']?>">
                              </td>
                              <td><?php echo $value['product_name']?>
                              </td>
                              <td>
                                <?php echo $value['product_qty']; ?>
                              </td>
                              <td>Rp <?php echo number_format($value["product_price"],0,',','.'); ?></td>
                              <td><?php echo $value['product_discount']; ?>%</td>
                              <td>Rp <?php echo number_format($value["order_subtotal"] * $value["product_qty"],0,',','.'); ?></td>
                              <td>
                              </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right" style="vertical-align: middle">Total</td>
                                <td colspan="2">Rp <?php echo number_format($order["order_total"],0,',','.'); ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-success text-right" style="font-size: 14px; vertical-align:middle;">
                                  Poin digunakan
                                </td>
                                <td colspan="2" style="vertical-align:middle;font-size:14px;" class="text-success">
                                  Rp <?php echo number_format($order["order_used_point"],0,',','.');?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-muted text-right" style="font-size: 14px; vertical-align:middle;">
                                  Biaya pengiriman (<?php echo $order["order_ship_weight"]/1000;?>Kg)
                                </td>
                                <td colspan="2" class="text-muted" style="vertical-align:middle;font-size:14px;">
                                  Rp <?php echo number_format($order["order_ship_cost"],0,',','.');?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right" style="vertical-align:middle;font-weight:bold;">
                                  Grand Total
                                </th>
                                <th colspan="2" style="vertical-align:middle;font-weight:bold;">
                                  Rp <?php echo number_format($order["order_grand_total"],0,',','.');?>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-success text-right" style="font-size:14px;"><img class="img-responsive" src="coin-muted.png" style="display:inline-block;width:18px;"> Mendapatkan cashback poin Rp <strong><?php echo number_format($order["order_points"],0,',','.'); ?></strong> dari transaksi ini</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.table-responsive -->
                <div class="row">
                  <div class="col-sm-4">
                      <h3>Penerima</h3>
                      <p><?php echo $order["order_ship_receiver_name"]; ?>
                          <br><?php echo $order["order_ship_receiver_phone"]; ?>
                          <br><?php echo $order["order_ship_address"]; ?>
                          <br><br><?php echo $order["order_ship_district"]; ?>
                          <br><?php echo $order["order_ship_city"] . " - " . $order["order_ship_province"]; ?>
                          <br><br><font class="text-muted text-small"><?php echo $order["order_ship_note"] ? "Catatan: " . $order["order_ship_note"] : ""; ?></font></p>
                  </div>
                  <div class="col-sm-4">
                      <h3>Bank Pilihan</h3>
                      <img class="img-responsive" style="height:40px;display:inline-block;margin-bottom:0px;" src="file_assets/banks/<?php echo $bank["bank_image"]; ?>">
                      <p><?php echo $bank["bank_name"]; ?>
                          <br><?php echo $bank["bank_account"]; ?>
                          <br><?php echo $bank["bank_account_number"]; ?>
                          <br>Rp <?php echo number_format($order["order_grand_total"],0,',','.');?>
                          </p>
                  </div>
                  <div class="col-sm-4">
                      <h3>Jasa Pengiriman</h3>
                      <img class="img-responsive" style="height:40px;display:inline-block;margin-bottom:0px;" src="file_assets/couriers/<?php echo $order["order_ship_vendor"]; ?>.png">
                      <p><?php echo $order["order_ship_package"]; ?>
                          <br><?php echo $order["order_ship_etd"]; ?>
                          <br>Berat: <?php echo $order["order_ship_weight"]/1000; ?>Kg
                          <br>Rp <?php echo number_format($order["order_ship_cost"],0,',','.');?>
                          </p>
                  </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
