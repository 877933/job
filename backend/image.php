<?php

header("Content-type: image/png");
$string = $_GET['days'];
$im = imagecreatefrompng("calvin_resolutions.png");
$black = imagecolorallocate($im, 0, 0, 0);
$font = 'comicsans.ttf';

$initialX = '153';
$initialY = '35';
$increaseY = '23';

$fontSize = '16';
$fontRotation = '0';

$firstline = esc_html__('What do you mean', 'jobcareer');
$secondline = sprintf(esc_html__('there are %s days until', 'jobcareer'),$string);
$thirdline = esc_html__('Christmas?! What am', 'jobcareer');
$fourthline = esc_html__('I supposed to do until', 'jobcareer');
$fifthline = esc_html__('then? WAIT?! I am', 'jobcareer');
$sixthline = esc_html__('not a patient man!', 'jobcareer');

//imagestring($im, $font, $px, 20, $string, $black);
imagettftext($im, $fontSize, $fontRotation, $initialX, $initialY, $black, $font, $firstline);
imagettftext($im, $fontSize, $fontRotation, $initialX, $initialY + $increaseY, $black, $font, $secondline);
imagettftext($im, $fontSize, $fontRotation, $initialX, $initialY + ($increaseY * 2), $black, $font, $thirdline);
imagettftext($im, $fontSize, $fontRotation, $initialX, $initialY + ($increaseY * 3), $black, $font, $fourthline);
imagettftext($im, $fontSize, $fontRotation, $initialX, $initialY + ($increaseY * 4), $black, $font, $fifthline);
imagettftext($im, $fontSize, $fontRotation, $initialX, $initialY + ($increaseY * 5), $black, $font, $sixthline);
imagepng($im);
imagedestroy($im);
