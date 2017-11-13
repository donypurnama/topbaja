<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Daftar Kategori</h4>
                        <hr>
                        <a class="btn btn-with-icon btn-primary btn-fill btn-wd btn-header" href="category/add"><i class="ti-view-list"></i>Tambah Kategori</a>
                        <input type="text" placeholder="Search.." class="search-field pull-right">
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Kategori</th>
                                    <th>Gambar kategori</th>
                                    <th>Deskripsi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data) {
                                    foreach ($data as $key=>$result) {
                                ?>
                                <tr>
                                    <td>
                                        <h5>
                                        <?php echo $result["category_name"];?></h5>
                                        <p class="text-date">Dibuat pada <?php echo $result["category_created_time"];?></p>
                                    </td>
                                    <td class="td-article">
                                          <img src="../file_assets/categories/<?php echo $result["category_image"];?>" alt="<?php echo $result["category_name"];?>" class="img-responsive"/>
                                    </td>
                                    <td class="td-article col-md-4"><?php echo $result["category_description"];?></td>
                                    <td class="td-buttons">
                                        <a href="category/edit/<?php echo $result['category_url'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Ubah</a>
                                        <a href="#" data-href="category/delete/<?php echo $result['category_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
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
