<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ubah Artikel</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="article/update" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="article_title" class="form-control border-input input-article-title" placeholder="Masukkan Judul Artikel" maxlength="150" required value="<?php echo $data['article_title'];?>">
                                        <hr>
                                        <textarea class="input-block-level" id="summernote" name="article_content"><?php echo htmlspecialchars($data['article_content']);?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" name="article_meta_description" class="form-control border-input" placeholder="Masukkan Keywords pisahkan dengan tanda ',' " maxlength="160"  value="<?php echo $data['article_meta_description'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="funkyradio">
                                            <div class="funkyradio-default">
                                                <input type="radio" name="article_status" id="inactive" value="0" <?php if ($data['article_status'] == "0") echo 'Checked';?>/>
                                                <label for="inactive">Draft</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="article_status" id="active" value="1" <?php if ($data['article_status'] == "1") echo 'Checked';?>/>
                                                <label for="active">Published</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="article/" class="btn  btn-fill btn-wd btn-back-update">Batal</a>
                                <input type="hidden" name="article_id" value="<?php echo $data['article_id'];?>">
                                <input type="submit" class="btn btn-success btn-fill btn-wd" value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
