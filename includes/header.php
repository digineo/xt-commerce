<?php
/* -----------------------------------------------------------------------------------------
   $Id: header.php 288 2007-03-23 03:28:11Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce 
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(header.php,v 1.40 2003/03/14); www.oscommerce.com 
   (c) 2003	 nextcommerce (header.php,v 1.13 2003/08/17); www.nextcommerce.org 

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


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['language_charset']; ?>" /> 
<meta http-equiv="Content-Style-Type" content="text/css" />
<?php include(DIR_WS_MODULES.FILENAME_METATAGS); ?>
<?php
/*
  The following copyright announcement is in compliance
  to section 2c of the GNU General Public License, and
  thus can not be removed, or can only be modified
  appropriately.

  Please leave this comment intact together with the
  following copyright announcement.

*/
?>
<!--
	This OnlineStore is brought to you by XT-Commerce, Community made shopping
	XTC is a free open source e-Commerce System
	created by Mario Zanier & Guido Winger and licensed under GNU/GPL.
	Information and contribution at http://www.xt-commerce.com
-->
<meta name="generator" content="(c) by <?php echo PROJECT_VERSION; ?> , http://www.xt-commerce.com" />
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo 'templates/'.CURRENT_TEMPLATE.'/stylesheet.css'; ?>" />
<?php
// require theme based javascript
require('templates/'.CURRENT_TEMPLATE.'/javascript/general.js.php');

if (strstr($PHP_SELF, FILENAME_CHECKOUT_PAYMENT)) {
 echo $payment_modules->javascript_validation();
}

if (strstr($PHP_SELF, FILENAME_CREATE_ACCOUNT)) {
require('includes/form_check.js.php');
}


if (strstr($PHP_SELF, FILENAME_CREATE_GUEST_ACCOUNT )) {
require('includes/form_check.js.php');
}
if (strstr($PHP_SELF, FILENAME_ACCOUNT_PASSWORD )) {
require('includes/form_check.js.php');
}
if (strstr($PHP_SELF, FILENAME_ACCOUNT_EDIT )) {
require('includes/form_check.js.php');
}
if (strstr($PHP_SELF, FILENAME_ADDRESS_BOOK_PROCESS )) {
  if (isset($_GET['delete']) == false) {
    include('includes/form_check.js.php');
  }
  }
if (strstr($PHP_SELF, FILENAME_CHECKOUT_SHIPPING_ADDRESS )or strstr($PHP_SELF,FILENAME_CHECKOUT_PAYMENT_ADDRESS)) {
require('includes/form_check.js.php');
?>
<script type="text/javascript"><!--
function check_form_optional(form_name) {
  var form = form_name;

  var firstname = form.elements['firstname'].value;
  var lastname = form.elements['lastname'].value;
  var street_address = form.elements['street_address'].value;

  if (firstname == '' && lastname == '' && street_address == '') {
    return true;
  } else {
    return check_form(form_name);
  }
}
//--></script>
<?php
}

if (strstr($PHP_SELF, FILENAME_ADVANCED_SEARCH )) {
?>
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript"><!--
function check_form() {
  var error_message = unescape("<?php echo xtc_js_lang(JS_ERROR); ?>");
  var error_found = false;
  var error_field;
  var keywords = document.getElementById("advanced_search").keywords.value;
  var pfrom = document.getElementById("advanced_search").pfrom.value;
  var pto = document.getElementById("advanced_search").pto.value;
  var pfrom_float;
  var pto_float;

  if ( (keywords == '' || keywords.length < 1) && (pfrom == '' || pfrom.length < 1) && (pto == '' || pto.length < 1) ) {
    error_message = error_message + unescape("<?php echo xtc_js_lang(JS_AT_LEAST_ONE_INPUT); ?>");
    error_field = document.getElementById("advanced_search").keywords;
    error_found = true;
  }

  if (pfrom.length > 0) {
    pfrom_float = parseFloat(pfrom);
    if (isNaN(pfrom_float)) {
      error_message = error_message + unescape("<?php echo xtc_js_lang(JS_PRICE_FROM_MUST_BE_NUM); ?>");
      error_field = document.getElementById("advanced_search").pfrom;
      error_found = true;
    }
  } else {
    pfrom_float = 0;
  }

  if (pto.length > 0) {
    pto_float = parseFloat(pto);
    if (isNaN(pto_float)) {
      error_message = error_message + unescape("<?php echo xtc_js_lang(JS_PRICE_TO_MUST_BE_NUM); ?>");
      error_field = document.getElementById("advanced_search").pto;
      error_found = true;
    }
  } else {
    pto_float = 0;
  }

  if ( (pfrom.length > 0) && (pto.length > 0) ) {
    if ( (!isNaN(pfrom_float)) && (!isNaN(pto_float)) && (pto_float < pfrom_float) ) {
      error_message = error_message + unescape("<?php echo xtc_js_lang(JS_PRICE_TO_LESS_THAN_PRICE_FROM); ?>");
      error_field = document.getElementById("advanced_search").pto;
      error_found = true;
    }
  }

  if (error_found == true) {
    alert(error_message);
    error_field.focus();
    return false;
  }
}

function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=280,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
<?php
}

