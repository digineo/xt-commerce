<?php
/* -----------------------------------------------------------------------------------------
   $Id: account_notifications.php,v 1.5 2004/02/07 23:05:09 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(account_notifications.php,v 1.2 2003/05/22); www.oscommerce.com
   (c) 2003	 nextcommerce (account_notifications.php,v 1.13 2003/08/17); www.nextcommerce.org 

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

  include( 'includes/application_top.php');
        // create smarty elements
  $smarty = new Smarty;
  // include boxes
  require(DIR_FS_CATALOG .'templates/'.CURRENT_TEMPLATE. '/source/boxes.php'); 
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_draw_hidden_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_draw_checkbox_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_draw_selection_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_image_button.inc.php');

  if (!isset($_SESSION['customer_id'])) {
    
    xtc_redirect(xtc_href_link(FILENAME_LOGIN, '', 'SSL'));
  }


  $global_query = xtc_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$_SESSION['customer_id'] . "'");
  $global = xtc_db_fetch_array($global_query);

  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    if (isset($_POST['product_global']) && is_numeric($_POST['product_global'])) {
      $product_global = xtc_db_prepare_input($_POST['product_global']);
    } else {
      $product_global = '0';
    }

    (array)$products = $_POST['products'];

    if ($product_global != $global['global_product_notifications']) {
      $product_global = (($global['global_product_notifications'] == '1') ? '0' : '1');

      xtc_db_query("update " . TABLE_CUSTOMERS_INFO . " set global_product_notifications = '" . (int)$product_global . "' where customers_info_id = '" . (int)$_SESSION['customer_id'] . "'");
    } elseif (sizeof($products) > 0) {
      $products_parsed = array();
      for ($i=0, $n=sizeof($products); $i<$n; $i++) {
        if (is_numeric($products[$i])) {
          $products_parsed[] = $products[$i];
        }
      }

      if (sizeof($products_parsed) > 0) {
        $check_query = xtc_db_query("select count(*) as total from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and products_id not in (" . implode(',', $products_parsed) . ")");
        $check = xtc_db_fetch_array($check_query);

        if ($check['total'] > 0) {
          xtc_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and products_id not in (" . implode(',', $products_parsed) . ")");
        }
      }
    } else {
      $check_query = xtc_db_query("select count(*) as total from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
      $check = xtc_db_fetch_array($check_query);

      if ($check['total'] > 0) {
        xtc_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
      }
    }

    $messageStack->add_session('account', SUCCESS_NOTIFICATIONS_UPDATED, 'success');

    xtc_redirect(xtc_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  }

  $breadcrumb->add(NAVBAR_TITLE_1_ACCOUNT_NOTIFICATIONS, xtc_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2_ACCOUNT_NOTIFICATIONS, xtc_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL'));

 require(DIR_WS_INCLUDES . 'header.php');



$smarty->assign('CHECKBOX_GLOBAL',xtc_draw_checkbox_field('product_global', '1', (($global['global_product_notifications'] == '1') ? true : false), 'onclick="checkBox(\'product_global\')"'));
if ($global['global_product_notifications'] != '1') {
$smarty->assign('GLOBAL_NOTIFICATION','0');
} else {
$smarty->assign('GLOBAL_NOTIFICATION','1');
}
  if ($global['global_product_notifications'] != '1') {

    $products_check_query = xtc_db_query("select count(*) as total from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
    $products_check = xtc_db_fetch_array($products_check_query);
    if ($products_check['total'] > 0) {

      $counter = 0;
      $notifications_products='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
      $products_query = xtc_db_query("select pd.products_id, pd.products_name from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_NOTIFICATIONS . " pn where pn.customers_id = '" . (int)$_SESSION['customer_id'] . "' and pn.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by pd.products_name");
      while ($products = xtc_db_fetch_array($products_query)) {
      $notifications_products.= '

                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="checkBox(\'products['.$counter.']\')">
                    <td class="main" width="30">'.xtc_draw_checkbox_field('products[' . $counter . ']', $products['products_id'], true, 'onclick="checkBox(\'products[' . $counter . ']\')"').'</td>
                    <td class="main"><b>'.$products['products_name'].'</b></td>
                  </tr> ';

        $counter++;
      }
      $notifications_products.= '</table>';
      $smarty->assign('PRODUCTS_NOTIFICATION',$notifications_products);
    } else {

    }

  }

  $smarty->assign('FORM_ACTION',xtc_draw_form('account_notifications', xtc_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL')) . xtc_draw_hidden_field('action', 'process'));
  $smarty->assign('language', $_SESSION['language']);
  $smarty->assign('BUTTON_BACK','<a href="' . xtc_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . xtc_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>');
  $smarty->assign('BUTTON_CONTINUE',xtc_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE));
  $smarty->caching = 0;
  $main_content=$smarty->fetch(CURRENT_TEMPLATE . '/module/account_notifications.html');

  $smarty->assign('language', $_SESSION['language']);
  $smarty->assign('main_content',$main_content);
  $smarty->caching = 0;
  if (!defined(RM)) $smarty->load_filter('output', 'note');
  $smarty->display(CURRENT_TEMPLATE . '/index.html');
  ?>