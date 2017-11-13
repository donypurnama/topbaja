<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Produk <?php echo $data['product_name'];?></h4>
                        <p class="category photo-qty">Memproses..</p>
                    </div>
                    <div class="content">
                        <form action="product/upload/<?php echo $data['product_url'];?>" id="form-upload">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Gambar</label>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="file" name="file[]" multiple id="file" class="form-control border-input">
                                            </div>
                                            <div class="col-md-2">
                                                <img src="../file_assets/loader.gif" class="img-responsive ajax-loader" style="max-height:40px;width:auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="product/" class="btn btn-default btn-fill btn-wd"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
                            <a href="#" id="upload-btn" class="btn btn-success btn-fill btn-wd"><i class="glyphicon glyphicon-open"></i> Upload</a>
                        </form>
                        <hr>
                        <div class="row"><ul class="thumbnails"></ul></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi
            </div>
            <div class="modal-body">
                Hapus data?<br>
                <small class="">*Data yang telah terhapus tidak dapat dikembalikan.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok">Lanjutkan</a>
            </div>
        </div>
    </div>
</div>