if (strstr($PHP_SELF, FILENAME_PRODUCT_REVIEWS_WRITE )) {
?>

<script type="text/javascript"><!--
function checkForm() {
  var error = 0;
  var error_message = unescape("<?php echo xtc_js_lang(JS_ERROR); ?>");

  var review = document.getElementById("product_reviews_write").review.value;

  if (review.length < <?php echo REVIEW_TEXT_MIN_LENGTH; ?>) {
    error_message = error_message + unescape("<?php echo xtc_js_lang(JS_REVIEW_TEXT); ?>");
    error = 1;
  }

  if (!((document.getElementById("product_reviews_write").rating[0].checked) || (document.getElementById("product_reviews_write").rating[1].checked) || (document.getElementById("product_reviews_write").rating[2].checked) || (document.getElementById("product_reviews_write").rating[3].checked) || (document.getElementById("product_reviews_write").rating[4].checked))) {
    error_message = error_message + unescape("<?php echo xtc_js_lang(JS_REVIEW_RATING); ?>");
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>
<?php
}
if (strstr($PHP_SELF, FILENAME_POPUP_IMAGE )) {
?>

<script type="text/javascript"><!--
var i=0;
function resize() {
  if (navigator.appName == 'Netscape') i=40;
  if (document.images[0]) window.resizeTo(document.images[0].width +30, document.images[0].height+60-i);
  self.focus();
}
//--></script>
<?php 
} 

?>
</head>
<?php
if (strstr($PHP_SELF, FILENAME_POPUP_IMAGE )) {
echo '<body onload="resize();"> ';
} else {
echo '<body>';
}

// econda tracking
if (TRACKING_ECONDA_ACTIVE=='true') {	
?>
<script type="text/javascript">
<!--
var emos_kdnr='<?php echo TRACKING_ECONDA_ID; ?>';
//-->
</script>
<a name="emos_sid" rel="<?php echo session_id(); ?>" rev=""></a>
<a name="emos_name" title="siteid" rel="<?php echo $_SESSION['languages_id']; ?>" rev=""></a>
<?php	
//	require_once(DIR_WS_INCLUDES . 'econda/econda.php');
}


if (strstr($PHP_SELF, FILENAME_CHECKOUT_SUCCESS) && GOOGLE_CONVERSION == 'true') {
require('includes/google_conversiontracking.js.php');
}


  // include needed functions
  require_once('inc/xtc_output_warning.inc.php');
  require_once('inc/xtc_image.inc.php');
  require_once('inc/xtc_parse_input_field_data.inc.php');
  require_once('inc/xtc_draw_separator.inc.php');

//  require_once('inc/xtc_draw_form.inc.php');
//  require_once('inc/xtc_draw_pull_down_menu.inc.php');

  // check if the 'install' directory exists, and warn of its existence
  if (WARN_INSTALL_EXISTENCE == 'true') {
    if (file_exists(dirname($_SERVER['SCRIPT_FILENAME']) . '/xtc_installer')) {
      xtc_output_warning(WARNING_INSTALL_DIRECTORY_EXISTS);
    }
  }

  // check if the configure.php file is writeable
  if (WARN_CONFIG_WRITEABLE == 'true') {
    if ( (file_exists(dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php')) && (is_writeable(dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php')) ) {
      xtc_output_warning(WARNING_CONFIG_FILE_WRITEABLE);
    }
  }

  // check if the session folder is writeable
  if (WARN_SESSION_DIRECTORY_NOT_WRITEABLE == 'true') {
    if (STORE_SESSIONS == '') {
      if (!is_dir(xtc_session_save_path())) {
        xtc_output_warning(WARNING_SESSION_DIRECTORY_NON_EXISTENT);
      } elseif (!is_writeable(xtc_session_save_path())) {
        xtc_output_warning(WARNING_SESSION_DIRECTORY_NOT_WRITEABLE);
      }
    }
  }

  // check session.auto_start is disabled
  if ( (function_exists('ini_get')) && (WARN_SESSION_AUTO_START == 'true') ) {
    if (ini_get('session.auto_start') == '1') {
      xtc_output_warning(WARNING_SESSION_AUTO_START);
    }
  }

  if ( (WARN_DOWNLOAD_DIRECTORY_NOT_READABLE == 'true') && (DOWNLOAD_ENABLED == 'true') ) {
    if (!is_dir(DIR_FS_DOWNLOAD)) {
      xtc_output_warning(WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT);
    }
  }


$smarty->assign('navtrail',$breadcrumb->trail(' &raquo; '));
if (isset($_SESSION['customer_id'])) {

$smarty->assign('logoff',xtc_href_link(FILENAME_LOGOFF, '', 'SSL'));
}
if ( $_SESSION['account_type']=='0') {
$smarty->assign('account',xtc_href_link(FILENAME_ACCOUNT, '', 'SSL'));
}
$smarty->assign('cart',xtc_href_link(FILENAME_SHOPPING_CART, '', 'SSL'));
$smarty->assign('checkout',xtc_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
$smarty->assign('store_name',TITLE);

    

  if (isset($_GET['error_message']) && xtc_not_null($_GET['error_message'])) {

$smarty->assign('error',htmlspecialchars(urldecode($_GET['error_message'])));

  }

  if (isset($_GET['info_message']) && xtc_not_null($_GET['info_message'])) {

$smarty->assign('error','
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="headerInfo">
        <td class="headerInfo">'.htmlspecialchars($_GET['info_message']).'</td>
      </tr>
    </table>');

  }

  include(DIR_WS_INCLUDES.FILENAME_BANNER);
?>