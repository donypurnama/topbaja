<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Daftar Testimonial</h4>
                        <hr>
                        <a class="btn btn-with-icon btn-primary btn-fill btn-wd btn-header" href="testimonials/add"><i class="ti-help"></i>Tambah Testimonial Baru</a>
                        <input type="text" placeholder="Search.." class="search-field pull-right">
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Testimonials</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data) {
                                    foreach ($data as $key=>$result) {
                                ?>
                                <tr>
                                    <td class="col-md-8">
                                        <div class="col-md-4 pull-left"><img src="../file_assets/testimonials/<?php echo $result["testimonials_image"];?>" alt="<?php echo $result["testimonials_customers"];?>" class="img-responsive"/></div>
                                        <div class="col-md-8 pull-right">
                                          <h5><?php echo $result["testimonials_quote"];?></h5>
                                          <small class="text-ellipsis-row-1"><?php echo $result["testimonials_customers"];?></small>
                                          <p class="text-date">Dibuat pada <?php echo $result["testimonials_created_time"];?></p>
                                        </div>
                                    </td>
                                    <td class="td-buttons">
                                        <a href="testimonials/edit/<?php echo $result['testimonials_id'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Ubah</a>
                                        <a href="#" data-href="testimonials/delete/<?php echo $result['testimonials_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
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
