<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Daftar Pertanyaan</h4>
                        <hr>
                        <a class="btn btn-with-icon btn-primary btn-fill btn-wd btn-header" href="faq/add"><i class="ti-help"></i>Tambah Pertanyaan Baru</a>
                        <input type="text" placeholder="Search.." class="search-field pull-right">
                        <!--
                            <h4 class="title">Daftar pertanyaan Terkait</h4>
                            <p class="category">Pengaturan pertanyaan Terkait</p>-->
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Pertanyaan</th>
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
                                        <h5>
                                        <?php echo $result["faq_question"];?></h5>
                                        <small class="text-ellipsis-row-1"><?php echo $result["faq_answer"];?></small>
                                        <p class="text-date">Dibuat pada <?php echo $result["faq_created_time"];?></p>
                                    </td>
                                    <td class="td-buttons">
                                        <a href="faq/edit/<?php echo $result['faq_id'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Ubah</a>
                                        <a href="#" data-href="faq/delete/<?php echo $result['faq_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
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
