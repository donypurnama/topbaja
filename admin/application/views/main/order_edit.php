<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php
            if ($data) {
                foreach ($data as $key=>$result) {
            ?>
            <div class="col-md-offset-1 col-md-10">
                <div class="card">
                    <div class="header">
                        <div class="col-xs-8">
                          <h4 class="title">Pesanan : <strong><?php echo $result['order_ref']?></strong></h4>
                          <p class="text-order">Tanggal Transaksi: <?php echo date("d-M-Y", strtotime($result["order_created_time"]));?> | Grand Total: Rp. <strong><?php echo number_format($result['order_grand_total'],0,",","."); ?></strong></p>
                        </div>
                        <div class="col-xs-4">
                          <h4 class="title">Status :
                            <strong>
                              <?php
                                if ($result['order_status']==0){
                                  echo "<p class='text-warning'>Menunggu Pembayaran</p>";
                                }elseif ($result['order_status']==1){
                                  echo "<p class='text-warning'>Verifikasi Pembayaran</p>";
                                }elseif ($result['order_status']==2){
                                  echo "<p class='text-warning'>Dalam Proses</p>";
                                }elseif ($result['order_status']==3){
                                  echo "<p class='text-success'>Sudah di Kirim</p>";
                                }elseif ($result['order_status']==4){
                                  echo "<p class='text-danger'>Dibatalkan</p>";
                                }
                              ?>
                            </strong></h4>
                        </div>
                    </div>
                    <div class="content">
                      <table class="table table-order live-table">
                          <tbody>
                              <tr>
                                <td class="col-md-8">
                                  <p><strong><?php echo $result['customer_first_name']." ".$result['customer_last_name'];?></strong></p>
                                  <p><?php echo $result['order_ship_address'].", ".$result['order_ship_district'].", <br>".$result['order_ship_city'].", ".$result['order_ship_province'];?>
                                  <br><?php echo $result['order_ship_postal_code'];?>
                                  <p>Penerima: <?php echo $result['order_ship_receiver_name']." | Telp: ".  $result['order_ship_receiver_phone'];?> </p>
                                  <p>Poin: <?php echo $result['order_points'];?> | Used Point: <?php echo $result['order_used_point'];?> </p>
                                </td>
                                <td class="col-md-2">
                                  <strong>Berat Barang</strong>
                                  <p><?php echo $result['order_ship_weight']/1000 . " kg";?></p>
                                  <strong>Keterangan</strong>
                                  <p><?php if ($result['order_ship_note']== "") {
                                    echo " - ";
                                  }else {
                                    echo $result['order_ship_note'] ;
                                  }?></p>
                                  <strong>Total</strong>
                                  <p><?php echo "Rp. ".number_format($result['order_total'],0,",",".") ;?></p>
                                </td>
                                <td class="col-md-2">
                                  <strong>Pengiriman</strong>
                                  <p><?php echo $result['order_ship_vendor'];?> </p>
                                  <strong>Durasi Pengiriman</strong>
                                  <p><?php echo $result['order_ship_etd'];?></p>
                                  <strong>Ongkos Kirim</strong>
                                  <p><?php echo "Rp. ".number_format($result['order_ship_cost'],0,",",".") ;?></p>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                  <strong>Resi</strong>
                                  <p><?php if ($result['order_ship_resi']== "") {
                                    echo " - ";
                                  }else {
                                    echo $result['order_ship_resi'] ;
                                  }?></p>
                                </td>
                                <td class="col-md-4">
                                  <strong>Tanggal Kirim</strong>
                                  <p><?php if ($result['order_ship_date']== "") {
                                    echo " - ";
                                  }else {
                                    echo $result['order_ship_date'] ;
                                  }?></p>
                                </td>
                              </tr>
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>

            <!-- Detai Verifikasi -->
            <div class="col-md-offset-1 col-md-10">
                <div class="card">
                    <div class="header">
                      <h4 class="title">Data Verifikasi</h4>
                    </div>
                    <div class="content">
                      <table class="table table-order live-table">
                          <tbody>
                              <tr>
                                <td colspan="1">
                                  <p><strong>Nama Pengirim</strong></p>
                                  <p><strong>Bank</strong></p>
                                  <p><strong>Akun Bank</strong></p>
                                  <p><strong>Jumlah</strong></p>
                                  <p><strong>Bank Tujuan</strong></p>
                                </td>
                                <td colspan="2">
                                  <p><?php echo $retVal = (!empty($result['order_verification_sender_name'])) ? $result['order_verification_sender_name'] :"-" ;?></p>
                                  <p><?php echo $retVal = (!empty($result['order_verification_sender_bank'])) ? $result['order_verification_sender_bank'] :"-" ;?></p>
                                  <p><?php echo $retVal = (!empty($result['order_verification_sender_bank_account'])) ? $result['order_verification_sender_bank_account'] :"-" ;?></p>
                                  <p><?php echo "Rp. " .$retVal = (!empty($result['order_verification_total'])) ? number_format($result['order_verification_total'],2,",",".") :"-" ;?></p>
                                  <p><?php echo $retVal = (!empty($result['bank_id'])) ? $result['bank_name']:"-" ;;?></p>
                                </td>
                                <td class="td-order" >
                                  <?php
                                    if (!empty($result['order_verification_photo'])) {
                                  ?>
                                    <img src="../file_assets/verification/<?php echo  $result["order_verification_photo"];?>" alt="<?php echo $result["order_ref"];?>" class="img-responsive"/>
                                  <?php
                                    }else{
                                  ?>
                                  -
                                  <?php
                                    }
                                  ?>


                                </td>
                              </tr>
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>

            <!-- Detail Order -->
            <div class="col-md-offset-1 col-md-10">
                <div class="card">
                    <div class="header">
                          <h4 class="title">Detail Order</h4>
                    </div>
                    <div class="content">
                      <table class="table table-order live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Produk</th>
                                    <th class="icon-eye">Jumlah</th>
                                    <th class="icon-eye">Harga <span class="text-scale"> (Rp.) </span></th>
                                    <th class="icon-eye">Diskon <span class="text-scale"> (%) </span></th>
                                    <th class="icon-eye">Subtotal <span class="text-scale"> (Rp.) </span></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php

                                foreach ($order_details as $key => $result) {
                              ?>
                              <tr>
                                <td>
                                  <?php echo $result['product_name']?>
                                </td>
                                <td class="icon-eye">
                                  <?php echo $result['product_qty']?>
                                </td>
                                <td class="text-right">
                                  <?php echo number_format($result['product_price'],0,",",".")?>
                                </td>
                                <td class="icon-eye">
                                  <?php echo $result['product_discount']?>
                                </td>
                                <td class="text-right">
                                  <?php echo number_format($result['order_subtotal'],0,",",".")?>
                                </td>
                              </tr>
                              <?php
                                }

                              ?>
                          </tbody>
                          <tfoot>
                              <tr>
                                  <td colspan="4" class="text-right" style="vertical-align: middle">Total</td>
                                  <td colspan="2" class="text-right"><?php echo number_format($order["order_total"],0,',','.'); ?> </td>
                              </tr>
                              <tr>
                                  <td colspan="4" class="text-success text-right" style="font-size: 14px; vertical-align:middle;">
                                    Poin digunakan
                                  </td>
                                  <td colspan="2" style="vertical-align:middle;font-size:14px;" class="text-success text-right">
                                    <?php echo number_format($order["order_used_point"],0,',','.');?>
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan="4" class="text-muted text-right" style="font-size: 14px; vertical-align:middle;">
                                    Biaya pengiriman (<?php echo $order["order_ship_weight"]/1000;?>Kg)
                                  </td>
                                  <td colspan="2" class="text-muted text-right" style="vertical-align:middle;font-size:14px;">
                                    <?php echo number_format($order["order_ship_cost"],0,',','.');?>
                                  </td>
                              </tr>
                              <tr>
                                  <th colspan="4" class="text-right" style="vertical-align:middle;font-weight:bold;">
                                    Grand Total
                                  </th>
                                  <th colspan="2" class="text-right" style="vertical-align:middle;font-weight:bold;">
                                    <?php echo number_format($order["order_grand_total"],0,',','.');?>
                                  </th>
                              </tr>
                          </tfoot>
                      </table>
                    </div>
                </div>
            </div>

            <div class="col-md-offset-1 col-md-10">
                <div class="card">
                    <div class="header">
                          <h4 class="title"> Ubah Status Pesanan</h4>
                    </div>
                    <div class="content">
                      <form method="POST" action="order/update">
                          <?php
                          if($data){
                            foreach ($data as $key => $result) {
                          ?>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="funkyradio">
                                        <div class="funkyradio-default">
                                            <input class="order_status" type="checkbox" name="order_status" id="0" value="0"
                                              <?php
                                                if($result['order_status']!=4) echo "checked = 'true'";
                                                if($result['order_status']!=0) echo "disabled";
                                              ?>
                                            />
                                            <label for="0">Menunggu Pembayaran</label>
                                        </div>
                                    </div>
                                    <div class="funkyradio">
                                        <div class="funkyradio-default">
                                            <input class="order_status" type="checkbox" name="order_status" id="1" value="1"
                                            <?php
                                              if($result['order_status']==1 || $result['order_status']==2 || $result['order_status']==3) echo "checked = 'true'";
                                              if($result['order_status']!=0) echo "disabled";
                                            ?>
                                            />
                                            <label for="1">Verifikasi Pembayaran</label>
                                        </div>
                                    </div>
                                    <div class="funkyradio">
                                        <div class="funkyradio-primary">
                                            <input class="order_status" type="checkbox" name="order_status" id="2" value="2"
                                            <?php
                                              if($result['order_status']==2 || $result['order_status']==3 ) echo "checked disabled";
                                              if($result['order_status']==4 ) echo "disabled";
                                            ?>
                                            />
                                            <label for="2">Dalam Proses</label>
                                        </div>
                                    </div>
                                    <div class="funkyradio">
                                        <div class="funkyradio-success">
                                            <input class="order_status" type="checkbox" name="order_status" id="3" value="3"
                                            <?php
                                              if($result['order_status']==3) echo "checked disabled";
                                              if($result['order_status']==4 ) echo "disabled";
                                            ?>
                                            />
                                            <label for="3">Sudah dikirim</label>
                                        </div>
                                    </div>
                                    <div class="funkyradio">
                                        <div class="funkyradio-danger">
                                            <input class="order_status" type="checkbox" name="order_status" id="4" value="4"
                                              <?php
                                                if($result['order_status']==4) echo "checked disabled";
                                                if($this->session->userdata("antglobal_backend")["user_access_level"]==0){
                                                  echo "disabled";
                                                }
                                              ?>
                                            />
                                            <label for="4">Dibatalkan</label>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row order_resi">
                              <div class="col-md-4">
                                  <div class="form-group" id="sandbox-container">
                                      <label>Tanggal Kirim</label>
                                      <input  class="form-control border-input" type="text" name="order_ship_date" placeholder="Masukan Tanggal Kirim" required="true" value="<?php echo $result['order_ship_date']?>">
                                  </div>
                              </div>
                              <div class="col-md-8">
                                  <div class="form-group">
                                      <label>Nomor Resi</label>
                                      <input  class="form-control border-input"type="text" name="order_ship_resi" placeholder="Masukan Nomor Resi" required="true" value="<?php echo $result['order_ship_resi']?>">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Alamat Pengiriman</label>
                                    <div class="funkyradio">
                                        <div class="funkyradio-success">
                                            <input type="checkbox" name="order-address-edit" id="address-edit" value="0"/>
                                            <label for="address-edit">Ubah Alamat Pengiriman?</label>
                                            <p class="text-date">*tidak dapat mengganti kecamaatan, kota, provinsi</p>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row order-address-edit">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Provinsi</label>
                                      <input  class="form-control border-input"type="text" name="order_ship_province" value="<?php echo $result['order_ship_province']?>" readonly="true">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Kota</label>
                                      <input  class="form-control border-input"type="text" name="order_ship_city" value="<?php echo $result['order_ship_city']?>" readonly="true">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Kecamatan</label>
                                      <input  class="form-control border-input"type="text" name="order_ship_district" value="<?php echo $result['order_ship_district']?>" readonly="true">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Kode Pos</label>
                                      <input  class="form-control border-input"type="text" name="order_ship_postal_code" value="<?php echo $result['order_ship_postal_code']?>" readonly="true">
                                  </div>
                              </div>
                          </div>
                          <div class="row order-address-edit">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Alamat</label>
                                      <textarea class="form-control border-input" name="order_ship_address"><?php echo $result['order_ship_address']?></textarea>
                                  </div>
                              </div>

                          </div>
                          <div class="text-right">
                              <a href="order/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                              <input type="hidden" name="order_id" value="<?php echo $result['order_id']?>"/>
                              <input type="hidden" name="customer_id" value="<?php echo $result['customer_id']?>"/>
                              <input type="hidden" id="order_status_prev"  name="order_status_prev" value="<?php echo $result['order_status']?>"/>
                              <input type="hidden" name="order_points" value="<?php echo $result['order_points']?>"/>
                              <input type="hidden" name="order_used_point" value="<?php echo $result['order_used_point']?>"/>

                              <input type="submit" data-target="#confirm-save" class="btn btn-success btn-fill btn-wd" value="Simpan">
                          </div>
                          <div class="clearfix"></div>
                          <?php
                            }
                          }
                          ?>
                      </form>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
            ?>
            <div class="col-md-offset-1 col-md-10">
              <div class="card">
                <h5>Tidak ada Data</h5>
              </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
