<?php
/* -----------------------------------------------------------------------------------------
   $Id: cart_actions.php,v 1.31 2004/06/11 19:07:29 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(application_top.php,v 1.273 2003/05/19); www.oscommerce.com
   (c) 2003         nextcommerce (application_top.php,v 1.54 2003/08/25); www.nextcommerce.org

   Released under the GNU General Public License
   -----------------------------------------------------------------------------------------
   Third Party contribution:
   Add A Quickie v1.0 Autor  Harald Ponce de Leon

   Credit Class/Gift Vouchers/Discount Coupons (Version 5.10)
   http://www.oscommerce.com/community/contributions,282
   Copyright (c) Strider | Strider@oscworks.com
   Copyright (c  Nick Stanko of UkiDev.com, nick@ukidev.com
   Copyright (c) Andre ambidex@gmx.net
   Copyright (c) 2001,2002 Ian C Wilson http://www.phesis.org


   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/



   // Shopping cart actions
  if (isset($_GET['action'])) {
    // redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
      xtc_redirect(xtc_href_link(FILENAME_COOKIE_USAGE));
    }

    if (DISPLAY_CART == 'true') {
      $goto =  FILENAME_SHOPPING_CART;
      $parameters = array('action', 'cPath', 'products_id', 'pid');
    } else {
      $goto = basename($PHP_SELF);
      if ($_GET['action'] == 'buy_now') {
        $parameters = array('action', 'pid', 'products_id');
      } else {
        $parameters = array('action', 'pid');
      }
    }
    switch ($_GET['action']) {
      // customer wants to update the product quantity in their shopping cart
      case 'update_product':
        for ($i = 0, $n = sizeof($_POST['products_id']); $i < $n; $i++) {
          if (in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
            $_SESSION['cart']->remove($_POST['products_id'][$i]);
          } else {
              if ($_POST['cart_quantity'][$i]>MAX_PRODUCTS_QTY) $_POST['cart_quantity'][$i]=MAX_PRODUCTS_QTY;
            $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
            $_SESSION['cart']->add_cart($_POST['products_id'][$i], xtc_remove_non_numeric($_POST['cart_quantity'][$i]), $attributes, false);
          }
        }
        xtc_redirect(xtc_href_link($goto, xtc_get_all_get_params($parameters)));
        break;
      // customer adds a product from the products page
      case 'add_product':
        if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
            if ($_POST['products_qty']>MAX_PRODUCTS_QTY) $_POST['products_qty']=MAX_PRODUCTS_QTY;
          $_SESSION['cart']->add_cart((int)$_POST['products_id'], $_SESSION['cart']->get_quantity(xtc_get_uprid($_POST['products_id'], $_POST['id']))+$_POST['products_qty'], $_POST['id']);
        }
        xtc_redirect(xtc_href_link($goto, xtc_get_all_get_params($parameters)));
        break;

      case 'check_gift':
      require_once(DIR_FS_INC .'xtc_collect_posts.inc.php');
      xtc_collect_posts();
     // echo $_POST['gift_code'];
      break;

            // customer wants to add a quickie to the cart (called from a box)
      case 'add_a_quickie' :

        if (GROUP_CHECK=='true') {
        $group_check="and group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
        }

      $quickie_query = xtc_db_query("select
                                        products_fsk18,
                                        products_id from " . TABLE_PRODUCTS . "
                                        where products_model = '" . $_POST['quickie'] . "'
                                        ".$group_check."
                                        ");
                                        
                              if (!xtc_db_num_rows($quickie_query)) {
                                if (GROUP_CHECK=='true') {
                                $group_check="and group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
                                }
                                $quickie_query = xtc_db_query("select
                                                 products_fsk18,
                                                 products_id from " . TABLE_PRODUCTS . "
                                                 where products_model LIKE '%" . $_POST['quickie'] . "%'
                                                 ".$group_check."
                                                 ");
                              }
                              if (xtc_db_num_rows($quickie_query) != 1) {
                                xtc_redirect(xtc_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords=' . $_POST['quickie'], 'NONSSL'));
                              }
                              $quickie = xtc_db_fetch_array($quickie_query);
                              if (xtc_has_product_attributes($quickie['products_id'])) {
                                xtc_redirect(xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $quickie['products_id'], 'NONSSL'));
                              } else {
                                if ($quickie['products_fsk18']=='1' && $_SESSION['customers_status']['customers_fsk18']=='1') {
                                xtc_redirect(xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $quickie['products_id'], 'NONSSL'));
                                }
                                if ($_SESSION['customers_status']['customers_fsk18_display']=='0' && $quickie['products_fsk18']=='1') {
                                xtc_redirect(xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $quickie['products_id'], 'NONSSL'));
                                }
                                if ($_POST['quickie']!='') {
                                    $act_qty=$_SESSION['cart']->get_quantity(xtc_get_uprid($quickie['products_id'], 1));
                                    if ($act_qty>MAX_PRODUCTS_QTY) $act_qty=MAX_PRODUCTS_QTY-1;
                                    $_SESSION['cart']->add_cart($quickie['products_id'], $act_qty+1, 1);
                                    xtc_redirect(xtc_href_link($goto, xtc_get_all_get_params(array('action')), 'NONSSL'));
                                } else {
                                 xtc_redirect(xtc_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords=' . $_POST['quickie'], 'NONSSL'));
                                }
                              }
                              break;

      // performed by the 'buy now' button in product listings and review page
      case 'buy_now':
        if (isset($_GET['BUYproducts_id'])) {
        // check permission to view product
        $permission_query=xtc_db_query("SELECT group_ids,products_fsk18 from ".TABLE_PRODUCTS." where products_id='".(int)$_GET['BUYproducts_id']."'");
        $permission=xtc_db_fetch_array($permission_query);

         // check for FSK18
         if ($permission['products_fsk18']=='1' && $_SESSION['customers_status']['customers_fsk18']=='1') {
         xtc_redirect(xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['BUYproducts_id'], 'NONSSL'));
            }
         if ($_SESSION['customers_status']['customers_fsk18_display']=='0' && $permission['products_fsk18']=='1') {
            xtc_redirect(xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['BUYproducts_id'], 'NONSSL'));
         }

         if (GROUP_CHECK=='true') {

         if (!strstr($permission['group_ids'],'c_'.$_SESSION['customers_status']['customers_status_id'].'_group')) {
          xtc_redirect(xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['BUYproducts_id']));
         }
         }
          if (xtc_has_product_attributes($_GET['BUYproducts_id'])) {
            xtc_redirect(xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['BUYproducts_id']));
          } else {
            $_SESSION['cart']->add_cart((int)$_GET['BUYproducts_id'], $_SESSION['cart']->get_quantity((int)$_GET['BUYproducts_id'])+1);
          }
        }
        xtc_redirect(xtc_href_link($goto, xtc_get_all_get_params(array('action'))));
        break;
      case 'notify':
        if (isset($_SESSION['customer_id'])) {
          if (isset($_GET['products_id'])) {
            $notify = (int)$_GET['products_id'];
          } elseif (isset($_GET['notify'])) {
            $notify = $_GET['notify'];
          } elseif (isset($_POST['notify'])) {
            $notify = $_POST['notify'];
          } else {
            xtc_redirect(xtc_href_link(basename($_SERVER['PHP_SELF']), xtc_get_all_get_params(array('action', 'notify'))));
          }
          if (!is_array($notify)) $notify = array($notify);
          for ($i = 0, $n = sizeof($notify); $i < $n; $i++) {
            $check_query = xtc_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $notify[$i] . "' and customers_id = '" . (int)$_SESSION['customer_id'] . "'");
            $check = xtc_db_fetch_array($check_query);
            if ($check['count'] < 1) {
              xtc_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . (int)$_SESSION['customer_id'] . "', now())");
            }
          }
          xtc_redirect(xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action', 'notify'))));
        } else {
         //
          xtc_redirect(xtc_href_link(FILENAME_LOGIN, '', 'SSL'));
        }
        break;
      case 'notify_remove':
        if (isset($_SESSION['customer_id']) && isset($_GET['products_id'])) {
          $check_query = xtc_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . (int)$_GET['products_id'] . "' and customers_id = '" . (int)$_SESSION['customer_id'] . "'");
          $check = xtc_db_fetch_array($check_query);
          if ($check['count'] > 0) {
            xtc_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . (int)$_GET['products_id'] . "' and customers_id = '" . (int)$_SESSION['customer_id'] . "'");
          }
          xtc_redirect(xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array('action'))));
        } else {

          xtc_redirect(xtc_href_link(FILENAME_LOGIN, '', 'SSL'));
        }
        break;
      case 'cust_order':
        if (isset($_SESSION['customer_id']) && isset($_GET['pid'])) {
          if (xtc_has_product_attributes((int)$_GET['pid'])) {
            xtc_redirect(xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['pid']));
          } else {
            $_SESSION['cart']->add_cart((int)$_GET['pid'], $_SESSION['cart']->get_quantity((int)$_GET['pid'])+1);
          }
        }
        xtc_redirect(xtc_href_link($goto, xtc_get_all_get_params($parameters)));
        break;
    }
  }

?>