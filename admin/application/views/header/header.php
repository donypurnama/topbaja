<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $menu_url; ?>"><?php echo strtoupper($menu);?></a>
            <?php if (isset($submenu)) { ?>
            <a class="navbar-brand">/</a>
            <a class="navbar-brand"><?php echo strtoupper($submenu);?>
            </a>
            <?php } ?>
        </div>
        <?php if ($this->session->userdata("antglobal_backend")["user_logged_in"]===true){?>
        <div class="">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout">Logout</a>
            </ul>
        </div>
        <?php }?>
    </div>
</nav>
