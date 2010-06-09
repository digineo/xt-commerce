<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_oe_get_allow_tax.inc.php

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

// Gibt Status der MWSt. Anzeige für den jeweiligen Kundenstatus aus
  function xtc_oe_get_allow_tax($customers_id) {
    $customer_query = xtc_db_query("select customers_status from " . TABLE_CUSTOMERS . " where customers_id  = '" . $customers_id . "'");
    $customer = xtc_db_fetch_array($customer_query);

    $allow_query = xtc_db_query("select customers_status_show_price_tax from " . TABLE_CUSTOMERS_STATUS . " where customers_status_id  = '" . $customer['customers_status'] . "'");
    $allow = xtc_db_fetch_array($allow_query);

    return $allow['customers_status_show_price_tax'];
  }
 ?>