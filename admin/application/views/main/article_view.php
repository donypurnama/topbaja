<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Daftar Artikel</h4>
                        <hr>
                        <a class="btn btn-with-icon btn-primary btn-fill btn-wd btn-header" href="article/add"><i class="ti-file"></i>Tambah Artikel Baru</a>
                        <input type="text" placeholder="Search..." class="search-field pull-right">
                        <!--
                            <h4 class="title">Daftar pertanyaan Terkait</h4>
                            <p class="category">Pengaturan pertanyaan Terkait</p>-->
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Artikel</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data) {
                                    foreach ($data as $key=>$result) {
                                ?>
                                <tr>
                                    <td class="td-article col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 pull-left"><?php echo $result["article_cover"]; ?></div>
                                            <div class="col-md-8 pull-right">
                                                <h5><?php echo $result["article_title"];?></h5>
                                                <p class="article-text text-ellipsis-row-5"><?php echo strip_tags(str_replace("\n", '', preg_replace("/<img[^>]+\>/i", "", $result["article_content"])));?></small>
                                            </div>
                                        </div>
                                        <p class="text-date">Dibuat pada <?php echo $result["article_created_time"];?></p>
                                    </td>
                                    <td>
                                      <?php
                                        echo $result["article_status"];
                                      ?></td>
                                    <td class="td-buttons">
                                        <a href="article/edit/<?php echo $result['article_url'];?>" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt2"></i>Ubah</a>
                                        <a href="#" data-href="article/delete/<?php echo $result['article_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
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
