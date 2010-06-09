<?php
/* -----------------------------------------------------------------------------------------
   $Id: vvc_display.php,v 1.0 

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce www.oscommerce.com 
   (c) 2003	 nextcommerce www.nextcommerce.org

   Third Party contribution:

	Visual Verify Code (VVC) security
        http://www.oscommerce.com/community/contributions,1560/page,26
        Original file: vvc_display.php,v 1.0 26SEP03
	Written for use with:
        osCommerce, Open Source E-Commerce Solutions http://www.oscommerce.com
	Part of Contribution Named:
        Visual Verify Code (VVC) by William L. Peer, Jr. (wpeer@forgepower.com) for www.onlyvotives.com

    Modified for use in XT-Commerce by GamesEmpire.de Matthias Hinsche http://www.gamesempire.de

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

require('includes/application_top.php');
require_once(DIR_FS_INC . 'ge_vvcode.inc.php');


$visual_verify_code = ""; 

     function xtc_Random_Code($length) {
       $chars = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');

       $max_chars = count($chars) - 1;
       srand( (double) microtime()*1000000);

       $rand_str = '';
       for($i=0;$i<$length;$i++)
       {
         $rand_str = ( $i == 0 ) ? $chars[rand(0, $max_chars)] : $rand_str . $chars[rand(0, $max_chars)];
       }

         return $rand_str;
       }


$visual_verify_code = xtc_Random_Code(6);

$_SESSION['vvcode'] = $visual_verify_code;
$vvimg = vvcode_render_code($visual_verify_code);
?>
