<div id="content">
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <div class="box text-center">
                <h1 class="text-success">Transaksi Berhasil <i class="fa fa-check-circle-o"></i></h1>
                <h4>Nomor Transaksi : <?php echo $order["order_ref"]; ?></h4>
                <p class="lead" style="font-size:14px;color:#999;">Detail transaksi dapat dilihat di email Anda. Segera lakukan pembayaran dan verifikasi pada halaman <a href="account/order">Order</a>.</p>
                <p class="lead" style="font-size:14px;color:#999;"><strong>Lakukan Transfer sejumlah Rp <?php echo number_format($order["order_grand_total"],0,',','.');?>.<br />Ke rekening dibawah ini:</strong></p>
                <div>
                    <img class="img-responsive" style="height:40px;display:inline-block;margin-bottom:0px;" src="file_assets/banks/<?php echo $order["bank_image"]; ?>">
                    <p><?php echo $order["bank_name"]; ?>
                        <br><?php echo $order["bank_account"]; ?>
                        <br><?php echo $order["bank_account_number"]; ?>
                    </p>
                </div>
                <small class="text-danger text-center">Pastikan Anda hanya mengirimkan pembayaran pada rekening yang telah kami sediakan.</small>
                <p>
                  <a href="home">Halaman utama</a>
                </p>
                <!-- <p>Setelah registrasi anda dapat berbelanja segala jenis produk kami dengan berbagai penawaran menarik!</p> -->
                <hr>
            </div>
        </div>
    </div>
</div>
