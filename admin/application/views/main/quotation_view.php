<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <input type="text" placeholder="Search.." class="search-field pull-right">
                        <h4 class="title">Daftar Permintaan </h4>
                        <hr>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Permintaan</th>
                                    <th>Pelanggan</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th class="icon-eye"><i class="ti-eye"></i></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data) {
                                    foreach ($data as $key=>$result) {
                                ?>
                                <tr>
                                  <td><?php echo $result['quotation_title'];?></td>
                                  <td><?php echo $result['customer_first_name']. " ".$result['customer_last_name'];?></td>
                                  <td><?php echo $result['quotation_category'];?></td>
                                  <td><?php echo $result['quotation_description'];?></td>
                                  <td class="icon-eye">
                                    <?php echo $retVal = ($result['quotation_seen']) ?  "Sudah" :  "Belum" ;?>
                                  </td>
                                  <td class="td-buttons">
                                      <a href="quotation/detail/<?php echo $result['quotation_id'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Detail</a>
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
    </div>
</div>
