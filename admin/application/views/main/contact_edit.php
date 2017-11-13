<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Pesan</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="contact/update">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Judul Pesan</label>
                                        <input type="text" name="contact_title" class="form-control border-input" value="<?php echo $data['contact_title'];?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Customer</label>
                                        <input type="text" name="contact_person_name" class="form-control border-input" value="<?php echo $data['contact_person_name'];?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" name="contact_person_phone" class="form-control border-input" value="<?php echo $data['contact_person_phone'];?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="contact_person_email" class="form-control border-input" value="<?php echo $data['contact_person_email'];?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Perusahaan</label>
                                        <input type="text" name="contact_company_name" class="form-control border-input" value="<?php echo $data['contact_company_name'];?>" maxlength="100" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pesan</label>
                                        <textarea class="form-control border-input"name="contact_description" rows="10"><?php echo $data['contact_description'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="contact/" class="btn  btn-fill btn-wd ">kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
