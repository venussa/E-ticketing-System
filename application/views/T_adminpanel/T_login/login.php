
			<img class="img-background" src="<?php echo HomeUrl()?>/T_assets/img/background.jpg">
			
			<div class="container">
				
				<div class="col-md-12 col-lg-12 col-sm-12 hidden-xs margin-login"></div>
				<div class="col-xs-12 hidden-md" style="height: 50px;"></div>

				<div class="col-md-4 col-xs-12 col-md-offset-4">
					<form method="POST" onSubmit="return login(this)" action="<?php echo HomeUrl()."/handler"?>">
						<div class="panel panel-deafult panel-login">
							<div class="panel-body">
								<h2 class="login-title">Admin Login</h2>
								<input type="text" name="action" value="8" style="display: none;">
								<p class="login-description">Mohon Masukkan Username dan Password</p>
								<input type="text" class="form-control input-box" name="username" placeholder="Username" autocomplete="off">
								<input type="password" class="form-control input-box" name="password" placeholder="Password" required>
								<div class="alert alert-warning user" style="display: none;">Username Salah</div>
								<div class="alert alert-danger pass" style="display: none;">Password Salah</div>
								<div class="alert alert-info success" style="display: none;">Berhasil Login, Mengalihkan ...</div>
								<button class="btn btn-warning btn-width">Login</button>
							</div>
						</div>
					</form>
				</div>

			</div>

			<p class="dev-copy">Dev By : IamRoot Team</p>
		