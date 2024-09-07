<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('layout/master/head.php'); ?>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
	<div class="wrapper">
		<?php $this->load->view('layout/master/sidebar.php'); ?>
		<div class="main">
			<?php $this->load->view('layout/master/nav.php'); ?>
			<main class="content">
				<div class="container-fluid">
					<div class="d-sm-block title-page mb-4">
						<h3 class="mb-0"><?= $title ?></h3>
					</div>
					<?php if (validation_errors()) : ?>
						<div class="alert alert-danger">
							<?= validation_errors(); ?>
						</div>
					<?php endif; ?>
					<div class="card">
						<div class="card-body">
							<form action="<?= site_url('sk_penghasilan/tambah') ?>" method="post">
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
														<?= $penduduk->nama ?> (<?= $penduduk->nik ?>)
													</option>
												<?php endforeach; ?>
											</select>
											<div class="invalid-feedback">
												<?php echo form_error('id_penduduk'); ?>
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group mb-3">
											<label for="nomor"
												class="form-label <?php echo form_error('nomor') ? 'text-danger' : ''; ?>">Nomor
												Surat
											</label>
											<input type="text" name="nomor"
												class="form-control <?php echo form_error('nomor') ? 'is-invalid' : ''; ?>"
												value="<?php echo set_value('nomor'); ?>" placeholder="Nomor Surat"
												autocomplete="off">
											<div class="invalid-feedback">
												<?php echo form_error('nomor'); ?>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group mb-3">
											<label for="penghasilan_tetap"
												class="form-label <?php echo form_error('penghasilan_tetap') ? 'text-danger' : ''; ?>">
												Penghasilan Tetap
											</label>
											<input type="text" name="penghasilan_tetap" id="penghasilan_tetap"
												class="form-control <?php echo form_error('penghasilan_tetap') ? 'is-invalid' : ''; ?>"
												value="<?php echo set_value('penghasilan_tetap'); ?>"
												placeholder="Penghasilan Tetap" autocomplete="off"
												onkeyup="formatRupiah(this)">
											<div class="invalid-feedback">
												<?php echo form_error('penghasilan_tetap'); ?>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group mb-3">
											<label for="penghasilan_tambahan"
												class="form-label <?php echo form_error('penghasilan_tambahan') ? 'text-danger' : ''; ?>">
												Penghasilan Tambahan
											</label>
											<input type="text" name="penghasilan_tambahan" id="penghasilan_tambahan"
												class="form-control <?php echo form_error('penghasilan_tambahan') ? 'is-invalid' : ''; ?>"
												value="<?php echo set_value('penghasilan_tambahan'); ?>"
												placeholder="Penghasilan Tambahan" autocomplete="off"
												onkeyup="formatRupiah(this)">
											<div class="invalid-feedback">
												<?php echo form_error('penghasilan_tambahan'); ?>
											</div>
										</div>
									</div>
								</div>

								<button type="submit" class="btn btn-primary">Tambah</button>
								<a href="<?= site_url('sk_penghasilan') ?>" class="btn btn-secondary">Batal</a>
							</form>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<?php $this->load->view('layout/master/js.php'); ?>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
		})

		function formatRupiah(element) {
			let angka = element.value.replace(/[^,\d]/g, '').toString();
			let split = angka.split(',');
			let sisa = split[0].length % 3;
			let rupiah = split[0].substr(0, sisa);
			let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

			if (ribuan) {
				let separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			element.value = rupiah;
		}

		function removeDots() {
			// Hapus titik dari input penghasilan tetap dan tambahan
			document.getElementById('penghasilan_tetap').value = document.getElementById('penghasilan_tetap').value.replace(
				/\./g, '');
			document.getElementById('penghasilan_tambahan').value = document.getElementById('penghasilan_tambahan').value
				.replace(/\./g, '');
		}
	</script>
</body>




</html>