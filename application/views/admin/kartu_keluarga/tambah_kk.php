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
							<a href="<?= site_url('kartu_keluarga') ?>" class="btn btn-sm btn-info">
								<i class="fa fa-arrow-left"></i>
								Kembali Ke Daftar Kartu Keluarga
							</a>
						</div>
						<form action="<?= site_url('kartu_keluarga/tambah') ?>" method="post"
							enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="id_penduduk"
												class="form-label <?php echo form_error('id_penduduk') ? 'text-danger' : ''; ?>">Nama
												Penduduk</label>
											<select name="id_penduduk"
												class="form-control js-example-basic-single <?php echo form_error('id_penduduk') ? 'is-invalid' : ''; ?>">
												<option value="">-- Pilih Penduduk --</option>
												<?php foreach ($penduduk_list as $penduduk): ?>
													<option value="<?= $penduduk->id_penduduk ?>"
														<?= set_select('id_penduduk', $penduduk->id_penduduk); ?>>
														<?= $penduduk->nama ?> (<?= $penduduk->nik ?>)</option>
												<?php endforeach; ?>
											</select>
											<div class="invalid-feedback">
												<?php echo form_error('id_penduduk'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="kk"
												class="form-label <?php echo form_error('kk') ? 'text-danger' : ''; ?>">No.
												Kartu Keluarga
											</label>
											<input type="number" name="kk"
												class="form-control <?php echo form_error('kk') ? 'is-invalid' : ''; ?>"
												value="<?php echo set_value('kk'); ?>" placeholder="No. Kartu Keluarga"
												autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('kk'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="file_kk"
												class="form-label <?php echo form_error('file_kk') ? 'text-danger' : ''; ?>">File
												Kartu Keluarga</label>
											<input type="file" name="file_kk"
												class="form-control <?php echo form_error('file_kk') ? 'is-invalid' : ''; ?>"
												required>
											<div class="invalid-feedback">
												<?php echo form_error('file_kk'); ?>
											</div>
											<?php if (isset($error)): ?>
												<div class="text-danger">
													<?php echo $error; ?>
												</div>
											<?php endif; ?>
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