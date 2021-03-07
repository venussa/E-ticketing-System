<?php

/*
 *---------------------------------------------------------------
 * PROCCESS HANDLING
 *---------------------------------------------------------------
 *
 * handle all processes in the program
 */


if(isset($_POST['action'])){

	switch($_POST['action']){

		/* 
		* Switch Active or Disable TIcket
		* ----------------------------------------------------------
		*/

		case 1 : 

			// select ticket id from t_event table
			$query = database()->Query("SELECT * FROM t_event WHERE id='".$_POST['id']."' ");
			
			// show query result
			$show = $query->Fetch();

			// if ticket not found
			if($query->rowCount() == 0){

				echo "<false/>";

			// if ticket found
			}else{

				// activate ticket
				if($show['status_event'] == 1){

					database()->Query("UPDATE t_event SET status_event='0' WHERE id='".$show['id']."' ");

					echo "<off/>";

				// inactivate ticket
				}else{

					database()->Query("UPDATE t_event SET status_event='1' WHERE id='".$show['id']."' ");

					echo "<on/>";
				}

			}

		break;


		/* 
		* Delete ticket
		* ----------------------------------------------------------
		*/

		case 2 : 

			database()->Query("DELETE FROM t_event WHERE id='".$_POST['id']."' ");

		break;

		/* 
		* SAdd new ticket
		* ----------------------------------------------------------
		*/
		case 3:

			// column name of t_event table
			$column = array(
				"title",
				"description",
				"poster",
				"location",
				"address",
				"kuota",
				"price",
				"date_event",
				"status_event"
			);

			$allow_ext = array("jpg","png","jpeg");

			$file = $_FILES['poster'];

			$ext = get_extention($file['name']);

			$name = time();

			$path = projectDir()."/T_assets/img/poster/".$name.".".$ext;

			if(in_array($ext,$allow_ext)){

				if(!move_uploaded_file($file['tmp_name'], $path)){

					echo "<false/>";
					exit;

				}

			}else{

				 echo "<false/>";
				 exit;

			}

			// value of column in t_event table
			$value = array(
				"'".trim(strip_tags($_POST['title']))."'",
				"'".trim(strip_tags($_POST['description']))."'",
				"'".$name.".".$ext."'",
				"'".trim(strip_tags($_POST['location']))."'",
				"'".trim(strip_tags($_POST['address']))."'",
				"'".trim(strip_tags($_POST['kuota']))."'",
				"'".trim(strip_tags($_POST['price']))."'",
				"'".strtotime(trim(strip_tags($_POST['date']." ".$_POST['time'])))."'",
				'0'
			);

			// insert action to database
			if(database()->Query("INSERT INTO t_event (".implode(",",$column).") VALUES (".implode(",",$value).")")){

				// insert success
				echo "<true/>";

			}else{

				// insert failed
				echo "<false/>";

			}

		break;

		/* 
		* Save setting website
		* ----------------------------------------------------------
		*/
		case 4:

			// change password admin login page
			if(
				isset($_POST['oldpass']) and
				isset($_POST['newpas']) and
				isset($_POST['retype_newpas'])
			){

				if(
					!empty($_POST['oldpass']) and
					!empty($_POST['newpas']) and
					!empty($_POST['retype_newpas'])
				){

					// if old password is different
					if(encrypt($_POST['oldpass']) !== getSetting()->password){

						echo "<passfail/>";
						exit;

					}

					// if new password does not match
					if(encrypt($_POST['newpas']) !== encrypt($_POST['retype_newpas'])) {

						echo "<newpassfail/>";
						exit;

					}

					// if problem not found
					$response = true;	

				}

			}

			// collect new data setting
			$column = array(
				"email"		 => $_POST['email'],
				"no_rek"	 => $_POST['no_rek'],
				"bank_name"	 => $_POST['bank_name'],
				"rek_name"	 => $_POST['rek_name'],
				"address"	 => $_POST['address'],
				"phone"		 => $_POST['phone'],
				"bank_code"	 => $_POST['bank_code']
			);

			// save password changes if the response variable is detected
			if(isset($response)){

				if(database()->Query("UPDATE t_user SET password='".encrypt($_POST['newpas'])."' ")){

					// success saving
					$response = true;
				}else{

					// fail saving
					$response = false;
					echo "<failchangepass/>";
					exit;
				}

			}

			// loop collect new data setting and rebuilt it
			foreach($column as $key => $val){

				// insert data to database
				if(database()->Query("UPDATE t_conf SET value='".$val."' WHERE name='".$key."' ")){

					// success insert
					$response = true;

				}else{


					// faill insert
					$response = false;
					exit;

				}

			}

			// show success response
			if($response == true){

				echo "<success/>";

			}

		break;

		/* 
		* Payment confiramtion success
		* ----------------------------------------------------------
		*/

		case 5:

			// select payment information
			$query = database()->Query("SELECT * FROM t_order WHERE booking_id='".$_POST['id']."' ");

			// show query
			$show = $query->fetch();

			// count list result
			$rows = $query->rowCount();

			// if booking id not found
			if($rows == 0){
				
				echo "<off/>";
				exit;

			}

			// set active payment
			if($show['payment_status'] == "0"){

				// update payment data
				if(database()->Query("UPDATE t_order SET payment_status='1', pay_time='".time()."' WHERE booking_id='".$show['booking_id']."' ")){

					// renew payment code
					database()->Query("UPDATE t_code SET status='0' WHERE 
					code='".$show['payment_code']."' ") ;

					// send mail confirmation
					
					$event = database()->Query("SELECT * FROM t_event WHERE id='".$show['event_type']."' ");
					$event = $event->fetch();
					
					ob_start();
					require_once(projectDir()."/T_adminpanel/T_email/mail2.php");
					$mail2 = ob_get_clean();

					PHPmailer($show['email'],"Pembayaran Diverifikasi Untuk Pembelian Tiket Konser \"".$event['title']."\" - #".$show['booking_id'],$mail2);

					// active response
					echo "<on/>";
					exit;

				}



			}


		break;

		/* 
		* Scan QR
		* ----------------------------------------------------------
		*/
		case 6 :

			if(isset($_POST['id'])){

				// select payment information
				$query = database()->Query("SELECT * FROM t_order WHERE booking_id='".$_POST['id']."' ");

				// show query result
				$show = $query->fetch();

				// if booking id is found
				if($query->rowCount() !== 0){

					// if you have already done a scanning ticket
					if($show['check_in'] == "1"){

						echo "<p style='text-align:center' ><img src='".getIcon()->check."' width='120'></p>";
						echo "<p><b>Already Check In</b></p>";
						echo "<p><b>Time :</b>".date("d/m/Y H:i:s",$show['check_in_time'])." <br><i><small style='color:orangered'>(".timeHistory($show['check_in_time']).")</small></i></p>";

					// If it's the first time you scan a ticket
					}else{

						database()->Query("UPDATE t_order SET check_in='1',check_in_time='".time()."' WHERE booking_id='".$show['booking_id']."' ");

						echo "<p style='text-align:center' ><img src='".getIcon()->check."' width='120'></p>";
						echo "<p><b>Book Id : </b>".$show['booking_id']."</p>";
						echo "<p><b>Date Order : </b>".date("d/m/Y H:i:s",$show['order_time'])."</p>";
						echo "<p><b>Email : </b>".$show['email']."</p>";
						echo "<p><b>Book Id : </b>".$show['payment_code']."</p>";

					}



				// if booking id not found
				}else{

					echo "<no/>";

				}

			}

		break;

		/* 
		* Mark as read notification
		* ----------------------------------------------------------
		*/
		case 7:

			database()->Query("UPDATE t_logs SET status='1' ");

		break;

		/* 
		* Login proccess
		* ----------------------------------------------------------
		*/
		case 8:

			// clean username value
			$user = preg_replace("(['\"])",null,$_POST['username']);

			// clean and convert to md5 password value
			$pass = encrypt(preg_replace("(['\"])",null,$_POST['password']));

			// command for select username from t_user table
			$command = "SELECT * FROM t_user WHERE username='".$user."'";

			// query execute
			$query = database()->Query($command);

			// show query result
			$show = $query->fetch();

			// if username not found
			if($query->rowCount() == 0){

				echo "<nouser/>";
				exit;

			}

			// if password is diferent
			if($pass !== $show['password']){

				echo "<nopass/>";
				exit;

			}


			// success response and create new session
			$_SESSION['login_status'] = true;
			echo "<success/>";
			exit;

		break;

		/* 
		* Reply message
		* ----------------------------------------------------------
		*/

		case 9:

			if(isset($_POST['id'])){
			
				// select data
				$query = database()->Query("SELECT * FROM t_msgs WHERE id='".$_POST['id']."' ");
				// show query result
				$show = $query->fetch();

				// count record
				$row = $query->rowCount();

				// check if data is found
				if($row !== 0){

					$pesan = str_replace("'",null,$_POST['pesan']);

					// update data
					if(database()->Query("UPDATE t_msgs SET status='1', reply='".$pesan."' WHERE id='".$_POST['id']."'" )){

						// success update
						   
						$reply = "
						<p style='font-size:20px;'><b>Pesan Balasan</b><br></p>
						<p><b>Pertanyaan : </b>".$show['msg']."</p>
						<p><b>Balasan : </b>".$pesan."</p>
						<p><br><br><i>* Kami tidak akan membalas pesan anda jika membalas email ini, silakan tanyakan lagi pada kami dengan mengisi pertanyaan pada menu contact di website kami.</i></p>
						";
						
						PHPmailer($show['email'],"Balasan Pesan [ ".wordLimit($show['msg'],4)." ] - No Reply",$reply);
						
						echo "<yes/>";

					}else{
						
						// failed update
						echo "<no/>";

					}


				}else{

					// data not found
					echo "<no/>";

				}
			}

		break;

		/* 
		* Theme Activate
		* ----------------------------------------------------------
		*/

		case 10:

			if(isset($_POST['id'])){

				// select data
				$query = database()->Query("SELECT * FROM t_theme WHERE id='".$_POST['id']."' ");

				// show query result
				$show = $query->fetch();

				// count query result
				$record = $query->rowCount();

				// if the theme is found
				if($record !== 0){

					// if status is 0
					if($show['status'] == 0){

						// disable all
						database()->Query("UPDATE t_theme SET status='0'");

						// activate selected theme
						database()->Query("UPDATE t_theme SET status='1' WHERE id='".$_POST['id']."' ");

						echo "<active/>";

					}else{

						// disable all
						database()->Query("UPDATE t_theme SET status='0'");

						// disable selected theme
						database()->Query("UPDATE t_theme SET status='0' WHERE id='".$_POST['id']."' ");

						echo "<nonactive/>";

					}

				}
			}

		break;

		/* 
		* Upload New Theme
		* ----------------------------------------------------------
		*/

		case 11:

			if(isset($_FILES) and !empty($_FILES['file']['name'])){

				// set file index id
				$name = $_FILES['file']['name'];

				// set upload path
				$path_upload = projectDir()."/T_themes/";

				// get file extention
				$ext = get_extention($name);

				// set theme directory name
				$theme_name = str_replace(".zip","",get_file_name($name));

				if($ext == "zip"){

					// upload file
					if(move_uploaded_file($_FILES['file']['tmp_name'],$path_upload."".$name)){

						// extract zip theme file
						if(ExtractZip($path_upload."".$name,$path_upload)){
							
							// get theme title
							$theme_title = ucwords(implode(null, file($path_upload."".$theme_name."/title.txt")));

							// insert theme data to db
							database()->Query("INSERT INTO t_theme (name,path,status) VALUES ('".$theme_title."','T_themes/".$theme_name."/','0')");
							
							// delete zip file of theme
							unlink($path_upload."".$name);

							// redirect
							header("location:".HomeUrl()."/adminpanel/themes");
							exit;

						}
					}
				}

			}
				
		break;

		/* 
		* Delete Theme
		* ----------------------------------------------------------
		*/

		case 12:

			if(isset($_POST['id'])){

				// select theme from t_theme table
				$query = database()->Query("SELECT * FROM t_theme WHERE id='".$_POST['id']."' ");

				// show query result
				$show = $query->fetch();

				// count query result
				$record = $query->rowCount();

				if($record !== 0){

					// Delete data theme from db
					database()->Query("DELETE FROM t_theme WHERE id='".$_POST['id']."' ");

					// delete directory theme
					deleteDirectory(projectDir()."/".$show['path']);

					echo "<done/>";

				}

			}

		break;

		/* 
		* Theme setting
		* ----------------------------------------------------------
		*/

		case 13:

			// path of config file
			$paths = projectDir()."/".getTheme()->path."data.json";

			// rebuild config file
			$get_config = implode(null,file($paths));

			// rebuild to json from config file
			$reference = fetch_json($get_config);

			// duplicate json config file
			$json = fetch_json($get_config);

			// loop post index
			foreach($_POST as $index => $value){

				if($index !== "action"){
					
					if($index == "description"){

						$json = update_json([$index => strip_tags($value)],fetch_json($json));

					}else{
						
						$json = update_json([$index => $value],fetch_json($json));

					}
					
				}

			}

			// loop files action for upload
			foreach($_FILES as $index => $value){

				// get extention file
				$extention = strtolower(get_extention($value['name']));

				// generate filename
				$filename = md5($value['size']."-".time());

				// set upload path
				$path = projectDir()."/T_assets/img/".$filename.".".$extention;

				// upload file
				if(move_uploaded_file($value['tmp_name'],$path)){

					// allowed extention
					$ext = array("jpg","jpeg","png","gif","svg");

					// check the extention available
					foreach($ext as $key => $url){

						// if success delete older file
						if(unlink(projectDir()."/T_assets/img/".$reference->$index.".".$url) == true){

							$json = update_json([$index => $filename],fetch_json($json));

						// if failed delete older file
						}else{

							$json = update_json([$index => $filename],fetch_json($json));

						}

					}

				}else{

					$json = update_json([$index => $reference->$index],fetch_json($json));
				}

			}

			// write file
			if(write_file($json,$paths,"w+")){

				echo "<yes/>";

			}else{
				echo "<no/>";
			}
			

		break;

	}

}