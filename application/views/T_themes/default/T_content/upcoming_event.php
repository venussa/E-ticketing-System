<section id="tickets">
  <div class="bgimg-1" >
    <div class="caption">

      <?php if(is_mobile()) $font = "font-size:30px;margin-top:-10px;";
            else $font = "";
            ?>

        <h2 class="text-uppercase display-4" style="color: white;<?php echo $font ?>" >UPCOMING EVENT</h2>
      
    </div>
  </div>
    <div class="container" style="max-width: 800px; padding-top: 64px; padding-bottom: 64px;">

        <?php

            $query = database()->Query("SELECT * FROM t_event WHERE date_event > ".time()." and status_event='1' ORDER BY id DESC");

            $record = $query->rowCount();

            if($record == 0){
              echo "<h2 style='text-align:center'>Event Not Found</h2>
              <p style='color:#777;text-align:center'>no recent events found</p>";
            }else{

            while($show = $query->fetch()){

        ?>

      <div class="row padding32">
        <div class="col-md-7 col-sm-6 d-flex align-items-center justify-content-center flex-center">
            <div style="color: #777;background-color:white;text-align:center;text-align: justify;">
              <?php if(is_mobile())  {?>
                <h5 align="left"><b><?php echo $show['title']?></b></h5>
              <?php }else{ ?>
                <h2 align="left"><b><?php echo $show['title']?></b></h2>
              <?php } ?>
              <p align="left"><?php echo $show['description']?></p>
              <p><b>Lokasi Acara :</b><br><?php echo $show['location']?></p>
              <p align="left"><b>Alamat :</b><br><?php echo $show['address']?></p>
              <p><b>Waktu Acara :</b><br><?php echo date("d M Y",$show['date_event'])?></p>
              
            </div>
        </div>
        
        <div class="col-lg-5 col-md-5 col-sm-5 d-flex flex-column justify-content-center" style="padding-left: 40px;">
            <div class="card bg-default" style="width: 18rem;">
              <img src="<?php echo projectUrl()."/T_assets/img/poster/".$show['poster']?>" width="100%" style="border-radius: 5px 5px 0 0">
              <div class="card-body">
                <p style="font-size: 13px;"><b>Harga Tiket :</b><br>Rp <?php echo number_format($show['price'])?></p>
                <a href="javascript:void(0)" onClick="return buy_ticket(<?php echo $show['id']?>)" class="btn btn-primary btn-<?php echo $show['id']?>" >Get Ticket</a>
              </div>
            </div>
        </div>
      </div>

  <?php } 
}?>

    </div>
</section>