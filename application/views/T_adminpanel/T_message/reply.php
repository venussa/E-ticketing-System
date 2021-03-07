<?php

if(isset($_GET['id'])){

	$query = database()->Query("SELECT * FROM t_msgs WHERE id='".$_GET['id']."' "); 
	$show = $query->fetch();

?>
<form data="<?php echo $show['id']?>" method="POST" action="<?php echo HomeUrl()."/handler"?>" onSubmit="return reply_msg(this)" class="panel form-setting">
		<table width="100%" class="tables">
			<tr>
				<td class="column-name">
					<b>Nama</b>
					<p>* Nama pengirim pesan</p>
				</td>
				<td>
					<input type="text" name="nama" class="form-control" value="<?php echo $show['nama']?>" readonly="true">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Email</b>
					<p>* Email pengirim pesan</p>
				</td>
				<td>
					<input type="temail" name="email" class="form-control" value="<?php echo $show['email']?>" readonly="true">
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Pesan</b>
					<p>* Pesan yang dikirim</p>
				</td>
				<td>
					<textarea readonly="true" class="form-control" ><?php echo htmlspecialchars($show['msg'])?></textarea>
				</td>
			</tr>

			<tr>
				<td class="column-name">
					<b>Balas</b>
					<p>* Masukkan pesan balasan anda</p>
				</td>
				<td>
					<textarea name="pesan" class="form-control" ></textarea>
				</td>
			</tr>

			<tr>
				<td class="column-name"></td>
				<td >
					<input type="text" name="action" value="9" style="display: none;">
					<input type="text" name="id" value="<?php echo $_GET['id']?>" style="display: none;">
					<button type="button" class="btn btn-default" onClick="return add_form_reply(this)">Batal</button>
					<button type="submit" class="btn btn-info btn-reply">Balas</button>
				</td>
			</tr>
			
		</table>
	</form>

<?php } ?>