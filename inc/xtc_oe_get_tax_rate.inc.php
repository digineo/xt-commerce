<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_oe_get_tax_rate.inc.php

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

// Berechnet Nettopreis aus Brutto
// Gibt den MWST Satz anhand der ID aus
  function xtc_oe_get_tax_rate($tax_class_id) {

    $tax_rate_query = xtc_db_query("select tax_rate from " . TABLE_TAX_RATES . " where tax_class_id = '" . $tax_class_id . "'");
    $tax_rate = xtc_db_fetch_array($tax_rate_query);

    return $tax_rate['tax_rate'];
  }
 ?>