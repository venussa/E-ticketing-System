<?php

/*
 *---------------------------------------------------------------
 * PERMALINK CONFIGURASION
 *---------------------------------------------------------------
 *
 * Handles to set the page access pattern like it does htaccess
 * with configuration like the following
 * ex : "A" => "B"
 * "A" for url used to access
 * "B" for the file address that will be rewritten
 * So if you access it via a web browser, then 
 * the url that is accessed is http://domain.com/"A"
 * so the "B" file will be accessed and open
 */

// page permalink setting
(new system\core\controller)->declarate_space(array(
	
	"adminpanel"	=> "T_adminpanel/index",
	
	// proccess file handling
	"handler"		=> "T_adminpanel/handler",

	// datatable proccess for ticket management
	"add-ticket"	=> "T_adminpanel/T_ticket/add-ticket",
	"datatables"	=> "T_adminpanel/T_ticket/datatables",

	// datatable proccess for payment management
	"datatables2"	=> "T_adminpanel/T_payment/datatables",

	// datatable proccess for payment management
	"reply"			=> "T_adminpanel/T_message/reply",
	"datatables3"	=> "T_adminpanel/T_message/datatables",

	// send payment confirmation
	"payment-proof" => "payment-proof",

	// load theme setting
	"theme-setting" => "T_adminpanel/T_themes/setting",

	// send contact message
	"send-message"	=> "handler",

	// "cusTom" 	=> "index", // create dinamic permalink

));