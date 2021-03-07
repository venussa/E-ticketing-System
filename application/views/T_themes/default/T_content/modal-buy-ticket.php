 <?php
 if(isset($_POST['id']) and is_numeric($_POST['id'])) {

    $query = database()->Query("SELECT * FROM t_event WHERE id='".$_POST['id']."' ");
    $record = $query->rowCount();

    $show = $query->fetch();

    if($record !== 0){

 ?>
 <div id="success" style="text-align: center;padding: 20px;display: none;">
     <img src="<?php echo getIcon()->check?>" width="150">
     <p><b style="font-size: 25px;">Order berhasil</b></p>
     <p>Silahkan check email anda untuk informasi pembayaran dan lain-lain.</p>
 </div>
 <table width="100%" id="register" >
    <tr>

<?php if(is_mobile() == false){?>
        <td style="width: 300px;" valign="top">
            <div style="padding: 18px;">
            <div style="border:1px #ddd solid;padding:5px;">
            <img src="<?php echo projectUrl()."/T_assets/img/poster/".$show['poster']?>" style="width: 100%">
            </div>
            </div>

             <div style="padding-left: 10px;padding-right: 10px;margin-top:-10px;">
            <p class="alert alert-info" style="font-size: 13px;margin:10px;"><b>Waktu Acara :</b><br><?php echo date("d M Y, H:i",$show['date_event'])?></p>
            <p class="alert alert-info" style="font-size: 13px;margin:10px;"><b>Harga Tiket :</b><br>Rp <?php echo number_format($show['price'])?></p>
            </div>

        </td>

    <?php } ?>

        <td style="padding: 15px;" valign="top">
        <form method="POST" action="<?php echo HomeUrl()."/send-message"?>" enctype="multipart/form-data" onSubmit="return submit_ticket(this)">

            <?php if(is_mobile()){?>
            <h5 style="border-bottom:2px #ddd dashed;padding-bottom: 10px;margin-bottom: 15px;"><?php echo wordLimit($show['title'],7)?></h5>
            <?php }else{?>
            <h4 style="border-bottom:2px #ddd dashed;padding-bottom: 10px;margin-bottom: 15px;"><?php echo $show['title']?></h4>
            <?php } ?>
      
            <p><b>Nama Lengkap</b></p>
            <input style="margin-bottom: 10px;" type="text" name="nama" class="form-control" placeholder="" required="">
            <p><b>Alamat Tinggal</b></p>
            <input style="margin-bottom: 10px;" type="text" name="address" class="form-control" placeholder="" required="">
            <p><b>Email</b> <span style="font-size: 11px;color:#777">* Pastikan email yang anda masukkan sudah benar</span></p> 
            <input style="margin-bottom: 10px;" type="email" name="email" class="form-control" placeholder="" required="">
            <p><b>No. Telephone</b></p>
            <input style="margin-bottom: 10px;" type="number" name="telephone" class="form-control" placeholder="" required="">
            <hr/>
            <input type="text" name="action" value="3" style="display: none;">
            <input type="text" name="id" value="<?php echo $show['id']?>" style="display: none;">
            
            <div style="color: #ff0000;font-size: 11px;margin-bottom: 10px;margin-top: -5px;display: none;" id="notif"></div>

            <button class="btn btn-default" type="button" style="border:1px #ddd solid;width:105px;" onClick="return buy_ticket()">Batal</button>
            <button class="btn btn-info buys" type="submit" style="border:1px #ddd solid;width:165px;">Beli Ticket</button>
        </form>
        </td>
    </tr>
</table>

<?php } 

}

?>