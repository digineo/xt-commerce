  <?php
/* -----------------------------------------------------------------------------------------
   $Id: product_info.php,v 1.37 2004/06/04 12:14:44 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(product_info.php,v 1.94 2003/05/04); www.oscommerce.com 
   (c) 2003      nextcommerce (product_info.php,v 1.46 2003/08/25); www.nextcommerce.org

   Released under the GNU General Public License 
   -----------------------------------------------------------------------------------------
   Third Party contribution:
   Customers Status v3.x  (c) 2002-2003 Copyright Elari elari@free.fr | www.unlockgsm.com/dload-osc/ | CVS : http://cvs.sourceforge.net/cgi-bin/viewcvs.cgi/elari/?sortby=date#dirlist
   New Attribute Manager v4b                            Autor: Mike G | mp3man@internetwork.net | http://downloads.ephing.com   
   Cross-Sell (X-Sell) Admin 1                          Autor: Joshua Dechant (dreamscape)
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/
    

   //include needed functions

   require_once(DIR_FS_INC . 'xtc_get_shipping_status_name.inc.php');
   require_once(DIR_FS_INC . 'xtc_check_categories_status.inc.php');
   require_once(DIR_FS_INC . 'xtc_get_products_mo_images.inc.php');
   require_once(DIR_FS_INC . 'xtc_get_vpe_name.inc.php');
   

   
 $info_smarty = new Smarty;
 $info_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
 $group_check='';
 
 if (GROUP_CHECK=='true') $group_check="and p.group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
  
  $product_info_query="select
                                      p.products_fsk18,
                                      p.products_discount_allowed,
                                      p.products_id,
                                      p.products_ean,
                                      pd.products_name,
                                      pd.products_description,
                                      p.products_model,
                                      p.products_shippingtime,
                                      p.products_quantity,
                                      p.products_weight,
                                      p.products_image,
                                      p.products_status,
                                      p.products_ordered,
                                      p.products_price,
                                      pd.products_url,
                                      p.products_tax_class_id,
                                      p.products_date_added,
                                      p.products_date_available,
                                      p.manufacturers_id,
                                      p.products_vpe,
                                      p.products_vpe_status,
                                      p.products_vpe_value,
                                      p.product_template 									  
                                      from " . TABLE_PRODUCTS . " p,
                                      " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                      where p.products_status = '1'
                                      and p.products_id = '" . (int)$_GET['products_id'] . "'
                                      and pd.products_id = p.products_id
                                      ".$group_check."
                                      and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";



  $product_info_query = xtDBquery($product_info_query);

  if (!xtc_db_num_rows(&$product_info_query,true)) { // product not found in database

  $error=TEXT_PRODUCT_NOT_FOUND;
  include(DIR_WS_MODULES . FILENAME_ERROR_HANDLER);


  } else {
    if (ACTIVATE_NAVIGATOR=='true') include(DIR_WS_MODULES . 'product_navigator.php');
    
    xtc_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$_GET['products_id'] . "' and language_id = '" . $_SESSION['languages_id'] . "'");
    $product_info = xtc_db_fetch_array(&$product_info_query,true);


    //fsk18 lock
    if ($_SESSION['customers_status']['customers_fsk18_display']=='0' && $product_info['products_fsk18']=='1') {

  $error=TEXT_PRODUCT_NOT_FOUND;
  include(DIR_WS_MODULES . FILENAME_ERROR_HANDLER);


    } else {

    $products_price=$xtPrice->xtcGetPrice($product_info['products_id'],
                                        $format=true,
                                        1,
                                        $product_info['products_tax_class_id'],
                                        $product_info['products_price'],1);

    // check if customer is allowed to add to cart
    if ($_SESSION['customers_status']['customers_status_show_price']!='0') {
        // fsk18
        if ($_SESSION['customers_status']['customers_fsk18']=='1') {
            if ($product_info['products_fsk18']=='0') {
            $info_smarty->assign('ADD_QTY',xtc_draw_input_field('products_qty', '1','size="3"') . ' ' . xtc_draw_hidden_field('products_id', $product_info['products_id']));
            $info_smarty->assign('ADD_CART_BUTTON', xtc_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART));
        }
        } else {
        $info_smarty->assign('ADD_QTY',xtc_draw_input_field('products_qty', '1','size="3"') . ' ' . xtc_draw_hidden_field('products_id', $product_info['products_id']));
        $info_smarty->assign('ADD_CART_BUTTON', xtc_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART));
        }
    }

    if ($product_info['products_fsk18']=='1') {
    $info_smarty->assign('PRODUCTS_FSK18','true');
    }
    if (ACTIVATE_SHIPPING_STATUS=='true') {
    $shipping_status=xtc_get_shipping_status_name($product_info['products_shippingtime']);
    $info_smarty->assign('SHIPPING_NAME',$shipping_status['name']);
    if ($shipping_status['image']!='')  $info_smarty->assign('SHIPPING_IMAGE','admin/images/icons/'.$shipping_status['image']);
    }
    $info_smarty->assign('FORM_ACTION', xtc_draw_form('cart_quantity', xtc_href_link(FILENAME_PRODUCT_INFO, xtc_get_all_get_params(array('action')) . 'action=add_product')));
    $info_smarty->assign('FORM_END','</form>');
    $info_smarty->assign('PRODUCTS_PRICE',$products_price['formated']);
    if ($product_info['products_vpe_status']==1 && $product_info['products_vpe_value']!=0.0) $info_smarty->assign('PRODUCTS_VPE',$xtPrice->xtcFormat($products_price['plain']*(1/$product_info['products_vpe_value']),true).TXT_PER.xtc_get_vpe_name($product_info['products_vpe']));
    $info_smarty->assign('PRODUCTS_ID',$product_info['products_id']);
    $info_smarty->assign('PRODUCTS_NAME',$product_info['products_name']);
    $info_smarty->assign('PRODUCTS_MODEL',$product_info['products_model']);
    $info_smarty->assign('PRODUCTS_EAN',$product_info['products_ean']);
    $info_smarty->assign('PRODUCTS_QUANTITY',$product_info['products_quantity']);
    $info_smarty->assign('PRODUCTS_WEIGHT',$product_info['products_weight']);
    $info_smarty->assign('PRODUCTS_STATUS',$product_info['products_status']);
    $info_smarty->assign('PRODUCTS_ORDERED',$product_info['products_ordered']);
    $info_smarty->assign('PRODUCTS_PRINT', '<img src="'.DIR_WS_ICONS.'print.gif"  style="cursor:hand" onclick="javascript:window.open(\''.xtc_href_link(FILENAME_PRINT_PRODUCT_INFO,'products_id='.$_GET['products_id']).'\', \'popup\', \'toolbar=0, width=640, height=600\')" alt="" />');
    $info_smarty->assign('PRODUCTS_DESCRIPTION',stripslashes($product_info['products_description']));
    $image='';
    if ($product_info['products_image']!='') $image=DIR_WS_INFO_IMAGES . $product_info['products_image'];
    
    $info_smarty->assign('PRODUCTS_IMAGE',$image);
    $info_smarty->assign('PRODUCTS_POPUP_LINK','javascript:popupWindow(\'' . xtc_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id']) . '&imgID=0\')');
	
    //mo_images - by Novalis@eXanto.de
	if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') $connector = '/'; else $connector = '&';
	$info_smarty->assign('PRODUCTS_POPUP_LINK','javascript:popupWindow(\'' . xtc_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id'] . $connector . 'imgID=' . '0'). '\')');
    $mo_images = xtc_get_products_mo_images($product_info['products_id']); 
    if (isset($mo_images)){
    foreach($mo_images as $img) {
    	$mo_img = DIR_WS_INFO_IMAGES . $img['image_name'];
    	$info_smarty->assign('PRODUCTS_IMAGE_'.$img['image_nr'], $mo_img);
		$info_smarty->assign('PRODUCTS_POPUP_LINK_'.$img['image_nr'],'javascript:popupWindow(\'' . xtc_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id'] . $connector . 'imgID='.$img['image_nr']).'\')');
    }}
	//mo_images EOF
    
      if ($_SESSION['customers_status']['customers_status_public'] == 1 && $_SESSION['customers_status']['customers_status_discount'] != '0.00') {
      	$discount = $_SESSION['customers_status']['customers_status_discount'];
      	if ($product_info['products_discount_allowed'] < $_SESSION['customers_status']['customers_status_discount']) $discount = $product_info['products_discount_allowed'];
      	if ($discount != '0.00' ) $info_smarty->assign('PRODUCTS_DISCOUNT',$discount . '%');	
      }

include(DIR_WS_MODULES . 'product_attributes.php');
include(DIR_WS_MODULES . 'product_reviews.php'); 


    if (xtc_not_null($product_info['products_url'])) $info_smarty->assign('PRODUCTS_URL',sprintf(TEXT_MORE_INFORMATION, xtc_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false)));


    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
        $info_smarty->assign('PRODUCTS_DATE_AVIABLE',sprintf(TEXT_DATE_AVAILABLE, xtc_date_long($product_info['products_date_available'])));


    } else {
        if ($product_info['products_date_added']!='0000-00-00 00:00:00') $info_smarty->assign('PRODUCTS_ADDED',sprintf(TEXT_DATE_ADDED, xtc_date_long($product_info['products_date_added'])));

    }

 if ($_SESSION['customers_status']['customers_status_graduated_prices'] == 1) include(DIR_WS_MODULES.FILENAME_GRADUATED_PRICE);
 

 include(DIR_WS_MODULES . FILENAME_PRODUCTS_MEDIA);
 include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
  }
  if ($product_info['product_template']=='' or $product_info['product_template']=='default') {
          $files=array();
          if ($dir= opendir(DIR_FS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/module/product_info/')){
          while  ($file = readdir($dir)) {
        if (is_file( DIR_FS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/module/product_info/'.$file) and ($file !="index.html")){
        $files[]=array(
                        'id' => $file,
                        'text' => $file);
        }//if
        } // while
        closedir($dir);
        }
  $product_info['product_template']=$files[0]['id'];
  }


  $info_smarty->assign('language', $_SESSION['language']);
  // set cache ID
  if (USE_CACHE=='false') {
  $info_smarty->caching = 0;
  $product_info= $info_smarty->fetch(CURRENT_TEMPLATE.'/module/product_info/'.$product_info['product_template']);
  } else {
  $info_smarty->caching = 1;	
  $info_smarty->cache_lifetime=CACHE_LIFETIME;
  $info_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_GET['products_id'].$_SESSION['language'].$_SESSION['customers_status']['customers_status_name'].$_SESSION['currency'];
  $product_info= $info_smarty->fetch(CURRENT_TEMPLATE.'/module/product_info/'.$product_info['product_template'],$cache_id);
  }


  }
  $smarty->assign('main_content',$product_info);

  ?>