<?php
	
	/**
	* Call the display registered in the database 
	* as the active theme used. The theme is stored 
	* in the T_themes folder
    */
	
	// call active theme

	if(getTheme() !== false){

		require_once(projectDir()."/".getTheme()->path."/index.php");

	}else{

		echo "WELCOME TO MY FRAMEWORK !!!";

	}

?>