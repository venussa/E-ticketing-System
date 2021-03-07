<?php

/*
 *---------------------------------------------------------------
 * ADDITIONAL FUNCTION
 *---------------------------------------------------------------
 *
 * create new functions that are custom from the user
 */

/* ------------------------------------------------------------------------------------- */

if(!function_exists("getIcon")){

	/**
	 * Get icon as dynamic
	 *
	 * by reading and scanning the contents of the folder 
	 * in application/views/T_assets/img/
	 * After that, the address will be set automatically 
	 * to facilitate the calling of images
	 *
	 * @return	mixed => json which contains a string
	 */
	
	function getIcon(){

		// Scan directory
		$data = glob(projectDir()."/T_assets/img/*");

		// loop scan result
		foreach ($data as $key => $value) {

				// get file name from loop scan result
				$name = get_file_name($value);

				// replace all space and min symbol (-) with underscore (_)
				$index = str_replace(array(" ","-"),"_",$name);

				// replcae dot symboiol with null string for
				// create the file name as index for json create object
				$index = str_replace(".".get_extention($name),"",$index);
				
				// specify data on each index
				$path[$index] = HomeUrl()."/T_assets/img/".$name;

		}

		/**
		* returns the process results of json type
		* @return array, json, string (mixed)
		*/

		return json_decode(json_encode($path));

	}

}

/* ------------------------------------------------------------------------------------- */

if(!function_exists("getPaging")){

	/**
	 * Get paging infomation
	 *
	 * to check and set the page that is currently active, 
	 * a lot of data is presented on each page and also the initial and final
	 * limits of the data specified on each page
	 *
	 * @return	mixed => array which contains a string
	 */

	function getPaging(){

		// logic if the page index in the $ _POST variable exists
		if(isset($_POST['page'])){

			// logic detects whether or not the variable 
			// is empty and also detects data types that are 
			// supposed to be numeric data types
			if(empty($_POST['page']) or (is_numeric($_POST['page']) == false)) {
				
				// if conditions aren't met
				$page = 1;

			}else{

				// if conditions are met
				$page = $_POST['page'];

			}

		// if conditions aren't met
		} else $page = 1;

		// a lot of data from pages
		$dataperpage = $_POST['dataperpage'];

		// initial data limit
		$offset = ($page- 1) * $dataperpage;

		// keywords for data search
		if(isset($_POST['keyword'])){

			// condition if the keyword exists
			$keyword = $_POST['keyword'];

		}else{

			//condition if the keyword does not exist
			$keyword = null;

		}

		// collect and present data into a variable 
		// $data that has a type of data array which will 
		// then be converted into a json object to facilitate the calling
		$data = array(

			"dataperpage"		=> $dataperpage, // a lot of data from pages
			"offset"			=> $offset, // initial data limit
			"page"				=> $page, // page active number
			"keyword"			=> $keyword, // kewordd query search

		);
		
		/**
		* returns the process results of json type
		* @return array, json, string (mixed)
		*/
		return json_decode(json_encode($data));
	}

}

/* ------------------------------------------------------------------------------------- */

