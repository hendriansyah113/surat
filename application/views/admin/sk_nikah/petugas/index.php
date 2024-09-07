<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('layout/master/head.php'); ?>
	<!-- CSS untuk DataTables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- JavaScript DataTables -->
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>

	<!-- JavaScript DataTables Buttons -->
	<script src="https://cdn.datatables.net/buttons/1.7.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.print.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

	<style>
		.dataTables_wrapper .dt-buttons {
			margin-bottom: 10px;
		}

		.dataTables_wrapper .dt-buttons .btn {
			background-color: #007bff;
			/* Warna background tombol */
			color: #fff;
			/* Warna teks tombol */
			border: 1px solid #007bff;
			/* Border tombol */
			border-radius: 4px;
			/* Sudut tombol */
			padding: 6px 12px;
			/* Padding tombol */
			margin-right: 5px;
			/* Jarak antar tombol */
			font-size: 14px;
			/* Ukuran font */
		}

		.dataTables_wrapper .dt-buttons .btn:hover {
			background-color: #0056b3;
			/* Warna background saat hover */
			border-color: #0056b3;
			/* Warna border saat hover */
			color: #fff;
			/* Warna teks saat hover */
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
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success" role="alert">
							<h6>
								<i class="fa fa-check-circle fs-5"></i>
								Berhasil !
							</h6>
							<p class="mb-0"><?php echo $this->session->flashdata('success'); ?></p>
						</div>
					<?php endif; ?>

					<div class="card">
						<div class="card-header">
							<a href="<?= site_url('sk_nikah/tambah') ?>" class="btn btn-sm btn-info">
								<i class="fa fa-plus"></i>
								Tambah
							</a>
						</div>
						<div class="card-body">
							<table id="table-data" class="table table-striped table-bordered dt-responsive nowrap"
								style="width:100%;">
								<thead>
									<tr>
										<th>NO</th>
										<th>NAMA PENDUDUK</th>
										<th>STATUS PERNIKAHAN</th>
										<th>TANGGAL PERMOHONAN</th>
										<th>STATUS</th>
										<th>ALASAN PENOLAKAN</th>
										<th>NO SURAT</th>
										<th>AKSI</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($permohonan_list as $index => $permohonan) : ?>
										<tr>
											<td><?= $index + 1 ?></td>
											<td><?= $permohonan->nama ?></td>
											<td><?= $permohonan->status_nikah ?></td>
											<td><?= $permohonan->tanggal_permohonan ?></td>
											<td><?= $permohonan->status ?></td>
											<td><?= $permohonan->alasan_penolakan ?></td>
											<td><?= $permohonan->nomor ?></td>
											<td>
												<?php if ($permohonan->status === 'Menunggu') : ?>
													<a href="<?= site_url('sk_nikah/edit/' . $permohonan->id) ?>"
														class="btn btn-warning btn-sm">Edit</a>
													<a href="<?= site_url('sk_nikah/hapus/' . $permohonan->id) ?>"
														class="btn btn-danger btn-sm"
														onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>

				</div>

			</main>

			<!-- Footer -->
			<?php $this->load->view('layout/master/footer.php'); ?>
			<!-- End Footer -->
		</div>
	</div>

	<?php $this->load->view('layout/master/js.php'); ?>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
	<script src="<?php echo base_url('assets/master/js/script.js'); ?>"></script>
	<script>
		$(document).ready(function() {
			$('#table-data').DataTable({
				dom: 'Bfrtip',
				buttons: [{
						extend: 'copyHtml5',
						text: '<i class="fa fa-copy"></i> Copy',
						titleAttr: 'Copy',
						className: 'btn btn-primary'
					},
					{
						extend: 'excelHtml5',
						text: '<i class="fa fa-file-excel"></i> Excel',
						titleAttr: 'Excel',
						className: 'btn btn-success'
					},
					{
						extend: 'csvHtml5',
						text: '<i class="fa fa-file-csv"></i> CSV',
						titleAttr: 'CSV',
						className: 'btn btn-warning'
					},
					{
						extend: 'pdfHtml5',
						text: '<i class="fa fa-file-pdf"></i> PDF',
						titleAttr: 'PDF',
						className: 'btn btn-danger'
					}
				],
				responsive: true
			});
		});
	</script>
</body>

</html>