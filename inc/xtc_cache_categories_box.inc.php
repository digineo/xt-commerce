<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_cache_categories_box.inc.php,v 1.1 2003/09/06 21:47:50 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(cache.php,v 1.10 2003/02/11); www.oscommerce.com 
   (c) 2003	 nextcommerce (xtc_cache_categories_box.inc.php,v 1.3 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   
//! Cache the categories box
// Cache the categories box
  function xtc_cache_categories_box($auto_expire = false, $refresh = false) {
    global $cPath, $foo, $id, $categories_string;

    if (($refresh == true) || !read_cache($cache_output, 'categories_box-' . $_SESSION['language'] . '.cache' . $cPath, $auto_expire)) {
      ob_start();
      include(DIR_WS_BOXES . 'categories.php');
      $cache_output = ob_get_contents();
      ob_end_clean();
      write_cache($cache_output, 'categories_box-' . $_SESSION['language'] . '.cache' . $cPath);
    }

    return $cache_output;
  }

 ?>