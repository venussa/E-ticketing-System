<!DOCTYPE html>
<html>
<head>
	<title>Welcome To Adminpanel</title>
	<link rel="shortcut icon" href="<?php echo getIcon()->data?>">

		
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 

	CallCSS([
		"T_assets/css/bootstrap.css",
		"T_assets/css/bootstrap-theme.min.css",
		"T_assets/css/jquery-timepicker.min.css",
		"T_assets/js/jquery-ui/jquery-ui.min.css",
		"T_assets/css/style.css"
	]);

	CallJS([
		"T_assets/js/jquery.js",
		"T_assets/js/QR.js",
	]);
	
	if(splice(2) == "add-ticket") {

		$url = "datatables";

	}elseif(splice(2) == "payment-list"){

		$url = "datatables2";

	}elseif(splice(2) == "mail"){

		$url = "datatables3";

	} else {

		$url = null;

	}

?>

</head>
<body style="display: none;">


<input type="hidden" class="active-url" value="<?php echo HomeUrl()?>/"/>
<input type="hidden" class="active-table" value="<?php echo $url?>"/>

	<div class="web-container">
		<div id="web-content">