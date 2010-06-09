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

    $ttf[0] = DIR_FS_CATALOG.'/includes/fonts/Dustismo_sans.ttf';
    $ttf[1] = DIR_FS_CATALOG.'/includes/fonts/dustismo_bold_italic.ttf';
    $ttf[2] = DIR_FS_CATALOG.'/includes/fonts/dustismo_italic.ttf';
    $ttf[3] = DIR_FS_CATALOG.'/includes/fonts/Dustismo_Roman.ttf';
    $ttf[4] = DIR_FS_CATALOG.'/includes/fonts/Dustismo_Roman_Bold.ttf';
    $ttf[5] = DIR_FS_CATALOG.'/includes/fonts/Dustismo_Roman_Italic.ttf';
    $ttf[6] = DIR_FS_CATALOG.'/includes/fonts/Dustismo_Roman_Italic_Bold.ttf';

    $width = 240;
    $height =50;

    $imgh = imagecreate($width, $height);
    
    $fonts = imagecolorallocate($imgh, 112, 112, 112);
    $lines = imagecolorallocate($imgh, 220, 148, 002);
    $background = imagecolorallocate($imgh, 196, 196, 196);
    imagefill($imgh, 0, 0, $background);

    $x = xtc_rand(0, 20);
    $y = xtc_rand(20, 40);
    for ($i = $x, $z = $y; $i < $width && $z < $width;) {
        imageLine($imgh, $i, 0, $z, $height, $lines);
        $i += $x;
        $z += $y;
    }

    $x = xtc_rand(0, 20);
    $y = xtc_rand(20, 40);
    for ($i = $x, $z = $y; $i < $width && $z < $width;) {
        imageLine($imgh, $z, 0, $i, $height, $lines);
        $i += $x;
        $z += $y;
    }    
    
    $x = xtc_rand(0, 10);
    $y = xtc_rand(10, 20);
    for ($i = $x, $z = $y; $i < $height && $z < $height;) {
        imageLine($imgh, 0, $i, $width, $z, $lines);
        $i += $x;
        $z += $y;
    }

    $x = xtc_rand(0, 10);
    $y = xtc_rand(10, 20);
    for ($i = $x, $z = $y; $i < $height && $z < $height;) {
        imageLine($imgh, 0, $z, $width, $i, $lines);
        $i += $x;
        $z += $y;
    }    
       
    for ($i = 0; $i < strlen($code); $i++) {
        $font = $ttf[(int)xtc_rand(0, count($ttf)-1)];
        $size = xtc_rand(30, 36);
        $rand = xtc_rand(1,20);
        $direction = xtc_rand(0,1);

      if ($direction == 0) {
       $angle = 0-$rand;
    } else {
       $angle = $rand;
    }
        
        imagettftext($imgh, $size, $angle, 15+(36*$i) , 38, $fonts, $font, substr($code, $i, 1));
    }
    
    header('Content-Type: image/jpeg');
    imagejpeg($imgh);
    imagedestroy($imgh);
 }
}
 ?>