<div id="content">
  <div class="container">

      <div class="col-sm-12">

          <ul class="breadcrumb">

              <li><a href="home">Home</a>
              </li>
              <li><a href="blog">Blog</a>
              </li>
              <li><?php echo $blog["article_title"];?></li>
          </ul>
      </div>

      <div class="col-sm-9" id="blog-post">


          <div class="box">

              <h1><?php echo $blog["article_title"]; ?></h1>
              <p class="author-date"><?php echo $blog["article_created_time"]; ?></p>

              <div id="post-content" class="article-blog-content">

                    <?php echo $blog["article_content"];?>
                  
              </div>
          </div>
          <!-- /.box -->
      </div>
      <!-- /#blog-post -->

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
                      <li>
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
</div>
