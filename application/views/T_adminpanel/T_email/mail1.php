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
	.submit{
		background: #fff;border:1px #09f solid;border-radius: 10px;padding:10px;color:#09f;
		-webkit-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		-moz-box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		box-shadow: -1px 0px 8px -4px rgba(0,0,0,0.75);
		font-weight:600;
		cursor: pointer;
	}

</style>
</head>
<body>

	<div class="container">
	<h2 style="color:#f5f5f5">Order Berhasil di Tambahkan</h2>
	<p style="color:#f5f5f5"><b>Hai <?php echo $_POST['nama']?></b></p>
	<p style="color:#f5f5f5">Order tiket untuk event <b><?php echo $show['title']?></b> dengan Kode pembayaran <b><?php echo $payment_code?></b> berhasil di tambahkan. Total tagihan sebesar <b>Rp <?php echo number_format(($show['price']+$payment_code))?></b>. Segera lakukan pembayaran dalam kurun waktu 1 x 24 Jam.</p>

	<p class="title" style="width: 300px;"><b>Informasi Rekening Untuk Pembayaran</b></p>

	<hr class="line" />
	<br>
	<div class="content">
	<table width="100%">
		<tr>
			<td style="width: 150px;color:#777">Atas Nama</td>
			<td style="font-weight:600;color:#666">: <?php echo getSetting()->rek_name?></td>
		</tr>
		<tr>
			<td style="width: 150px;color:#777">No. Rekening</td>
			<td style="font-weight:600;color:#666">: <?php echo getSetting()->no_rek?></td>
		</tr>
		<tr>
			<td style="width: 150px;color:#777">Bank Terkait</td>
			<td style="font-weight:600;color:#666">: <?php echo getSetting()->bank_name?></td>
		</tr>
		<tr>
			<td style="width: 150px;color:#777">Kode Bank</td>
			<td style="font-weight:600;color:#666">: <?php echo getSetting()->bank_code?></td>
		</tr>
	</table>
</div>

	<p class="title" style="width: 200px;"><b>Informasi Pembelian Tiket</b></p>

<hr class="line" />
	<br>
	<div class="content">
	<table width="100%">
		<tr>
			<td style="width: 150px;color:#777">Kode Booking</td>
			<td style="font-weight:600;color:#666">: #<?php echo $booking_id?></td>
		</tr>

		<tr>
			<td style="width: 150px;color:#777">Event</td>
			<td style="font-weight:600;color:#666">: <?php echo $show['title']?></td>
		</tr>
		<tr>
			<td style="width: 150px;color:#777">Lokasi</td>
			<td style="font-weight:600;color:#666">: <?php echo $show['location']?></td>
		</tr>
		<tr>
			<td style="width: 150px;color:#777">Alamat</td>
			<td style="font-weight:600;color:#666">: <?php echo $show['address']?></td>
		</tr>

		<tr>
			<td style="width: 150px;color:#777">Waktu Acara</td>
			<td style="font-weight:600;color:#666">: <?php echo date("d M Y, H:i",$show['date_event'])?> WIB
			</td>
		</tr>

	
		<tr>
			<td style="width: 150px;color:#777">Harga Ticket</td>
			<td style="font-weight:600;color:#666">: Rp <?php echo number_format($show['price'])?></td>
		</tr>
			<tr>
			<td style="width: 150px;color:#777">Kode Pembayaran</td>
			<td style="font-weight:600;color:#666">: <?php echo $payment_code?></td>
		</tr>
		<tr>
			<td style="width: 150px;color:#777">Order Pada</td>
			<td style="font-weight:600;color:#666">: <?php echo date("d M Y, H:i",$order_time)?> WIB
			</td>
		</tr>
		</tr>
			<tr>
			<td style="width: 150px;color:#777">Total</td>
			<td style="font-weight:600;color:#666">: Rp <?php echo number_format(($show['price']+$payment_code))?></td>
		</tr>
	
	</table>

</div>
<br>
<hr class="line" />
	<center style="margin-top:10px;">
	<a href="<?php echo HomeUrl()."/payment-proof/".encrypt($_POST['nama'])."/".encrypt($_POST['email'])?>"><button class="submit">Upload Bukti Transfer</button></a><br>
	<span style="font-size:13px;color:#f5f5f5"><i>Click untuk mengkonfirmasi bukti transfer</i></span>
	</center>
<br>
<hr class="line" />
	<p style="color:#f5f5f5">Jika kamu mengalami kendala dalam pembayaran, silahkan hubungi kami pada menu contact pada website kami. Untuk mempercepat proses verifikasi pembayaran, kamu juga bisa mengkonfirmasinya dengan mengirim pesan kepada kami pada menu contact di website kami. dengan menyertakan kode booking dan kode pembayaran yang anda terima di email.</p>

	<span style="font-size:13px;color:#f5f5f5"><i>( * Pastikan nominal pembayaran yang kamu input sama seperti nominal yang kami beritahukan, karena 3 digit terakhir dari nominal pembayaran kamu adalah sebagai kode unik untuk mempercepat proses verifikasi pembayaran kamu )</i></span>
</div>
</body>
</html>