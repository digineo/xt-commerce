<?php
/* -----------------------------------------------------------------------------------------
   $Id: product_listing.php,v 1.25 2004/06/03 17:27:06 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(product_listing.php,v 1.42 2003/05/27); www.oscommerce.com 
   (c) 2003	 nextcommerce (product_listing.php,v 1.19 2003/08/1); www.nextcommerce.org

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

$module_smarty= new Smarty;
$module_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
$result=true;
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_get_all_get_params.inc.php');
  require_once(DIR_FS_INC . 'xtc_image_button.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_shipping_status_name.inc.php');

  $listing_split = new splitPageResults($listing_sql, $_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');
  $module_content=array();
  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = xtDBquery($listing_split->sql_query);
    while ($listing = xtc_db_fetch_array(&$listing_query,true)) {
      $rows++;
      if ($_SESSION['customers_status']['customers_status_show_price'] != '0') {

        $price=$xtPrice->xtcGetPrice($listing['products_id'],$format=true,1,$listing['products_tax_class_id'],$listing['products_price']);
        $buy_now='';
      	if ($_SESSION['customers_status']['customers_fsk18']=='1') {
            if ($listing['products_fsk18']=='0') $buy_now='<a href="' . xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action')) . 'action=buy_now&BUYproducts_id=' . $listing['products_id'], 'NONSSL') . '">' . xtc_image_button('button_buy_now.gif', TEXT_BUY . $listing['products_name'] . TEXT_NOW);
        } else {
        $buy_now='<a href="' . xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action')) . 'action=buy_now&BUYproducts_id=' . $listing['products_id'], 'NONSSL') . '">' . xtc_image_button('button_buy_now.gif', TEXT_BUY . $listing['products_name'] . TEXT_NOW);
        }
        $fsk18='';
        if ($listing['products_fsk18']=='1') {
        $fsk18='true';
        }
      }
      $image='';
      if ($listing['products_image']!='') {
      $image=DIR_WS_THUMBNAIL_IMAGES . $listing['products_image'];
      }
      if (ACTIVATE_SHIPPING_STATUS=='true') {
                  $shipping_status=xtc_get_shipping_status_name($listing['products_shippingtime']);
                  $shipping_status_name=$shipping_status['name'];
                  if ($shipping_status['image']!='') $shipping_status_image='admin/images/icons/'.$shipping_status['image'];
       }
      $module_content[]=array(
      				'PRODUCTS_NAME'=>$listing['products_name'],
                    'PRODUCTS_MODEL'=>$listing['products_model'],
                    'PRODUCTS_EAN'=>$listing['products_ean'],
      				'PRODUCTS_SHORT_DESCRIPTION'=>$listing['products_short_description'],
      				'PRODUCTS_IMAGE'=>$image,
      				'PRODUCTS_PRICE'=>$price,
      				'PRODUCTS_LINK' =>xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']),
      				'BUTTON_BUY_NOW'=>$buy_now,
                    'PRODUCTS_FSK18' => $fsk18,
                    'SHIPPING_NAME'=>$shipping_status_name,
                    'SHIPPING_IMAGE'=>$shipping_status_image,
                    'PRODUCTS_ID'=>$listing['products_id']);
    }
  }

  if  ($listing_split->number_of_rows > 0) {

$navigation='
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText">'.$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS).'</td>
    <td class="smallText" align="right">'.TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, xtc_get_all_get_params(array('page', 'info', 'x', 'y'))).'</td>
  </tr>
</table>';
      if (GROUP_CHECK=='true') {
   $group_check="and c.group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
  }
    $category_query = xtc_db_query("select
                                    cd.categories_description,
                                    cd.categories_name,
                                    c.listing_template,
                                    c.categories_image from " .
                                    TABLE_CATEGORIES . " c, " .
                                    TABLE_CATEGORIES_DESCRIPTION . " cd
                                    where c.categories_id = '" . $current_category_id . "'
                                    and cd.categories_id = '" . $current_category_id . "'
                                    ".$group_check."
                                    and cd.language_id = '" . $_SESSION['languages_id'] . "'");

    $category = xtc_db_fetch_array($category_query);
    $image='';
    if ($category['categories_image']!='') $image=DIR_WS_IMAGES.'categories/'.$category['categories_image'];
    $module_smarty->assign('CATEGORIES_NAME',$category['categories_name']);
    $module_smarty->assign('CATEGORIES_IMAGE',$image);
    $module_smarty->assign('CATEGORIES_DESCRIPTION',$category['categories_description']);

} else {

// no product found
$result=false;

}
      // get default template
   if ($category['listing_template']=='' or $category['listing_template']=='default') {
          $files=array();
          if ($dir= opendir(DIR_FS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/module/product_listing/')){
          while  (($file = readdir($dir)) !==false) {
        if (is_file( DIR_FS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/module/product_listing/'.$file) and ($file !="index.html")){
        $files[]=array(
                        'id' => $file,
                        'text' => $file);
        }//if
        } // while
        closedir($dir);
        }
  $category['listing_template']=$files[0]['id'];
  }


  if ($result!=false) {

  $module_smarty->assign('MANUFACTURER_DROPDOWN',$manufacturer_dropdown);
  $module_smarty->assign('language', $_SESSION['language']);
  $module_smarty->assign('module_content',$module_content);
  $module_smarty->assign('NAVIGATION',$navigation);
  // set cache ID
  if (USE_CACHE=='false') {
  $module_smarty->caching = 0;
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/product_listing/'.$category['listing_template']);
  } else {
  $module_smarty->caching = 1;
  $module_smarty->cache_lifetime=CACHE_LIFETIME;
  $module_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id =   $_GET['cPath'].'_'.
                $_SESSION['language'].'_'.
                $_SESSION['customers_status']['customers_status_name'].'_'.
                $_SESSION['currency'].'_'.
                $_GET['manufacturers_id'].'_'.
                $_GET['filter_id'].'_'.
                $_GET['page'].'_'.
                $_GET['keywords'].'_'.
                $_GET['categories_id'].'_'.
                $_GET['pfrom'].'_'.
                $_GET['pto'].'_'.
                $_GET['x'].'_'.
                $_GET['y'];
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/product_listing/'.$category['listing_template'],$cache_id);
  }
  $smarty->assign('main_content',$module);
  } else {

  $error=TEXT_PRODUCT_NOT_FOUND;
  include(DIR_WS_MODULES . FILENAME_ERROR_HANDLER);
  }
?>