<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tambah Pertanyaan</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="faq/insert">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pertanyaan</label>
                                        <input type="text" name="faq_question" class="form-control border-input" placeholder="Masukkan Pertanyaan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jawaban</label>
                                        <textarea name="faq_answer" class="form-control border-input" placeholder="Masukkan Jawaban" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="faq/" class="btn  btn-fill btn-wd btn-back">Batal</a>
                                <input type="submit" class="btn btn-success btn-fill btn-wd" value="Simpan">
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
