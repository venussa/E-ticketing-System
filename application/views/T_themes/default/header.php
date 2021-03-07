<!DOCTYPE html>
<html lang="en">

    <head>

        <title><?php echo getThemeText()->title?></title>

        <?php 
        
            $icon = getThemeText()->icon;
            $banner = getThemeText()->heading_bg;
            $ticket = getThemeText()->ticket_bg;
            $contact = getThemeText()->contact_bg;
            $about = getThemeText()->about_bg;
            $thumbnail = getThemeText()->thumbnail;

        ?>
        <link rel="shortcut icon" href="<?php echo getIcon()->$icon?>">

        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta itemprop="name" content="<?php echo domain()?>">
        <meta name="description" content="<?php echo getThemeText()->description?>">

        <meta property="og:image" content="<?php echo getIcon()->$thumbnail?>">
        <meta property="og:url" content="<?php echo documentUrl()?>">
        <meta property="og:type" content="website" >
        <meta property="og:title" content="<?php echo getThemeText()->title?>" >
        <meta property="og:description" content="<?php echo getThemeText()->description?>" >

        <meta content='follow, all' name='Googlebot-Image' />
        <meta content='all, index, follow' name='yahoobot' />
        <meta content='all, index, follow' name='bingbot' />
        <meta content='follow, all' name='alexabot' />
        <meta content='follow, all' name='msnbot' />
        <meta content='Global' name='Distribution' />
        <meta content='global' name='target' />
        <meta content='never' name='expires' />
        <meta content='always' name='revisit' />
        <meta content='general' name='rating' />
        <meta content='all' name='audience' />
        <meta content='follow, all' name='Slurp' />
        <meta content='follow, all' name='ZyBorg' />
        <meta content='follow, all' name='Scooter' />
        <meta content='ALL' name='SPIDERS' />
        <meta content='ALL' name='WEBCRAWLERS' />
        <meta content='en' name='language' />
        <meta content='10' name='pagerank?' />
        <meta content='no-cache' http-equiv='cache-control' />
        <meta content='no-cache' http-equiv='pragma' />
        <meta content='Google, Aeiwi, Alexa, AllTheWeb, AltaVista, AOL Netfind, Anzwers, Canada, DirectHit, EuroSeek, Excite, Overture, Go, HotBot. InfoMak, Kanoodle, Lycos, MasterSite, National Directory, Northern Light, SearchIt, SimpleSearch, WebsMostLinked, WebTop, What-U-Seek, AOL, Yahoo, WebCrawler, Infoseek, Excite, Magellan, LookSmart, CNET, Googlebot' name='search engines' />
     

        <?php 

            CallCSS([
                getTheme()->path."T_assets/css/bootstrap.min.css",
                getTheme()->path."T_assets/css/contact.css",
                getTheme()->path."T_assets/css/font-awesome.min.css",

            ]);

        ?>
     
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Permanent+Marker" rel="stylesheet">

        <style>
            
            * {
                margin: 0;
                padding: 0;
            }

            html, body {
                height: 100%;
                font-family: 'Noto Sans', sans-serif;
            }

            h1, h2, h3, h4, h5, h6{
                font-family: 'Permanent Marker', cursive;
            }

            p {
                font-family: 'Noto Sans', sans-serif;
            }

            #main-container {
                min-height: 100%;
            }

            #main {
                overflow: auto;
                padding-bottom: 100px;
            }

            /* Navbar Custom CSS */
            .navbar {
                padding-top: 15px;
                padding-bottom: 15px;
            }

            .navbar-nav > li{
                padding-left:10px;
                padding-right:10px;
            }

            .mx-auto {
                text-align: center;
            }

            .navbar-expand-md{
                display: flex;
                flex-direction: row-reverse;
            }

            .navbar-nav.navbar-center {
                position: absolute;
                left: 50%;
                transform: translatex(-50%);
            }

            .bg-light {
                transition: 500ms ease;
                background-color: transparent!important;
            }

            .bg-light.scrolled {
                background: #000!important;
                border-bottom: 2px #343a40;
            }

            @media only screen and (max-width: 767px) {
                .bg-light {
                  background-color: #000!important;
                }

                .bg-light.scrolled {
                    background: #000!important;
                    border-bottom: 2px #030404;
                }
                
            }

            /* /Navbar Custom CSS */


            /* Hero Custom CSS */
            .hero {
                width: 100%;
                height: 100%;
                min-width: 100%;
                min-height: 100%;
                position: relative;
                background-attachment: fixed;
            }

            .hero::before {
                background-image: url(<?php echo getIcon()->$banner?>);
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                background-attachment: fixed;
                content: "";
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -2;
                opacity: 0.4;
            }

            @media (min-width: 1760px) {
                .hero::before {
                    background-image: url(<?php echo getIcon()->$banner?>);
                }
            }

            .flex-center {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-content: center;
            }

            .hero-message {
                color: #fff;
                text-shadow: #343a40 2px;
                min-width: 100%;
                min-height: 12em;
                position: relative;
            }

            .hero-title,
            .hero-sub-title {
                width: 100%;
                display: block;
                text-align: center;
            }

            .hero-title {
                font-size: 70px;
                margin: 3% 0;
                text-transform: uppercase;
            }

            .hero::after {
                background-color: #030404;
                content: "";
                display: block;
                position: absolute;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 100%;
                z-index: -1;
                opacity: 0.4;
            }

            .h-txt {
                padding: 20% 2%;
            }

            /* /Hero Custom CSS */

            /* About Custom CSS */
            .about-title {
                background: url(<?php echo getIcon()->$about?>);
                background-size: cover;
                background-position: center;
                min-height: 35vw;
                opacity: 0.65;
            }

            .about-title {
                text-shadow: #343a40 2px;
                color: white;
                width: 100%;
                display: block;
                text-align: center;
            }

            @media (min-width: 1760px) {
                .about-title::before {
                    background-image: url(<?php echo getIcon()->$banner?>);
                }
            }

            .about-text {
                padding-top: 6vh;
                padding-bottom: 6vh;
            }

            /* About Custom CSS */

            /* Footer Custom CSS */

            #footer {
                height: 250px;
                margin-top: -40px;
                clear: both;
                background-color: #000;
                color: #f3f3f3;
                position: relative;
                border-top: 1px solid #EBEBEB;
            }

            /* Footer Custom CSS */

            /* Parallax Background */

            .bg-default{
                background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
            }

            .bgimg-1, .bgimg-2 {
                position: relative;
                opacity: 0.65;
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
              
              }
              
              .bgimg-1 {
                background-image: url(<?php echo getIcon()->$ticket?>);
                min-height: 400px;
              }
              
              .bgimg-2 {
                background-image: url(<?php echo getIcon()->$contact?>);
                min-height: 400px;
              }
              
              .caption {
                position: absolute;
                left: 0;
                top: 50%;
                width: 100%;
                text-align: center;
                color: #000;
              }

              .modal-container{
                position: fixed;
                z-index: 999;
                width: 60%;
                left:20%;
                top:10%;
                display: none;
                padding:10px;
              }

              .modal-content{
                background: #fff;
                border-radius: 4px;
                padding: 10px;
                -webkit-box-shadow: -1px 0px 8px -1px rgba(0,0,0,0.75);
                -moz-box-shadow: -1px 0px 8px -1px rgba(0,0,0,0.75);
                box-shadow: -1px 0px 8px -1px rgba(0,0,0,0.75);
              }

              .bg-transparent{
                display: none;
                background: url(<?php echo getIcon()->bg?>);
                position: fixed;
                z-index: 999;
                width: 100%;
                height:200%;
              }

            /* /Parallax Background */
        </style>
        
    </head>
       
    <body>


        <!-- Main Content -->
    <div class="main-container" id="home">

        <div class="main">

        <div class="bg-transparent" onClick="return buy_ticket()"></div>

        <?php 

            if(is_mobile()) $width = "style='width:100%;left:0%;top:0%;z-index:999'";
            else $width = "";

        ?>


            <div class="modal-container" <?php echo $width ?>>

                <div class="panel pane-default modal-content" >                    
                

                </div>

            </div>