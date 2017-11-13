<div class="content">
    <div class="container-fluid">
        <!-- Permintaan -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <!-- <input type="text" placeholder="Search.." class="search-field pull-right"> -->
                        <h4 class="title">Riwayat Permintaan
                          <?php if($data_orders) echo $data_orders['0']['customer_first_name']." ".$data_orders['0']['customer_last_name'];?></h4>
                        <hr>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Tanggal Transaksi</th>
                                    <th>Permintaan</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              if ($data_quotations) {
                                  foreach ($data_quotations as $key=>$result) {
                              ?>
                              <tr>
                                <td><?php echo date("d - M - Y", strtotime($result['quotation_created_time']));?></td>
                                <td><?php echo $result['quotation_title'];?></td>
                                <td><?php echo $result['quotation_category'];?></td>
                                <td><?php echo $result['quotation_description'];?></td>
                              </tr>
                              <?php
                                  }
                              } else {
                              ?>
                              <tr><td colspan="4"><p class="text-primary text-center">Tidak ada data</p></td></tr>
                              <?php
                              }
                              ?>
                            </tbody>
                        </table>
                      </div>
                  </div>
            </div>
        </div>
        <!-- Pesanan -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <!-- <input type="text" placeholder="Search.." class="search-field pull-right"> -->
                        <h4 class="title">Riwayat Pesanan <?php if($data_orders)echo $data_orders['0']['customer_first_name']." ".$data_orders['0']['customer_last_name'];?></h4>
                        <hr>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Tanggal Transaksi</th>
                                    <th>No. Pesanan </th>
                                    <th>Alamat Kirim</th>
                                    <th>Poin</th>
                                    <th>Status</th>
                                    <th>Total<span class="text-scale"> (Rp.) </span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data_orders) {
                                    foreach ($data_orders as $key=>$result) {
                                ?>
                                <tr>
                                  <td><?php echo date("d - M - Y", strtotime($result['order_created_time']));?></td>
                                  <td><?php echo $result['order_ref'];?></td>
                                  <td class="col-md-3"><?php echo $result['order_ship_address'].", ".$result['order_ship_district'].", ".$result['order_ship_city'].", ".$result['order_ship_province']. ", ".$result['order_ship_postal_code'];?></td>
                                  <td><?php echo $result['order_points'];?></td>
                                  <td>
                                    <?php
                                      if ($result['order_status']==0){
                                        echo "Menunggu Pembayaran ";
                                      }elseif ($result['order_status']==1){
                                        echo "Verifikasi Pembayaran";
                                      }elseif ($result['order_status']==2){
                                        echo "Sudah di Proses";
                                      }elseif ($result['order_status']==3){
                                        echo "Sudah di Kirim";
                                      }elseif ($result['order_status']==4){
                                        echo "Dibatalkan";
                                      }
                                    ?>
                                  </td>
                                  <td class="price">
                                    <?php echo number_format($result['order_grand_total'],0,",",".")?>
                                  </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                <tr><td colspan="6"><p class="text-primary text-center">Tidak ada data</p></td></tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
