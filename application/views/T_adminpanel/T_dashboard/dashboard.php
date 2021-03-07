<?php $dashboard = dashboard() ?>
<div class="col-md-12" >

	<p class="page-label">
		<img src="<?php echo getIcon()->home?>"  width="25"> 
		<span>adminpanel / dashboard</span>
	</p>

	<p class="alert alert-default" style="border:1px #ddd solid;">Selamat Datang di aplikasi penjualan ticket online</p>

</div>
<div class="col-md-3">
	<div class="panel">
		<div class="panel-heading bg-default">
			<p style="font-size: 40px;"><?php echo $dashboard->total?></p>
			<p>Order total</p>
			<img style="float: right;margin-top:-95px;" src="<?php echo getIcon()->order?>" width="80" height="80">
		</div>
		<div class="panel-body" style="padding: 10px;font-size: 12px;color:#666;">
			Update <?php echo $dashboard->total_time?>
		</div>
		
	</div>
</div>
		

<div class="col-md-3">
	<div class="panel">
		<div class="panel-heading bg-info">
			<p style="font-size: 40px;color:#f5f5f5"><?php echo $dashboard->complete?></p>
			<p style="color:#f5f5f5">Order Completed</p>
			<img style="float: right;margin-top:-95px;" src="<?php echo getIcon()->complete?>" width="80" height="70">
		</div>
		<div class="panel-body" style="padding: 10px;font-size: 12px;color:#666;">
			Update <?php echo $dashboard->complete_time?>
		</div>
	</div>
</div>
		
<div class="col-md-3">
	<div class="panel">
		<div class="panel-heading bg-warning">
			<p style="font-size: 40px;color:#f5f5f5"><?php echo $dashboard->pending?></p>
			<p style="color:#f5f5f5">Pending Orders</p>
			<img style="float: right;margin-top:-90px;" src="<?php echo getIcon()->pending?>" width="60">
		</div>
		<div class="panel-body" style="padding: 10px;font-size: 12px;color:#666;">
			Update <?php echo $dashboard->pending_time?>
		</div>
	</div>
</div>
		
<div class="col-md-3">
	<div class="panel">
		<div class="panel-heading bg-success">
			<p style="font-size: 18px;color:#f5f5f5;margin-top: 15px;">Rp <?php echo number_format($dashboard->price)?></p>
			<p style="color:#f5f5f5;margin-top:22px;">Entry Balance</p>
			<img style="float: right;margin-top:-90px;" src="<?php echo getIcon()->balance?>" width="75">
		</div>
		<div class="panel-body" style="padding: 10px;font-size: 12px;color:#666;">
			Update <?php echo $dashboard->price_time?>
		</div>
	</div>
</div>
