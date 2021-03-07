<p class="page-label">
    <img src="<?php echo getIcon()->home?>"  width="25"> 
    <span>adminpanel / scan QR</span>
  </p>
<div class="col-md-12">

  <div id="QR-Code">

             <audio id="beep" controls style="display: none;">
              <source src="<?php echo HomeUrl()."/T_assets/js/beep.mp3"?>" type="audio/mpeg">
            </audio> 

            <button id="play" data-toggle="tooltip" style="display: none;" title="Play" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-play"></span></button>

            <button id="stop" data-toggle="tooltip" style="display: none;" title="Stop" type="button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-stop"></span></button>

            <h1 id="w-title">Scan Your Ticket</h1>

                  <div class="camera-box">
                  	<img id="webcame-notfound" src="<?php echo getIcon()->webcam?>">
                     <canvas id="qr-canvas"></canvas>

                     <p id="w-text">Scan the QR code on the ticket and book your ticket</p>

                     <p id="w-nf" style="display: none;text-align: center;border:1px #ddd solid;width: 250px;padding:10px;border-radius: 5px;">
                       <img src="<?php echo getIcon()->nf?>" width="150"><br><br>
                       <text style="margin-top: 20px;font-size:20px"><b>Ticket Not Found</b></text>
                     </p>

                     <p id="w-result" style="display: none;text-align: center;border:1px #ddd solid;width: 250px;padding:10px;border-radius: 5px;"></p>
                  
                      
                  </div>
                  <p style="display: none;" id="scanned-QR"></p>
             
      </div>
  <input id="base-url" url="<?php echo HomeUrl()?>" value="<?php echo projectUrl()."/assets/"?>" style="display: none">
</div>

<script>
    var video = document.createElement("video");
    var canvasElement = document.getElementById("qr-canvas");
    var canvas = canvasElement.getContext("2d");

    function drawLine(begin, end, color) {
      canvas.beginPath();
      canvas.moveTo(begin.x, begin.y);
      canvas.lineTo(end.x, end.y);
      canvas.lineWidth = 4;
      canvas.strokeStyle = color;
      canvas.stroke();
    }

    // Use facingMode: environment to attemt to get the front camera on phones
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
      video.srcObject = stream;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.play();
      requestAnimationFrame(tick);
    });

    function tick() {
      
      if (video.readyState === video.HAVE_ENOUGH_DATA) {
  
        canvasElement.hidden = false;

        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        var code = jsQR(imageData.data, imageData.width, imageData.height, {
          inversionAttempts: "dontInvert",
        });
        if (code) {
          drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
          drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
          drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
          drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
          
          // data param
          data_proccess(code.data);
        } else {
         
          
        }
      }
      requestAnimationFrame(tick);
    }

    function data_proccess(data_id){

      $.ajax({

        type : "POST",
        url  : $("#base-url").attr("url")+"/handler",
        data : {
          action  : "6",
          id    : data_id
        } ,
        success : function(event){

          if(event.indexOf("<no/>") !== -1){
                      
            $("#w-nf").show();
            $("#w-result").hide();

          }else{
            $("#beep")[0].play();
            $("#w-nf").hide();
            $("#w-result").show();
            $("#w-result").html(event);

          }

        }
      });
    }
</script>