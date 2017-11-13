<div id="content">
    <div class="container">

        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="home">Home</a>
                </li>
                <li>Pembelian</li>
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

        <div class="col-md-9" id="customer-orders">
            <div class="box">
                <h1>Pembelian</h1>
                <p class="text-muted">Jika Anda memiliki pertanyaan, silahkan kunjungi halaman <a href="contact-us">Kontak kami</a>, atau gunakan fitur live chat.</p>
                <?php if ($this->session->flashdata("order_remove")){ ?>
                <p class="text-success">
                <?php
                echo $this->session->flashdata("order_remove");
                ?>
                </p>
                <?php } ?>
                <hr>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-muted">
                                <th>Tgl. Transaksi</th>
                                <th>Kode Transaksi</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($orders as $key => $value) {
                          ?>
                          <tr>
                              <td style="font-size:12px;"><?php echo substr($value["order_created_time"], 0, 10);?></td>
                              <th><?php echo $value["order_ref"];?></th>
                              <td>Rp <?php echo number_format($value["order_grand_total"],0,',','.');?></td>
                              <td><span class="label <?php echo $value["order_status_class"];?>"><?php echo $value["order_status_text"];?></span>
                              </td>
                              <td><a href="account/order/<?php echo $value['order_ref']; ?>" class="btn btn-primary btn-xs">Detail Order</a>
                                <?php if ($value["order_status"] <= 1) { ?>
                                <a href="account/verification/<?php echo $value['order_ref']; ?>" class="btn btn-primary btn-xs">Verifikasi Pembayaran</a>
                                <?php } else { ?>
                                <font class="text-small text-success" style="font-weight:500;">Pembayaran diterima <i class="fa fa-check"></i></font>
                                <?php } ?>
                              </td>
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
</div>
