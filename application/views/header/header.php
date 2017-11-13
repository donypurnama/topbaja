<div id="top">

    <div class="container">
        <div class="col-md-4 offer" >
            <a href="quotation" class="btn btn-success btn-sm" style="text-transform:none;" data-animate-hover="shake">Butuh maintenance atau pembelian besar? </a>
        </div>
        <div class="col-md-8">
            <ul class="menu text-center" style="padding-left:0px;">
              <?php if (($this->session->userdata("antglobal")) && $this->session->userdata("antglobal")["customer_logged_in"] === true) { ?>
                <li>
                  <img src="coin-white.png" class="img-responsive" style="display:inline-block;width:18px;"/><font style="color:#FFF;"> Rp <?php echo number_format($customer["customer_point"],0,',','.'); ?></font>
                </li>
                <li>
                  <a href="account/profile"><?php echo $customer["customer_first_name"];?></a>
                </li>
                <li><a href="account/logout">Logout</a>
                </li>
              <?php } else { ?>
                <li>
                  <a href="login">Login</a>
                </li>
                <li><a href="register">Register</a>
                </li>
              <?php } ?>
            </ul>
        </div>
    </div>
</div>

 <!-- data-animate="fadeInDown" -->

<div class="navbar navbar-default yamm" role="navigation" id="navbar">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand home" href="home" data-animate-hover="bounce">
                <img src="logo.png" alt="TOPBAJA logo" class="hidden-xs" style="height:100%;width:auto;">
                <img src="logo.png" alt="TOPBAJA logo" style="height:100%;width:auto;" class="visible-xs"><span class="sr-only">TOP BAJA - go to homepage</span>
            </a>
            <div class="navbar-buttons">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-align-justify"></i>
                </button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
                <?php if (($this->session->userdata("antglobal")) && $this->session->userdata("antglobal")["customer_logged_in"] === true) { ?>
                <a class="btn btn-default navbar-toggle" href="cart">
                    <i class="fa fa-shopping-cart"></i> <span class="hidden-xs"><?php echo $cart["count_item"]; ?> Keranjang</span>
                </a>
                <?php } ?>
            </div>
        </div>
        <!--/.navbar-header -->

        <div class="navbar-collapse collapse" id="navigation">

            <ul class="nav navbar-nav navbar-left">
                <li class="<?php if ($active == "home") echo "active"; ?>"><a href="home" style="">Home</a></li>
                <li class="dropdown<?php if ($active == "aboutus") echo "active"; ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">About Us<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="about-topbaja">TOP BAJA</a></li>
                    <li><a href="about-contractor">Jasa / Contractor</a></li>
                  </ul>
                </li>
                <li class="dropdown yamm-fw <?php if ($active == "category") echo "active"; ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Products<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                  <?php foreach ($header_categories as $key => $value) { ?>
                                    <div class="col-sm-3">
                                        <img class="img img-responsive hidden-sm hidden-xs" style="height:50px;" src="file_assets/categories/<?php echo $value['category_image'];?>">
                                        <h5><a href="category/<?php echo $value['category_url']; ?>"><?php echo $value["category_name"];?></a></h5>
                                        <ul>
                                            <?php foreach ($value["types"] as $key2 => $value2) {?>
                                            <li>
                                                <a href="category/<?php echo $value['category_url'] . '/' . $value2['type_url']; ?>">
                                                    <?php echo $value2["type_name"];?>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                  <?php
                                  }
                                  ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="<?php if ($active == "contact") echo "active"; ?>"><a href="contact-us" style="">Contact Us</a></li>
                <li class="<?php if ($active == "testimonials") echo "active";?>"><a href="testimonials" style="">Testimonial</a></li>
                <li class="dropdown <?php if ($active == "blog") echo "active";?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Blog <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="promo">Hot Promo</a></li>
                    <li><a href="gallery">Gallery</a></li>
                    <li><a href="blog">Artikel</a></li>
                  </ul>
                </li>
            </ul>

        </div>
        <!--/.nav-collapse -->

        <div class="navbar-buttons">
            <?php if (($this->session->userdata("antglobal")) && $this->session->userdata("antglobal")["customer_logged_in"] === true) { ?>
            <div class="navbar-collapse collapse right" id="basket-overview">
                <a href="cart" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm"><?php echo $cart; ?> Barang di Keranjang Belanja</span></a>
            </div>
            <?php } ?>
            <!--/.nav-collapse -->

            <div class="navbar-collapse collapse right" id="search-not-mobile">
                <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
            </div>

        </div>

        <div class="collapse clearfix" id="search">

            <form class="navbar-form" role="search" method="get" action="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search" required>
                    <span class="input-group-btn">
                    <span style="text-danger" id="error_msg"><?php echo validation_errors(); ?></span>

  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

    </span>
                </div>
            </form>

        </div>
        <!--/.nav-collapse -->

    </div>
    <!-- /.container -->
</div>
