<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_input_validation.inc.php 70 2007-01-07 14:19:12Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


   function xtc_input_validation($var,$type,$replace_char) {

      switch($type) {
                case 'cPath':
                        $replace_param='/[^0-9_]/';
                        break;
                case 'int':
                        $replace_param='/[^0-9]/';
                        break;
                case 'char':
                        $replace_param='/[^a-zA-Z]/';
                        break;

      }

    $val=preg_replace($replace_param,$replace_char,$var);

    return $val;
   }



?>