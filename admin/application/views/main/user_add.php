<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tambah Admin</h4>
                    </div>
                    <div class="content">
                        <?php echo form_open_multipart('user/validate'); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>username*</label> <?php echo "<strong><span class='text-danger pull-right'>".form_error('user_name')."</span></strong>"; ?>
                                        <input type="text" name="user_name" class="form-control border-input" maxlength="50" placeholder="Masukkan user name Anda" value="<?php echo set_value('user_name'); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Nama*</label> <?php echo "<strong><span class='text-danger pull-right'>".form_error('user_fullname')."</span></strong>"; ?>
                                      <input type="text" name="user_fullname" class="form-control border-input" maxlength="100"placeholder="Masukkan Nama Anda" value="<?php echo set_value('user_fullname'); ?>" required>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Password (8 sampai 20 karakter)*</label> <?php echo "<strong><span class='text-danger pull-right'>".form_error('user_fullname')."</span></strong>"; ?>
                                      <input type="Password" name="user_passcode" class="form-control border-input" minlength="8" maxlength="20" placeholder="Masukkan Password Anda" value="<?php echo set_value('user_passcode'); ?>" required>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Akses Level</label>
                                        <div class="funkyradio">
                                            <div class="funkyradio-default">
                                                <input type="radio" name="user_access_level" id="admin" value="0" checked/>
                                                <label for="admin">Admin</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="user_access_level" id="root" value="1" />
                                                <label for="root">Root Admin</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="funkyradio">
                                            <div class="funkyradio-default">
                                                <input type="radio" name="user_status" id="inactive" value="0" checked/>
                                                <label for="inactive">Inactive</label>
                                            </div>
                                            <div class="funkyradio-success">
                                                <input type="radio" name="user_status" id="active" value="1" />
                                                <label for="active">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="user/" class="btn  btn-fill btn-wd btn-back">Batal</a>
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
