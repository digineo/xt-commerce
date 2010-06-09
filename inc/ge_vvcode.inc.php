<?php
/* -----------------------------------------------------------------------------------------
   $Id: ge_vvcode.inc.php,v 1.0

   XTC-NEWSLETTER_RECIPIENTS RC1 - Contribution for XT-Commerce http://www.xt-commerce.com
   by Matthias Hinsche http://www.gamesempire.de

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce www.oscommerce.com 
   (c) 2003	 nextcommerce www.nextcommerce.org

   Third Party contribution:

    	Visual Verify Code (VVC) security
	  http://www.oscommerce.com/community/contributions,1560/page,26
 	  file: visual_verify_code.php,v 1.0 26SEP03
	  Written for use with:
        osCommerce, Open Source E-Commerce Solutions http://www.oscommerce.com
	  Part of Contribution Named:
        Visual Verify Code (VVC) by William L. Peer, Jr. (wpeer@forgepower.com) for www.onlyvotives.com

    Modified for use in XT-Commerce by GamesEmpire.de Matthias Hinsche

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

   
  function vvcode_render_code($code) {
        if (!empty($code)) {
            $imwidth=120;
            $imheight=30;
            Header("Content-type: image/Jpeg");
            $im = @ImageCreate ($imwidth, $imheight) or die ("ERROR! Cannot create new GD image - see: verify_code_img_gen.php");

            $background_color = ImageColorAllocate ($im, 255, 255, 255);
            $text_color = ImageColorAllocate ($im, 0, 0, 0);
            $border_color = ImageColorAllocate ($im, 154, 154, 154);

            //strip any spaces that may have crept in
            //end-user wouldn't know to type the space! :)
            $code = str_replace(" ", "", $code);
            $x=0;

            $stringlength = strlen($code);
            for ($i = 0; $i< $stringlength; $i++) {
                 $x = $x + (rand (8, 15));
                 $y = rand (2, 10);
                 $font = rand (2,5);
                 $single_char = substr($code, $i, 1);
                 imagechar($im, $font, $x, $y, $single_char, $text_color);
                }

            imagerectangle ($im, 2, 2, $imwidth-2, $imheight-2, $border_color);

            ImageJpeg($im);
            ImageDestroy;
        }
  }

 ?>