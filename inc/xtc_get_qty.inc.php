<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_get_qty.inc.php 70 2007-01-07 14:19:12Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

   function xtc_get_qty($products_id)  {

     if (strpos($products_id,'{'))  {
    $act_id=substr($products_id,0,strpos($products_id,'{'));
  } else {
    $act_id=$products_id;
  }

  return $_SESSION['actual_content'][$act_id]['qty'];

   }

?>