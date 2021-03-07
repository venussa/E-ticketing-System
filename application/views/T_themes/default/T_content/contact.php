<section id="contact">
  <div class="bgimg-2">
      <div class="caption">
          <h2 class="text-uppercase display-4" style="color: white;margin-top: -20px;" >Contact</h2>
      </div>
    </div>
    <div class="container ccontent padding64">
    <p class="text-center text-muted"><i><span >Jika anda memiliki pertanyaan yang ingin ditanyakan, silahkan contact kami dengan informasi kontak berikut ini.</span></i></p>
      <div class="row padding32">
      <div class="col m6 margin-bottom large">
              <i class="fa fa-map-marker" style="width:30px"></i> <span ><?php echo getSetting()->address?></span><br>
              <i class="fa fa-phone" style="width:30px"></i> <span >Phone: <?php echo getSetting()->phone?></span><br>
              <i class="fa fa-envelope" style="width:30px"> </i> <span >Email: <a href="mailto:<?php echo getSetting()->email?>" style="color:#000;text-decoration: none;"><?php echo getSetting()->email?></a></span><br>
          </div>

          <?php
          if(is_mobile()){
            $margin = "style='width:100%;border-top:2px #ddd dashed;padding-top:15px;margin-top:10px;padding:15px;'";
          }else{
            $margin = 'class="col m12"';
          }
          ?>
        
          <div <?php echo $margin?>>
            <form id="contactForm" name="sentMessage" method="post" action="<?php echo HomeUrl()."/send-message"?>" novalidate="novalidate">
              <div class="row" style="margin:0 -16px 8px -16px">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Name" required="required" data-validation-required-message="Please enter your name." name="name">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <input class="form-control" id="email" type="email" placeholder="Email" required="required" data-validation-required-message="Please enter your email address." name="email">
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Message" required="required" data-validation-required-message="Please enter a message." name="msg"></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>


                <div class="col-lg-12 text-center" style="">
                  <div  class="alert alert-info" id="alert-response" style="display: none;">Pesan Terkirim</div>
                  <div class="alert alert-danger" id="alert-response1" style="display: none;">Pesan Gagal Terkirim</div>
                  <input type="text" name="action" value="1" style="display: none;">
                  <button id="sendMessageButton" class="btn btn-primary text-uppercase cright w3-section" type="submit">KIRIM PESAN</button>
                </div>


              </div>
            </form>
          </div>
      </div>
    </div>
</section>