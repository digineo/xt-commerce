<?php
/* -----------------------------------------------------------------------------------------
   $Id: render_vvcode.inc.php,v 1.0
   
   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   
   by Guido Winger for XT:Commerce (gwinger@xtcommerce.com)
  
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

require_once(DIR_FS_INC . 'xtc_rand.inc.php');
   
function vvcode_render_code($code) {
        if (!empty($code)) {
   putenv('GDFONTPATH='.realpath('./includes/fonts/'));

    $ttf_file[0] = 'dustismo_bold.ttf';
    $ttf_file[1] = 'domestic_manners.ttf';
    $ttf_file[2] = 'penguin_attacks.ttf';

    $width = 240;
    $height = 40;

    $imgh = imagecreate($width, $height);
    
    $fonts = imagecolorallocate($imgh, 112, 112, 112);
    $lines = imagecolorallocate($imgh, 220, 148, 002);
    $background = imagecolorallocate($imgh, 196, 196, 196);
    imagefill($imgh, 0, 0, $background);
    
    $a = xtc_rand(0, 15);
    $b = xtc_rand(15, 40);
    for ($i = $a, $d = $b; $i < $width && $d < $width;) {
        imageLine($imgh, $i, 0, $d, $height, $lines);
        $i += $a;
        $d += $b;
    }

    $a = xtc_rand(0, 15);
    $b = xtc_rand(15, 40);
    for ($i = $a, $d = $b; $i < $width && $d < $width;) {
        imageLine($imgh, $d, 0, $i, $height, $lines);
        $i += $a;
        $d += $b;
    }    
    
    $a = xtc_rand(0, 15);
    $b = xtc_rand(15, 40);
    for ($i = $a, $d = $b; $i < $height && $d < $height;) {
        imageLine($imgh, 0, $i, $width, $d, $lines);
        $i += $a;
        $d += $b;
    }

    $a = xtc_rand(0, 15);
    $b = xtc_rand(15, 40);
    for ($i = $a, $d = $b; $i < $height && $d < $height;) {
        imageLine($imgh, 0, $d, $width, $i, $lines);
        $i += $a;
        $d += $b;
    }    
       
    for ($i = 0; $i < strlen($code); $i++) {
        $xtc_random_font = $ttf_file[(int)xtc_rand(0, count($ttf_file)-1)];
        //echo $xtc_random_font;
        $xtc_random_size = xtc_rand(25, 35);
        $xtc_random_angle = xtc_rand(-30, 30);

        imagettftext($imgh, $xtc_random_size, $xtc_random_angle, 40*$i+10 , 30, $fonts, $xtc_random_font, substr($code, $i, 1));
    }
    
    
    
    header('Content-Type: image/png');
    imagepng($imgh);
    imagedestroy($imgh);
 }
}
 ?>