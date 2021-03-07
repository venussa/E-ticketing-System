<title>Upload Bukti Transfer</title>
<?php CallCSS(getTheme()->path."T_assets/css/bootstrap.css") ?>
<body style="background: #ddd">

<form id="#contactForm" method="POST" action="<?php echo HomeUrl()."/send-message"?>" onSubmit="return submit_confirmation(this)">
	<input type="text" name="name" value="<?php echo decrypt(splice(2))?>" style="display: none;">
	<input type="email" name="email" value="<?php echo decrypt(splice(3))?>" style="display: none;">
	<input type="text" name="msg" value="Konfirmasi Dana Telah Saya Transfer" style="display: none;">
	<input type="file" name="file" id="proof" onChange="return readURL(this)" style="display: none;">
	<input type="text" name="action" value="1" style="display: none;">

	<div style="border:1px #ddd solid;padding: 10px;background: #fff;padding-top:5px;" class="col-md-4 col-md-offset-4">
	<h2 style="border-bottom: 2px #ddd dashed;padding: 15px;text-align: center;padding-top:0px;">Upload Bukti Transfer</h2>
	
	<img src="<?php echo getIcon()->galery?>" class="preview-file" width="100%" data="proof" onClick="select_img(this)">
	<hr/>
	<div  class="alert alert-info" id="alert-response" style="display: none;">Pesan Terkirim</div>
     <div class="alert alert-danger" id="alert-response1" style="display: none;">Pesan Gagal Terkirim</div>
     <p style="color:#777"><i>Upload foto bukti transfer dengan jelas</i></p>
	<button style="width:100%" id="sendMessageButton" class="btn btn-info text-uppercase cright w3-section" type="submit">KIRIM PESAN</button>
	</div>
</form>
<?php CallJS(getTheme()->path."T_assets/js/jquery.js")?>
<script>
	function submit_confirmation(id){

            $.ajax({
                type    : $(id).attr("method"),
                url     : $(id).attr("action"),
                data 	: new FormData(id),
				contentType: false,
				cache	: false,
				processData:false,
                beforeSend : function(){
                    $("#sendMessageButton").html("MENGIRIM ...");
                    $("#sendMessageButton").attr("disabled","true");
                },
                success : function(event){
                    if(event.indexOf("<yes/>") !== -1){
                        $("#alert-response1").hide();
                        $("#alert-response").fadeIn();
                        $("#alert-response").delay(2000).fadeOut();
                        $("#name").val("");
                        $("#email").val("");
                        $("#message").val("");
                        $("#sendMessageButton").html("KIRIM PESAN");
                        $("#sendMessageButton").removeAttr("disabled");
                        setTimeout(function(){
                        	window.location="<?php echo HomeUrl()?>";
                        },2000);
                    }else if(event.indexOf("<no/>") !== -1){
                        $("#alert-response").hide();
                        $("#alert-response1").fadeIn();
                        $("#alert-response1").delay(2000).fadeOut();
                        $("#sendMessageButton").html("KIRIM PESAN");
                        $("#sendMessageButton").removeAttr("disabled");
                    }
                }
            });

            return false;

        }

	function readURL(input) {

	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function(e) {
	      $($(".preview-"+$(input).attr("name"))).attr('src', e.target.result);
	    }

	    reader.readAsDataURL(input.files[0]);
	  }
	}

	function select_img(a){

		$("#"+$(a).attr("data")).click();

	}

</script>

</body>