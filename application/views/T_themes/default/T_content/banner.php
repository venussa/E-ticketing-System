<section id="home" class="hero flex-center">
    <div class="h-txt hero-message">

    	<?php if(is_mobile()){ ?>

    		<h3 class="hero-title" style="font-size: 35px;margin-top: 150px;"><?php echo getThemeText()->heading?></h3>
        	<h4 class="hero-sub-title"  style="font-size: 20px;margin-bottom: 100px"><?php echo getThemeText()->subheading?></h4>


    	<?php }else{ ?>

    		<h1 class="hero-title" ><?php echo getThemeText()->heading?></h1>
        <h4 class="hero-sub-title" ><?php echo getThemeText()->subheading?></h4>


    	<?php } ?>
        
    </div>
</section>