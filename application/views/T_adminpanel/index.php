<?php
	
	/**
	* Switch andminpanel page depend the paramter data
	* Only user who has been login can access this page
	* The file is divided into 3 main parts, namely the header, content, and footer
	* for headers and footers stored in the main folder of the admin page
	* the content of the admin page is stored in the 
	* content subfolder in the T_adminpanel folder
	* the configuration is splice 1 for adminpanel url
	* splice 2 for additional url
	*/

	checkLogin();

	// include header PHP file
	require_once(projectDir()."/T_adminpanel/header.php");

	// include menu PHP file
	// and will not be called if it is on the login page

	if(splice(2) !== "login")

	require_once(projectDir()."/T_adminpanel/menu.php");


	// read paramater from url
	// ex : http://domain.com/adminpanel/dashboard 

	switch(splice(2)){

		// paramter condition and selection

		// call login file
		case "login":

			require_once(projectDir()."/T_adminpanel/T_login/login.php");

		break;

		// call dashboard file
		case "dashboard":

			require_once(projectDir()."/T_adminpanel/T_dashboard/dashboard.php");

		break;

		// call ticket file
		case "add-ticket":

			require_once(projectDir()."/T_adminpanel/T_ticket/ticket.php");

		break;

		// call payment file
		case "payment-list":

			require_once(projectDir()."/T_adminpanel/T_payment/payment.php");

		break;

		// call mailmessage file
		case "mail":

			require_once(projectDir()."/T_adminpanel/T_message/mail-msg.php");

		break;

		// call scan-qr file
		case "scan-qr":

			require_once(projectDir()."/T_adminpanel/T_scan-qr/scan-qr.php");

		break;

		// Themes
		case "themes":

			require_once(projectDir()."/T_adminpanel/T_themes/theme.php");

		break;

		// callsettings file
		case "settings":

			require_once(projectDir()."/T_adminpanel/T_setting/settings.php");

		break;

		// action to logout and delete the current session
		case "logout":

			session_destroy();
			header("location:".HomeUrl()."/adminpanel/login");
			exit;

		break;

		// if none of the data from the splice 2 matches
		default:

			require_once(projectDir()."/T_adminpanel/T_dashboard/dashboard.php");

		break;

	}


	// include footer PHP file 
	require_once(projectDir()."/T_adminpanel/footer.php");


?>