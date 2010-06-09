<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_parse_category_path.inc.php,v 1.1 2003/09/06 21:47:50 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(general.php,v 1.225 2003/05/29); www.oscommerce.com 
   (c) 2003	 nextcommerce (xtc_parse_category_path.inc.php,v 1.5 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
 // include needed function
 require_once(DIR_FS_INC . 'xtc_string_to_int.inc.php');
// Parse and secure the cPath parameter values
  function xtc_parse_category_path($cPath) {
// make sure the category IDs are integers
    $cPath_array = array_map('xtc_string_to_int', explode('_', $cPath));

// make sure no duplicate category IDs exist which could lock the server in a loop
    $tmp_array = array();
    $n = sizeof($cPath_array);
    for ($i=0; $i<$n; $i++) {
      if (!in_array($cPath_array[$i], $tmp_array)) {
        $tmp_array[] = $cPath_array[$i];
      }
    }

    return $tmp_array;
  }
 ?>
