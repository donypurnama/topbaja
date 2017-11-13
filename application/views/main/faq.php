<div id="content">
    <div class="container">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                  <a href="home">Home</a>
                </li>
                <li>Pertanyaan Umum</li>
            </ul>

        </div>

        <div class="col-md-9">


            <div class="box" id="contact">
                <h3>Pertanyaan Umum</h3>

                <hr>

                <div class="panel-group" id="accordion">
                    <?php foreach($faq as $key => $value){?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">

                              <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $value["faq_id"];?>">

                            <?php echo $value["faq_answer"];?>

                              </a>

                          </h4>
                        </div>
                        <div id="<?php echo $value["faq_id"];?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p><?php echo $value["faq_question"]; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- /.panel -->
                </div>
                <!-- /.panel-group -->
            </div>
        </div>
        <!-- /.col-md-9 -->

        <div class="col-md-3">
            <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                    <h3 class="panel-title">Halaman penting</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                      <li>
                          <a href="about-us">Tentang Kami</a>
                      </li>
                        <li class="active">
                            <a href="frequently-asked-questions">Pertanyaan Umum</a>
                        </li>
                        <li>
                            <a href="policy">Kebijakan Pengunjung</a>
                        </li>
                        <li>
                            <a href="terms-and-conditions">Syarat dan Ketentuan</a>
                        </li>
                        <li>
                            <a href="contact-us">Kontak Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
