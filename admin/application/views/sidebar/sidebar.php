<div class="sidebar" data-background-color="white" data-active-color="danger">
    <!--
    Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
    Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                Menu
            </a>
        </div>

        <ul class="nav">
            <li class="<?php if ($menu == 'home') echo 'active';?>">
                <a href="home">
                    <i class="ti-panel"></i>
                    <p>Home</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'banner') echo 'active';?>">
                <a href="banner">
                    <i class="ti-image"></i>
                    <p>Banner</p>
                </a>
            </li>
            <?php if($this->session->userdata("antglobal_backend")["user_access_level"]==1){?>
            <li class="<?php if ($menu == 'penjualan') echo 'active';?>">
                <a href="report/init/sales">
                    <i class="ti-stats-up"></i>
                    <p>Laporan Penjualan</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'pelanggan') echo 'active';?>">
                <a href="report/init/customer">
                    <i class="ti-user"></i>
                    <p>Laporan Pelanggan</p>
                </a>
            </li>
            <?php }?>
            <li class="<?php if ($menu == 'order') echo 'active';?>">
                <a href="order">
                    <i class="ti-list"></i>
                    <p>Pesanan</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'quotation') echo 'active';?>">
                <a href="quotation">
                    <i class="ti-pencil-alt"></i>
                    <p>Permintaan</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'contact') echo 'active';?>">
                <a href="contact">
                    <i class="ti-email"></i>
                    <p>Pesan</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'kategori') echo 'active';?>">
                <a href="category">
                    <i class="ti-view-list"></i>
                    <p>Kategori</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'tipe') echo 'active';?>">
                <a href="type">
                    <i class="ti-view-list-alt"></i>
                    <p>Tipe</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'brand') echo 'active';?>">
                <a href="brand">
                    <i class="ti-tag"></i>
                    <p>Brand</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'produk') echo 'active';?>">
                <a href="product">
                    <i class="ti-package"></i>
                    <p>Produk</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'promo') echo 'active';?>">
                <a href="promo">
                    <i class="ti-agenda"></i>
                    <p>Promo</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'gallery') echo 'active';?>">
                <a href="galleries">
                    <i class="ti-gallery"></i>
                    <p>Gallery</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'artikel') echo 'active';?>">
                <a href="article">
                    <i class="ti-file"></i>
                    <p>Artikel</p>
                </a>
            </li>



            <li class="<?php if ($menu == 'faq') echo 'active';?>">
                <a href="faq">
                    <i class="ti-help"></i>
                    <p>FAQ</p>
                </a>
            </li>
            <li class="<?php if ($menu == 'testimonials') echo 'active';?>">
                <a href="testimonials">
                    <i class="ti-notepad"></i>
                    <p>Testimonial</p>
                </a>
            </li>
            <?php if($this->session->userdata("antglobal_backend")["user_access_level"]==1){?>
            <li class="<?php if ($menu == 'admin') echo 'active';?>">
                <a href="user">
                    <i class="ti-user"></i>
                    <p>Admin</p>
                </a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
