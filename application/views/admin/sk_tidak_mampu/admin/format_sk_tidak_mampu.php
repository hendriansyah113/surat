<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Surat Tugas</title>
	<style>
		@media print {
			@page {
				size: A4;
				margin: 20mm;
			}

			body {
				margin: 0;
				padding: 0;
			}

			.container {
				width: 100%;
				max-width: none;
				border: none;
				box-sizing: border-box;
			}
		}

		.container {
			width: 210mm;
			/* Lebar A4 */
			min-height: 297mm;
			/* Tinggi A4 */
			margin: 0 auto;
			padding: 20mm;
			box-sizing: border-box;
			border: 1px solid #000;
		}

		body {
			font-family: Arial, sans-serif;
		}

		.header {
			text-align: center;
			margin-bottom: 20px;
		}

		.header-content {
			display: flex;
			/* Aktifkan Flexbox */
			align-items: center;
			/* Sejajarkan item secara vertikal di tengah */
			justify-content: center;
			/* Sejajarkan item di tengah secara horizontal */
		}

		.header img {
			width: 80px;
			margin-right: 15px;
			/* Jarak antara gambar dan teks */
		}

		.header h1,
		.header h2,
		.header h3 {
			margin: 0;
			text-align: left;
			/* Buat teks sejajar kiri */
		}

		.header h1 {
			font-size: 24px;
			font-weight: bold;
		}

		.header h2,
		.header h3 {
			font-size: 18px;
		}

		.content {
			margin-top: 20px;
			line-height: 1.6;
		}

		.content p {
			text-align: justify;
		}

		.title {
			text-align: center;
		}

		.content table {
			width: 100%;
			margin-top: 10px;
			border-collapse: collapse;
		}

		.content table td {
			padding: 10px;
		}

		.signature {
			margin-top: 60px;
			display: flex;
			justify-content: flex-end;
			text-align: right;
		}

		.signature p {
			margin: 0;
			line-height: 1.5;
		}

		.signature .name {
			margin-top: 60px;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="header">
			<div class="header-content">
				<img src="<?= base_url('uploads/images/logo_pky.gif') ?>" alt="Logo">
				<div class="text">
					<h1>PEMERINTAH KOTA PALANGKA RAYA</h1>
					<h2>KECAMATAN JEKAN RAYA</h2>
					<h3>Jalan Mahir Mahar Lingkar Luar Palangka Raya</h3>
				</div>
			</div>
			<hr>
		</div>
		<p class="title"><strong>SURAT TIDAK MAMPU</strong></p>
		<p class="title">Nomor: <?= $permohonan['nomor'] ?></p>
		<div class="content">
			<p>Yang bertanda tangan di bawah ini Kecamatan Jekan Raya, Kota Palangka Raya, menerangkan
				bahwa:</p>
			<table>
				<tr>
					<td>Nama</td>
					<td>: <?= $permohonan['nama'] ?></td>
				</tr>
				<tr>
					<td>Tempat dan Tanggal Lahir</td>
					<td>: <?= $permohonan['tempat_lahir'] . ", " . $permohonan['tanggal_lahir'] ?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>: <?= $permohonan['jenis_kelamin'] ?></td>
				</tr>
				<tr>
					<td>Pekerjaan</td>
					<td>: <?= $permohonan['pekerjaan'] ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>: <?= $permohonan['alamat'] ?></td>
				</tr>
			</table>
			<p>Berdasarkan data dan hasil verifikasi, yang bersangkutan tergolong dalam kategori tidak mampu dan layak
				untuk mendapatkan bantuan sesuai dengan ketentuan yang berlaku.
			</p>
			<p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
			<br>
			<br>
			<br>
		</div>
		<div class="signature">
			<div>
				<p>Palangka Raya, <?= date('d F Y') ?></p>
				<p>Kepala Dinas Kecamatan Jekan Raya</p>
				<br>
				<br>
				<br>
				<p class="name">Untung Sutrisno, S.Sos., M.A.P</p>
			</div>
		</div>
	</div>
</body>






</html>