if(!function_exists("getTableQuery")){

	/**
	 * Selecting the mysql query command that will be executed
	 *
	 * the task is to select the query command which is 
	 * responsible for performing query operations for the 
	 * t_order table and also the t_event table
	 *
	 * @uses getPaging function
	 * @return	mixed => array which contains a string
	 */

	function getTableQuery(){

		// parmater datatables are used to display a list of management tickets
		// which method of reading uses url which is separated by boundary sign /
		// EX : /data1/data2/data3
		// splice(1) is data1, splice(2) is data 2, etc

		// if the keyword is empty
		if(!empty(getPaging()->keyword)){

			// if slice 1 is datatables
			if(splice(1) == "datatables"){

				// it's important to choose the whole data 
				$data['select1'] = "SELECT * FROM t_event WHERE 
										title like '%".getPaging()->keyword."%' or 
										description like '%".getPaging()->keyword."%' or 
										location like '%".getPaging()->keyword."%' or 
										address like '%".getPaging()->keyword."%' or 
										price like '%".getPaging()->keyword."%' 
										ORDER BY id DESC";

				// it's important to choose data based on keywords
				$data['select2'] = "SELECT * FROM t_event WHERE 
										title like '%".getPaging()->keyword."%' or 
										description like '%".getPaging()->keyword."%' or 
										location like '%".getPaging()->keyword."%' or 
										address like '%".getPaging()->keyword."%' or 
										price like '%".getPaging()->keyword."%' 
										ORDER BY id DESC 
										LIMIT ".getPaging()->offset.",".getPaging()->dataperpage;


			// if slice 1 is datatables2										
			}else if(splice(1) == "datatables2"){

				// to differentiate booking_id search with payment_code, 
				// where the payment code only has 3 digits of character 
				// while the booking id exceeds 3 digits

				// detect that the payment code is sought
				if(strlen(getPaging()->keyword) <= 3){

					$command = "payment_code like '%".getPaging()->keyword."%'";


				// detect that the booking id is sought
				}else{

					$command = "booking_id like '%".getPaging()->keyword."%' or 
								email like '%".getPaging()->keyword."%'";

				}

				// it's important to choose the whole data 
				$data['select1'] = "SELECT * FROM t_order WHERE $command ORDER BY order_time DESC";

				// it's important to choose data based on keywords
				$data['select2'] = "SELECT * FROM t_order WHERE $command
									ORDER BY order_time DESC 
									LIMIT ".getPaging()->offset.",".getPaging()->dataperpage;

			// if slice 1 is datatables3
			}else{

				// it's important to choose the whole data 
				$data['select1'] = "SELECT * FROM t_msgs WHERE 
										nama like '%".getPaging()->keyword."%' or 
										email like '%".getPaging()->keyword."%' or 
										msg like '%".getPaging()->keyword."%'
										ORDER BY id DESC";

				// it's important to choose data based on keywords
				$data['select2'] = "SELECT * FROM t_msgs WHERE 
										nama like '%".getPaging()->keyword."%' or 
										email like '%".getPaging()->keyword."%' or 
										msg like '%".getPaging()->keyword."%'
										ORDER BY id DESC 
										LIMIT ".getPaging()->offset.",".getPaging()->dataperpage;

			}
		

		// if the keyword isn't empty			
		}else{

			// if slice 1 is datatables
			if(splice(1) == "datatables"){

				// it's important to choose the whole data 
				$data['select1'] = "SELECT * FROM t_event ORDER BY id DESC";

				// it's important to choose data based on keywords
				$data['select2'] = "SELECT * FROM t_event ORDER BY id DESC 
							LIMIT ".getPaging()->offset.",".getPaging()->dataperpage;


			// if slice 1 is datatables2
			}else if(splice(1) == "datatables2"){

				// it's important to choose the whole data 
				$data['select1'] = "SELECT * FROM t_order ORDER BY order_time DESC";

				// it's important to choose data based on keywords
				$data['select2'] = "SELECT * FROM t_order ORDER BY order_time DESC 
							LIMIT ".getPaging()->offset.",".getPaging()->dataperpage;

			// if slice 1 is datatables3
			}else{

				// it's important to choose the whole data 
				$data['select1'] = "SELECT * FROM t_msgs ORDER BY id DESC";

				// it's important to choose data based on keywords
				$data['select2'] = "SELECT * FROM t_msgs ORDER BY id DESC 
							LIMIT ".getPaging()->offset.",".getPaging()->dataperpage;

			}

		}

		/**
		* returns the process results of json type
		* @return array, json, string (mixed)
		*/
		return json_decode(json_encode($data));

	}

}

/* ------------------------------------------------------------------------------------- */

if(!function_exists("getSetting")){

	/**
	 * get website settings data
	 *
	 * @return	mixed => array which contains a string
	 */

	function getSetting(){

		// query to select data in the t_user table
		$query =  database()->Query("SELECT * FROM t_user");

		// show the query result
		$show = $query->fetch();

		// loop result and create a new array
		foreach($show as $key => $val){

			$data[$key] = $val;

		}

		// query to select data in the t_conf user
		$query = database()->Query("SELECT * FROM t_conf ORDER BY id ASC");

		// loop the query result and creat a new array
		while($show = $query->fetch()){

			$data[$show['name']] = $show['value'];

		}

		/**
		* returns the process results of json type
		* @return array, json, string (mixed)
		*/
		return json_decode(json_encode($data));

	}

}

/* ------------------------------------------------------------------------------------- */

if(!function_exists("dashboard")){

	/**
	 * get a summary of information from ticket sales
	 *
	 * the data obtained will be presented on the dashboard page of the adminpanel
	 *
	 * @return	mixed => array which contains a string
	 */

	function dashboard(){

	/**
	* get overall order data
	* --------------------------------------------------------------------
	*/

		// query to select data in the t_order table
		$query_total = database()->Query("SELECT * FROM t_order ORDER BY order_time DESC");

		// show query result
		$show = $query_total->fetch();

		// set data result
		$order['total'] = $query_total->rowCount();

		// set update timestamp
		if($show['order_time'] == "0") $time = time();
		else $time = $show['order_time'];
		$order['total_time'] = timeHistory($time);


	/**
	* get payment information complete
	* --------------------------------------------------------------------
	*/

		// query to select data in the t_order table
		$query_total = database()->Query("SELECT * FROM t_order WHERE payment_status='1'  ORDER BY order_time DESC");

		// show query result
		$show = $query_total->fetch();

		// set data result
		$order['complete'] = $query_total->rowCount();

		// set update timestamp
		if($show['pay_time'] == "0") $time = time();
		else $time = $show['pay_time'];
		$order['complete_time'] = timeHistory($time);


	/**
	* get pending payment information
	* --------------------------------------------------------------------
	*/

		// query to select data in the t_order table
		$query_total = database()->Query("SELECT * FROM t_order WHERE payment_status='0'  ORDER BY order_time DESC");

		// show query result
		$show = $query_total->fetch();

		// set data result
		$order['pending'] = $query_total->rowCount();

		// set update timestamp
		if($show['order_time'] == "0") $time = time();
		else $time = $show['order_time'];
		$order['pending_time'] = timeHistory($time);


	/**
	* get financial data
	* --------------------------------------------------------------------
	*/

		// variable to save calculation of income estimates
		$money = 0;

		// query to select data in the t_order table
		$count_money = database()->Query("SELECT * FROM t_order WHERE payment_status='1' ");

		// loop query result 
		while($show = $count_money->fetch()){

			// query to select data in the t_event table
			$get_event = database()->Query("SELECT * FROM t_event WHERE id='".$show['event_type']."' ");

			// show query result
			$get_event = $get_event->fetch();

			// income accumulation
			$money += $get_event['price'];

		}

		// set data result
		$order['price'] = $money;

		// set update timestamp
		$order['price_time'] = $order['pending_time'];

		/**
		* returns the process results of json type
		* @return array, json, string (mixed)
		*/
		return json_decode(json_encode($order));

	}

}

