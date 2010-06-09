<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_oe_get_customers_status.inc.php

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   XTC-Bestellbearbeitung:
   http://www.xtc-webservice.de / Matthias Hinsche
   info@xtc-webservice.de

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (xtc_get_products_price.inc.php,v 1.13 2003/08/20); www.nextcommerce.org
   
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

// Gibt den jeweiligen Kundenstatus aus
  function xtc_oe_get_customers_status($customers_id) {
    $customer_query = xtc_db_query("select customers_status from " . TABLE_CUSTOMERS . " where customers_id  = '" . $customers_id . "'");
    $customer = xtc_db_fetch_array($customer_query);

    return $customer['customers_status'];
  }
 ?>