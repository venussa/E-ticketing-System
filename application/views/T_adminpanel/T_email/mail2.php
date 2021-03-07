<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Heebo&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

	*{
		font-family: 'Heebo', sans-serif;
		
	}
	td{
		padding:10px;
	}

	.title{
		padding: 10px;
		margin-top:30px;
		background: #fff;
		width: 120px;
		border-radius: 10px;
		color:#09f;
		-webkit-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		-moz-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		
	}
	
	@media only screen and (min-width: 768px) {

	.container{
		border:1px #ddd solid;
		padding: 20px;
		border-radius: 5px;
		width: 70%;
		margin-left:15%;
		background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%);
	}

	}

	@media only screen and (max-width: 768px) {
		.container{
		border:1px #ddd solid;
		padding: 20px;
		border-radius: 5px;
		width: 100%;
		background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%);
	}
	}

	.content{
		background: #fff;
		border-radius: 10px;
		-webkit-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		-moz-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		padding:20px;
	}

	.line{
		border:transparent;
		border-bottom:2px #f5f5f5 dashed;
		-webkit-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		-moz-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
	}

	.QR{
		border: 1px #ddd solid;
		padding:25px;
		border-radius: 10px;
		background: #fff;
		-webkit-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		-moz-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
	}

</style>
</head>
<body>
	<div class="container">
	<h2 style="color: #f5f5f5">Pembayaran Kamu Sudah Diverifikasi</h2>
	<p style="color: #f5f5f5"><b>Hai <?php echo $show['name']?></b></p>
	<p style="color: #f5f5f5">Pembayaran kamu dengan kode boking <b>#<?php echo $show['booking_id']?></b> dan kode pembayaran <b><?php echo $show['payment_code']?></b> sudah berhasil terverifikasi.</p>
	<p class="title"><b>Payment Detail</b></p>
	<hr class="line" />
	<div style="text-align: center;padding: 20px;">
	<button class="QR"><?php 
	        createQR($show['booking_id'],200,200,$show['booking_id'],projectDir()."/T_assets/img/QR/");
	        echo "<img src='".HomeUrl()."/T_assets/img/QR/".$show['booking_id'].".png' width='200' height='200'>";
	        ?></button>
	</div>
<hr class="line" />
	<br>
	<div class="content">
	<table width="100%">
		<tr>
			<td style="width:150px;color:#777">Kode Booking</td>
			<td style="font-weight:600;color:#666">: #<?php echo $show['booking_id']?></td>
		</tr>

		<tr>
			<td style="width:150px;color:#777">Event</td>
			<td style="font-weight:600;color:#666">: <?php echo $event['title']?></td>
		</tr>
		<tr>
			<td style="width:150px;color:#777">Lokasi</td>
			<td style="font-weight:600;color:#666">: <?php echo $event['location']?>
			</td>
		</tr>
		<tr>
			<td style="width:150px;color:#777">Alamat</td>
			<td style="font-weight:600;color:#666">: <?php echo $event['address']?>
			</td>
		</tr>

		<tr>
			<td style="width:150px;color:#777">Waktu Acara</td>
			<td style="font-weight:600;color:#666">: <?php echo date("d M Y, H:i",$event['date_event'])?> WIB
			</td>
		</tr>

	
			<tr>
			<td style="width:150px;color:#777">Harga Ticket</td>
			<td style="font-weight:600;color:#666">: Rp <?php echo number_format($event['price'])?></td>
		</tr>
			<tr>
			<td style="width:150px;color:#777">Kode Pembayaran</td>
			<td style="font-weight:600;color:#666">: <?php echo $show['payment_code']?></td>
		</tr>
		</tr>
			<tr>
			<td style="width:150px;color:#777">Total</td>
			<td style="font-weight:600;color:#666">: Rp <?php echo number_format(($event['price']+$show['payment_code']))?></td>
		</tr>
	
	</table>
</div>
<br>
	<hr class="line" />
	<p style="color:#f5f5f5">Perlihatkan email ini pada saat proses check-in nantinya sebagi bukti pembelian tiket anda. Jika ada hal yang ingin di tanyakan, silahkan hubungi kami pada menu contact pada website kami</p>
</div>
</body>
</html>