<?php

use Dompdf\Dompdf;

function generate_pdf($html = '', $file_name = 'laporan_jasa', $size = 'A4', $orientation = 'landscape', $attachment = false) {
   $dompdf = new Dompdf;
   $dompdf->LoadHtml($html);
   $dompdf->setPaper($size, $orientation);
   $dompdf->render();
   $dompdf->stream($file_name,['Attachment' => $attachment]);
}
