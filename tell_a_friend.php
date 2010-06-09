<?php
/* -----------------------------------------------------------------------------------------
   $Id: tell_a_friend.php,v 1.12 2004/02/22 16:15:30 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(tell_a_friend.php,v 1.39 2003/05/28); www.oscommerce.com
   (c) 2003	 nextcommerce (tell_a_friend.php,v 1.13 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

  include( 'includes/application_top.php');
      $smarty = new Smarty;
      $mail_smarty= new Smarty;
  // include boxes
  require(DIR_FS_CATALOG .'templates/'.CURRENT_TEMPLATE. '/source/boxes.php');
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_draw_textarea_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_image_button.inc.php');
  require_once(DIR_FS_INC . 'xtc_validate_email.inc.php');


  if (isset($_SESSION['customer_id'])) {
    $account = xtc_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
    $account_values = xtc_db_fetch_array($account);
  } elseif (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false') {

    xtc_redirect(xtc_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $valid_product = false;
  if (isset($_GET['products_id'])) {
    $product_info_query = xtc_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
    $valid_product = (xtc_db_num_rows($product_info_query) > 0);
  }

  $breadcrumb->add(NAVBAR_TITLE_TELL_A_FRIEND, xtc_href_link(FILENAME_TELL_A_FRIEND, 'send_to=' . $_GET['send_to'] . '&products_id=' . $_GET['products_id']));

 require(DIR_WS_INCLUDES . 'header.php');

  if ($valid_product == false) {
xtc_redirect(FILENAME_DEFAULT);
  } else {
    $product_info = xtc_db_fetch_array($product_info_query);
    $smarty->assign('heading_tell_a_friend',sprintf(HEADING_TITLE_TELL_A_FRIEND, $product_info['products_name']));

    $error = false;

    if (isset($_GET['action']) && ($_GET['action'] == 'process') && !xtc_validate_email(trim($_POST['friendemail']))) {
      $friendemail_error = true;
      $error = true;
    } else {
      $friendemail_error = false;
    }

    if (isset($_GET['action']) && ($_GET['action'] == 'process') && empty($_POST['friendname'])) {
      $friendname_error = true;
      $error = true;
    } else {
      $friendname_error = false;
    }

    if (isset($_SESSION['customer_id'])) {
      $from_name = $account_values['customers_firstname'] . ' ' . $account_values['customers_lastname'];
      $from_email_address = $account_values['customers_email_address'];
    } else {
      $from_name = $_POST['yourname'];
      $from_email_address = $_POST['from'];
    }
	  
    if (!isset($_SESSION['customer_id'])) {
      if (isset($_GET['action']) && ($_GET['action'] == 'process') && !xtc_validate_email(trim($from_email_address))) {
        $fromemail_error = true;
        $error = true;
      } else {
        $fromemail_error = false;
      }
    }

    if (isset($_GET['action']) && ($_GET['action'] == 'process') && empty($from_name)) {
      $fromname_error = true;
      $error = true;
    } else {
      $fromname_error = false;
    }

    if (isset($_GET['action']) && ($_GET['action'] == 'process') && ($error == false)) {

      $mail_smarty->assign('message',$_POST['yourmessage']);
      $mail_smarty->assign('language', $_SESSION['language']);
      $mail_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
      $mail_smarty->assign('logo_path',HTTP_SERVER.DIR_WS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/img/');
      $mail_smarty->assign('PRODUCTS_LINK',xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
      $mail_smarty->caching = 0;
      $html_mail = $mail_smarty->fetch(CURRENT_TEMPLATE . '/mail/'.$_SESSION['language'].'/tell_friend_mail.html');
      $mail_smarty->caching = 0;
      $txt_mail = $mail_smarty->fetch(CURRENT_TEMPLATE . '/mail/'.$_SESSION['language'].'/tell_friend_mail.txt');

      $smarty->assign('action','send');
      $smarty->assign('message',sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, stripslashes($_POST['products_name']), $_POST['friendemail']));
      $smarty->assign('BUTTON_CONTINUE','<a href="' . xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']) . '">' . xtc_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>');

      xtc_php_mail($from_email_address, $from_name,$_POST['friendemail'],$_POST['friendname'],'', $from_email_address, $from_name, '', '', CONTACT_US_EMAIL_SUBJECT, $html_mail , $txt_mail );

    } else {
      if (isset($_SESSION['customer_id'])) {
        $your_name_prompt = $account_values['customers_firstname'] . ' ' . $account_values['customers_lastname'];
        $your_email_address_prompt = $account_values['customers_email_address'];
      } else {
        $your_name_prompt = xtc_draw_input_field('yourname', (($fromname_error == true) ? $_POST['yourname'] : $_GET['yourname']));
        if ($fromname_error == true) $your_name_prompt .= '&nbsp;' . TEXT_REQUIRED;
        $your_email_address_prompt = xtc_draw_input_field('from', (($fromemail_error == true) ? $_POST['from'] : $_GET['from']));
        if ($fromemail_error == true) $your_email_address_prompt .= ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
      }

$smarty->assign('FORM_ACTION',xtc_draw_form('email_friend', xtc_href_link(FILENAME_TELL_A_FRIEND, 'action=process&products_id=' . $_GET['products_id'])) . xtc_draw_hidden_field('products_name', $product_info['products_name']));
$smarty->assign('INPUT_NAME',$your_name_prompt);
$smarty->assign('INPUT_EMAIL',$your_email_address_prompt);
$smarty->assign('INPUT_MESSAGE',xtc_draw_textarea_field('yourmessage', 'soft', 40, 8));

$input_friendname= xtc_draw_input_field('friendname', (($friendname_error == true) ? $_POST['friendname'] : $_GET['friendname']));
 if ($friendname_error == true) $input_friendname.= '&nbsp;' . TEXT_REQUIRED;

$input_friendemail= xtc_draw_input_field('friendemail', (($friendemail_error == true) ? $_POST['friendemail'] : $_GET['send_to']));
if ($friendemail_error == true) $input_friendemail.= ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
$smarty->assign('INPUT_FRIENDNAME',$input_friendname);
$smarty->assign('INPUT_FRIENDEMAIL',$input_friendemail);

$smarty->assign('BUTTON_BACK','<a href="' . xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']) . '">' . xtc_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>');
$smarty->assign('BUTTON_SUBMIT',xtc_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE));
    }
  }

  $smarty->assign('language', $_SESSION['language']);
  $smarty->assign('FORM_END','</form>');

               // set cache ID
  $smarty->caching = 0;
  $main_content= $smarty->fetch(CURRENT_TEMPLATE.'/module/tell_a_friend.html');

  $smarty->assign('language', $_SESSION['language']);
  $smarty->assign('main_content',$main_content);
  $smarty->caching = 0;
  if (!defined(RM)) $smarty->load_filter('output', 'note');
  $smarty->display(CURRENT_TEMPLATE . '/index.html');
  ?>