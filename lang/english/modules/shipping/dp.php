<?php
/* -----------------------------------------------------------------------------------------
   $Id: dp.php 899 2005-04-29 02:40:57Z hhgag $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(dp.php,v 1.4 2003/02/18 04:28:00); www.oscommerce.com 
   (c) 2003	 nextcommerce (dp.php,v 1.5 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   German Post (Deutsche Post WorldNet)         	Autor:	Copyright (C) 2002 - 2003 TheMedia, Dipl.-Ing Thomas Plänkers | http://www.themedia.at & http://www.oscommerce.at

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/


define('MODULE_SHIPPING_DP_TEXT_TITLE', 'German Post');
define('MODULE_SHIPPING_DP_TEXT_DESCRIPTION', 'German Post - Worldwide Shipping Module');
define('MODULE_SHIPPING_DP_TEXT_WAY', 'Dispatch to');
define('MODULE_SHIPPING_DP_TEXT_UNITS', 'kg');


define('MODULE_SHIPPING_DP_STATUS_TITLE' , 'German Post WorldNet');
define('MODULE_SHIPPING_DP_STATUS_DESC' , 'Wollen Sie den Versand über die deutsche Post anbieten?');
define('MODULE_SHIPPING_DP_HANDLING_TITLE' , 'Handling Fee');
define('MODULE_SHIPPING_DP_HANDLING_DESC' , 'Bearbeitungsgebühr für diese Versandart in Euro');
define('MODULE_SHIPPING_DP_COUNTRIES_1_TITLE' , 'DP Zone 1 Countries');
define('MODULE_SHIPPING_DP_COUNTRIES_1_DESC' , 'Comma separated list of two character ISO country codes that are part of Zone 1');
define('MODULE_SHIPPING_DP_COST_1_TITLE' , 'DP Zone 1 Shipping Table');
define('MODULE_SHIPPING_DP_COST_1_DESC' , 'Shipping rates to Zone 1 destinations based on a range of order weights. Example: 0-3:8.50,3-7:10.50,... Weights greater than 0 and less than or equal to 3 would cost 14.57 for Zone 1 destinations.');
define('MODULE_SHIPPING_DP_COUNTRIES_2_TITLE' , 'DP Zone 2 Countries');
define('MODULE_SHIPPING_DP_COUNTRIES_2_DESC' , 'Comma separated list of two character ISO country codes that are part of Zone 2');
define('MODULE_SHIPPING_DP_COST_2_TITLE' , 'DP Zone 2 Shipping Table');
define('MODULE_SHIPPING_DP_COST_2_DESC' , 'Shipping rates to Zone 2 destinations based on a range of order weights. Example: 0-3:8.50,3-7:10.50,... Weights greater than 0 and less than or equal to 3 would cost 23.78 for Zone 2 destinations.');
define('MODULE_SHIPPING_DP_COUNTRIES_3_TITLE' , 'DP Zone 3 Countries');
define('MODULE_SHIPPING_DP_COUNTRIES_3_DESC' , 'Comma separated list of two character ISO country codes that are part of Zone 3');
define('MODULE_SHIPPING_DP_COST_3_TITLE' , 'DP Zone 3 Shipping Table');
define('MODULE_SHIPPING_DP_COST_3_DESC' , 'Shipping rates to Zone 3 destinations based on a range of order weights. Example: 0-3:8.50,3-7:10.50,... Weights greater than 0 and less than or equal to 3 would cost 26.84 for Zone 3 destinations.');
define('MODULE_SHIPPING_DP_COUNTRIES_4_TITLE' , 'DP Zone 4 Countries');
define('MODULE_SHIPPING_DP_COUNTRIES_4_DESC' , 'Comma separated list of two character ISO country codes that are part of Zone 4');
define('MODULE_SHIPPING_DP_COST_4_TITLE' , 'DP Zone 4 Shipping Table');
define('MODULE_SHIPPING_DP_COST_4_DESC' , 'Shipping rates to Zone 4 destinations based on a range of order weights. Example: 0-3:8.50,3-7:10.50,... Weights greater than 0 and less than or equal to 3 would cost 32.98 for Zone 4 destinations.');
define('MODULE_SHIPPING_DP_COUNTRIES_5_TITLE' , 'DP Zone 5 Countries');
define('MODULE_SHIPPING_DP_COUNTRIES_5_DESC' , 'Comma separated list of two character ISO country codes that are part of Zone 5');
define('MODULE_SHIPPING_DP_COST_5_TITLE' , 'DP Zone 5 Shipping Table');
define('MODULE_SHIPPING_DP_COST_5_DESC' , 'Shipping rates to Zone 5 destinations based on a range of order weights. Example: 0-3:8.50,3-7:10.50,... Weights greater than 0 and less than or equal to 3 would cost 32.98 for Zone 5 destinations.');
define('MODULE_SHIPPING_DP_COUNTRIES_6_TITLE' , 'DP Zone 6 Countries');
define('MODULE_SHIPPING_DP_COUNTRIES_6_DESC' , 'Comma separated list of two character ISO country codes that are part of Zone 6');
define('MODULE_SHIPPING_DP_COST_6_TITLE' , 'DP Zone 6 Shipping Table');
define('MODULE_SHIPPING_DP_COST_6_DESC' , 'Shipping rates to Zone 6 destinations based on a range of order weights. Example: 0-3:8.50,3-7:10.50,... Weights greater than 0 and less than or equal to 3 would cost 5.62 for Zone 6 destinations.');

define('MODULE_SHIPPING_DP_TAX_CLASS_TITLE' , _MODULES_TAX_ZONE_TITLE);
define('MODULE_SHIPPING_DP_TAX_CLASS_DESC' ,_MODULES_TAX_ZONE_DESC);
define('MODULE_SHIPPING_DP_ZONE_TITLE' , _MODULES_ZONE_TITLE);
define('MODULE_SHIPPING_DP_ZONE_DESC' , _MODULES_ZONE_DESC);
define('MODULE_SHIPPING_DP_SORT_ORDER_TITLE' , _MODULES_SORT_ORDER_TITLE);
define('MODULE_SHIPPING_DP_SORT_ORDER_DESC' , _MODULES_SORT_ORDER_DESC);
define('MODULE_SHIPPING_DP_ALLOWED_TITLE' , _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_SHIPPING_DP_ALLOWED_DESC' , _MODULES_ZONE_ALLOWED_DESC);
define('MODULE_SHIPPING_DP_INVALID_ZONE', _MODULE_INVALID_SHIPPING_ZONE);
define('MODULE_SHIPPING_DP_UNDEFINED_RATE', _MODULE_UNDEFINED_SHIPPING_RATE);
?>
