<?php

/* -----------------------------------------------------------------------------------------
   $Id: moneyorder.php 192 2007-02-24 16:24:52Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(moneyorder.php,v 1.8 2003/02/16); www.oscommerce.com 
   (c) 2003	 nextcommerce (moneyorder.php,v 1.4 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Check/Money Order');
define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Make payable to:&nbsp;' . MODULE_PAYMENT_MONEYORDER_PAYTO . '<br />Send to:<br /><br />' . nl2br(STORE_NAME_ADDRESS) . '<br /><br />' . 'Your order will not ship until we receive payment!');
define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', "Make payable to: " . MODULE_PAYMENT_MONEYORDER_PAYTO . "\n\nSend to:\n" . STORE_NAME_ADDRESS . "\n\n" . 'Your order will not ship until we receive payment');
define('MODULE_PAYMENT_MONEYORDER_TEXT_INFO', '');
define('MODULE_PAYMENT_MONEYORDER_STATUS_TITLE', 'Enable Check/Money Order Module');
define('MODULE_PAYMENT_MONEYORDER_STATUS_DESC', 'Do you want to accept Check/Money Order payments?');
define('MODULE_PAYMENT_MONEYORDER_PAYTO_TITLE', 'Make Payable to:');
define('MODULE_PAYMENT_MONEYORDER_PAYTO_DESC', 'Who should payments be made payable to?');

define('MODULE_PAYMENT_MONEYORDER_COST_TITLE', _MODULES_PAYMENT_FEE_TITLE);
define('MODULE_PAYMENT_MONEYORDER_COST_DESC', _MODULES_PAYMENT_FEE_DESC);
define('MODULE_PAYMENT_MONEYORDER_ZONE_TITLE', _MODULES_ZONE_TITLE);
define('MODULE_PAYMENT_MONEYORDER_ZONE_DESC', _MODULES_ZONE_DESC);
define('MODULE_PAYMENT_MONEYORDER_ALLOWED_TITLE', _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_PAYMENT_MONEYORDER_ALLOWED_DESC', _MODULES_ZONE_ALLOWED_DESC);
define('MODULE_PAYMENT_MONEYORDER_SORT_ORDER_TITLE', _MODULES_SORT_ORDER_TITLE);
define('MODULE_PAYMENT_MONEYORDER_SORT_ORDER_DESC', _MODULES_SORT_ORDER_DESC);
define('MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID_TITLE', _MODULES_SET_ORDER_STATUS_TITLE);
define('MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID_DESC', _MODULES_SET_ORDER_STATUS_DESC);
?>