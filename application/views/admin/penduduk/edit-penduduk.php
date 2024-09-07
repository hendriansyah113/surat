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
							<a href="<?= site_url('penduduk') ?>" class="btn btn-sm btn-info">
								<i class="fa fa-arrow-left"></i>
								Kembali Ke Daftar Penduduk
							</a>
						</div>
						<form action="<?= site_url('penduduk/edit/' . $penduduk['id_penduduk']) ?>" method="post"
							enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="nama"
												class="form-label <?php echo form_error('nama') ? 'text-danger' : ''; ?>">Nama
											</label>
											<input type="text" name="nama"
												class="form-control <?php echo form_error('nama') ? 'is-invalid' : ''; ?>"
												value="<?php echo $penduduk['nama'] ?>" placeholder="Nama Penduduk"
												autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('nama'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="nik"
												class="form-label <?php echo form_error('nik') ? 'text-danger' : ''; ?>">NIK
											</label>
											<input type="number" name="nik"
												class="form-control <?php echo form_error('nik') ? 'is-invalid' : ''; ?>"
												value="<?php echo $penduduk['nik'] ?>" placeholder="NIK Penduduk"
												autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('nik'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="alamat"
												class="form-label <?php echo form_error('alamat') ? 'text-danger' : ''; ?>">Alamat
											</label>
											<textarea name="alamat"
												class="form-control <?php echo form_error('alamat') ? 'is-invalid' : ''; ?>"
												placeholder="Alamat Penduduk"
												rows="3"><?php echo $penduduk['alamat'] ?></textarea>
											<div class="invalid-feedback">
												<?php echo form_error('alamat'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="pekerjaan"
												class="form-label <?php echo form_error('pekerjaan') ? 'text-danger' : ''; ?>">Pekerjaan
											</label>
											<input type="text" name="pekerjaan"
												class="form-control <?php echo form_error('pekerjaan') ? 'is-invalid' : ''; ?>"
												value="<?php echo $penduduk['pekerjaan'] ?>" placeholder="Pekerjaan"
												autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('pekerjaan'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="unit"
												class="form-label <?php echo form_error('unit') ? 'text-danger' : ''; ?>">Unit
												Kerja/Instansi
											</label>
											<input type="text" name="unit"
												class="form-control <?php echo form_error('unit') ? 'is-invalid' : ''; ?>"
												value="<?php echo $penduduk['unit'] ?>"
												placeholder="Unit Kerja/Instansi" autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('unit'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="tempat_lahir"
												class="form-label <?php echo form_error('tempat_lahir') ? 'text-danger' : ''; ?>">Tempat
												Lahir
											</label>
											<input type="text" name="tempat_lahir"
												class="form-control <?php echo form_error('tempat_lahir') ? 'is-invalid' : ''; ?>"
												value="<?php echo $penduduk['tempat_lahir'] ?>"
												placeholder="Tempat Lahir Penduduk" autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('tempat_lahir'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="tanggal_lahir"
												class="form-label <?php echo form_error('tanggal_lahir') ? 'text-danger' : ''; ?>">Tanggal
												Lahir
											</label>
											<input type="date" name="tanggal_lahir"
												class="form-control <?php echo form_error('tanggal_lahir') ? 'is-invalid' : ''; ?>"
												value="<?php echo $penduduk['tanggal_lahir'] ?>"
												placeholder="Tanggal Lahir" autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('tanggal_lahir'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label
												class="form-label <?php echo form_error('jenis_kelamin') ? 'text-danger' : ''; ?>">Jenis
												Kelamin</label>
											<div class="form-check">
												<input type="radio" id="laki_laki" name="jenis_kelamin"
													value="Laki-laki"
													class="form-check-input <?php echo form_error('jenis_kelamin') ? 'is-invalid' : ''; ?>"
													<?php echo set_radio('jenis_kelamin', 'Laki-laki', $penduduk['jenis_kelamin'] === 'Laki-laki'); ?>>
												<label for="laki_laki" class="form-check-label">Laki-laki</label>
											</div>
											<div class="form-check">
												<input type="radio" id="perempuan" name="jenis_kelamin"
													value="Perempuan"
													class="form-check-input <?php echo form_error('jenis_kelamin') ? 'is-invalid' : ''; ?>"
													<?php echo set_radio('jenis_kelamin', 'Perempuan', $penduduk['jenis_kelamin'] === 'Perempuan'); ?>>
												<label for="perempuan" class="form-check-label">Perempuan</label>
											</div>
											<div class="invalid-feedback">
												<?php echo form_error('jenis_kelamin'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-0">
											<label
												class="form-label <?php echo form_error('status_nikah') ? 'text-danger' : ''; ?>">Status
												Nikah</label>
											<div class="form-check">
												<input type="radio" id="belum_menikah" name="status_nikah"
													value="Belum Menikah"
													class="form-check-input <?php echo form_error('status_nikah') ? 'is-invalid' : ''; ?>"
													<?php echo set_radio('status_nikah', 'Belum Menikah', $penduduk['status_nikah'] === 'Belum Menikah'); ?>>
												<label for="belum_menikah" class="form-check-label">Belum
													Menikah</label>
											</div>
											<div class="form-check">
												<input type="radio" id="menikah" name="status_nikah" value="Menikah"
													class="form-check-input <?php echo form_error('status_nikah') ? 'is-invalid' : ''; ?>"
													<?php echo set_radio('status_nikah', 'Menikah', $penduduk['status_nikah'] === 'Menikah'); ?>>
												<label for="menikah" class="form-check-label">Menikah</label>
											</div>
											<div class="form-check">
												<input type="radio" id="cerai" name="status_nikah" value="Cerai"
													class="form-check-input <?php echo form_error('status_nikah') ? 'is-invalid' : ''; ?>"
													<?php echo set_radio('status_nikah', 'Cerai', $penduduk['status_nikah'] === 'Cerai'); ?>>
												<label for="cerai" class="form-check-label">Cerai</label>
											</div>
											<div class="invalid-feedback">
												<?php echo form_error('status_nikah'); ?>
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