<div class="content">
    <div class="container-fluid">
        <?php if (!$data){?>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="card">
                    <div class="content">
                        <form method="POST" action="report/customer" enctype="multipart/form-data">
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>Periode Awal</label>
                                    <div>
                                        <input id="from" class="form-control border-input datepicker" name="start_date"type="text" placeholder="Masukan Tanggal Awal Periode">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Periode Akhir</label>
                                    <div>
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
        <?php }?>
        <?php if ($data){?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="header">
                      <h4 class="title">Laporan Pelanggan</h4>
                  </div>
                  <div class="content table-responsive table-full-width">
                      <table class="table table-striped live-table">
                          <thead>
                              <tr class="table-header">
                                  <th>Pelanggan</th>
                                  <th>Email</th>
                                  <th class="icon-eye">Points</th>
                                  <th class="icon-eye">Total Pesanan</th>
                                  <th class="icon-eye">Total Permintaan</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ($data) {
                                foreach ($data as $key=>$result) {
                            ?>
                            <tr>
                                <td class="td-title">
                                    <strong><?php echo $result['customer_name'];?></strong>
                                </td>
                                <td>
                                    <?php echo $result['customer_email_address'];?></strong>
                                </td>
                                <td class="icon-eye">
                                    <?php echo $result['customer_point'];?></strong>
                                </td>
                                <td class="icon-eye">
                                    <?php echo $result['customer_order_transaction'] ;?></strong>
                                </td>
                                <td class="icon-eye">
                                    <?php echo $result['customer_quotation_transaction'];?></strong>
                                </td>
                                <td class="td-buttons">
                                    <a href="report/detail_customer/<?php echo $result['customer_id']."/".date("Y-m-d",strtotime($date['start_date']))."/".date("Y-m-d",strtotime($date['end_date']));?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Detail</a>
                                </td>
                            </tr>
                            <?php
                              }
                            }else{
                            ?>
                            <tr>
                              <td colspan="4">Tidak ada Data</td>
                            </tr>
                            <?php
                            }
                            ?>
                          </tbody>
                      </table>
                      <div class="row">
                        <div class="col-sm-4 col-xs-3">
                          <?php
                          if ($pagination["current_page"] > 1) {
                          ?>
                          <button class="btn btn-primary btn-page-prev" id="btnPrevPage" value="<?php echo $pagination["current_page"]-1; ?>"><i class="fa fa-arrow-circle-o-left"></i><span class="hidden-xs">Sebelumnya</span></button>
                          <?php
                          }
                          ?>
                        </div>
                        <div class="col-sm-4 col-xs-6 page-showing text-center">
                            Halaman <strong><?php echo $pagination["current_page"]; ?></strong> / <strong><?php echo $pagination["total_page"]; ?></strong>
                        </div>
                        <div class="col-sm-4 col-xs-3 ">
                          <?php
                          if ($pagination["current_page"] < $pagination["total_page"]) {
                          ?>
                          <button type="submit" class="btn btn-primary pull-right btn-page-next" id="btnNextPage" value="<?php echo $pagination["current_page"]+1; ?>"><span class="hidden-xs">Berikutnya</span><i class="fa fa-arrow-circle-o-right"></i></button>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <?php }?>

    </div>
</div>
