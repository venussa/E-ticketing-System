<div class="col-md-12" >

	<p class="page-label">
		<img src="<?php echo getIcon()->home?>"  width="25"> 
		<span>adminpanel / themes</span>
	</p>

</div>
<span id="theme-edit" style="display: none;"></span>
<span id="theme-list">
<div class="col-md-6 col-md-offset-3">
	<h3 style="padding: 10px;text-align: center;margin-bottom: 20px;">Upload New Theme</h3>
	<form class="form-inline center-block well" action="<?php echo HomeUrl()."/handler"?>" method="POST" enctype="multipart/form-data">
	    <div class="input-group">
	    	<input type="text" name="action" value="11" style="display: none;">
	        <label id="browsebutton" class="btn btn-default input-group-addon" for="my-file-selector" style="background-color:white">
	            <input id="my-file-selector" type="file" name="file" style="display:none;">
	            Browse...
	        </label>
	        <input id="label" type="text" class="form-control" readonly="">
	    </div>
	  <button type="submit" class="btn btn-primary" style="padding: 14px;">Upload</button>

	  <span class="help-block">
		<small id="fileHelp" class="form-text text-muted">Only ZIP is allowed to upload</small>
		</span>

	</form>
		
</div>
<div class="col-md-12"><hr/></div>
<?php 
$query = database()->Query("SELECT * FROM t_theme ORDER BY id DESC");

while($show = $query->fetch()){ 

	if($show['status'] == "1"){

		$check = getIcon()->check;
		$border = "border:3px green solid";
	}else{
		$check = getIcon()->uncheck;
		$border = "border:1px #ddd solid";
	}

	?>
<div class="col-md-4 cont-<?php echo $show['id']?>">
	<div class="panel panel-default box-theme box-<?php echo $show['id']?>" style="padding: 10px;<?php echo $border ?>">
		<img src="<?php echo HomeUrl()."/".$show['path']."/thumbnail.png"?>" width="100%">
		<p style="margin-top: 13px;font-size: 17px;"><b><?php echo $show['name']?></b></p>

		<span style="float: right;margin-top: -36px;">
			<img onClick="return edit_theme(<?php echo $show['id']?>)" src="<?php echo getIcon()->edit?>" width="23" style="cursor:pointer;margin-right: 10px;margin-top:2px">
			<img class="load-<?php echo $show['id']?>" src="<?php echo getIcon()->oval?>" width="23" style="cursor:pointer;margin-right: 10px;display: none;margin-top:2px">
			<img class="img-check img-<?php echo $show['id']?>" data1="<?php echo getIcon()->check?>" data2="<?php echo getIcon()->uncheck?>" src="<?php echo $check?>" width="27" style="cursor:pointer;margin-right: 9px;margin-top:2px" onClick="return activate(<?php echo $show['id']?>)">
			<img src="<?php echo getIcon()->bin?>" width="20" style="cursor:pointer" onClick="return delete_theme(<?php echo $show['id']?>)">
		</span>
		
	</div>
</div>
<?php } ?>
</span>