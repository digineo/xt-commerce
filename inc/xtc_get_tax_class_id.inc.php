<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_get_tax_class_id.inc.php,v 1.1 2003/12/31 14:53:53 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

  function xtc_get_tax_class_id($products_id) {


    $tax_query = xtc_db_query("SELECT
                               products_tax_class_id
                               FROM ".TABLE_PRODUCTS."
                               where products_id='".$products_id."'");
    $tax_query_data=xtc_db_fetch_array($tax_query);

    return $tax_query_data['products_tax_class_id'];
  }
 ?>