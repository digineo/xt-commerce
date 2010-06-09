<?php

/* -----------------------------------------------------------------------------------------
   $Id: cod.php 192 2007-02-24 16:24:52Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(cod.php,v 1.7 2002/04/17); www.oscommerce.com 
   (c) 2003	 nextcommerce (cod.php,v 1.5 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
define('MODULE_PAYMENT_TYPE_PERMISSION', 'cod');
define('MODULE_PAYMENT_COD_TEXT_TITLE', 'Cash on Delivery');
define('MODULE_PAYMENT_COD_TEXT_DESCRIPTION', 'Cash on Delivery');
define('MODULE_PAYMENT_COD_TEXT_INFO', '');
define('MODULE_PAYMENT_COD_STATUS_TITLE', 'Enable Cash On Delivery Module');
define('MODULE_PAYMENT_COD_STATUS_DESC', 'Do you want to accept Cash On Delevery payments?');

define('MODULE_PAYMENT_COD_COST_TITLE', _MODULES_PAYMENT_FEE_TITLE);
define('MODULE_PAYMENT_COD_COST_DESC', _MODULES_PAYMENT_FEE_DESC);
define('MODULE_PAYMENT_COD_ZONE_TITLE', _MODULES_ZONE_TITLE);
define('MODULE_PAYMENT_COD_ZONE_DESC', _MODULES_ZONE_DESC);
define('MODULE_PAYMENT_COD_ALLOWED_TITLE', _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_PAYMENT_COD_ALLOWED_DESC', _MODULES_ZONE_ALLOWED_DESC);
define('MODULE_PAYMENT_COD_SORT_ORDER_TITLE', _MODULES_SORT_ORDER_TITLE);
define('MODULE_PAYMENT_COD_SORT_ORDER_DESC', _MODULES_SORT_ORDER_DESC);
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_TITLE', _MODULES_SET_ORDER_STATUS_TITLE);
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_DESC', _MODULES_SET_ORDER_STATUS_DESC);
?>
