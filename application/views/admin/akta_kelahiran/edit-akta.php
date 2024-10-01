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
							<a href="<?= site_url('akta_kelahiran') ?>" class="btn btn-sm btn-info">
								<i class="fa fa-arrow-left"></i>
								Kembali Ke Daftar Akta Kelahiran
							</a>
						</div>
						<form action="<?= site_url('akta_kelahiran/edit/' . $akta['id_akta']) ?>" method="post"
							enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="id_penduduk"
												class="form-label <?php echo form_error('id_penduduk') ? 'text-danger' : ''; ?>">Nama
												Penduduk</label>
											<select name="id_penduduk_disabled"
												class="form-control js-example-basic-single <?php echo form_error('id_penduduk') ? 'is-invalid' : ''; ?>"
												disabled>
												<option value="">-- Pilih Penduduk --</option>
												<?php foreach ($penduduk_list as $penduduk) : ?>
													<option value="<?= $penduduk->id_penduduk ?>"
														<?= $penduduk->id_penduduk == $akta['id_penduduk'] ? 'selected' : '' ?>>
														<?= $penduduk->nama ?> (<?= $penduduk->nik ?>)</option>
												<?php endforeach; ?>
											</select>

											<!-- Input hidden untuk mengirimkan id_penduduk -->
											<input type="hidden" name="id_penduduk" value="<?= $akta['id_penduduk'] ?>">

											<div class="invalid-feedback">
												<?php echo form_error('id_penduduk'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="no_akta"
												class="form-label <?php echo form_error('no_akta') ? 'text-danger' : ''; ?>">No.
												Akta Kelahiran
											</label>
											<input type="number" name="no_akta"
												class="form-control <?php echo form_error('no_akta') ? 'is-invalid' : ''; ?>"
												value="<?= $akta['no_akta'] ?>" placeholder="No. Kartu Keluarga"
												autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('no_akta'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="file_akta" class="form-label">File Kartu Keluarga</label>
											<input type="file" name="file_akta" class="form-control">
											<div class="invalid-feedback">
												<?php echo form_error('file_akta'); ?>
											</div>

											<!-- Menampilkan gambar jika file KK ada -->
											<?php if (!empty($akta['file_akta'])) : ?>
												<div class="mt-2">
													<img src="<?= base_url('uploads/akta/' . $akta['file_akta']); ?>"
														alt="File Kartu Keluarga" width="200" class="img-thumbnail">
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

	<!-- Modal Peringatan -->
	<div class="modal fade" id="fileErrorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">File Upload Error</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p id="errorMessage">File yang diunggah tidak sesuai format atau ukurannya lebih dari 2MB.</p>
				</div>
			</div>
		</div>
	</div>


	<?php $this->load->view('layout/master/js.php'); ?>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();

			// Validasi file upload
			$('form').on('submit', function(e) {
				var fileInput = $('input[name="file_akta"]')[0];
				var file = fileInput.files[0];

				// Cek apakah ada file yang diupload
				if (file) {
					var fileSize = file.size / 1024 / 1024; // Convert ke MB
					var fileType = file.type;

					// Validasi ukuran file
					if (fileSize > 2) {
						e.preventDefault();
						$('#errorMessage').text('Ukuran file tidak boleh lebih dari 2MB.');
						$('#fileErrorModal').modal('show');
						return false;
					}

					// Validasi tipe file
					var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
					if ($.inArray(fileType, allowedTypes) == -1) {
						e.preventDefault();
						$('#errorMessage').text(
							'Format file tidak valid. Hanya jpg, jpeg, png, dan pdf yang diperbolehkan.'
						);
						$('#fileErrorModal').modal('show');
						return false;
					}
				}
			});
		});
	</script>
</body>

</html>