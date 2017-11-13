<div id="content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="home">Home</a>
                </li>
                <li>Profil</li>
            </ul>

        </div>

        <div class="col-md-3">
            <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                    <h3 class="panel-title">Menu pengguna</h3>
                </div>

                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="<?php echo $menu["account"]; ?>">
                          <a href="account/profile"><i class="fa fa-user"></i> Profil</a>
                        </li>
                        <li class="<?php echo $menu["order"]; ?>">
                            <a href="account/order"><i class="fa fa-list"></i> Pembelian</a>
                        </li>
                        <li class="<?php echo $menu["wishlist"]; ?>">
                            <a href="wishlist"><i class="fa fa-heart"></i> Wishlist</a>
                        </li>
                        <li>
                            <a href="account/logout"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- /.col-md-3 -->

            <!-- *** CUSTOMER MENU END *** -->
        </div>

        <div class="col-md-9">
            <div class="box">
                <h1>Profil Pengguna</h1>
                <hr>
                <h3>Biodata</h3>
                <form action="account/update_bio" method="post">
                    <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="email">Email <i class="fa fa-lock"></i></label>
                              <input type="text" class="form-control" value="<?php echo $customer['customer_email_address']; ?>" disabled>
                              <input type="hidden" class="form-control" name="customer_email_address" value="<?php echo $customer['customer_email_address'];?>">
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="firstname">Nama Depan *</label>
                                <input type="text" class="form-control" name="customer_first_name" placeholder="Masukkan nama depan Anda" value="<?php echo $customer['customer_first_name']; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="lastname">Nama Belakang *</label>
                                <input type="text" class="form-control" name="customer_last_name" placeholder="Masukkan nama belakang Anda" value="<?php echo $customer['customer_last_name']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="city">Nama Perusahaan *</label>
                                <input type="text" class="form-control" name="customer_company_name" placeholder="Masukkan nama perusahaan (Jika ada)" value="<?php echo $customer['customer_company_name']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone">Nomor Telepon *</label>
                                <input type="number" class="form-control" name="customer_phone" value="<?php echo $customer['customer_phone']; ?>" placeholder="Masukkan nomor telepon" required>
                            </div>
                        </div>
                        <div class="col-sm-12 text-danger">
                          <?php
                          if ($this->session->flashdata("update_bio")){
                          ?>
                          <p class="text-success">
                            <?php
                            echo $this->session->flashdata("update_bio");
                            ?>
                             <i class="fa fa-check"></i>
                          </p>
                          <?php
                          }
                          ?>
                            <?php echo $err["update_bio_error"]; ?>
                        </div>
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
                <hr>
                <h3>Ubah Password</h3>
                <form action="account/update_password" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password_old">Password Lama *</label>
                                <input type="password" class="form-control" placeholder="Masukkan Password Anda saat ini" required name="customer_old_passcode" value="<?php echo ($this->input->post('customer_old_passcode')) ? $this->input->post('customer_old_passcode') : '';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password_1">Password Baru *</label>
                                <input type="password" class="form-control" placeholder="Masukkan Password baru" required name="customer_passcode" value="<?php echo ($this->input->post('customer_passcode')) ? $this->input->post('customer_passcode') : '';?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password_2">Konfirmasi Password Baru*</label>
                                <input type="password" class="form-control" placeholder="Masukkan kembali Password baru" required name="customer_passconf" value="<?php echo ($this->input->post('customer_passconf')) ? $this->input->post('customer_passconf') : '';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 text-danger">
                        <?php
                        if ($this->session->flashdata("update_pass")){
                        ?>
                        <p class="text-success">
                          <?php
                          echo $this->session->flashdata("update_pass");
                          ?>
                           <i class="fa fa-check"></i>
                        </p>
                        <?php
                        }
                        ?>
                          <?php echo $err["update_password_error"]; ?>
                      </div>
                      <div class="col-sm-12 text-right">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Ubah Password</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
