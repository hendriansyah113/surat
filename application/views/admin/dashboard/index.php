<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('layout/master/head.php'); ?>
	<style>
		.card {
			margin-bottom: 20px;
		}

		.card-title {
			font-size: 18px;
			font-weight: bold;
		}

		.alert-info {
			background-color: #d1ecf1;
			border-color: #bee5eb;
			color: #0c5460;
		}

		.card-body {
			padding: 20px;
		}

		.card-footer {
			background-color: #f8f9fa;
			padding: 10px;
		}

		.card-text {
			font-size: 1.2rem;
			color: #333;
		}

		.list-unstyled li {
			margin: 10px 0;
		}

		.list-unstyled li i {
			margin-right: 8px;
		}
	</style>
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
					<div class="alert alert-primary" role="alert">
						<strong>Selamat Datang <?= $username->username ?></strong>
					</div>

					<!-- Section untuk Visi dan Misi -->
					<div class="row mb-4">
						<div class="col-md-12">
							<div class="card shadow-sm border-0">
								<div class="card-body p-4">
									<div class="text-center">
										<h4 class="card-title font-weight-bold text-primary">Visi</h4>
										<hr class="w-25 mx-auto" style="border-top: 2px solid #007bff;">
										<p class="card-text font-italic mt-3 mb-4" style="font-size: 1.2rem;">
											"Menjadi sistem informasi kependudukan yang andal, cepat, dan responsif
											dalam mendukung pelayanan publik yang berkualitas."
										</p>
									</div>

									<div class="text-center">
										<h4 class="card-title font-weight-bold text-primary">Misi</h4>
										<hr class="w-25 mx-auto" style="border-top: 2px solid #007bff;">
									</div>

									<ul class="list-unstyled mt-3" style="font-size: 1.1rem;">
										<li><i class="fas fa-check-circle text-success"></i> Menyediakan layanan
											administrasi kependudukan yang mudah diakses dan efisien.</li>
										<li><i class="fas fa-check-circle text-success"></i> Meningkatkan kecepatan
											pemrosesan data dan dokumen kependudukan.</li>
										<li><i class="fas fa-check-circle text-success"></i> Menyajikan data
											kependudukan yang akurat untuk mendukung kebijakan dan pengambilan
											keputusan.</li>
										<li><i class="fas fa-check-circle text-success"></i> Memberikan pengalaman
											pengguna yang nyaman dengan antarmuka yang intuitif.</li>
										<li><i class="fas fa-check-circle text-success"></i> Meningkatkan keamanan data
											kependudukan dengan proteksi yang optimal.</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- End Section untuk Visi dan Misi -->

					<?php if ($this->session->userdata('level') === 'admin'): ?>
						<!-- Alert Pengajuan Domisili -->
						<?php if ($ada_pengajuan_domisili): ?>
							<div class="alert alert-warning" role="alert">
								<strong>Perhatian!</strong> Ada pengajuan SK Domisili yang memerlukan persetujuan.
							</div>
						<?php endif; ?>

						<!-- Alert Pengajuan Tugas -->
						<?php if ($ada_pengajuan_tugas): ?>
							<div class="alert alert-warning" role="alert">
								<strong>Perhatian!</strong> Ada pengajuan SK Tugas yang memerlukan persetujuan.
							</div>
						<?php endif; ?>

						<!-- Alert Pengajuan Penghasilan -->
						<?php if ($ada_pengajuan_penghasilan): ?>
							<div class="alert alert-warning" role="alert">
								<strong>Perhatian!</strong> Ada pengajuan SK Penghasilan yang memerlukan persetujuan.
							</div>
						<?php endif; ?>

						<!-- Alert Pengajuan Tidak Mampu -->
						<?php if ($ada_pengajuan_tidak_mampu): ?>
							<div class="alert alert-warning" role="alert">
								<strong>Perhatian!</strong> Ada pengajuan SK Tidak Mampu yang memerlukan persetujuan.
							</div>
						<?php endif; ?>

						<!-- Alert Pengajuan Usaha -->
						<?php if ($ada_pengajuan_usaha): ?>
							<div class="alert alert-warning" role="alert">
								<strong>Perhatian!</strong> Ada pengajuan SK Usaha yang memerlukan persetujuan.
							</div>
						<?php endif; ?>

						<!-- Alert Pengajuan Nikah -->
						<?php if ($ada_pengajuan_nikah): ?>
							<div class="alert alert-warning" role="alert">
								<strong>Perhatian!</strong> Ada pengajuan SK Nikah yang memerlukan persetujuan.
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<div class="row">
						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Jumlah Penduduk</h5>
									<div class="row">
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Total</h6>
											<p class="card-text"><?= $jumlah_penduduk ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Card lainnya untuk data pengajuan, surat tugas, dan SK Usaha -->
						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Jumlah Kartu Keluarga</h5>
									<div class="row">
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Total</h6>
											<p class="card-text"><?= $kartu_keluarga ?></p>
										</div>
										<div class="col-md-6">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Jumlah SK Tugas</h5>
									<div class="row">
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Total</h6>
											<p class="card-text"><?= $surat_tugas ?></p>
										</div>
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Disetujui</h6>
											<p class="card-text"><?= $surat_tugas_disetujui ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Jumlah SK Usaha</h5>
									<div class="row">
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Total</h6>
											<p class="card-text"><?= $surat_usaha ?></p>
										</div>
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Disetujui</h6>
											<p class="card-text"><?= $surat_usaha_disetujui ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Jumlah SK Nikah</h5>
									<div class="row">
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Total</h6>
											<p class="card-text"><?= $jumlah_sk_nikah ?></p>
										</div>
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Disetujui</h6>
											<p class="card-text"><?= $sk_nikah_disetujui ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Card lainnya untuk data pengajuan, surat tugas, dan SK Usaha -->
						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Jumlah SK Domisili</h5>
									<div class="row">
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Total</h6>
											<p class="card-text"><?= $jumlah_sk_domisili ?></p>
										</div>
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Disetujui</h6>
											<p class="card-text"><?= $sk_domisili_disetujui ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Jumlah SK Penghasilan</h5>
									<div class="row">
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Total</h6>
											<p class="card-text"><?= $jumlah_sk_penghasilan ?></p>
										</div>
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Disetujui</h6>
											<p class="card-text"><?= $sk_penghasilan_disetujui ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Jumlah SK Tidak Mampu</h5>
									<div class="row">
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Total</h6>
											<p class="card-text"><?= $tidak_mampu ?></p>
										</div>
										<div class="col-md-6">
											<h6 class="card-subtitle mb-2 text-muted">Disetujui</h6>
											<p class="card-text"><?= $tidak_mampu_disetujui ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>

	</main>

	<!-- Footer -->
	<?php $this->load->view('layout/master/footer.php'); ?>
	<!-- End Footer -->
	</d iv>
	</div>


	<?php $this->load->view('layout/master/js.php'); ?>
</body>

</html>