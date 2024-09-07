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
							<form action="<?= site_url('sk_domisili/tambah') ?>" method="post">
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
								<button type="submit" class="btn btn-primary">Tambah</button>
								<a href="<?= site_url('sk_domisili') ?>" class="btn btn-secondary">Batal</a>
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
	</script>
</body>

</html>