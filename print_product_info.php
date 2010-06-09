<?php
/* -----------------------------------------------------------------------------------------
   $Id: print_product_info.php,v 1.6 2004/04/26 12:28:47 fanta2k Exp $   

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

  include( 'includes/application_top.php');
  
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_get_products_mo_images.inc.php');

  $smarty = new Smarty;

  $product_info_query = xtc_db_query("select p.products_id,p.products_tax_class_id,p.products_price, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  $product_info = xtc_db_fetch_array($product_info_query);

  $products_price=$xtPrice->xtcGetPrice($product_info['products_id'],
                                        $format=true,
                                        1,
                                        $product_info['products_tax_class_id'],
                                        $product_info['products_price']);


  $products_attributes_query = xtc_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  $products_attributes = xtc_db_fetch_array($products_attributes_query);
  if ($products_attributes['total'] > 0) {
    $products_options_name_query = xtc_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$_SESSION['languages_id'] . "' order by popt.products_options_name");
    while ($products_options_name = xtc_db_fetch_array($products_options_name_query)) {
      $selected = 0;

      $products_options_query = xtc_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix,pa.attributes_stock, pa.attributes_model from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$_GET['products_id'] . "' and pa.options_id = '" . $products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$_SESSION['languages_id'] . "'");
      while ($products_options = xtc_db_fetch_array($products_options_query)) {
        $module_content[] = array(
          'GROUP'=>$products_options_name['products_options_name'],
          'NAME'=>$products_options['products_options_values_name']);

        if ($products_options['options_values_price'] != '0') {

        if ($_SESSION['customers_status']['customers_status_show_price_tax'] == 1) {
        $tax_rate=xtc_get_tax_rate($product_info['products_tax_class_id']);
        $products_options['options_values_price']=xtc_add_tax($products_options['options_values_price'],xtc_get_tax_rate($product_info['products_tax_class_id']));
        }
          $module_content[sizeof($module_content)-1]['NAME'] .= ' (' . $products_options['price_prefix'] . $xtPrice->xtcFormat($products_options['options_values_price'], true) .')';
        }
      }
    }
  }

  // assign language to template for caching
  $smarty->assign('language', $_SESSION['language']);	

  $image='';
  if ($product_info['products_image']!='') {
  $image=DIR_WS_CATALOG . DIR_WS_THUMBNAIL_IMAGES . $product_info['products_image'];
  }
  $smarty->assign('PRODUCTS_NAME', $product_info['products_name']);
  $smarty->assign('PRODUCTS_MODEL', $product_info['products_model']);
  $smarty->assign('PRODUCTS_DESCRIPTION', $product_info['products_description']);
  $smarty->assign('PRODUCTS_IMAGE',$image);
  $smarty->assign('PRODUCTS_PRICE', $products_price);
  $smarty->assign('module_content', $module_content);
  
  //more images - by Novalis
  $mo_images = xtc_get_products_mo_images($product_info['products_id']);
  if (isset($mo_images)){ 
  foreach($mo_images as $img) {
  	$mo_img = DIR_WS_CATALOG . DIR_WS_THUMBNAIL_IMAGES . $img['image_name'];
  	$smarty->assign('PRODUCTS_IMAGE_'.$img['image_nr'], $mo_img);  	
  }}

  // set cache ID
  if (USE_CACHE=='false') {
  $smarty->caching = 0;
  } else {
  $smarty->caching = 1;	
  $smarty->cache_lifetime=CACHE_LIFETIME;
  $smarty->cache_modified_check=CACHE_CHECK;
  }
  $cache_id = $_SESSION['language'] . '_' . $product_info['products_id'];
  

  $smarty->display(CURRENT_TEMPLATE . '/module/print_product_info.html', $cache_id);
?>