<div class="col-md-12" >

	<p class="page-label">
		<img src="<?php echo getIcon()->home?>"  width="25"> 
		<span>adminpanel / settings</span>
	</p>

	<p>Pastikan informasi yang anda masukkan benar, karena kesalahan data akan mempengaruhi dalam proses pelayanan pembelian ticket<br><br></p>

</div>

<div class="col-md-12">

	<form method="POST" action="<?php echo HomeUrl()."/handler"?>" onSubmit="return save_setting(this)" class="panel form-setting">
		<table width="100%" class="tables">
			<tr>
				<td class="column-name">
					<b>Username</b>
				</td>

				<td>
					<?php echo getSetting()->username?>
				</td>

			</tr>

			<tr>
				<td class="column-name">
					<b>Password Lama</b>
					<p>* Abaikan jika tidak ingin mengganti password admin anda</p>
				</td>
				<td>
					<input type="password" name="oldpass" class="form-control">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Password Baru</b>
					<p>* Abaikan jika tidak ingin mengganti password admin anda</p>
				</td>
				<td>
					<input type="password" name="newpas" class="form-control">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Ulangi Password Baru</b>
					<p>* Abaikan jika tidak ingin mengganti password admin anda</p>
				</td>
				<td>
					<input type="password" name="retype_newpas" class="form-control">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Email</b>
					<p>* Masukan email dengan benar untuk kebutuhan notifikasi</p>
				</td>
				<td>
					<input type="email" name="email" class="form-control" value="<?php echo getSetting()->email?>">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Addrress</b>
					<p>* Masukkan alamat kepengurusan</p>
				</td>
				<td>
					<input type="text" name="address" class="form-control" value="<?php echo getSetting()->address?>">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Phone Number</b>
					<p>* Masukkan nomor telephone yang bisa dihubungi</p>
				</td>
				<td>
					<input type="text" name="phone" class="form-control" value="<?php echo getSetting()->phone?>">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>No. Rekening</b>
					<p>* Nomor tujuan yang digunakan untuk mentransfer dana pembelian ticket</p>
				</td>
				<td>
					<input type="number" name="no_rek" class="form-control" value="<?php echo getSetting()->no_rek?>">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Bank Penyedia</b>
					<p>* Masukan nama bank yang melayani, Ex : BCA, Mandiri, Dll</p>
				</td>
				<td>
					<input type="text" name="bank_name" class="form-control" value="<?php echo getSetting()->bank_name?>">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Nama di Rekening</b>
					<p>* Nama yang terdaftar pada rekening</p>
				</td>
				<td>
					<input type="text" name="rek_name" class="form-control" value="<?php echo getSetting()->rek_name?>">
				</td>
			</tr>
			<tr>
				<td class="column-name">
					<b>Kode Bank</b>
					<p>* Kode unik dari tiap tiap bank</p>
				</td>
				<td>
					<input type="text" name="bank_code" class="form-control" value="<?php echo getSetting()->bank_code?>">
				</td>
			</tr>
			<tr>
				<td class="column-name"></td>
				<td >
					<input type="text" name="action" value="4" style="display: none;">
					<div class="alert alert-warning old" style="display: none;">Old Password Is Wrong</div>
					<div class="alert alert-warning new" style="display: none;">New Password Didn't Match</div>
					<div class="alert alert-danger other" style="display: none;">Failed Save Configuration</div>
					<div class="alert alert-info ook" style="display: none;">Success</div>
					<button class="btn btn-info">Save Setting</button>
				</td>
			</tr>
		</table>
	</form>
</div>