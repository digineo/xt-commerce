<?php

/* -----------------------------------------------------------------------------------------
   $Id: eustandardtransfer.php 192 2007-02-24 16:24:52Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(ptebanktransfer.php,v 1.4.1 2003/09/25 19:57:14); www.oscommerce.com

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

define('MODULE_PAYMENT_EUSTANDARDTRANSFER_TEXT_TITLE', 'EU-Standard Bank Transfer');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_TEXT_DESCRIPTION', '<br />Please use the following details to transfer your total order value:<br />' .
'<br />Bank Name: ' . MODULE_PAYMENT_EUTRANSFER_BANKNAM .
'<br />Branch: ' . MODULE_PAYMENT_EUTRANSFER_BRANCH .
'<br />Account Name: ' . MODULE_PAYMENT_EUTRANSFER_ACCNAM .
'<br />Account No.: ' . MODULE_PAYMENT_EUTRANSFER_ACCNUM .
'<br />IBAN:: ' . MODULE_PAYMENT_EUTRANSFER_ACCIBAN .
'<br />BIC/SWIFT: ' . MODULE_PAYMENT_EUTRANSFER_BANKBIC .
//                                                         '<br />Sort Code: ' . MODULE_PAYMENT_EUTRANSFER_SORTCODE .
'<br /><br />Your order will not ship until we receive payment in the above account.<br />');

define('MODULE_PAYMENT_EUSTANDARDTRANSFER_STATUS_TITLE', 'Allow Bank Transfer Payment');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_STATUS_DESC', 'Do you want to accept bank transfer order payments?');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_TEXT_INFO', '');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_BRANCH_TITLE', 'Branch Location');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_BRANCH_DESC', 'The brach where you have your account.');

define('MODULE_PAYMENT_EUSTANDARDTRANSFER_BANKNAM_TITLE', 'Bank Name');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_BANKNAM_DESC', 'Your full bank name');

define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ACCNAM_TITLE', 'Bank Account Name');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ACCNAM_DESC', 'The name associated with the account.');

define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ACCNUM_TITLE', 'Bank Account No.');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ACCNUM_DESC', 'Your account number.');

define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ACCIBAN_TITLE', 'Bank Account IBAN');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ACCIBAN_DESC', 'International account id.<br />(ask your bank if you don\'t know it)');

define('MODULE_PAYMENT_EUSTANDARDTRANSFER_BANKBIC_TITLE', 'Bank Bic');
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_BANKBIC_DESC', 'International bank id.<br />(ask your bank if you don\'t know it)');

define('MODULE_PAYMENT_EUSTANDARDTRANSFER_COST_TITLE', _MODULES_PAYMENT_FEE_TITLE);
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_COST_DESC', _MODULES_PAYMENT_FEE_DESC);
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ZONE_TITLE', _MODULES_ZONE_TITLE);
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ZONE_DESC', _MODULES_ZONE_DESC);
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ALLOWED_TITLE', _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ALLOWED_DESC', _MODULES_ZONE_ALLOWED_DESC);
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_SORT_ORDER_TITLE', _MODULES_SORT_ORDER_TITLE);
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_SORT_ORDER_DESC', _MODULES_SORT_ORDER_DESC);
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ORDER_STATUS_ID_TITLE', _MODULES_SET_ORDER_STATUS_TITLE);
define('MODULE_PAYMENT_EUSTANDARDTRANSFER_ORDER_STATUS_ID_DESC', _MODULES_SET_ORDER_STATUS_DESC);
?>
