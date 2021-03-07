<?php
	
	switch($_POST['action']){

		/* 
		* Send Message
		* ----------------------------------------------------------
		*/
		case 1:

			if(isset($_POST['email']) and isset($_POST['name']) and isset($_POST['msg'])){

				// clean XSS
				$name = strip_tags(str_replace("'","",$_POST['name']));
				$email = strip_tags(str_replace("'","",$_POST['email']));
				$msg = strip_tags(str_replace("'","",$_POST['msg']));

				if(!empty($name) and !empty($email) and !empty($msg)){

					// table column name
					$column = implode(",",array("nama","email","msg","reply","status","send_time"));

					// if uload image detect
					if(!empty($_FILES['file']['name'])){

						$allow = array("jpg","jpeg","png");
						$file = $_FILES['file'];
						$ext = get_extention($_FILES['file']['name']);
						$proof_img = md5(time()."-".$email);
						$path = projectDir()."/T_assets/img/other/".$proof_img.".".$ext;

						if(in_array($ext,$allow)){
							$url = HomeUrl()."/T_assets/img/other/".$proof_img.".".$ext;
							move_uploaded_file($file['tmp_name'], $path);
							$msg = "<a href=\"".$url."\" target=\"_blank\"><img src=\"".$url."\" width=\"200\"></a><p>".$msg."</p>";
						}else{
							echo "<no/>";
							exit;
						}
					}

					// table value
					$value = implode(",",array(
						"'".$name."'",
						"'".$email."'",
						"'".$msg."'",
						"''",
						"'0'",
						"'".time()."'",
					));

					// insert message
					if(database()->Query("INSERT INTO t_msgs ($column) VALUES ($value)")){
                        
                        $message = "<p style='font-size:20px'>Dari : <b>".$name."</b></p>
                        <p><b>Pesan : </b> <i>".$msg."</i><br></p>
                        <p>Segera balas dengan mengakses halaman admin website, Terimaksih.</p>
                        ";
                        
                        PHPmailer(getSetting()->email,"Pesan Dari ".$name." [".$email."]",$message);
                        
						echo "<yes/>";

					}else{

						echo "<no/>";
					}

				}

				echo "<no/>";

			}

		break;

		/* 
		* Get Modal Payment Ticket
		* ----------------------------------------------------------
		*/

		case 2:

			require_once(projectDir()."/".getTheme()->path."T_content/modal-buy-ticket.php");

		break;

		/* 
		* Send Payment Information Ticket
		* ----------------------------------------------------------
		*/

		case 3:

			if(isset($_POST['email']) and is_numeric($_POST['id'])) {

				// clean XSS
				$_POST['nama'] = strip_tags(preg_replace("(['\"])",null,$_POST['nama']));
				$_POST['address'] = strip_tags(preg_replace("(['\"])",null,$_POST['address']));
				$_POST['email'] = strip_tags(preg_replace("(['\"])",null,$_POST['email']));
				$_POST['telephone'] = strip_tags(preg_replace("(['\"])",null,$_POST['telephone']));

				// if the number isn't numeric
				if(is_numeric($_POST['telephone']) == false){

					echo "<tlp/>";
					exit;

				}

				// if the mail is different
				$check_mail = explode("@",$_POST['email']);

				if(isset($check_mail[1])){

					$check_domain = explode(".",$check_mail[1]);

					if(!isset($check_domain[1])){

						echo "<mail/>";
						exit;

					}

				}else{

					echo "<mail/>";
					exit;

				}

				// select data event from t_event table
				$check = database()->Query("SELECT * FROM t_event WHERE id='".$_POST['id']."'");

				// count query result
				$row = $check->rowCount();

				// show result
				$show = $check->fetch();

				// if event not found
				if($row == 0) {

					echo "<false/>";
					exit;

				}


				// if event doesn't active
				if($show['status_event'] == "0"){
					echo "<false/>";
					exit;
				} 

				// select payment code from t_code event
				$get_code = database()->Query("SELECT code FROM t_code WHERE status='0' ORDER BY RAND() LIMIT 1");

				// show query result
				$get_code = $get_code->fetch();

				// set payment code
				$get_code = $get_code['code'];

				// if the code < 100
				if(($get_code < 100) and ($get_code >= 10)){

					$code = "0".$get_code;

				}

				// if the code < 10
				if(($get_code < 10)) {

					$code = "00".$get_code;

				}

				// if the code > 100
				if(($get_code > 99)) {

					$code = $get_code;

				}

				$booking_id = time()."".$code;

				$event_type = $_POST['id'];

				$payment_code = $code;

				$payment_status = 0;

				$order_time = time();

				$pay_time = 0;

				$email = $_POST['email'];

				// select order information from t_order table
				$query = database()->Query("SELECT * FROM t_order WHERE event_type='".$_POST['id']."' and email = '".$email."' ");

				// table column name
				$column = array(
					"booking_id",
					"event_type",
					"payment_code",
					"payment_status",
					"order_time",
					"pay_time",
					"email",
					"name",
					"address",
					"no_tlp"
				);

				// table value
				$values = array(
					"'".$booking_id."'",
					"'".$event_type."'",
					"'".$payment_code."'",
					"'".$payment_status."'",
					"'".$order_time."'",
					"'".$pay_time."'",
					"'".$email."'",
					"'".$_POST['nama']."'",
					"'".$_POST['address']."'",
					"'".$_POST['telephone']."'"
				);

				// if order not found, the order will proccess
				if($query->rowCount() == 0 ){

					// insert order data
					database()->Query("INSERT INTO t_order (".implode(",",$column).") VALUES (".implode(",",$values).")");

					// set active payment code
					database()->Query("UPDATE t_code SET status='1' WHERE code='".$code."' ");

					// insert log activity
					database()->Query("INSERT INTO 
						t_logs (log_id,event_id) 
						VALUES ('".$booking_id."','".$event_type."')");

					// send mail confirmation
					ob_start();
					require_once(projectDir()."/T_adminpanel/T_email/mail1.php");
					$mail1 = ob_get_clean();

					PHPmailer($email,"Order Berhasil Untuk Pembelian Tiket Konser \"".$show['title']."\" - #".$booking_id,$mail1);

					echo "<true/>";

				}else{

					echo "<false/>";

				}

			}


		break;

	}

?>