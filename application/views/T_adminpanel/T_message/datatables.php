<?php checkLogin() ?>

<div class="widget-content">

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width: 25px;">No</th>
				<th style="width: 250px;">Informasi Pengirim</th>
				<th >#</th>
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

			?>

				<tr class="list-<?php echo $show['id']?>">

					<td><?php echo $number ?></td>
					<td>
						<p style="color:#666;font-size: 15px">
							<b><?php echo $show['nama']?></b></p>

						<p style="color:#666;font-size: 13px;">
							<?php echo $show['email']?></p>

						<p style="color:orangered;font-size: 10px;">
							<?php echo date("d M Y, H:i:s",$show['send_time'])?></p>
						<?php if($show['status'] == "0"){ ?>
						<p class="label-<?php echo $show['id']?>"><span class="label label-warning">Not Replied</span></p>	
						<?php }else{ ?>
						<p class="label-<?php echo $show['id']?>"><span class="label label-success">Replied</span></p>	
						<?php } ?>	
					</td>

					<td>
						<p><b>Pesan : </b><br><?php echo ($show['msg'])?> <button data="<?php echo $show['id']?>" onClick="return add_form_reply(this)" style="border:1px #ddd solid;border-radius: 3px;padding: 3px;"><img src="<?php echo getIcon()->reply?>" width="30"></button></p>

						<?php if(!empty(trim($show['reply']))){?>
						<p><b>Balasan : </b><br><?php echo htmlspecialchars($show['reply'])?></p>
						<?php } ?>
						
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