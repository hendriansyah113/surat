<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('layout/master/head.php'); ?>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
	<div class="wrapper">

		<!-- Sidebar -->
		<?php $this->load->view('layout/master/sidebar.php'); ?>
		<!-- End Sidebar -->

		<div class="main">
			<!-- Header Navbar -->
			<?php $this->load->view('layout/master/nav.php'); ?>
			<!-- End Header Navbar -->
			<main class="content">
				<div class="container-fluid">
					<div class="d-sm-block title-page mb-4">
						<h3 class="mb-0"><?= $title ?></h3>
					</div>
					<?php if ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger" role="alert">
							<h6>
								<i class="fa fa-times-circle fs-5"></i>
								Error
							</h6>
							<p class="mb-0"><?php echo $this->session->flashdata('error'); ?></p>
						</div>
					<?php endif; ?>
					<div class="card">
						<div class="card-header">
							<a href="<?= site_url('admin') ?>" class="btn btn-sm btn-info">
								<i class="fa fa-arrow-left"></i>
								Kembali Ke Daftar Akun
							</a>
						</div>
						<form action="<?= site_url('admin/tambah') ?>" method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="username"
												class="form-label <?php echo form_error('username') ? 'text-danger' : ''; ?>">Username
											</label>
											<input type="text" name="username"
												class="form-control <?php echo form_error('username') ? 'is-invalid' : ''; ?>"
												value="<?php echo set_value('username'); ?>" placeholder="username"
												autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('username'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="password"
												class="form-label <?php echo form_error('password') ? 'text-danger' : ''; ?>">Password
											</label>
											<input type="text" name="password"
												class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>"
												value="<?php echo set_value('password'); ?>" placeholder="password"
												autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('password'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-0">
											<label
												class="form-label <?php echo form_error('level') ? 'text-danger' : ''; ?>">Level
											</label>
											<div class="form-check">
												<input type="radio" id="pegawai" name="level" value="pegawai"
													class="form-check-input <?php echo form_error('level') ? 'is-invalid' : ''; ?>"
													<?php echo set_radio('level', 'pegawai'); ?>>
												<label for="pegawai" class="form-check-label">Pegawai</label>
											</div>
											<div class="form-check">
												<input type="radio" id="admin" name="level" value="admin"
													class="form-check-input <?php echo form_error('level') ? 'is-invalid' : ''; ?>"
													<?php echo set_radio('level', 'admin'); ?>>
												<label for="admin" class="form-check-label">Admin</label>
											</div>
											<div class="form-check">
												<input type="radio" id="capil" name="level" value="capil"
													class="form-check-input <?php echo form_error('level') ? 'is-invalid' : ''; ?>"
													<?php echo set_radio('level', 'capil'); ?>>
												<label for="capil" class="form-check-label">Capil</label>
											</div>
											<div class="invalid-feedback">
												<?php echo form_error('level'); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer d-flex align-items-center justify-content-between">
								<button type="submit" name="save" class="btn btn-sm btn-success">
									<i class="fa fa-check"></i>
									Simpan
								</button>
							</div>
						</form>
					</div>
				</div>
			</main>

			<!-- Footer -->
			<?php $this->load->view('layout/master/footer.php'); ?>

			<!-- End Footer -->
		</div>
	</div>

	<?php $this->load->view('layout/master/js.php'); ?>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
		})
	</script>
</body>


</html>