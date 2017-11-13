<div class="content">
    <div class="container-fluid">
        <?php if (!@$date){?>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="card">
                    <div class="content">
                        <form method="POST" action="report/sales" enctype="multipart/form-data">
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>Periode Awal</label>
                                    <div id="sandbox-container">
                                        <input id="from"class="form-control border-input datepicker" name="start_date"type="text" placeholder="Masukan Tanggal Awal Periode">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Periode Akhir</label>
                                    <div id="sandbox-container">
                                        <input id="to" class="form-control border-input datepicker" name="end_date" type="text" placeholder="Masukan Tanggal Akhir Periode">
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="text-right">
                                <input type="submit" class="btn btn-success btn-fill btn-wd" value="Lihat">
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{?>
        <div class="row">
          <div class="col-lg-4 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-2">
                               <div class="icon-big icon-info text-center">
                                   <i class="ti-pencil-alt"></i>
                               </div>
                           </div>
                           <div class="col-xs-10">
                               <div class="numbers">
                                   <p>Jumlah Permintaan</p>
                                   <?php echo COUNT($data_quotations)?>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
          </div>
          <div class="col-lg-4 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-2">
                               <div class="icon-big icon-info text-center">
                                   <i class="ti-shopping-cart-full"></i>
                               </div>
                           </div>
                           <div class="col-xs-10">
                               <div class="numbers">
                                   <p>Jumlah Pesanan </p>
                                   <?php echo COUNT($data_orders)?>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
          </div>
          <div class="col-lg-4 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-2">
                               <div class="icon-big icon-info text-center">
                                   <i class="ti-money"></i>
                               </div>
                           </div>
                           <div class="col-xs-10">
                               <div class="numbers">
                                   <p>Grand Total Pesanan</p>
                                   <?php
                                    $grand_total= 0;
                                    foreach ($data_orders as $key => $value) {
                                      $grand_total += $value['order_grand_total'];
                                    }
                                    echo "Rp. ".number_format($grand_total,0,",",".");
                                   ?>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
          </div>
        </div>

        <!-- Tabel Permintaan -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">

                        <h4 class="title">Daftar Permintaan</h4>
                        <hr>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                          <thead>
                              <tr class="table-header">
                                  <th>Tanggal Transaksi</th>
                                  <th>Pelanggan</th>
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
                              <td><?php echo $result['customer_first_name']." ".$result['customer_last_name'];?></td>
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

        <!-- Table Penjualan -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">

                        <h4 class="title">Daftar Pesanan</h4>
                        <hr>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Tanggal Transaksi</th>
                                    <th>No. Pesanan </th>
                                    <th>Pelanggan</th>
                                    <th>Alamat Kirim</th>
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
                                <td><?php echo $result['customer_first_name']." ".$result['customer_last_name'];?></td>
                                <td class="col-md-3"><?php echo $result['order_ship_address'].", ".$result['order_ship_district'].", ".$result['order_ship_city'].", ".$result['order_ship_province']. ", ".$result['order_ship_postal_code'];?></td>

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
        </div>

        <?php } ?>
</div>
