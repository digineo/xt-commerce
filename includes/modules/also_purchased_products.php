<?php
/* -----------------------------------------------------------------------------------------
   $Id: also_purchased_products.php,v 1.11 2004/03/16 15:01:16 fanta2k Exp $   

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

$module_smarty= new Smarty;
$module_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
  // include needed files
  require_once(DIR_FS_INC . 'xtc_get_products_name.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_short_description.inc.php');

  if (isset($_GET['products_id'])) {

    //fsk18 lock
  $fsk_lock='';
  if ($_SESSION['customers_status']['customers_fsk18_display']=='0') $fsk_lock=' and p.products_fsk18!=1';
  
  if (GROUP_CHECK=='true') $group_check="and p.group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
  
    $orders_query = xtc_db_query("select
                                  p.products_fsk18,
                                  p.products_id,
                                  p.products_price,
                                  p.products_tax_class_id,
                                  p.products_image from " .
                                  TABLE_ORDERS_PRODUCTS . " opa, " .
                                  TABLE_ORDERS_PRODUCTS . " opb, " .
                                  TABLE_ORDERS . " o, " . TABLE_PRODUCTS . " p
                                  where opa.products_id = '" . (int)$_GET['products_id'] . "'
                                  and opa.orders_id = opb.orders_id
                                  and opb.products_id != '" . (int)$_GET['products_id'] . "'
                                  and opb.products_id = p.products_id
                                  and opb.orders_id = o.orders_id ".$fsk_lock."
                                  and p.products_status = '1'
                                  ".$group_check."
                                  ".$fsk_lock."
                                  group by p.products_id order by o.date_purchased desc limit " . MAX_DISPLAY_ALSO_PURCHASED);

    $num_products_ordered = xtc_db_num_rows($orders_query);
    if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED) {

      $row = 0;
      $module_content = array();
      while ($orders = xtc_db_fetch_array($orders_query)) {
        $orders['products_name'] = xtc_get_products_name($orders['products_id']);
        $orders['products_short_description'] = xtc_get_short_description($orders['products_id']);

    $image='';
    if ($orders['products_image']!='') $image=DIR_WS_THUMBNAIL_IMAGES . $orders['products_image'];
	$SEF_parameter='';
    if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') $SEF_parameter='&product='.xtc_cleanName($orders['products_name']); 
      
    if ($_SESSION['customers_status']['customers_status_show_price']!='0') {
    $buy_now='';
    if ($_SESSION['customers_status']['customers_fsk18']=='1') {
        if ($orders['products_fsk18']=='0') $buy_now='<a href="' . xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action')) . 'action=buy_now&BUYproducts_id=' . $orders['products_id'], 'NONSSL') . '">' . xtc_image_button('button_buy_now.gif', TEXT_BUY . $orders['products_name'] . TEXT_NOW);
    } else {
        $buy_now='<a href="' . xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action')) . 'action=buy_now&BUYproducts_id=' . $orders['products_id'], 'NONSSL') . '">' . xtc_image_button('button_buy_now.gif', TEXT_BUY . $orders['products_name'] . TEXT_NOW);
    }

	$module_content[]=array(
							'PRODUCTS_NAME' => $orders['products_name'],
							'PRODUCTS_DESCRIPTION' => $orders['products_short_description'],
							'PRODUCTS_PRICE' => $xtPrice->xtcGetPrice($orders['products_id'],$format=true,1,$orders['products_tax_class_id'],$orders['products_price']),
							'PRODUCTS_LINK' => xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $orders['products_id'].$SEF_parameter),
							'PRODUCTS_IMAGE' => $image,
							'BUTTON_BUY_NOW'=>$buy_now);
  } else {
    $module_content[]=array(
                            'PRODUCTS_NAME' => $orders['products_name'],
                            'PRODUCTS_DESCRIPTION' => $orders['products_short_description'],
                            'PRODUCTS_PRICE' => $xtPrice->xtcGetPrice($orders['products_id'],$format=true,1,$orders['products_tax_class_id'],$orders['products_price']),
                            'PRODUCTS_LINK' => xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $orders['products_id'].$SEF_parameter),
                            'PRODUCTS_FSK18' => 'true',
                            'PRODUCTS_IMAGE' => $image);

  }
    $row ++;
      }

  $module_smarty->assign('language', $_SESSION['language']);
  $module_smarty->assign('module_content',$module_content);
  // set cache ID
  if (USE_CACHE=='false') {
  $module_smarty->caching = 0;
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/also_purchased.html');
  } else {
  $module_smarty->caching = 1;	
  $module_smarty->cache_lifetime=CACHE_LIFETIME;
  $module_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_SESSION['language'].$_GET['products_id'].$_SESSION['customers_status']['customers_status_name'];
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/also_purchased.html',$cache_id);
  }
  $info_smarty->assign('MODULE_also_purchased',$module);
  
    }
  }
?>