/* ------------------------------------------------------------------------------------- */

if(!function_exists("getNotif")){

	/**
	 * get the latest information about the purchase request
	 * 
	 * @param $option = 1 or 0
	 * @return	string
	 */

	function getNotif($option = null){

		// query to select data in the t_logs table
		$query = database()->Query("SELECT * FROM t_logs WHERE status='0' ORDER BY id DESC");

		// count record from selecting
		$count_q1 = $query->rowCount();

		// query to select data in the t_msgs tabl
		$query = database()->Query("SELECT * FROM t_msgs WHERE status='0' ORDER BY id DESC");

		// count record from selecting
		$count_q2 = $query->rowCount();


		/**
		* returns the process results of string data
		* @return string, boolean
		*/

		if($option == 1){
			
			if($count_q1 == 0) return 1;
			else return 0;
		
		}else{

			if($count_q2 == 0) return 1;
			else return 0;
		}


	}

}


/* ------------------------------------------------------------------------------------- */

if(!function_exists("checkLogin")){

	/**
	 * detect login session
	 * 
	 * @param $_SESSION['login_status']
	 * @return	void
	 */

	function checkLogin(){

		// if the variable $_SESSION['login_status'] is detected
		// indicates that a login is happening
		if(isset($_SESSION['login_status'])){

			// if $ _SESSION['login_status'] is true
			if($_SESSION['login_status'] == true){

				// jika splice 2 is login
				if(splice(2) == "login"){

					// redirect to dashboard page
					header("location:".HomeUrl()."/adminpanel/dashboard");

					exit;

				}

			// // if $ _SESSION['login_status'] isn't true
			// indicates that a login isn't happening
			// then a new variable will be formed named response
			}else $response = false;

		// if the variable $_SESSION['login_status'] isn't detected\
		// indicates that a login isn't happening
		// then a new variable will be formed named response
		}else $response = false;


		// follow-up of the printed response variable
		if(isset($response)){

			// that this code will be executed if splice 2 is not worth login
			if(splice(2) !== "login"){
				
				// redirect to login page
				header("location:".HomeUrl()."/adminpanel/login");

				exit;
			}
		}
	}
}

/* ------------------------------------------------------------------------------------- */

if(!function_exists("getTheme")){

	/**
	 * get active theme
	 * 
	 * @return	mixed
	 */

	function getTheme(){

		// select activer theme from table t_themes from mysql database
		$query = database()->Query("SELECT * FROM t_theme WHERE status='1' ");

		// sum selected record
		$sum_record = $query->rowCount();

		// show query result
		$show = $query->fetch();

		// if no active theme
		if($sum_record == 0){

			return false;

		}

		// if active theme is found
		$data = array(
			"name"	=> $show['name'],
			"path"	=> $show['path'],
			"status"=> $show['status']
		);

		/**
		* returns the process results of string data
		* @return string, boolean
		*/

		return  json_decode(json_encode($data));

	}

}

/* ------------------------------------------------------------------------------------- */

if(!function_exists("getThemeText")){

	/**
	 * get text content for themes from data.json
	 * in based theme directory
	 * 
	 * @return	mixed
	 */

	function getThemeText(){

		// if the theme is active
		if(getTheme() !== false){

			// get file config 
			$path = projectDir()."/".getTheme()->path."data.json";

			// rebuilt file config to json type
			$get_config = implode(null,file($path));


			/**
			* returns the process results of json type
			* @return array, json, string (mixed)
			*/

			return json_decode($get_config);
		
		// if no one theme active
		}else return false;

	}

}

/* ------------------------------------------------------------------------------------- */

if(!function_exists("getActiveMenu")){

	/**
	 * Set background color for active menu
	 * 
	 * @return	string
	 */

	function getActiveMenu($data = null){

		if(!empty($data)){

			if(splice(2) == $data){

				return "style='background: #b9def0'";

			}elseif(empty(splice(2))) {

				if($data == "dashboard"){

					return "style='background: #b9def0'";
				
				}

			}

		}

	}

}
