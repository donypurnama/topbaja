<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Daftar Gallery</h4>
                        <hr>
                        <a class="btn btn-with-icon btn-primary btn-fill btn-wd btn-header" href="galleries/add"><i class="ti-image"></i>Tambah Gallery</a>
                        <input type="text" placeholder="Search.." class="search-field pull-right">
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Foto</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Category</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data) {
                                    foreach ($data as $key=>$result) {
                                ?>
                                <tr>
                                    <td class="td-banner col-md-2">
                                        <img src="../file_assets/galleries/<?php echo $result["gallery_image"];?>" alt="<?php echo $result["gallery_url"];?>" class="img-responsive"/>
                                    </td>
                                    <td><?php echo $result["gallery_title"];?></td>
                                    <td><?php echo $result["gallery_description"];?></td>
                                    <td><?php echo $result["gallery_category_id"];?></td>
                                    <td class="td-buttons">
                                        <a href="galleries/edit/<?php echo $result['gallery_id'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Ubah</a>
                                        <a href="#" data-href="galleries/delete/<?php echo $result['gallery_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
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
