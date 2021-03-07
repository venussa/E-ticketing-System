<?php checkLogin() ?>

<div class="widget-content">

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width: 25px;">No</th>
				<th style="width: 350px;">Buyer Info</th>
				<th style="width: 350px;">Booking Info</th>
				<th style="width: 150px;">Status</th>
			</tr>
		</thead>

		<tbody>
			<?php

			$query_count = database()->Query(getTableQuery()->select1)->rowCount();

			$query_fetch = database()->Query(getTableQuery()->select2);

			$query_fetch_count = $query_fetch->rowCount();

			$start_list_number = getPaging()->page * getPaging()->dataperpage;
			$start_list_number = $start_list_number - getPaging()->dataperpage + 1;

			$end_list_number = $query_fetch_count + $start_list_number - 1;

			$number  = $start_list_number;


			if($query_count !== 0){

			while($show = $query_fetch->fetch()){ 

			$event_name = database()->Query("SELECT title,description,date_event FROM t_event WHERE id='".$show['event_type']."' ");
			$event_name = $event_name->fetch();

			?>

				<tr class="list-<?php echo $show['booking_id']?>">

					<td><?php echo $number ?></td>
					<td>
						<p><b><?php echo $show['name']?></b></p>
						<p style="color:#666;font-size: 12px">
							<b>Alamat : </b>
							<i><?php echo $show['address']?></i></p>

						<p style="color:#666;font-size: 12px">
							<b>Contact : </b>
							<i><?php echo $show['no_tlp']?></i></p>

						<p style="color:orangered;font-size: 12px"><i><?php echo date("d M Y, H:i:s",$show['order_time'])." <span style='color:#777;font-size:10px;'>(".timeHistory($show['order_time']).")</span>"?></i></p>

						<p class="alert alert-info" style="font-size: 14px"><b>Acara : </b><i><?php echo $event_name['title']?></i></p>	

							
					</td>

					<td>
						
						<p><b>Booking ID</b> : <br><?php echo $show['booking_id']?>

						<?php if($show['check_in'] == "0") { ?>
							<span class="label label-warning" style="margin-left:10px;">Not Check In</span>
						<?php }else{?>
							<span class="label label-success" style="margin-left:10px;">Check In</span>
						<?php } ?>
						
					</p>
						<p><b>Order Pada</b> : <br><?php echo date("d M Y, H:i:s",$show['order_time'])?></p>
						<p><b>Email Order</b> : <br><?php echo $show['email']?></p>	
						<p><b>Payment Code</b> : <br><?php echo $show['payment_code']?></p>	

					</td>

					<td>
					
					<?php

						if($show['payment_status'] == "1"){

							$status = "on";
							$pos = "margin-left:0px;";
							$msg = "Sudah Dibayar";

						}else{

							$status = "on";
							$pos = "margin-left:-50px;";
							$msg = "Belum Dibayar";

						}

					?>

					<p><b id="status-<?php echo $show['booking_id']?>"><?php echo $msg?></b></p>

						<div class="switch">
							<img url="<?php echo HomeUrl()?>" data="<?php echo $show['booking_id'] ?>" status="<?php echo $status?>" onClick="return pay_status(this)" src="<?php echo getIcon()->switch?>" width="118" style="cursor:pointer;<?php echo $pos?>">
						</div>

						<p style="font-size: 11px;color:orangered;margin-top:10px;"><i>* Pastikan bahwa pembeli telah benar-benar membayar</i></p>
					
					</td>
				</tr>

			<?php $number++; } 

			}else{

			?>

				<tr>
					<td colspan="6" style="text-align: center;padding: 10px;">Data Not Found</td>
				</tr>

			<?php } ?>
			
				
			
			</tbody>
		</table>

		<p class="paging-pos">
			Showing <?php echo $start_list_number?> 
			to <?php echo $end_list_number ?> 
			Of <?php echo $query_count?> Entries
		<p>
	
	<div class="paging-list-info">
		
		<?php 

		echo pagination(

			getPaging()->page, // active oage
			getPaging()->dataperpage, // list data per page
			$query_count, // total data
			HomeUrl().'/adminpanel/add-ticket/', // url pagination
			"pagination", // <u class
			null, // <li class
			null, // <a href class
			null, // pjax-attribute
			'active', // active page class
			'onClick="return load_table(this)"' // other attribute

		)?>
		
	</div>

</div>