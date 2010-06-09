<?php
/* -----------------------------------------------------------------------------------------
   $Id: upcoming_products.php,v 1.6 2004/03/16 15:01:16 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(upcoming_products.php,v 1.23 2003/02/12); www.oscommerce.com 
   (c) 2003	 nextcommerce (upcoming_products.php,v 1.7 2003/08/22); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

$module_smarty= new Smarty;
$module_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_date_short.inc.php');
   $module_content=array();

    //fsk18 lock
  $fsk_lock='';
  if ($_SESSION['customers_status']['customers_fsk18_display']=='0') {
  $fsk_lock=' and p.products_fsk18!=1';
  }   

     if (GROUP_CHECK=='true') {
   $group_check="and p.group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
  }
  $expected_query = xtc_db_query("select p.products_id,
                                  pd.products_name,
                                  products_date_available as date_expected from " .
                                  TABLE_PRODUCTS . " p, " .
                                  TABLE_PRODUCTS_DESCRIPTION . " pd
                                  where to_days(products_date_available) >= to_days(now())
                                  and p.products_id = pd.products_id
                                  ".$group_check."
                                  ".$fsk_lock."
                                  and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                  order by " . EXPECTED_PRODUCTS_FIELD . " " . EXPECTED_PRODUCTS_SORT . "
                                  limit " . MAX_DISPLAY_UPCOMING_PRODUCTS);
  if (xtc_db_num_rows($expected_query) > 0) {

    $row = 0;
    while ($expected = xtc_db_fetch_array($expected_query)) {
      $row++;
      $module_content[]=array('PRODUCTS_LINK'=>xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $expected['products_id']),
                               'PRODUCTS_NAME'=>$expected['products_name'],
                               'PRODUCTS_DATE'=>xtc_date_short($expected['date_expected'])
                               );

    }


    $module_smarty->assign('language', $_SESSION['language']);
  $module_smarty->assign('module_content',$module_content);
  // set cache ID
  if (USE_CACHE=='false') {
  $module_smarty->caching = 0;
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/upcoming_products.html');
  } else {
  $module_smarty->caching = 1;
  $module_smarty->cache_lifetime=CACHE_LIFETIME;
  $module_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_SESSION['language'].$_SESSION['customers_status']['customers_status_name'].$_SESSION['currency'];
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/upcoming_products.html',$cache_id);
  }
  $default_smarty->assign('MODULE_upcoming_products',$module);
  }
?>