<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <?php
                        if ($url == "selection") {
                          $title = "Pilihan";
                        } elseif ($url == "discount") {
                          $title = "Diskon";
                        } elseif ($url == "top") {
                          $title = "Terlaris";
                        }

                        ?>
                        <input type="text" placeholder="Search.." class="search-field pull-right">
                        <h4 class="title">Tambah Produk <?php echo $title;?></h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Diskon <span class="text-scale"> (%) </span></th>
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
                                    <td class="icon-eye">
                                        <?php echo($result["product_discount"])."%";?>
                                    </td>
                                    <td>
                                        <?php echo "Rp. ". number_format($result["product_price"],0,',','.');?>
                                    </td>
                                    <td class="td-buttons">
                                        <a href="home/add_product/<?php echo $url."/".$result['product_id'];?>" class="btn btn-sm btn-success btn-fill"><i class="ti-plus"></i> Tambah</a>
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
</div>
