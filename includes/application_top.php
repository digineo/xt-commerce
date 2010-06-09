<?php
/* -----------------------------------------------------------------------------------------
   $Id: application_top.php,v 1.31 2004/06/11 19:07:29 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(application_top.php,v 1.273 2003/05/19); www.oscommerce.com
   (c) 2003	 nextcommerce (application_top.php,v 1.54 2003/08/25); www.nextcommerce.org

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
  // start the timer for the page parse time log
  define('PAGE_PARSE_START_TIME', microtime());

  // set the level of error reporting
  error_reporting(E_ALL & ~E_NOTICE);
//  error_reporting(E_ALL);

  // Set the local configuration parameters - mainly for developers - if exists else the mainconfigure
  if (file_exists('includes/local/configure.php')) {
    include('includes/local/configure.php');
  } else {
    include('includes/configure.php');
  }


  
  // define the project version
  define('PROJECT_VERSION', 'XT-Commerce v3.0.1');

  // set the type of request (secure or not)
  $request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

  // set php_self in the local scope
  $PHP_SELF = $_SERVER['PHP_SELF'];

  // include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

  // include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

  // SQL caching dir
  define('SQL_CACHEDIR',DIR_FS_CATALOG.'cache/');



  // Below are some defines which affect the way the discount coupon/gift voucher system work
// Be careful when editing them.
//
// Set the length of the redeem code, the longer the more secure
  define('SECURITY_CODE_LENGTH', '10');
//
// The settings below determine whether a new customer receives an incentive when they first signup
//
// Set the amount of a Gift Voucher that the new signup will receive, set to 0 for none
//  define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', '10');  // placed in the admin configuration mystore
//
// Set the coupon ID that will be sent by email to a new signup, if no id is set then no email :)
//  define('NEW_SIGNUP_DISCOUNT_COUPON', '3'); // placed in the admin configuration mystore

  // Store DB-Querys in a Log File
  define('STORE_DB_TRANSACTIONS', 'false');

  // include used functions
  require_once(DIR_FS_INC . 'xtc_db_connect.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_close.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_error.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_perform.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_query.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_queryCached.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_fetch_array.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_num_rows.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_data_seek.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_insert_id.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_free_result.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_fetch_fields.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_output.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_input.inc.php');
  require_once(DIR_FS_INC . 'xtc_db_prepare_input.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_top_level_domain.inc.php');
  require_once(DIR_FS_INC . 'xtc_not_null.inc.php');
  require_once(DIR_FS_INC . 'xtc_update_whos_online.inc.php');

  require_once(DIR_FS_INC . 'xtc_activate_banners.inc.php');
  require_once(DIR_FS_INC . 'xtc_expire_banners.inc.php');
  require_once(DIR_FS_INC . 'xtc_expire_specials.inc.php');
  require_once(DIR_FS_INC . 'xtc_href_link.inc.php');
  require_once(DIR_FS_INC . 'xtc_parse_category_path.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_product_path.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_parent_categories.inc.php');
  require_once(DIR_FS_INC . 'xtc_redirect.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_uprid.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_all_get_params.inc.php');
  require_once(DIR_FS_INC . 'xtc_has_product_attributes.inc.php');
  require_once(DIR_FS_INC . 'xtc_image.inc.php');
  require_once(DIR_FS_INC . 'xtc_note.inc.php');
  require_once(DIR_FS_INC . 'xtc_check_stock_attributes.inc.php');
  require_once(DIR_FS_INC . 'xtc_currency_exists.inc.php');
  require_once(DIR_FS_INC . 'xtc_draw_separator.inc.php');
  require_once(DIR_FS_INC . 'xtc_remove_non_numeric.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_ip_address.inc.php');
  require_once(DIR_FS_INC . 'xtc_setcookie.inc.php');
  require_once(DIR_FS_INC . 'xtc_check_agent.inc.php');
  require_once(DIR_FS_INC . 'xtc_count_cart.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_qty.inc.php');
  require_once(DIR_FS_INC . 'create_coupon_code.inc.php');
  require_once(DIR_FS_INC . 'xtc_gv_account_update.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_tax_rate_from_desc.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_tax_rate.inc.php');
  require_once(DIR_FS_INC . 'xtc_add_tax.inc.php');

  require_once(DIR_FS_INC . 'xtc_input_validation.inc.php');




  // make a connection to the database... now
  xtc_db_connect() or die('Unable to connect to database server!');




  $configuration_query = xtc_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = xtc_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }

    // set the application parameters
  function xtDBquery($query) {
       if (DB_CACHE=='true') {
           //  echo 'cached query: '.$query.'<br>';
            $result=xtc_db_queryCached($query);
          } else {
             $result=xtc_db_query($query);
    }
    return $result;
  }
  
  // if gzip_compression is enabled, start to buffer the output
  if ( (GZIP_COMPRESSION == 'true') && ($ext_zlib_loaded = extension_loaded('zlib')) && (PHP_VERSION >= '4') ) {
    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
      ob_start('ob_gzhandler');
    } else {
      ini_set('zlib.output_compression_level', GZIP_LEVEL);
    }
  }

  // set the HTTP GET parameters manually if search_engine_friendly_urls is enabled
  if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
    if (strlen(getenv('PATH_INFO')) > 1) {
      $GET_array = array();
      $PHP_SELF = str_replace(getenv('PATH_INFO'), '', $PHP_SELF);
      $vars = explode('/', substr(getenv('PATH_INFO'), 1));
      for ($i=0, $n=sizeof($vars); $i<$n; $i++) {
        if (strpos($vars[$i], '[]')) {
          $GET_array[substr($vars[$i], 0, -2)][] = $vars[$i+1];
        } else {
          $_GET[$vars[$i]] = $vars[$i+1];
        }
        $i++;
      }

      if (sizeof($GET_array) > 0) {
        while (list($key, $value) = each($GET_array)) {
          $_GET[$key] = $value;
        }
      }
    }
  }

  // set the top level domains
  $http_domain = xtc_get_top_level_domain(HTTP_SERVER);
  $https_domain = xtc_get_top_level_domain(HTTPS_SERVER);
  $current_domain = (($request_type == 'NONSSL') ? $http_domain : $https_domain);

  // include cache functions if enabled
 // if (USE_CACHE == 'true') include(DIR_WS_FUNCTIONS . 'cache.php');

  // include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

  // include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');

  // some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

  // define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

  // set the session name and save path
  session_name('XTCsid');
  session_save_path(SESSION_WRITE_DIRECTORY);

  // set the session cookie parameters
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, '/', (xtc_not_null($current_domain) ? '.' . $current_domain : ''));
  } elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', '/');
    ini_set('session.cookie_domain', (xtc_not_null($current_domain) ? '.' . $current_domain : ''));
  }

  // set the session ID if it exists
  if (isset($_POST[session_name()])) {
    session_id($_POST[session_name()]);
  } elseif ( ($request_type == 'SSL') && isset($_GET[session_name()]) ) {
    session_id($_GET[session_name()]);
  }

  // start the session
  $session_started = false;
  if (SESSION_FORCE_COOKIE_USE == 'True') {
    xtc_setcookie('cookie_test', 'please_accept_for_session', time()+60*60*24*30, '/', $current_domain);

    if (isset($_COOKIE['cookie_test'])) {
      session_start();
      include(DIR_WS_INCLUDES . 'tracking.php');
      $session_started = true;
    }
  } elseif (CHECK_CLIENT_AGENT == 'True') {
    $user_agent = strtolower(getenv($_SERVER['HTTP_USER_AGENT']));
    $spider_flag = false;

    if (xtc_not_null($user_agent)) {
      $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

      for ($i=0, $n=sizeof($spiders); $i<$n; $i++) {
        if (xtc_not_null($spiders[$i])) {
          if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
            $spider_flag = true;
            break;
          }
        }
      }
    }

    if ($spider_flag == false) {
      session_start(); 
      include(DIR_WS_INCLUDES . 'tracking.php');
      $session_started = true;
    }
  } else {
    session_start();   
    include(DIR_WS_INCLUDES . 'tracking.php');
    $session_started = true;
  }

  // verify the ssl_session_id if the feature is enabled
  if ( ($request_type == 'SSL') && (SESSION_CHECK_SSL_SESSION_ID == 'True') && (ENABLE_SSL == true) && ($session_started == true) ) {
    $ssl_session_id = getenv('SSL_SESSION_ID');
    if (!session_is_registered('SSL_SESSION_ID')) {
      $_SESSION['SESSION_SSL_ID'] = $ssl_session_id;
    }

    if ($_SESSION['SESSION_SSL_ID'] != $ssl_session_id) {
      session_destroy();
      xtc_redirect(xtc_href_link(FILENAME_SSL_CHECK));
    }
  }

  // verify the browser user agent if the feature is enabled
  if (SESSION_CHECK_USER_AGENT == 'True') {
    $http_user_agent = getenv($_SERVER['HTTP_USER_AGENT']);
    if (!session_is_registered('SESSION_USER_AGENT')) {
      $_SESSION['SESSION_USER_AGENT'] = $http_user_agent;
    }

    if ($_SESSION['SESSION_USER_AGENT'] != $http_user_agent) {
      session_destroy();
      xtc_redirect(xtc_href_link(FILENAME_LOGIN));
    }
  }

  // verify the IP address if the feature is enabled
  if (SESSION_CHECK_IP_ADDRESS == 'True') {
    $ip_address = xtc_get_ip_address();
    if (!isset($_SESSION['SESSION_IP_ADDRESS'])) {
      $_SESSION['SESSION_IP_ADDRESS'] = $ip_address;
    }

    if ($_SESSION['SESSION_IP_ADDRESS'] != $ip_address) {
      session_destroy();
      xtc_redirect(xtc_href_link(FILENAME_LOGIN));
    }
  }



  // include currencies class and create an instance
  /*
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  */


  // include the mail classes
  if (EMAIL_TRANSPORT == 'sendmail') include(DIR_WS_CLASSES . 'class.phpmailer.php');
  if (EMAIL_TRANSPORT == 'smtp') include(DIR_WS_CLASSES . 'class.smtp.php');


  // set the language
  if (!isset($_SESSION['language']) || isset($_GET['language'])) {

    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language(xtc_input_validation($_GET['language'],'char',''));

    if (!isset($_GET['language'])) $lng->get_browser_language();

    $_SESSION['language'] = $lng->language['directory'];
    $_SESSION['languages_id'] = $lng->language['id'];
    $_SESSION['language_charset'] = $lng->language['language_charset'];
  }

  // include the language translations
  require(DIR_WS_LANGUAGES . $_SESSION['language'].'/'.$_SESSION['language'] . '.php');

  // currency
  if (!isset($_SESSION['currency']) || isset($_GET['currency']) || ( (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && (LANGUAGE_CURRENCY != $_SESSION['currency']) ) ) {

    if (isset($_GET['currency'])) {
      if (!$_SESSION['currency'] = xtc_currency_exists($_GET['currency'])) $_SESSION['currency'] = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    } else {
      $_SESSION['currency'] = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    }
  }
  if (isset($_SESSION['currency']) && $_SESSION['currency'] == '') {
    $_SESSION['currency'] = DEFAULT_CURRENCY;
  }

  // include cart actions


  // write customers status in session
  require(DIR_WS_INCLUDES . 'write_customers_status.php');

  // testing new price class

  require(DIR_WS_CLASSES . 'xtcPrice.php');
    $xtPrice = new xtcPrice($_SESSION['currency'],$_SESSION['customers_status']['customers_status_id']);

  require(DIR_WS_INCLUDES.FILENAME_CART_ACTIONS); 
    // create the shopping cart & fix the cart if necesary
  if (!is_object($_SESSION['cart'])) {
    $_SESSION['cart'] = new shoppingCart();
  }


  // include the who's online functions
  xtc_update_whos_online();

  // split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

  // infobox
  require(DIR_WS_CLASSES . 'boxes.php');

  // auto activate and expire banners
  xtc_activate_banners();
  xtc_expire_banners();

  // auto expire special products
  xtc_expire_specials();

  // calculate category path
  if (isset($_GET['cPath'])) {
    $cPath = xtc_input_validation($_GET['cPath'],'cPath','');
  } elseif (isset($_GET['products_id']) && !isset($_GET['manufacturers_id'])) {
    $cPath = xtc_get_product_path((int)$_GET['products_id']);
  } else {
    $cPath = '';
  }

  if (xtc_not_null($cPath)) {
    $cPath_array = xtc_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
  } else {
    $current_category_id = 0;
  }

  // include the breadcrumb class and start the breadcrumb trail
  require(DIR_WS_CLASSES . 'breadcrumb.php');
  $breadcrumb = new breadcrumb;

  $breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
  $breadcrumb->add(HEADER_TITLE_CATALOG, xtc_href_link(FILENAME_DEFAULT));

  // add category names or the manufacturer name to the breadcrumb trail
  if (isset($cPath_array)) {
    for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
      if (GROUP_CHECK=='true') {
   $group_check="and c.group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
  }
      $categories_query = xtc_db_query("select
                                        cd.categories_name
                                        from " . TABLE_CATEGORIES_DESCRIPTION . " cd,
                                        ".TABLE_CATEGORIES." c
                                        where cd.categories_id = '" . $cPath_array[$i] . "'
                                        and c.categories_id=cd.categories_id
                                        ".$group_check."
                                        and cd.language_id='" . (int)$_SESSION['languages_id'] . "'");
      if (xtc_db_num_rows($categories_query) > 0) {
        $categories = xtc_db_fetch_array($categories_query);
        $breadcrumb->add($categories['categories_name'], xtc_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i+1)))));
      } else {
        break;
      }
    }
  } elseif (isset($_GET['manufacturers_id'])) {
    $manufacturers_query = xtc_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
    $manufacturers = xtc_db_fetch_array($manufacturers_query);
    $breadcrumb->add($manufacturers['manufacturers_name'], xtc_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . (int)$_GET['manufacturers_id']));
  }

  // add the products model to the breadcrumb trail
  if (isset($_GET['products_id'])) {
    $model_query = xtc_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . (int)$_GET['products_id'] . "'");
    $model = xtc_db_fetch_array($model_query);
    $breadcrumb->add($model['products_model'], xtc_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . '&products_id=' . (int)$_GET['products_id']));
  }

  // initialize the message stack for output messages
  require(DIR_WS_CLASSES . 'message_stack.php');
  $messageStack = new messageStack;

  // set which precautions should be checked
  define('WARN_INSTALL_EXISTENCE', 'false');
  define('WARN_CONFIG_WRITEABLE', 'false');
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
  define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'true');




  // Include Template Engine
  require(DIR_WS_CLASSES . 'Smarty_2.6.3/Smarty.class.php');

  if (isset($_SESSION['customer_id'])) {
  $account_type_query=xtc_db_query("SELECT
                                    account_type,
                                    customers_default_address_id
                                    FROM
                                    ".TABLE_CUSTOMERS."
                                    WHERE customers_id = '".(int)$_SESSION['customer_id']."'");
  $account_type=xtc_db_fetch_array($account_type_query);

  // check if zone id is unset bug #0000169
  if (!isset($_SESSION['customer_country_id'])) {
  	$zone_query=xtc_db_query("SELECT  entry_country_id
                                     FROM ".TABLE_ADDRESS_BOOK."
                                     WHERE customers_id='".(int)$_SESSION['customer_id']."'
                                     and address_book_id='".$account_type['customers_default_address_id']."'");

    $zone=xtc_db_fetch_array($zone_query);
    $_SESSION['customer_country_id']=$zone['entry_country_id'];
  }
  $_SESSION['account_type']=$account_type['account_type'];
   } else {
   $_SESSION['account_type']='0';
   }

  // modification for nre graduated system
  unset($_SESSION['actual_content']);
  xtc_count_cart();

?>