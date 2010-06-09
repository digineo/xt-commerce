<?php
/* -----------------------------------------------------------------------------------------
   $Id: product_notifications.php,v 1.2 2004/05/31 15:56:36 matthias76 Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(product_notifications.php,v 1.7 2003/05/25); www.oscommerce.com 
   (c) 2003	 nextcommerce (product_notifications.php,v 1.9 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
$box_smarty = new smarty;
$box_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/'); 
$box_content='';
  // include needed files
  require_once(DIR_FS_INC . 'xtc_get_products_name.inc.php');

  if (isset($_GET['products_id'])) {

    if (isset($_SESSION['customer_id'])) {
      $check_query = xtc_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . (int)$_GET['products_id'] . "' and customers_id = '" . (int)$_SESSION['customer_id'] . "'");
      $check = xtc_db_fetch_array($check_query);

      $notification_exists = (($check['count'] > 0) ? true : false);
    } else {
      $notification_exists = false;
    }

    $info_box_contents = array();
    if ($notification_exists == true) {
      $box_content = '<table border="0" cellspacing="0" cellpadding="2"><tr><td class="infoBoxContents"><a href="' . xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . xtc_image('templates/' . CURRENT_TEMPLATE . '/img/box_products_notifications_remove.gif', IMAGE_BUTTON_REMOVE_NOTIFICATIONS) . '</a></td><td class="infoBoxContents"><a href="' . xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY_REMOVE, xtc_get_products_name($_GET['products_id'])) .'</a></td></tr></table>';
    } else {
      $box_content = '<table border="0" cellspacing="0" cellpadding="2"><tr><td class="infoBoxContents"><a href="' . xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . xtc_image('templates/' . CURRENT_TEMPLATE . '/img/box_products_notifications.gif', IMAGE_BUTTON_NOTIFICATIONS) . '</a></td><td class="infoBoxContents"><a href="' . xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY, xtc_get_products_name($_GET['products_id'])) .'</a></td></tr></table>';
    }

  }




    $box_smarty->assign('BOX_CONTENT', $box_content);

 	$box_smarty->assign('language', $_SESSION['language']);
    	  // set cache ID
  if (USE_CACHE=='false') {
  $box_smarty->caching = 0;
  $box_notifications= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_notifications.html');
  } else {
  $box_smarty->caching = 1;	
  $box_smarty->cache_lifetime=CACHE_LIFETIME;
  $box_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_SESSION['language'].$_GET['products_id'];
  $box_notifications= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_notifications.html',$cache_id);
  }

  $smarty->assign('box_NOTIFICATIONS',$box_notifications);
    
?>