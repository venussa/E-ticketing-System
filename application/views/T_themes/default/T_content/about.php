<section id="about">
    <div class="container-fluid">
        <div class="row py-5">
            <div class="col-md-6 about-title d-flex align-items-center justify-content-center flex-center">
                <h2 class="display-3" >About</h2>
            </div>
            
            <div class="col-lg-6 col-md-6 about-text d-flex flex-column justify-content-center" style="color: #777; padding-left: 50px; padding-right: 50px;" >
                <div class="<?php if(is_mobile()) echo "row" ?>">
                <?php echo getThemeText()->about?>
            </div>
            </div>
        </div>
  </div>
</section>