<form method="POST" action="<?php echo HomeUrl()."/handler"?>" onSubmit="return save_ticket(this)" class="panel form-setting" enctype="multipart/form-data">

	<input type="file" id="poster" name="poster" style="display: none;" required="true" onChange="return readURL(this)">
	
	

		<table width="100%" class="tables">
			<tr>
				<td class="column-name">
					<b>Poster</b>
					<p>* Masukkan Gambar Poster</p>
				</td>
				<td>
					<div style="width: 200px;text-align: center;">
						<div class="panel panel-default">
							<img data="poster" class="preview-poster" src="<?php echo getIcon()->galery?>" width="100%" onClick="return select_img(this)">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="column-name">
					<b>Title</b>
					<p>* Nama Acara</p>
				</td>
				<td>
					<input type="text" name="title" class="form-control">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Description</b>
					<p>* Keterangan singkat acara</p>
				</td>
				<td>
					<textarea name="description" class="form-control"></textarea>
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Location</b>
					<p>* lokasi acara</p>
				</td>
				<td>
					<input type="text" name="location" class="form-control">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Address</b>
					<p>* Alamat acara</p>
				</td>
				<td>
					<input type="text" name="address" class="form-control">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Kuota</b>
					<p>* jumlah maksimal ticket yang dijual</p>
				</td>
				<td>
					<input type="text" name="kuota" class="form-control">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Price</b>
					<p>* Harga tiket</p>
				</td>
				<td>
					<input type="text" name="price" class="form-control">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Date</b>
					<p>* Tanggal Pelaksanaan</p>
				</td>
				<td>
					<input type="text" name="date" class="form-control datepicker">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Time</b>
					<p>* Waktu pelaksanaan</p>
				</td>
				<td>
					<input type="text" name="time" class="form-control timepicker">
				</td>
			</tr>
			<tr>
				<td class="column-name"></td>
				<td >
					<input type="text" name="action" value="3" style="display: none;">
					<button type="button" class="btn btn-default" onClick="add_ticket(0)">Batal</button>
					<button type="submit" class="btn btn-info">Tambah Ticket</button>
				</td>
			</tr>
		</table>
	</form>

	<script>load_time()</script>