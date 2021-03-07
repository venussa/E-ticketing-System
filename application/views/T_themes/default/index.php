<?php 

    /**
    * The page to display the main page of the website
    * By dividing the content into several parts of the file
    * To make it easier for users to do HTML editing
    * For main files such as index, header, and footer, they are saved in main views
    * And the content of the main page is stored in the T_content folder on main views
    */

    // include Header file
    require_once(projectDir()."/".getTheme()->path."header.php");

    // include navigationbar menu file
    require_once(projectDir()."/".getTheme()->path."T_content/navmenu.php"); 

    // include banner file
    require_once(projectDir()."/".getTheme()->path."T_content/banner.php"); 

    // include about file
    require_once(projectDir()."/".getTheme()->path."T_content/about.php"); 

    // include upcoming event file
    require_once(projectDir()."/".getTheme()->path."T_content/upcoming_event.php"); 

    // include contact person file
    require_once(projectDir()."/".getTheme()->path."T_content/contact.php");

    // include footer file
    require_once(projectDir()."/".getTheme()->path."footer.php");

 ?>