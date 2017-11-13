<div id="content">
    <div class="container">
      <form method="post" action="cart/process">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="home">Home</a>
                </li>
                <li><a href="cart">Keranjang Belanja</a>
                </li>
                <li>Review</li>
            </ul>
        </div>

        <div class="col-md-10 col-md-offset-1" id="checkout">
            <div class="box">
                    <h1>Checkout</h1>
                    <ul class="nav nav-pills nav-justified">
                        <li class=""><a href="cart/checkout"><i class="fa fa-truck"></i><br>Pengiriman</a>
                        </li>
                        <li class="active"><a href="cart/review"><i class="fa fa-file-text"></i><br>Review Pembelian</a>
                        </li>
                    </ul>
                    <div class="content review-box">
                      <div class="row">
                        <div class="col-sm-8">
                          <div class="row same-height-row">
                            <div class="col-sm-12">
                              <div class="row">
                                <div class="col-sm-12">
                                  <h4 style="margin-top:22px;color:#999;"><i class="fa fa-truck"></i> Instruksi Pengiriman</h4>
                                  <hr>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="row same-height">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="text-muted">Nama Penerima</label>
                                        <p><?php echo $data['checkout_detail']['order_ship_receiver_name']; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="text-muted">No. Hp Penerima</label>
                                        <p><?php echo $data['checkout_detail']['order_ship_receiver_phone']; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="text-muted">Provinsi</label>
                                        <p><?php echo $data['checkout_detail']['order_ship_province']; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="text-muted">Kota / Kabupaten</label>
                                      <p><?php echo $data['checkout_detail']['order_ship_city']; ?></p>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="district">Kecamatan</label>
                                        <p><?php echo $data['checkout_detail']['order_ship_district']; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="text-muted">Kode Pos</label>
                                        <p><?php echo $data['checkout_detail']['order_ship_postal_code']; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="text-muted">Alamat Lengkap</label>
                                      <p><?php echo $data['checkout_detail']['order_ship_address']; ?></p>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="text-muted">Catatan Pengiriman</label>
                                      <p><?php echo $data['checkout_detail']['order_ship_note']; ?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="row same-height-row">
                            <div class="col-sm-12">
                              <div class="row">
                                <div class="col-sm-12">
                                  <h4 style="margin-top:22px;color:#999;"><i class="fa fa-truck"></i> Metode Pengiriman</h4>
                                  <hr>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="row same-height text-center">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                        <img class="img-responsive" style="height:40px; margin:0 auto;" src="file_assets/couriers/<?php echo $data['checkout_detail']['order_ship_vendor']; ?>.png">
                                      </div>
                                  </div>
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="text-muted">Service</label>
                                        <p><?php echo $data['checkout_detail']['order_ship_package']; ?></p>
                                      </div>
                                  </div>
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="text-muted">Estimasi Pengiriman</label>
                                        <p><?php echo $data['checkout_detail']['order_ship_etd']; ?></p>
                                      </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="text-muted">Biaya Pengiriman</label>
                                        <p>Rp <?php
                                        echo "-";
                                        //echo number_format($data['checkout_detail']['order_ship_cost'],0,',','.');
                                        ?></p>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <h4 style="margin-top:22px;color:#999;"><i class="fa fa-shopping-cart"></i> Detail Pembelian</h4>
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
                              foreach ($cart as $key => $value) {
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
                                  <td>Rp <?php echo number_format($value["subtotal"],0,',','.'); ?></td>
                                  <td>
                                  </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right" style="vertical-align: middle">Total</td>
                                    <td colspan="2">Rp <?php echo number_format($total,0,',','.'); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-success text-right" style="font-size: 14px; vertical-align:middle;">
                                      Poin digunakan
                                    </td>
                                    <td colspan="2" style="vertical-align:middle;font-size:14px;" class="text-success">
                                      Rp <?php echo number_format($used_point,0,',','.');?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-muted text-right" style="font-size: 14px; vertical-align:middle;">
                                      Biaya pengiriman (<?php echo $data["order_weight"]/1000;?>Kg)
                                    </td>
                                    <td colspan="2" class="text-muted" style="vertical-align:middle;font-size:14px;">
                                      Rp <?php //echo number_format($data["checkout_detail"]["order_ship_cost"],0,',','.');?>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-right" style="vertical-align:middle;">
                                      Grand Total
                                    </th>
                                    <th colspan="2" style="vertical-align:middle;">
                                      Rp <?php echo number_format($data["checkout_detail"]["order_grand_total"],0,',','.');?>
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="7" class="text-success text-right" style="font-size:14px;"> Mendapatkan cashback poin Rp <strong><?php echo number_format($cashback_point,0,',','.'); ?></strong> dari transaksi ini</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <h4 style="margin-top:22px;color:#999;"><i class="fa fa-credit-card"></i> Metode Pembayaran - Transfer Bank</h4>
                    <hr>
                    <div class="row">
                      <?php
                      foreach ($bank as $key=>$value) {
                      ?>
                      <div class="col-sm-4 choose-bank">
                        <div class="box shipping-method"><img src="file_assets/banks/<?php echo $value['bank_name']; ?>.png" class="img-responsive" title="<?php echo $value['bank_name']; ?>" style="margin:0 auto;height:50px;">
                          <h5 class="text-muted text-center text-ellipsis-row-1" title="<?php echo $value['bank_name']; ?>"><?php echo $value['bank_name']; ?></h5>
                          <p class="text-muted text-center" style="font-size:14px;"><?php echo $value['bank_account']; ?></p>
                          <p class="text-center text-muted"><?php echo $value['bank_account_number']; ?></p>
                          <div class="box-footer text-center"><input type="radio" required class="radio-shipment" name="bank" value="<?php echo $value["bank_id"]; ?>"/></div>
                        </div>
                      </div>
                      <?php
                      }
                      ?>
                    </div>
                    <p class="text-center text-danger"><i class="fa fa-warning"></i> Pastikan pembayaran hanya dilakukan melalui salah satu rekening di atas.</p>
                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="cart/checkout" data-submit="Kembali ke halaman pengiriman? Semua data pengiriman harus Anda isi kembali." class="btn btn-default"><i class="fa fa-chevron-left"></i>Pengiriman</a>
                        </div>
                        <div class="pull-right">
                            <button type="submit" id="btnSubmitTransaction" disabled name="submit_transaction" data-submit="Proses pesanan? Pastikan Anda mengisi alamat dan kontak penerima dengan benar" class="btn btn-primary">Proses Pembelian<i class="fa fa-check"></i>
                            </button>
                        </div>
                    </div>
            </div>
        </div>
      </form>
    </div>
</div>
