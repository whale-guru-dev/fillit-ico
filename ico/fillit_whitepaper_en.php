<?php
 $file = 'assets/pdf/fillit_whitepaper_en.pdf';                
 $filename = 'fillit_whitepaper_en.pdf';
 header ('Content-type: application/pdf');
 header ('Content-Disposition: inline; filename="' . $filename . '"');
 header ('Content-Transfer-Encoding: binary');
 header ('Accept-Ranges: bytes');
 @readfile($file);
?>