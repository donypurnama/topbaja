<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Daftar Produk</h4>
                        <hr>
                        <form class="navbar-form" role="search" method="get" action="product/search">
                        <a class="btn btn-with-icon btn-primary btn-fill btn-wd btn-header" href="product/add"><i class="ti-package"></i>Tambah Produk</a>
                          <input type="text" placeholder="Search.." class="pull-right search-field" name="search">
                        </form>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped ">
                            <thead>
                                <tr class="table-header">
                                    <th>Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data) {
                                    foreach ($data as $key=>$result) {
                                ?>
                                <tr>
                                    <td class="td-article col-md-4">
                                        <div class="row">
                                            <div class="col-md-4 pull-left"><img src="../file_assets/products/<?php echo $result["product_primary_image"];?>" alt="<?php echo $result["product_name"];?>" class="img-responsive"/></div>
                                            <div class="col-md-8 pull-right">
                                                <h5><?php echo $result["product_name"];?></h5>
                                                <p class="text-date"><?php echo $result["product_sku"];?></small>
                                            </div>
                                        </div>
                                        <p class="text-date">Terakhir diubah pada <?php echo $result["product_last_changed_time"];?></p>
                                    </td>
                                    <td class="td-article col-md-4">
                                        <?php echo $result["product_description"];?>
                                    </td>
                                    <td>
                                        <?php echo "Rp. ". number_format($result["product_price"],2,',','.');?>
                                    </td>
                                    <td class="td-buttons">
                                        <p><a href="product/image/<?php echo $result['product_url'];?>" class="btn btn-wide btn-info btn-fill"><i class="ti-gallery"></i> Galeri</a></p>
                                        <a href="product/edit/<?php echo $result['product_url'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Ubah</a>
                                        <a href="#" data-href="product/delete/<?php echo $result['product_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
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
