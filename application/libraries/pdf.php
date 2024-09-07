<?php

// Tambahkan autoload composer
require_once APPPATH . '../vendor/autoload.php';
// application/libraries/Pdf.php
use Dompdf\Dompdf;

class Pdf
{
	public function createPDF($html, $filename = '', $download = true)
	{
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		if ($download) {
			$dompdf->stream($filename);
		} else {
			$output = $dompdf->output();
			file_put_contents('uploads/surat/' . $filename, $output);
		}
	}
}
