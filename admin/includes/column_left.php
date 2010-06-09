<?php

/* --------------------------------------------------------------
   $Id: column_left.php 1231 2005-09-21 13:05:36Z mz $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(column_left.php,v 1.15 2002/01/11); www.oscommerce.com 
   (c) 2003	 nextcommerce (column_left.php,v 1.25 2003/08/19); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/

$admin_access_query = xtc_db_query("select * from " . TABLE_ADMIN_ACCESS . " where customers_id = '" . $_SESSION['customer_id'] . "'");
$admin_access = xtc_db_fetch_array($admin_access_query);


echo ('<h2 class="boxheader">' . BOX_HEADING_CUSTOMERS . '</h2>');
echo '<div class="boxbody"><ul class="contentlist">';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['customers'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CUSTOMERS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CUSTOMERS . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['customers_status'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CUSTOMERS_STATUS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CUSTOMERS_STATUS . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['orders'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_ORDERS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_ORDERS . '</a></li>';
echo '</ul></div>';

echo ('<h2 class="boxheader">' . BOX_HEADING_PRODUCTS . '</h2>');
echo '<div class="boxbody"><ul class="contentlist">';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['categories'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CATEGORIES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CATEGORIES . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['new_attributes'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_NEW_ATTRIBUTES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_ATTRIBUTES_MANAGER . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['products_attributes'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_PRODUCTS_ATTRIBUTES . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['products_options'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_PRODUCTS_OPTIONS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_PRODUCTS_OPTIONS . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['manufacturers'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_MANUFACTURERS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_MANUFACTURERS . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['reviews'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_REVIEWS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_REVIEWS . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['specials'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_SPECIALS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_SPECIALS . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['products_expected'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_PRODUCTS_EXPECTED, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_PRODUCTS_EXPECTED . '</a></li>';
echo '</ul></div>';

echo ('<h2 class="boxheader">' . BOX_HEADING_MODULES . '</h2>');
echo '<div class="boxbody"><ul class="contentlist">';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['modules'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_PAYMENT . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['modules'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_SHIPPING . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['modules'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_ORDER_TOTAL . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['module_export'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_MODULE_EXPORT) . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_MODULE_EXPORT . '</a></li>';
echo '</ul></div>';
echo ('<h2 class="boxheader">' . BOX_HEADING_STATISTICS . '</h2>');
echo '<div class="boxbody"><ul class="contentlist">';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['stats_products_viewed'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_STATS_PRODUCTS_VIEWED, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_PRODUCTS_VIEWED . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['stats_products_purchased'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_PRODUCTS_PURCHASED . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['stats_customers'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_STATS_CUSTOMERS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_STATS_CUSTOMERS . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['stats_sales_report'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_SALES_REPORT, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_SALES_REPORT . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['stats_campaigns'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CAMPAIGNS_REPORT, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CAMPAIGNS_REPORT . '</a></li>';
echo '</ul></div>';
echo ('<h2 class="boxheader">Econda</h2>');
echo '<div class="boxbody"><ul class="contentlist">';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['econda'] == '1'))
	echo '<li><a href="' . xtc_href_link('econda.php') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . 'ECONDA Shop Monitor</a></li>';
echo '</ul></div>';

echo ('<h2 class="boxheader">' . BOX_HEADING_TOOLS . '</h2>');
echo '<div class="boxbody"><ul class="contentlist">';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['module_newsletter'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_MODULE_NEWSLETTER) . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_MODULE_NEWSLETTER . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['content_manager'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONTENT_MANAGER) . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONTENT . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['blacklist'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_BLACKLIST, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_TOOLS_BLACKLIST . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['backup'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_BACKUP) . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_BACKUP . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['banner_manager'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_BANNER_MANAGER) . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_BANNER_MANAGER . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['server_info'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_SERVER_INFO) . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_SERVER_INFO . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['whos_online'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_WHOS_ONLINE) . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_WHOS_ONLINE . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['csv_backend'] == '1'))
	echo '<li><a href="' . xtc_href_link('csv_backend.php') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_IMPORT . '</a></li>';
echo '</ul></div>';
if (ACTIVATE_GIFT_SYSTEM == 'true') {
	echo ('<h2 class="boxheader">' . BOX_HEADING_GV_ADMIN . '</h2>');
	echo '<div class="boxbody"><ul class="contentlist">';
	if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['coupon_admin'] == '1'))
		echo '<li><a href="' . xtc_href_link(FILENAME_COUPON_ADMIN, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_COUPON_ADMIN . '</a></li>';
	if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['gv_queue'] == '1'))
		echo '<li><a href="' . xtc_href_link(FILENAME_GV_QUEUE, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_GV_ADMIN_QUEUE . '</a></li>';
	if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['gv_mail'] == '1'))
		echo '<li><a href="' . xtc_href_link(FILENAME_GV_MAIL, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_GV_ADMIN_MAIL . '</a></li>';
	if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['gv_sent'] == '1'))
		echo '<li><a href="' . xtc_href_link(FILENAME_GV_SENT, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_GV_ADMIN_SENT . '</a></li>';
	echo '</ul></div>';
}

echo ('<h2 class="boxheader">' . BOX_HEADING_ZONE . '</h2>');
echo '<div class="boxbody"><ul class="contentlist">';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['languages'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_LANGUAGES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_LANGUAGES . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['countries'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_COUNTRIES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_COUNTRIES . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['currencies'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CURRENCIES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CURRENCIES . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['zones'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_ZONES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_ZONES . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['geo_zones'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_GEO_ZONES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_GEO_ZONES . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['tax_classes'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_TAX_CLASSES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_TAX_CLASSES . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['tax_rates'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_TAX_RATES, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_TAX_RATES . '</a></li>';
echo '</ul></div>';

echo ('<h2 class="boxheader">' . BOX_HEADING_CONFIGURATION . '</h2>');
echo '<div class="boxbody"><ul class="contentlist">';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_1 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=2', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_2 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=3', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_3 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=4', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_4 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=5', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_5 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=7', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_7 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=8', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_8 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=9', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_9 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=10', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_10 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=11', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_11 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=12', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_12 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=13', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_13 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=14', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_14 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=15', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_15 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=16', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_16 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=17', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_17 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=18', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_18 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=19', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_19 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['configuration'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CONFIGURATION, 'gID=22', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CONFIGURATION_22 . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['orders_status'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_ORDERS_STATUS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_ORDERS_STATUS . '</a></li>';
if (ACTIVATE_SHIPPING_STATUS == 'true') {
	if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['shipping_status'] == '1'))
		echo '<li><a href="' . xtc_href_link(FILENAME_SHIPPING_STATUS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_SHIPPING_STATUS . '</a></li>';
}
if (ACTIVATE_STOCKS_TRAFFIC == 'true') {
	if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['stocks_traffic'] == '1'))
		echo '<li><a href="' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_STOCKS_TRAFFIC . '</a></li>';
}
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['products_vpe'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_PRODUCTS_VPE, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_PRODUCTS_VPE . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['campaigns'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_CAMPAIGNS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_CAMPAIGNS . '</a></li>';
if (($_SESSION['customers_status']['customers_status_id'] == '0') && ($admin_access['cross_sell_groups'] == '1'))
	echo '<li><a href="' . xtc_href_link(FILENAME_XSELL_GROUPS, '', 'NONSSL') . '">' . xtc_image(DIR_WS_IMAGES . 'icon_arrow.gif') . BOX_ORDERS_XSELL_GROUP . '</a></li>';
echo '</ul></div>';
?>