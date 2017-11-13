<div class="content">
    <div class="container-fluid">
        <!-- Notification Card -->
        <div class="row">
          <div class="col-lg-3 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-2">
                               <div class="icon-big icon-warning text-center">
                                   <i class="ti-shopping-cart-full"></i>
                               </div>
                           </div>
                           <div class="col-xs-10">
                               <div class="numbers">
                                   <p>Pesanan Belum Di Lihat</p>
                                   <?php
                                    if($orders){
                                      echo count($orders);
                                    }else{
                                      echo "0";
                                    }
                                   ?>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
          </div>
          <div class="col-lg-3 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-2">
                               <div class="icon-big icon-danger text-center">
                                   <i class="ti-shopping-cart-full"></i>
                               </div>
                           </div>
                           <div class="col-xs-10">
                               <div class="numbers">
                                   <p>Pesanan Menunggu Verifikasi</p>
                                   <?php
                                    if($not_verified_orders){
                                      echo count($not_verified_orders);
                                    }else{
                                      echo "0";
                                    }
                                   ?>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
          </div>
          <div class="col-lg-3 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-2">
                               <div class="icon-big icon-warning text-center">
                                   <i class="ti-pencil-alt"></i>
                               </div>
                           </div>
                           <div class="col-xs-10">
                               <div class="numbers">
                                   <p>Permintaan Belum Di Lihat</p>
                                   <?php
                                    if($quotations){
                                      echo count($quotations);
                                    }else{
                                      echo "0";
                                    }
                                   ?>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
          </div>
          <div class="col-lg-3 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-2">
                               <div class="icon-big icon-danger text-center">
                                   <i class="ti-help"></i>
                               </div>
                           </div>
                           <div class="col-xs-10">
                               <div class="numbers">
                                   <p>Kontak Pesan Belum Di Lihat</p>
                                   <?php
                                    if($contacts){
                                      echo count($contacts);
                                    }else{
                                      echo "0";
                                    }
                                   ?>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
          </div>
        </div>

        <!-- Order -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Pesanan</h3>
                        <p class="text-danger">Belum Dilihat</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>No Pesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Grand Total <span class="text-scale"> (Rp.) </span></th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              if ($orders) {
                                  foreach ($orders as $key=>$result) {
                              ?>
                              <tr>
                                  <td>
                                      <h5><?php echo $result["order_ref"];?></h5>
                                  </td>
                                  <td>
                                      <?php echo $result["customer_first_name"]." ".$result["customer_last_name"];?>
                                  </td>
                                  <td class="price">
                                    <?php echo number_format($result['order_grand_total'],0,"," ,".")?>
                                  </td>
                                  <td>
                                      <?php
                                      if ($result['order_status']==0){
                                        echo "Menunggu Pembayaran ";
                                      }elseif ($result['order_status']==1){
                                        echo "Melakukan Verifikasi";
                                      }elseif ($result['order_status']==2){
                                        echo "Sudah di Verifikasi dan di Proses";
                                      }elseif ($result['order_status']==3){
                                        echo "Terkirim";
                                      }
                                      ?>
                                  </td>
                                  <td class="td-buttons">
                                      <a href="order/detail/<?php echo $result['order_id'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Detail</a>
                                  </td>
                              </tr>
                              <?php
                                  }
                              } else {
                              ?>
                              <tr><td colspan="5"><p class="text-primary text-center">Tidak ada data</p></td></tr>
                              <?php
                              }
                              ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- Permintaan -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Permintaan</h3>
                        <p class="text-danger">Belum Dilihat</p>
                    </div>
                    <div class="content">
                      <div class="content table-responsive table-full-width">
                          <table class="table table-striped live-table">
                              <thead>
                                  <tr class="table-header">
                                      <th>Permintaan</th>
                                      <th>Pelanggan</th>
                                      <th>Kategori</th>
                                      <th>Deskripsi</th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                if ($quotations) {
                                    foreach ($quotations as $key=>$result) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $result["quotation_title"];?>
                                    </td>
                                    <td>
                                        <?php echo $result["customer_first_name"]." ".$result["customer_last_name"];?>
                                    </td>
                                    <td>
                                        <?php echo $result["quotation_category"];?>
                                    </td>
                                    <td>
                                        <?php echo $result["quotation_description"];?>
                                    </td>
                                    <td class="td-buttons">
                                        <a href="quotation/detail/<?php echo $result['quotation_id'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Detail</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                <tr><td colspan="5"><p class="text-primary text-center">Tidak ada data</p></td></tr>
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

        <!-- Contact -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Pesan Kontak</h3>
                        <p class="text-danger">Belum Dilihat</p>
                    </div>
                    <div class="content">
                      <div class="content table-responsive table-full-width">
                          <table class="table table-striped live-table">
                              <thead>
                                  <tr class="table-header">
                                      <th>Kontak</th>
                                      <th>Customer</th>
                                      <th>Email</th>
                                      <th>Deskripsi</th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                if ($contacts) {
                                    foreach ($contacts as $key=>$result) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $result["contact_title"];?>
                                    </td>
                                    <td>
                                        <?php echo $result["contact_person_name"];?>
                                    </td>
                                    <td>
                                        <?php echo $result["contact_person_email"];?>
                                    </td>
                                    <td>
                                        <?php echo $result["contact_description"];?>
                                    </td>
                                    <td class="td-buttons">
                                        <a href="contact/edit/<?php echo $result['contact_id'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Detail</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                <tr><td colspan="5"><p class="text-primary text-center">Tidak ada data</p></td></tr>
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
        <!-- Product Selection, Diskon, Topseliing -->
        <div class="row">
          <div class="col-lg-4 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-2">
                               <div class="icon-big icon-success text-center">
                                   <i class="ti-check-box"></i>
                               </div>
                           </div>
                           <div class="col-xs-8">
                              <h5>Produk Pilihan</h5>
                              <hr>
                           </div>
                           <div class="col-xs-2">
                              <a href="home/add_products/selection" class="btn btn-info btn-xs btn-fill add-product"><i class="ti-plus"></i></a>
                           </div>
                       </div>
                       <div class="content table-responsive table-full-width">
                           <table class="table table-striped live-table">
                               <tbody>
                                   <?php
                                   if ($selections) {
                                       foreach ($selections as $key=>$result) {
                                   ?>
                                   <tr>
                                       <td>
                                           <h5><?php echo $result["product_name"];?></h5>
                                       </td>
                                       <td class="td-buttons">
                                           <a href="#" data-href="home/delete/selection/<?php echo $result['display_selection_product_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
                                       </td>
                                   </tr>
                                   <?php
                                       }
                                   } else {
                                   ?>
                                   <tr><td colspan="3"><p class="text-primary text-center">Tidak ada data</p></td></tr>
                                   <?php
                                   }
                                   ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
          </div>
          <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="icon-big icon-success text-center">
                                    <i class="ti-tag"></i>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                 <h5>Produk Diskon</h5>
                                 <hr>
                            </div>
                            <div class="col-xs-2">
                               <a href="home/add_products/discount" class="btn btn-info btn-xs btn-fill add-product"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-striped live-table">
                                <tbody>
                                  <?php
                                  if ($discounts) {
                                      foreach ($discounts as $key=>$result) {
                                  ?>
                                  <tr>
                                      <td>
                                          <h5><?php echo $result["product_name"];?></h5>
                                      </td>
                                      <td class="td-buttons">
                                          <a href="#" data-href="home/delete/discount/<?php echo $result['display_discount_product_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
                                      </td>
                                  </tr>
                                  <?php
                                      }
                                  } else {
                                  ?>
                                  <tr><td colspan="3"><p class="text-primary text-center">Tidak ada data</p></td></tr>
                                  <?php
                                  }
                                  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

          </div>
          <div class="col-lg-4 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-2">
                               <div class="icon-big icon-success text-center">
                                   <i class="ti-money"></i>
                               </div>
                           </div>
                           <div class="col-xs-8">
                                <h5>Produk Terlaris</h5>
                                <hr>
                           </div>
                           <div class="col-xs-2">
                              <a href="home/add_products/top" class="btn btn-info btn-xs btn-fill add-product"><i class="ti-plus"></i></a>
                           </div>
                       </div>
                       <div class="content table-responsive table-full-width">
                           <table class="table table-striped live-table">
                               <tbody>
                                 <?php
                                 if ($tops) {
                                     foreach ($tops as $key=>$result) {
                                 ?>
                                 <tr>
                                     <td>
                                         <h5><?php echo $result["product_name"];?></h5>
                                     </td>
                                     <td class="td-buttons">
                                         <a href="#" data-href="home/delete/top/<?php echo $result['display_top_product_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
                                     </td>
                                 </tr>
                                 <?php
                                     }
                                 } else {
                                 ?>
                                 <tr><td colspan="3"><p class="text-primary text-center">Tidak ada data</p></td></tr>
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
