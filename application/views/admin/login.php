<html>

<head>
	<title>Kecamatan Jekan Raya</title>
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('uploads/images/logo_pky.gif') ?>">
	<link rel="icon" href="<?php echo base_url('assets/admin/image/trophy.png'); ?>" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo base_url('assets/login/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/login/css/auth.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/login/font/css/font-awesome.min.css'); ?>">
	<script src="<?php echo base_url('assets/login/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/login/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/login/js/validator.min.js'); ?>"></script>
</head>

<body>
	<div class="login">
		<div class="title-login">
			<h1>Kecamatan Jekan Raya</h1>
		</div>
		<div class="form-login">
			<form data-toggle="validator" role="form" method="post"
				action="<?php echo base_url('user/authenticate'); ?>">
				<div class="form-group form-group-lg">
					<label for="inputUsername" class="control-label">Username</label>
					<input type="text" class="form-control" id="inputUsername" name="username" required>
				</div>
				<div class="form-group form-group-lg">
					<label for="inputPassword" class="control-label">Password</label>
					<input type="password" class="form-control" id="inputPassword" name="password" required>
				</div>
				<button type="submit" class="btn btn-lg btn-hijau">Login</button>
			</form>
		</div>
		<?php
		if ($this->session->flashdata('error')) {
		?>
			<div class="failed-login">
				<?php echo $this->session->flashdata('error'); ?>
			</div>
		<?php
		} else {
		?>
			<div class="footer-login">
				Crafted with <i class="fa fa-heart fa-fw" aria-hidden="true" style="color:#e91e63"></i> in Palangka Raya
				<br>
				<center>
					<p>Created By <a href='' title='StokCoding.com' target='_blank'>Regalito De Dios Saputra Malo</a>
					</p>
				</center>

			</div>

		<?php
		}
		?>
	</div>
</body>


</html>