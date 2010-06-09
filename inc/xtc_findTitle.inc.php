<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_findTitle.inc.php 899 2005-04-29 02:40:57Z hhgag $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(new_attributes); www.oscommerce.com
   (c) 2003     nextcommerce (new_attributes.php,v 1.13 2003/08/21); www.nextcommerce.org

   Released under the GNU General Public License
   --------------------------------------------------------------
   Third Party contributions:
   New Attribute Manager v4b                Autor: Mike G | mp3man@internetwork.net | http://downloads.ephing.com

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


  function xtc_findTitle($current_pid, $languageFilter) {
    $query = "SELECT * FROM products_description where language_id = '" . $_SESSION['languages_id'] . "' AND products_id = '" . $current_pid . "'";

    $result = mysql_query($query) or die(mysql_error());

    $matches = mysql_num_rows($result);

    if ($matches) {
      while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $productName = $line['products_name'];
      }
      return $productName;
    } else {
      return "Something isn't right....";
    }
  }
?>