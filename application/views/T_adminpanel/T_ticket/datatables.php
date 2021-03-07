<?php checkLogin() ?>

<div class="widget-content">

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width: 25px;">No</th>
				<th style="width: 350px;">Informasi Acara</th>
				<th style="width: 250px;">Lokasi</th>
				<th style="width: 150px;">Kuota</th>
				<th style="width: 150px;">Harga</th>
				<th class="td-actions" >#</th>
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

			$sold_count = database()->Query("SELECT * FROM t_order WHERE event_type='".$show['id']."' and payment_status='1' ");

			$ticket_left = ($show['kuota'] - $sold_count->rowCount());
			$income = number_format(($sold_count->rowCount() * $show['price']));

				?>

				<tr class="list-<?php echo $show['id']?>">

					<td><?php echo $number ?></td>

					<td>
						<p><b><?php echo $show['title']?></b></p>

						<p style="color:#666;font-size: 12px"><i>"<?php echo $show['description']?>"</i></p>

						<p style="color:orangered;font-size: 11px"><i><?php echo date("d M Y, H:i:s",$show['date_event'])?></i></p>	
					</td>

					<td>
						<p><b><?php echo $show['location']?></b></p>

						<p><?php echo $show['address']?></p>
					</td>

					<td>
						<p><b>Total</b></p>

						<p style="font-size: 11px;margin-top:-5px;"><i><?php echo $show['kuota']?> Orang</i></p>

						<p><b>Tersisa</b></p>

						<p style="font-size: 11px;margin-top:-5px;"><i><?php echo $ticket_left?> Ticket</i></p>
					</td>

					<td>
						<p><b>Harga</b></p>
						<p><?php echo "Rp ".number_format($show['price'])?></p>
						<p><b>Total Pemasukan</b></p>
						<p><?php echo "Rp ".($income)?></p>

					</td>

					<td>
					
					<?php

						if($show['status_event'] == "1"){

							$status = "on";
							$pos = "margin-left:0px;";

						}else{

							$status = "on";
							$pos = "margin-left:-50px;";

						}

					?>

					<p><b>Status Jual</b></p>

						<div class="switch">
							<img url="<?php echo HomeUrl()?>" data="<?php echo $show['id'] ?>" status="<?php echo $status?>" onClick="return ticket_status(this)" src="<?php echo getIcon()->switch?>" width="118" style="cursor:pointer;<?php echo $pos?>">
						</div>

					<p><br><b>Hapus</b></p>

						<p onClick="return hapus(<?php echo $show['id']?>,<?php echo getPaging()->page?>)" class="dell-button">
							<img src="<?php echo HomeUrl()?>/T_assets/img/trash.png" width="20">
							<span style="margin-left:10px;">Hapus</span>
						</p>
					
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