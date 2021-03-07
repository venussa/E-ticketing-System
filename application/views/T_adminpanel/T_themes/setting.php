<div class="col-md-12">
	<form method="POST" action="<?php echo HomeUrl()."/handler"?>" enctype="multipart/form-data" onSubmit="return save_set_theme(this)">
	<div class="panel panel-default">
		<div class="panel-body">
<?php

if(isset($_POST['id'])){

	$query = database()->Query("SELECT * FROM t_theme WHERE id='".$_POST['id']."' ");

	$record = $query->rowCount();

	$show = $query->fetch();

	if($record !== 0){

		$load = projectDir()."/".$show['path']."data.json";

		foreach(getThemeText() as $key => $val){ 

			if($key == "icon"){
				echo "<div class='col-md-12' style='border-top:2px #ddd dashed;margin-bottom:20px;margin-top:20px'><br></div>";
			}

			if(($key == "about") or ($key == "description")){

				echo "<p style=''><b>".$key."</b></p>";
				echo "<textarea class='form-control' style='height:200px;margin-bottom:20px;' name='".$key."'>".$val."</textarea><br><br>";

			}elseif(
				($key == "heading_bg") or
				($key == "about_bg") or
				($key == "ticket_bg") or
				($key == "contact_bg") or
				($key == "icon") or 
				($key == "thumbnail") 
			){

				echo "<div class='col-md-3'>
				<div class=''>
				<div class='panel panel-default' style='border-radius:0px'>
				<div class='panel-heading' style='height:auto'>
				";
				echo "<b>".$key."</b>";
				echo "</div><div>";
				echo "<input type='file' id='".$key."' name='".$key."' style='display:none;' onChange='return readURL(this)'>
				<img class='preview-".$key."' src='".getIcon()->$val."' width='100%' height='150' data='".$key."' onClick='return select_img(this)'>
				</div></div></div></div>";

			}else{

				if($key !== "action"){
					echo "<p style=''><b>".$key."</b></p>";
					echo "<input class='form-control' name='".$key."' value='".$val."'>";
				}

			}

		}	

	}

}
?>
<div class="col-md-12" style="border-top:2px #ddd dashed">
	<br>
	<div class="alert alert-info yes" style="display: none;">Berhasil menyimpan</div>
	<div class="alert alert-danger no" style="display: none;">Gagal, periksa apakah data atau gambar yang anda masukkan sudah benar</div>
	<br>
	<input type="text" name="action" value="13" style="display: none;">
	<button id="btn-save" class="btn btn-info" type="submit">Simpan</button>
	<button  class="btn btn-default" type="button" onClick="edit_theme()">Kembali</button>

</div>
</div>
</div>
</form>
</div>

<?php CallJS(["T_assets/js/tinymce/js/tinymce/tinymce.min.js"]) ?>
<script>
	tinymce.init({
	  selector: 'textarea',
	  // plugins: ['autolink','image','link','lists','hr','paste','image','media','contextmenu','stylebuttons'],
	
	  paste_as_text: true,
	  
	  // toolbar: ['style-p style-h1 style-h2 style-h3 style-pre style-code | bold italic underline | numlist bullist | codesample | link image media'],
	  menubar: "",
	  default_link_target: "_blank",
	  setup: function (editor) {
	  	
	  	editor.on("keyup",function(){

	  		editor.save();
	  	});
	  	 
	  }
  });
</script>