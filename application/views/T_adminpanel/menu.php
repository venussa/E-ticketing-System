<?php

        if(is_mobile()){
            $margin = "margin-left:-11px;";
        }else{
            $margin = null;
        }
    ?>


<div onClick="show_notification()" id="close-float-box"></div>

<div class="container">

    <div id="navbar-wrapper">
        <header >
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="z-index: 998">
                <div class="container-fluid">
                    <div class="navbar-header">
                   
                        <a class="navbar-brand" href="<?php echo HomeUrl()?>/adminpanel">
                            <img src="<?php echo getIcon()->logo?>"  width="250">
                        </a>
                    </div>
                    <div id="navbar-collapse" class="collapse navbar-collapse">
                       
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                               <img url="<?php echo HomeUrl()."/adminpanel/payment-list"?>" style="margin-top:16px;margin-right:20px;cursor: pointer;" src="<?php echo getIcon()->bell?>"  width="35" onClick="return show_notification(this)">
                            </li>
                            <li class="dropdown">
                               <img onClick="window.location='<?php echo HomeUrl()."/adminpanel/mail"?>'" style="margin-top:19px;margin-right:20px;cursor: pointer;" src="<?php echo getIcon()->surat?>"  width="30">
                            </li>
                            <li class="dropdown">

                              <img onClick="window.location='<?php echo HomeUrl()."/adminpanel/logout"?>'" style="margin-top:22px;margin-right:20px;;cursor: pointer;" src="<?php echo getIcon()->logout?>"  width="23">

                              <?php 
                              if(getNotif(1) == "0"){ ?>
                                 <div id="alerts" style="width: 12px;height: 12px;border-radius: 100%;background: #DC143C;border:1px #DC143C solid;position: absolute;margin-left: -84px;margin-top:-24px;" class=""></div>
                             <?php } ?>

                             <?php 
                              if(getNotif(2) == "0"){ ?>
                             <div id="alerts" style="width: 12px;height: 12px;border-radius: 100%;background: #DC143C;border:1px #DC143C solid;position: absolute;margin-left: -27px;margin-top:-24px;" class=""></div>
                             <?php } ?>
                              
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        </header>
         <div class="float-box panel" style="display: none;width:500px;height:500px;overflow-y: scroll;">
             <?php echo getNotif()?>
         </div>
    </div>

    <div id="wrapper">
        <div id="sidebar-wrapper" style="z-index: 997">
            <aside id="sidebar" >
                <ul id="sidemenu" class="sidebar-nav" >
                    <?php if(is_mobile()){ ?>
                    <li>
                        <a href="javascript:void(0)" onClick="show_notification()">
                            <span class="sidebar-icon"><img style="position: absolute;margin-top:5px;<?php echo $margin ?>" src="<?php echo getIcon()->bell?>"  width="30"></span>
                            <span class="sidebar-title">Notofikasi</span>
                        </a>
                    </li>

                    <?php } ?>

                    <li <?php echo getActiveMenu("dashboard")?>>
                        <a href="<?php echo HomeUrl()."/adminpanel/dashboard"?>">
                            <span class="sidebar-icon"><img style="position: absolute;margin-top:5px;<?php echo $margin ?>" src="<?php echo getIcon()->dashboard?>"  width="30"></span>
                            <span class="sidebar-title">Dashboard</span>
                        </a>
                    </li>
                    <li <?php echo getActiveMenu("add-ticket")?>>
                        <a href="<?php echo HomeUrl()."/adminpanel/add-ticket"?>">
                            <span class="sidebar-icon"><img style="position: absolute;margin-top:5px;<?php echo $margin ?>" src="<?php echo getIcon()->event?>"  width="30"></span>
                            <span class="sidebar-title">Ticket & Balance</span>
                        </a>
                    </li>
                    <li <?php echo getActiveMenu("payment-list")?>>
                        <a href="<?php echo HomeUrl()."/adminpanel/payment-list"?>">
                            <span class="sidebar-icon"><img style="position: absolute;margin-top:5px;<?php echo $margin ?>" src="<?php echo getIcon()->payment?>"  width="30"></span>
                            <span class="sidebar-title">Payment & Check In</span>
                        </a>
                    </li>
                    
                    <li <?php echo getActiveMenu("mail")?>>
                        <a href="<?php echo HomeUrl()."/adminpanel/mail"?>">
                            <span class="sidebar-icon"><img style="position: absolute;margin-top:5px;<?php echo $margin ?>" src="<?php echo getIcon()->envelope?>"  width="30"></span>
                            <span class="sidebar-title">Message</span>
                        </a>
                    </li>
                   <li <?php echo getActiveMenu("scan-qr")?>>
                        <a href="<?php echo HomeUrl()."/adminpanel/scan-qr"?>">
                            <span class="sidebar-icon"><img style="position: absolute;margin-left:1px;<?php echo $margin ?>margin-top:7px;" src="<?php echo getIcon()->qr?>"  width="28"></span>
                            <span class="sidebar-title">Scan QR</span>
                        </a>
                    </li>

                    <li <?php echo getActiveMenu("themes")?>>
                        <a href="<?php echo HomeUrl()."/adminpanel/themes"?>">
                            <span class="sidebar-icon"><img style="position: absolute;margin-left:1px;<?php echo $margin ?>margin-top:7px;margin-left: 3px;" src="<?php echo getIcon()->theme?>"  width="26"></span>
                            <span class="sidebar-title">Themes</span>
                        </a>
                    </li>

                     <li <?php echo getActiveMenu("settings")?>>
                        <a href="<?php echo HomeUrl()."/adminpanel/settings"?>">
                            <span class="sidebar-icon"><img style="position: absolute;margin-left:6px;<?php echo $margin ?>margin-top:7px;" src="<?php echo getIcon()->Cog?>"  width="27"></span>
                            <span class="sidebar-title">Setting</span>
                        </a>
                    </li>

                    <?php if(is_mobile()){ ?>
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><img style="position: absolute;margin-top:5px;<?php echo $margin ?>" src="<?php echo getIcon()->logout?>"  width="25"></span>
                        </a>
                    </li>
                   <?php } ?>
                    
                </ul>
            </aside>            
        </div>
  
    </div> 
</div>

<div class="page-content">
    <div id="data-content">