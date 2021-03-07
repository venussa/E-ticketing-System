    </div>
 </div>
<!-- /Main Content -->

 <footer id="footer">
            <div class="container padding64 text-center">
                <!-- Copyright -->
                <div class="footer-copyright py-4">
                    <?php echo domain()?> &copy; 2019 All rights reserved.
                </div>
                <div style="font-size: 24px;">
                    <a href="<?php echo getThemeText()->facebook?>">
                        <i class="fa fa-facebook-official text-muted mr-4">
                        </i>
                    </a>
                    <a href="<?php echo getThemeText()->twitter?>">
                        <i class="fa fa-twitter text-muted mr-4">
                        </i>
                    </a>
                    <a href="<?php echo getThemeText()->instagram?>">
                        <i class="fa fa-instagram text-muted mr-4">
                        </i>
                    </a>
                </div>
                
            </div>
        </footer>


        <?php

        CallJS([
            getTheme()->path."T_assets/js/jquery.js",
            getTheme()->path."T_assets/js/propper.min.js",
            getTheme()->path."T_assets/js/bootstrap.min.js",
            getTheme()->path."T_assets/js/project.js",

        ]);
      ?>

      <script>
        
        function GoTo(id){

            var targetSec = $(id).attr("href");

            $(".nav-item").removeClass("active");
            $("."+$(id).attr("active")).addClass("active");

            $('html, body').animate({

                scrollTop: $(targetSec).offset().top

            }, 1000);

            $("#navbar").hide();

            return false;

        }


        $("#contactForm").submit(function(){

            $.ajax({
                type    : $(this).attr("method"),
                url     : $(this).attr("action"),
                data    : $(this).serialize(),
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

        });

        function buy_ticket(a = 0){
            

            if($(".modal-container").css("display") == "none"){

                $.ajax({
                    type    : "POST",
                    url     : "<?php echo HomeUrl()."/send-message"?>",
                    data    : {
                        id : a,
                        action : "2"
                    },
                    beforeSend : function(){
                        $(".btn-"+a).html("Please Wait ...");
                    },
                    success : function(event){
                        $(".btn-"+a).html("Get Ticket");
                        $(".modal-content").html(event);
                        $(".bg-transparent").show();
                        $(".modal-container").show();

                    }
                });

            }else{

                $(".modal-content").html("");
                $(".bg-transparent").hide();
                $(".modal-container").hide();

            }
        }

        function submit_ticket(a){

            $.ajax({
                type    : $(a).attr("method"),
                url     : $(a).attr("action"),
                data    : $(a).serialize(),
                beforeSend : function(){
                    
                    $("input").attr("disabled","true");
                    $("button").attr("disabled","true");
                    $(".buys").html("Please Wait ...");
                },
                success : function(event){

                    if(event.indexOf("<mail/>") !== -1){

                        $("#notif").html("* Format Email tidak sesuai");

                    }else if(event.indexOf("<tlp/>") !== -1){

                        $("#notif").html("* Format Nomor Telephone tidak sesuai");

                    }else if(event.indexOf("<true/>") !== -1){

                        $("#success").show();
                        $("#register").hide();

                    }else{

                        $("#notif").html("* Pembelian Gagal");

                    }

                    $("input").removeAttr("disabled");
                    $("button").removeAttr("disabled");
                    $(".buys").html("Beli Ticket");

                }
            });

            return false;
        }
        
        function show_navbar(){

            if( $("#navbar").css("display") == "none"){
                 $("#navbar").show();
            }else{
                 $("#navbar").hide();
            }
           
        }
        

      </script>
    </body>
</html>