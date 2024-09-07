<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('layout/master/head.php'); ?>
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
							<form action="<?= site_url('sk_penghasilan/tolak_permohonan/' . $permohonan['id']) ?>"
								method="post">
								<div class="form-group">
									<label for="alasan_penolakan">Alasan Penolakan</label>
									<textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control"
										required></textarea>
								</div>
								<button type="submit" class="btn btn-primary">Simpan</button>
								<a href="<?= site_url('permohonan/admin_list') ?>" class="btn btn-secondary">Batal</a>
							</form>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<?php $this->load->view('layout/master/js.php'); ?>
</body>

</html>