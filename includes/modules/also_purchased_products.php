<?php

/* -----------------------------------------------------------------------------------------
   $Id: also_purchased_products.php 254 2007-03-09 08:26:11Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(also_purchased_products.php,v 1.21 2003/02/12); www.oscommerce.com 
   (c) 2003	 nextcommerce (also_purchased_products.php,v 1.9 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

$module_smarty = new Smarty;
$module_smarty->assign('language', $_SESSION['language']);

// set cache ID
if (!CacheCheck()) {
	$cache=false;
	$module_smarty->caching = 0;
} else {
	$cache=true;
	$module_smarty->caching = 1;
	$module_smarty->cache_lifetime = CACHE_LIFETIME;
	$module_smarty->cache_modified_check = CACHE_CHECK;
	$cache_id = $_SESSION['language'].$_SESSION['customers_status']['customers_status_id'].$product->data['products_id'].$_SESSION['currency'];
}

if (!$module_smarty->is_cached(CURRENT_TEMPLATE.'/module/also_purchased.html', $cache_id) || !$cache) {
	$module_smarty->assign('tpl_path', 'templates/'.CURRENT_TEMPLATE.'/');
	$rebuild = true;

$data = $product->getAlsoPurchased();
if (count($data) >= MIN_DISPLAY_ALSO_PURCHASED) {

	$module_smarty->assign('language', $_SESSION['language']);
	$module_smarty->assign('module_content', $data);
	// set cache ID


}

}


if ($rebuild) $box_smarty->clear_cache(CURRENT_TEMPLATE.'/module/also_purchased.html', $cache_id);
$box_information = $box_smarty->fetch(CURRENT_TEMPLATE.'/module/also_purchased.html',$cache_id);

$info_smarty->assign('MODULE_also_purchased', $module);
?>