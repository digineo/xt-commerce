<?php
/* -----------------------------------------------------------------------------------------
   $Id: logoff.php,v 1.6 2004/02/17 21:13:26 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(logoff.php,v 1.12 2003/02/13); www.oscommerce.com 
   (c) 2003	 nextcommerce (logoff.php,v 1.16 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License
   -----------------------------------------------------------------------------------------
   Third Party contribution:

   Credit Class/Gift Vouchers/Discount Coupons (Version 5.10)
   http://www.oscommerce.com/community/contributions,282
   Copyright (c) Strider | Strider@oscworks.com
   Copyright (c  Nick Stanko of UkiDev.com, nick@ukidev.com
   Copyright (c) Andre ambidex@gmx.net
   Copyright (c) 2001,2002 Ian C Wilson http://www.phesis.org


   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

  include( 'includes/application_top.php');
       // create smarty elements
  $smarty = new Smarty;
  // include boxes
  require(DIR_FS_CATALOG .'templates/'.CURRENT_TEMPLATE. '/source/boxes.php'); 
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_image_button.inc.php');


  $breadcrumb->add(NAVBAR_TITLE_LOGOFF);

  xtc_session_destroy();

  unset($_SESSION['customer_id']);
  unset($_SESSION['customer_default_address_id']);
  unset($_SESSION['customer_first_name']);
  unset($_SESSION['customer_country_id']);
  unset($_SESSION['customer_zone_id']);
  unset($_SESSION['comments']);
  unset($_SESSION['user_info']);
  unset($_SESSION['customers_status']);
  unset($_SESSION['selected_box']);
  unset($_SESSION['navigation']);
  unset($_SESSION['shipping']);
  unset($_SESSION['payment']);
  // GV Code Start
  unset($_SESSION['gv_id']);
  unset($_SESSION['cc_id']);
  // GV Code End
  $_SESSION['cart']->reset();
  // write customers status guest in session again
  require(DIR_WS_INCLUDES . 'write_customers_status.php');

 require(DIR_WS_INCLUDES . 'header.php');

  $smarty->assign('BUTTON_CONTINUE','<a href="' . xtc_href_link(FILENAME_DEFAULT) . '">' . xtc_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>');
  $smarty->assign('language', $_SESSION['language']);


  $smarty->caching = 0;
  $main_content=$smarty->fetch(CURRENT_TEMPLATE . '/module/logoff.html');

  $smarty->assign('language', $_SESSION['language']);
  $smarty->assign('main_content',$main_content);
  $smarty->caching = 0;
  if (!defined(RM)) $smarty->load_filter('output', 'note');
  $smarty->display(CURRENT_TEMPLATE . '/index.html');
  ?>