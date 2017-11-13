<!-- Project Area Start Here -->
<div class="s-space-equal">
    <div class="container-fluid" id="isotope-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="isotope-classes-tab isotop-btn">
                    <a href="#" data-filter="*" class="current">All</a>
                    <a href="#" data-filter=".1">Event</a>
                    <a href="#" data-filter=".2">Uncategorized</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="featuredContainer item-space-xs zoom-gallery">

              <?php foreach($galleries as $key => $value ){?>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-mb-12 <?php echo $value["gallery_category_id"];?>">
                    <div class="project-box-layout3">
                        <img src="file_assets/galleries/<?php echo $value["gallery_image"];?>" class="img-responsive" alt="project">
                        <a href="file_assets/galleries/<?php echo $value["gallery_image"];?>" class="elv-zoom item-icon-top-bottom" data-fancybox-group="gallery" title="<?php echo $value["gallery_title"];?>">
                          <i class="fa fa-search" aria-hidden="true"></i></a>
                        <div class="item-content project-title project-para-light pa-15">
                            <h3>
                              <a href="file_assets/galleries/<?php echo $value["gallery_image"];?>" target="_blank"><?php echo $value["gallery_title"];?></a>
                            </h3>
                            <p><?php echo $value["gallery_description"];?></p>
                        </div>
                    </div>
                </div>

              <?php } ?>

            </div>
        </div>
    </div>
</div>
<!-- Project Area End Here -->
