<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="application-name" content="{application_name}">
    <meta name="author" content="{author}">
    <meta name="description" content="{description}">
    <meta name="generator" content="{generator}">
    <meta name="keywords" content="{keywords}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    {meta_facebook} {meta_twitter} {google_analytics}

    <title>{title}</title>

    <base href="{base_url}">

    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">


    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap-switch.min.css" rel="stylesheet">
    <link rel="stylesheet" href="custom/css/global.css">
    <link rel="stylesheet" href="custom/css/header.css">
    <link rel="stylesheet" href="custom/css/footer.css">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
    <!--  Fonts and Icons    -->
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link href="assets/css/summernote.css" rel="stylesheet">
    <link href="assets/css/sweetalert.css" rel="stylesheet">

    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/jquery.priceformat.min.js"></script>

    <link rel="stylesheet" href="custom/css/main.css">

    {link}
</head>
<body>
    <?php if ($full) { ?>
        {full}
    <?php } else { ?>
    <div class="wrapper">
        {sidebar}
        <div class="main-panel">
        {header}{main}{footer}
        </div>
    </div>
    <?php } ?>

    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/datepicker-id.js"></script>

    <script src="assets/js/chartist.min.js"></script>
    <script src="assets/js/bootstrap-notify.js"></script>
    <script src="assets/js/paper-dashboard.js"></script>
    <script src="assets/js/summernote.min.js"></script>
    <script src="custom/js/live-search.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="custom/js/main.js"></script>



    {script}
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Konfirmasi
                </div>
                <div class="modal-body">
                    Hapus data?<br>
                    <small class="">*Data yang telah terhapus tidak dapat dikembalikan.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger btn-ok">Lanjutkan</a>
                </div>
            </div>
        </div>
    </div>
    {error}
</body>
</html>
