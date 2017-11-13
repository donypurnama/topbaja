<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ubah Promo</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="promo/update" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="promo_title" class="form-control border-input input-article-title" placeholder="Masukkan Judul Promo" maxlength="150" required value="<?php echo $data['promo_title'];?>">
                                        <hr>
                                        <textarea class="input-block-level" id="summernote" name="article_content"><?php echo htmlspecialchars($data['promo_content']);?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <!-- <input type="text" name="promo_description" class="form-control border-input" placeholder="Masukkan Deskripsi"  value="<?php echo $data['promo_description'];?>"> -->
                                        <textarea class="input-block-level" id="summernotex " name="promo_description"><?php echo htmlspecialchars($data['promo_description']);?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" name="promo_meta_description" class="form-control border-input" placeholder="Masukkan Keywords pisahkan dengan tanda ',' " maxlength="160"  value="<?php echo $data['promo_meta_description'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="funkyradio">
                                            <div class="funkyradio-default">
                                                <input type="radio" name="promo_status" id="inactive" value="0" <?php if ($data['promo_status'] == "0") echo 'Checked';?>/>
                                                <label for="inactive">Draft</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="promo_status" id="active" value="1" <?php if ($data['promo_status'] == "1") echo 'Checked';?>/>
                                                <label for="active">Published</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="promo/" class="btn  btn-fill btn-wd btn-back-update">Batal</a>
                                <input type="hidden" name="promo_id" value="<?php echo $data['promo_id'];?>">
                                <input type="submit" class="btn btn-success btn-fill btn-wd" value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
