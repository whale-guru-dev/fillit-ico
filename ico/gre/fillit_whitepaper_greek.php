<?php
 $file = 'assets/pdf/fillit_whitepaper_greek.pdf';                
 $filename = 'fillit_whitepaper_greek.pdf';
 header ('Content-type: application/pdf');
 header ('Content-Disposition: inline; filename="' . $filename . '"');
 header ('Content-Transfer-Encoding: binary');
 header ('Accept-Ranges: bytes');
 @readfile($file);
?>