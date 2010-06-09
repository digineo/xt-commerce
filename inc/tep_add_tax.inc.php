<?php
/* -----------------------------------------------------------------------------------------
   $Id: tep_add_tax.inc.php,v 1.3 2004/04/25 13:54:39 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(general.php,v 1.225 2003/05/29); www.oscommerce.com
   (c) 2003	 nextcommerce (tep_add_tax.inc.php,v 1.3 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/
   
  function xtc_add_tax($price, $tax) {
    global $currencies;

    if ( (DISPLAY_PRICE_WITH_TAX == 'true') && ($tax > 0) ) {
      return xtc_round($price, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']) + xtc_calculate_tax($price, $tax);
    } else {
      return xtc_round($price, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']);
    }
  }
 ?>