<div id="content">
    <div class="container">
      <form method="post" action="cart/review">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="home">Home</a>
                </li>
                <li><a href="cart">Keranjang Belanja</a>
                </li>
                <li>Pengiriman</li>
            </ul>
        </div>

        <div class="col-md-12" id="checkout">
            <div class="box">
                    <h1>Checkout - <?php echo $cart_product_courier; ?> </h1>
                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a href="cart/checkout"><i class="fa fa-truck"></i><br>Pengiriman</a>
                        </li>
                        <li class="disabled"><a href="javascript:void(0)"><i class="fa fa-file-text"></i><br>Review Pembelian</a>
                        </li>
                    </ul>

                    <div class="content">
                        <h3>Keterangan Pengiriman</h3>
                        <div class="row same-height-row">
                          <div class="col-sm-6">
                            <div class="row same-height">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="order_ship_receiver_name">Nama Penerima</label>
                                      <input type="text" placeholder="Masukkan Nama Penerima" id="order_ship_receiver_name" name="order_ship_receiver_name" class="form-control" required>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="order_ship_receiver_phone">No. Hp Penerima</label>
                                      <input type="number" maxlength="15" min="0" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Masukkan No. HP Penerima" id="order_ship_receiver_phone" name="order_ship_receiver_phone" class="form-control" required>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="province">Provinsi</label>
                                      <select class="form-control" placeholder="Masukkan Nama Provinsi" id="province" required>
                                        <option value="" disabled selected>Pilih Provinsi</option>
                                        <?php
                                        foreach ($province as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value["province_id"]; ?>">
                                          <?php echo $value["province"]; ?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="city">Kota / Kabupaten</label>
                                    <select class="form-control" placeholder="Masukkan Nama Kotamadya/Kabupaten" id="city-dropdown" required>
                                      <option value="" disabled selected>Pilih Kota</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="district">Kecamatan</label>
                                      <select class="form-control" placeholder="Masukkan Nama Kecamatan" id="subdistrict-dropdown" required>
                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label>Kode Pos</label>
                                      <input type="number" placeholder="Masukkan Kode Pos" maxlength="5" min="0" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="order_ship_postal_code" required>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="row same-height">
                              <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="street">Alamat Lengkap</label>
                                    <textarea class="form-control" style="resize:none;" placeholder="Masukkan Alamat Lengkap Penerima" name="order_ship_address" rows="4" required></textarea>
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="street">Catatan Pengiriman</label>
                                    <textarea class="form-control" style="resize:none;" placeholder="Masukkan Keterangan Tambahan" name="order_ship_note" rows="2"></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <input type="text" name="cart_product_courier" value="<?php echo $cart_product_courier; ?>"/>
                        <input type="text" name="order_ship_province" value="" />
                        <input type="text" name="order_ship_city" value="" />
                        <input type="text" name="order_ship_district" value="" />
                        <input type="text" name="order_ship_vendor" value="" />
                        <input type="text" name="order_ship_package" value="" />
                        <input type="text" name="order_ship_etd" value="" />
                        <input type="text" name="order_ship_cost" value="" />
                    </div>
                    <hr>
                    <h3>Metode Pengiriman</h3>
                    <div id="loader" class="loader">Loading..</div>

                    <div class="freeshippingOpt" id="freeshippingOpt">
                      <?php if($cart_product_courier == '1') { ?>
                          <strong>Gratis Ongkos Kirim</strong>
                          <?php
                          if(in_array("ina", $exp_product_free_courier_id)) {
                            echo "<button type='button' class='btn btn-warning btn-sm'>Seluruh Indonesia</button> &nbsp;";
                          }
                          if(in_array("jkt", $exp_product_free_courier_id)) {
                            echo "<button type='button' class='btn btn-warning btn-sm'>JABODETABEK</button> &nbsp;";
                          }
                          if(in_array("java", $exp_product_free_courier_id)) {
                            echo "<button type='button' class='btn btn-warning btn-sm'>Seluruh Jawa</button> &nbsp;";
                          }
                      } ?>
                    </div>
                    <br>
                    <div class="row" id="shippingMethodContainer">
                    </div>
                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="cart" data-submit="Kembali ke keranjang belanja? Semua data yang Anda isi di halaman ini tidak akan disimpan." class="btn btn-default"><i class="fa fa-chevron-left"></i>Keranjang Belanja</a>
                        </div>
                        <div class="pull-right">
                            <button type="submit" id="btnReview" data-submit="Pastikan semua informasi telah terisi dengan benar, dan Anda memilih paket pengiriman yang sesuai." disabled class="btn btn-primary">Review Pembelian<i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
            </div>
        </div>
      </form>
    </div>
</div>
