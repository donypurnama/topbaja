<div id="content">
    <div class="container">

        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="home">Home</a>
                </li>
                <li><a href="account/order">Pembelian</a>
                </li>
                <li>Verifikasi <?php echo $order["order_ref"];?></li>
            </ul>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                    <h3 class="panel-title">Menu pengguna</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                          <a href="account/profile"><i class="fa fa-user"></i> Profil</a>
                        </li>
                        <li class="active">
                            <a href="account/order"><i class="fa fa-list"></i> Pembelian</a>
                        </li>
                        <li>
                            <a href="wishlist"><i class="fa fa-heart"></i> Wishlist</a>
                        </li>
                        <li>
                            <a href="account/logout"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="customer-order">
            <div class="box">
                <h3>Verifikasi Pembayaran</h3>
                <p class="text-muted">Jika Anda memiliki pertanyaan, silahkan kunjungi halaman <a href="contact-us">Kontak kami</a>, atau gunakan fitur live chat.</p>
                <hr>
                <div class="row">
                  <div class="col-sm-5">
                      <h5>Bank pilihan</h5>
                      <div class="box" style="padding:4px 10px;">
                        <table class="">
                          <tr>
                            <td>
                              <img class="img-responsive" style="width:60px;vertical-align:middle;" src="file_assets/banks/<?php echo $bank["bank_image"]; ?>">
                            </td>
                            <td>
                              <p style="letter-spacing:1px;font-size:12px;font-weight:500;margin:0px;padding:10px;padding-left:18px;" class="text-muted"><?php echo $bank["bank_name"]; ?>
                                  <br><?php echo $bank["bank_account"]; ?>
                                  <br><?php echo $bank["bank_account_number"]; ?>
                                  <br>Rp <?php echo number_format($order["order_grand_total"],0,',','.');?>
                              </p>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="form-group col-sm-12" style="border:solid 2px #DDD;padding:10px;">
                          <label for="name">Bukti Pembayaran</label>
                          <div class="img-container" id="img-container" style="width:100%;height:180px;background:url('file_assets/verification/<?php echo $order["order_verification_photo"];?>') #eee no-repeat center;background-size:contain;margin-bottom:8px;"></div>
                          <div id="vloader" class="loader">Loading..</div>
                          <input type="file" name="file" multiple id="file" class="form-control border-input">
                          <button type="button" id="verification-upload" data-ref="<?php echo $order["order_ref"];?>" class="form-control" style="margin-top:4px;"> Upload </button>
                          <p class="text-center text-danger" style="font-size:12px;margin-top: 10px;margin-bottom:0px;">*Lampirkan bukti transfer untuk mempercepat proses verifikasi.</p>
                      </div>
                  </div>
                  <div class="col-sm-5">
                    <form action="account/insert_verification" method="post" id="verification">
                      <h5>Verifikasi Pembayaran</h5>
                      <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="name">Nama Bank *</label>
                            <input type="text" class="form-control" name="order_verification_sender_bank" maxlength="50" required placeholder="Masukkan nama Bank Pengirim" value="<?php echo $order['order_verification_sender_bank'];?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="last_name">Nama Pemilik Rekening *</label>
                            <input type="text" class="form-control" name="order_verification_sender_name" maxlength="100" required placeholder="Masukkan nama Pengirim" value="<?php echo $order['order_verification_sender_name'];?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="email_address">Nomor Rekening *</label>
                            <input type="text" class="form-control" name="order_verification_sender_bank_account" maxlength="50" required placeholder="Masukkan No. Rekening Pengirim" value="<?php echo $order['order_verification_sender_bank_account'];?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="email_address">Jumlah Transfer *</label>
                            <input type="number" class="form-control" name="order_verification_total" required placeholder="Masukkan jumlah transfer Anda" value="<?php echo $order['order_grand_total'];?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="hidden" name="order_ref" value="<?php echo $order["order_ref"]; ?>"/>
                            <button type="submit" class="form-control"> Submit </button>
                        </div>
                        <div class='form-group col-sm-12 <?php echo $this->session->flashdata("verification_error") ? "text-danger" : "text-success";?>'>
                          <?php echo $this->session->flashdata("verification_error");?>
                          <?php echo $this->session->flashdata("verification_success");?>
                        </div>
                      </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
