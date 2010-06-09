<?php

/* -----------------------------------------------------------------------------------------
   $Id: print_product_info.php 300 2007-03-30 07:07:54Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(product_info.php,v 1.94 2003/05/04); www.oscommerce.com 
   (c) 2003	 nextcommerce (print_product_info.php,v 1.16 2003/08/25); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

include ('includes/application_top.php');

// include needed functions
require_once (DIR_FS_INC.'xtc_get_products_mo_images.inc.php');
require_once (DIR_FS_INC.'xtc_get_vpe_name.inc.php');
require_once (DIR_FS_INC.'xtc_date_long.inc.php');

$smarty = new Smarty;

$product_info_query = xtc_db_query("select * FROM ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd where p.products_status = '1' and p.products_id = '".(int) $_GET['products_id']."' and pd.products_id = p.products_id and pd.language_id = '".(int) $_SESSION['languages_id']."'");
$product_info = xtc_db_fetch_array($product_info_query);

$products_price = $xtPrice->xtcGetPrice($product_info['products_id'], $format = true, 1, $product_info['products_tax_class_id'], $product_info['products_price'], 1);

$products_attributes_query = xtc_db_query("select count(*) as total from ".TABLE_PRODUCTS_OPTIONS." popt, ".TABLE_PRODUCTS_ATTRIBUTES." patrib where patrib.products_id='".(int) $_GET['products_id']."' and patrib.options_id = popt.products_options_id and popt.language_id = '".(int) $_SESSION['languages_id']."'");
$products_attributes = xtc_db_fetch_array($products_attributes_query);
if ($products_attributes['total'] > 0) {
	$products_options_name_query = xtc_db_query("select distinct popt.products_options_id, popt.products_options_name from ".TABLE_PRODUCTS_OPTIONS." popt, ".TABLE_PRODUCTS_ATTRIBUTES." patrib where patrib.products_id='".(int) $_GET['products_id']."' and patrib.options_id = popt.products_options_id and popt.language_id = '".(int) $_SESSION['languages_id']."' order by popt.products_options_name");
	while ($products_options_name = xtc_db_fetch_array($products_options_name_query)) {
		$selected = 0;

		$products_options_query = xtc_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix,pa.attributes_stock, pa.attributes_model from ".TABLE_PRODUCTS_ATTRIBUTES." pa, ".TABLE_PRODUCTS_OPTIONS_VALUES." pov where pa.products_id = '".(int) $_GET['products_id']."' and pa.options_id = '".$products_options_name['products_options_id']."' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '".(int) $_SESSION['languages_id']."'");
		while ($products_options = xtc_db_fetch_array($products_options_query)) {
			$module_content[] = array ('GROUP' => $products_options_name['products_options_name'], 'NAME' => $products_options['products_options_values_name']);

			if ($products_options['options_values_price'] != '0') {

				if ($_SESSION['customers_status']['customers_status_show_price_tax'] == 1) {
					$tax_rate = $xtPrice->TAX[$product_info['products_tax_class_id']];
					$products_options['options_values_price'] = xtc_add_tax($products_options['options_values_price'], $xtPrice->TAX[$product_info['products_tax_class_id']]);
				}
				if ($_SESSION['customers_status']['customers_status_show_price'] == 1) {
					$module_content[sizeof($module_content) - 1]['NAME'] .= ' ('.$products_options['price_prefix'].$xtPrice->xtcFormat($products_options['options_values_price'], true,0,true).')';
				}
			}
		}
	}
}

// assign language to template for caching
$smarty->assign('language', $_SESSION['language']);

$image = '';
if ($product_info['products_image'] != '') {
	$image = DIR_WS_CATALOG.DIR_WS_THUMBNAIL_IMAGES.$product_info['products_image'];
}


		if ($_SESSION['customers_status']['customers_status_show_price'] != 0) {
			// price incl tax
			$tax_rate = $xtPrice->TAX[$product->data['products_tax_class_id']];				
			$tax_info = $main->getTaxInfo($tax_rate);
			$smarty->assign('PRODUCTS_TAX_INFO', $tax_info);
			$smarty->assign('PRODUCTS_SHIPPING_LINK',$main->getShippingLink());
		}
		
		
		if ($product->data['products_fsk18'] == '1') {
			$smarty->assign('PRODUCTS_FSK18', 'true');
		}
		if (ACTIVATE_SHIPPING_STATUS == 'true') {
			$smarty->assign('SHIPPING_NAME', $main->getShippingStatusName($product->data['products_shippingtime']));
			$smarty->assign('SHIPPING_IMAGE', $main->getShippingStatusImage($product->data['products_shippingtime']));
		}

		$smarty->assign('PRODUCTS_PRICE', $products_price['formated']);
		if ($product->data['products_vpe_status'] == 1 && $product->data['products_vpe_value'] != 0.0 && $products_price['plain'] > 0)
			$smarty->assign('PRODUCTS_VPE', $xtPrice->xtcFormat($products_price['plain'] * (1 / $product->data['products_vpe_value']), true).TXT_PER.xtc_get_vpe_name($product->data['products_vpe']));
		$smarty->assign('PRODUCTS_ID', $product->data['products_id']);
		$smarty->assign('PRODUCTS_NAME', $product->data['products_name']);		
		$smarty->assign('PRODUCTS_MODEL', $product->data['products_model']);
		$smarty->assign('PRODUCTS_EAN', $product->data['products_ean']);
		$smarty->assign('PRODUCTS_QUANTITY', $product->data['products_quantity']);
		$smarty->assign('PRODUCTS_WEIGHT', $product->data['products_weight']);
		$smarty->assign('PRODUCTS_STATUS', $product->data['products_status']);
		$smarty->assign('PRODUCTS_ORDERED', $product->data['products_ordered']);
		$smarty->assign('PRODUCTS_PRINT', '<img src="templates/'.CURRENT_TEMPLATE.'/buttons/'.$_SESSION['language'].'/print.gif"  style="cursor:hand" onclick="javascript:window.open(\''.xtc_href_link(FILENAME_PRINT_PRODUCT_INFO, 'products_id='.$product->data['products_id']).'\', \'popup\', \'toolbar=0, width=640, height=600\')" alt="" />');
		$smarty->assign('PRODUCTS_DESCRIPTION', stripslashes($product->data['products_description']));
		$image = '';
		if ($product->data['products_image'] != '')
			$image = DIR_WS_INFO_IMAGES.$product->data['products_image'];

		$smarty->assign('PRODUCTS_IMAGE', $image);
		
			//mo_images - by Novalis@eXanto.de
		if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
			$connector = '/';
		}else{
			$connector = '&';
		}
		$smarty->assign('PRODUCTS_POPUP_LINK', 'javascript:popupWindow(\''.xtc_href_link(FILENAME_POPUP_IMAGE, 'pID='.$product->data['products_id'].$connector.'imgID=0').'\')');
		$mo_images = xtc_get_products_mo_images($product->data['products_id']);
		if ($mo_images != false) {
			foreach ($mo_images as $img) {
				$mo_img = DIR_WS_INFO_IMAGES.$img['image_name'];
				$smarty->assign('PRODUCTS_IMAGE_'.$img['image_nr'], $mo_img);
				$smarty->assign('PRODUCTS_POPUP_LINK_'.$img['image_nr'], 'javascript:popupWindow(\''.xtc_href_link(FILENAME_POPUP_IMAGE, 'pID='.$product->data['products_id'].$connector.'imgID='.$img['image_nr']).'\')');
			}
		}
		//mo_images EOF

		$discount = 0.00;
		if ($_SESSION['customers_status']['customers_status_public'] == 1 && $_SESSION['customers_status']['customers_status_discount'] != '0.00') {
			$discount = $_SESSION['customers_status']['customers_status_discount'];
			if ($product->data['products_discount_allowed'] < $_SESSION['customers_status']['customers_status_discount'])
				$discount = $product->data['products_discount_allowed'];
			if ($discount != '0.00')
				$smarty->assign('PRODUCTS_DISCOUNT', $discount.'%');
		}

		if (xtc_not_null($product->data['products_url']))
			$smarty->assign('PRODUCTS_URL', sprintf(TEXT_MORE_INFORMATION, xtc_href_link(FILENAME_REDIRECT, 'action=product&id='.$product->data['products_id'], 'NONSSL', true, false)));

		if ($product->data['products_date_available'] > date('Y-m-d H:i:s')) {
			$smarty->assign('PRODUCTS_DATE_AVIABLE', sprintf(TEXT_DATE_AVAILABLE, xtc_date_long($product->data['products_date_available'])));

		} else {
			if ($product->data['products_date_added'] != '0000-00-00 00:00:00')
				$smarty->assign('PRODUCTS_ADDED', sprintf(TEXT_DATE_ADDED, xtc_date_long($product->data['products_date_added'])));

		}

$smarty->assign('module_content', $module_content);
$smarty->assign('charset',$_SESSION['language_charset']);


// set cache ID
 if (!CacheCheck()) {
	$smarty->caching = 0;
} else {
	$smarty->caching = 1;
	$smarty->cache_lifetime = CACHE_LIFETIME;
	$smarty->cache_modified_check = CACHE_CHECK;
}
$cache_id = $_SESSION['language'].'_'.$product_info['products_id'];

$smarty->display(CURRENT_TEMPLATE.'/module/print_product_info.html', $cache_id);
?>