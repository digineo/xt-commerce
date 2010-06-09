<?php
/*------------------------------------------------------------------------------
  $Id: cc.php,v 1.2 2004/03/16 20:12:29 fanta2k Exp $

  XTC-CC - Contribution for XT-Commerce http://www.xt-commerce.com
  modified by http://www.netz-designer.de

  Copyright (c) 2003 netz-designer
  -----------------------------------------------------------------------------
  based on:
  $Id: cc.php,v 1.2 2004/03/16 20:12:29 fanta2k Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
------------------------------------------------------------------------------*/

// include needed functions
require_once(DIR_FS_INC . 'xtc_php_mail.inc.php');
require_once(DIR_FS_INC . 'xtc_validate_email.inc.php');

  class cc {
    var $code, $title, $description, $enabled;

// class constructor
    function cc() {
      global $order;

      $this->code = 'cc';
      $this->title = MODULE_PAYMENT_CC_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_CC_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_CC_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_CC_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_CC_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_CC_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();
    }
	
// BMC Changes Start
// if cvv not enabled fill cc_cvv with 000
//	function ch_cvv() {

//	}
// BMC Changes End		

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_CC_ZONE > 0) ) {
        $check_flag = false;
        $check_query = xtc_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_CC_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = xtc_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
	if ( strtolower(USE_CC_CVV) == 'true' ) {
      $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
            '    var cc_owner = document.checkout_payment.cc_owner.value;' . "\n" .
            '    var cc_number = document.checkout_payment.cc_number.value;' . "\n" .
			'	 var cc_cvv = document.checkout_payment.cc_cvv.value;' . "\n" .
            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
			'	 if (cc_cvv == "" || cc_cvv.length != ' . CC_CVV_MIN_LENGTH . ') {' . "\n" .
			'	   error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_CVV . '";' . "\n" .
			'	   error = 1;' . "\n" .
			'	 }' . "\n" .			
            '  }' . "\n";

      return $js;
	  } else {
	        $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
            '    var cc_owner = document.checkout_payment.cc_owner.value;' . "\n" .
            '    var cc_number = document.checkout_payment.cc_number.value;' . "\n" .
			'	 var cc_cvv = document.checkout_payment.cc_cvv.value;' . "\n" .
            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '  }' . "\n";

      return $js;
	  }
    }

    function selection() {
      global $order;
// BMC for expiry date
      for ($i=1; $i<13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }
// BMC Changes Start
// for start date
      for ($i=1; $i < 13; $i++) {
        $start_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']-4; $i <= $today['year']; $i++) {
        $start_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }	  
		if (( strtolower(USE_CC_CVV) == 'true' ) && ( strtolower(USE_CC_ISS) == 'true' ) && ( strtolower(USE_CC_START) == 'true' )) {
// ++ issue ++ cvv ++ start date
      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => xtc_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => xtc_draw_input_field('cc_number')),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START,
                                                 'field' => xtc_draw_pull_down_menu('cc_start_month', $start_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_start_year', $start_year)),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => xtc_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_expires_year', $expires_year)),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV  . ' ' .'<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_POPUP_CVV, '', 'SSL') . '\')">' . MODULE_PAYMENT_CC_TEXT_CVV_LINK . '</a>',
                                                 'field' => xtc_draw_input_field('cc_cvv', '', 'size=4 maxlength=4')),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
                                                 'field' => xtc_draw_input_field('cc_issue', '', 'size=2 maxlength=2'))));
	  } elseif (( strtolower(USE_CC_CVV) != 'true' ) && ( strtolower(USE_CC_ISS) == 'true' ) && ( strtolower(USE_CC_START) == 'true' )) {
// -- cvv ++ issue ++ start date
      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => xtc_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => xtc_draw_input_field('cc_number')),
										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START,
										   		 'field' => xtc_draw_pull_down_menu('cc_start_month', $start_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_start_year', $start_year)),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => xtc_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_expires_year', $expires_year)),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
//										   		 'field' => xtc_draw_input_field('cc_cvv', '', 'size=4 maxlength=4')),
										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
										   		 'field' => xtc_draw_input_field('cc_issue', '', 'size=2 maxlength=2'))));
	  } elseif (( strtolower(USE_CC_ISS) != 'true' ) && ( strtolower(USE_CC_CVV) == 'true' ) && ( strtolower(USE_CC_START) == 'true' )) {
// ++ cvv -- issue ++ start date
      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => xtc_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => xtc_draw_input_field('cc_number')),
										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START,
										   		 'field' => xtc_draw_pull_down_menu('cc_start_month', $start_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_start_year', $start_year)),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => xtc_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_expires_year', $expires_year)),
										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV  . ' ' .'<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_POPUP_CVV, '', 'SSL') . '\')">' . MODULE_PAYMENT_CC_TEXT_CVV_LINK . '</a>',
										   		 'field' => xtc_draw_input_field('cc_cvv', '', 'size=4 maxlength=4')),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
//										   		 'field' => xtc_draw_input_field('cc_issue', '', 'size=2 maxlength=2'))
));
      } elseif (( strtolower(USE_CC_CVV) != 'true' ) && ( strtolower(USE_CC_ISS) == 'true' ) && ( strtolower(USE_CC_START) != 'true' )) {
// -- cvv ++ issue -- start date
      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => xtc_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => xtc_draw_input_field('cc_number')),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START,
//										   		 'field' => xtc_draw_pull_down_menu('cc_start_month', $start_month) . '&nbsp;' . tep_draw_pull_down_menu('cc_start_year', $start_year)),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => xtc_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_expires_year', $expires_year)),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
//										   		 'field' => xtc_draw_input_field('cc_cvv', '', 'size=4 maxlength=4')),
										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
										   		 'field' => xtc_draw_input_field('cc_issue', '', 'size=2 maxlength=2'))));
	  } elseif (( strtolower(USE_CC_CVV) == 'true' ) && ( strtolower(USE_CC_ISS) != 'true' ) && ( strtolower(USE_CC_START) != 'true' )) {
// ++ cvv -- issue -- start date
      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => xtc_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => xtc_draw_input_field('cc_number')),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START,
//										   		 'field' => xtc_draw_pull_down_menu('cc_start_month', $start_month) . '&nbsp;' . tep_draw_pull_down_menu('cc_start_year', $start_year)),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => xtc_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_expires_year', $expires_year)),
										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV  . ' ' .'<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_POPUP_CVV, '', 'SSL') . '\')">' . MODULE_PAYMENT_CC_TEXT_CVV_LINK . '</a>',
										   		 'field' => xtc_draw_input_field('cc_cvv', '', 'size=4 maxlength=4')),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
//										   		 'field' => xtc_draw_input_field('cc_issue', '', 'size=2 maxlength=2'))
));
	  } elseif (( strtolower(USE_CC_CVV) == 'true' ) && ( strtolower(USE_CC_ISS) == 'true' ) && ( strtolower(USE_CC_START) != 'true' )) {
// ++ cvv ++ issue -- start date
      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => xtc_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => xtc_draw_input_field('cc_number')),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START,
//										   		 'field' => xtc_draw_pull_down_menu('cc_start_month', $start_month) . '&nbsp;' . tep_draw_pull_down_menu('cc_start_year', $start_year)),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => xtc_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_expires_year', $expires_year)),
										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV  . ' ' .'<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_POPUP_CVV, '', 'SSL') . '\')">' . MODULE_PAYMENT_CC_TEXT_CVV_LINK . '</a>',
										   		 'field' => xtc_draw_input_field('cc_cvv', '', 'size=4 maxlength=4')),
										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
										   		 'field' => xtc_draw_input_field('cc_issue', '', 'size=2 maxlength=2'))));
	  } else {
// -- cvv -- issue -- start date
      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => xtc_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => xtc_draw_input_field('cc_number')),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START,
//										   		 'field' => xtc_draw_pull_down_menu('cc_start_month', $start_month) . '&nbsp;' . tep_draw_pull_down_menu('cc_start_year', $start_year)),
                                           array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => xtc_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . xtc_draw_pull_down_menu('cc_expires_year', $expires_year)),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
//										   		 'field' => xtc_draw_input_field('cc_cvv', '', 'size=4 maxlength=4')),
//										   array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
//										   		 'field' => xtc_draw_input_field('cc_issue', '', 'size=2 maxlength=2'))
));
      	  }
      return $selection;
    }

    function pre_confirmation_check() {

      include(DIR_WS_CLASSES . 'cc_validation.php');

      $cc_validation = new cc_validation();
      $result = $cc_validation->validate($_POST['cc_number'], $_POST['cc_expires_month'], $_POST['cc_expires_year']);

      $error = '';
      switch ($result) {
        case -1:
          $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
          break;
        case -2:
        case -3:
        case -4:
          $error = TEXT_CCVAL_ERROR_INVALID_DATE;
          break;
		case -5:
		  $error = sprintf(TEXT_CCVAL_ERROR_NOT_ACCEPTED, substr($cc_validation->cc_type, 0, 10), substr($cc_validation->cc_type, 0, 10));
		  break;
		case -6:
          $error = TEXT_CCVAL_ERROR_SHORT;
          break;
		case -7:
		  $error = TEXT_CCVAL_ERROR_BLACKLIST;
		  break;				  
        case false:
          $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
          break;
      }

      if ( ($result == false) || ($result < 1) ) {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&cc_owner=' . urlencode($_POST['cc_owner']) . '&cc_expires_month=' . $_POST['cc_expires_month'] . '&cc_expires_year=' . $_POST['cc_expires_year'];

        xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }
		if ( strtolower(USE_CC_CVV) != 'true' ) {
		$this->cc_cvv = '000';
		}
      $this->cc_card_type = $cc_validation->cc_type;
      $this->cc_card_number = $cc_validation->cc_number;
    }

    function confirmation() {
if (( strtolower(USE_CC_CVV) == 'true' ) && ( strtolower(USE_CC_ISS) == 'true' ) && ( strtolower(USE_CC_START) == 'true' )) {
// ++ cvv ++ issue ++ start date
      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['cc_owner']),
                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START, 
                    								'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_start_month'],1,$_POST['cc_start_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
											  		'field' => $_POST['cc_cvv']),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
											  		'field' => $_POST['cc_issue'])));
      return $confirmation;
	  } elseif (( strtolower(USE_CC_CVV) != 'true' ) && ( strtolower(USE_CC_ISS) == 'true' ) && ( strtolower(USE_CC_START) == 'true' )) {
// -- cvv ++ issue ++ start date
      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['cc_owner']),
                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START, 
                    								'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_start_month'],1,$_POST['cc_start_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year']))),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
//											  		'field' => $_POST['cc_cvv']),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
											  		'field' => $_POST['cc_issue'])));
      return $confirmation;
	  } elseif (( strtolower(USE_CC_CVV) == 'true' ) && ( strtolower(USE_CC_ISS) != 'true' ) && ( strtolower(USE_CC_START) == 'true' )) {
// ++ cvv -- issue ++ start date
      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['cc_owner']),
                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START, 
                    								'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_start_month'],1,$_POST['cc_start_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
											  		'field' => $_POST['cc_cvv']),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
//											  		'field' => $_POST['cc_issue'])
));
      return $confirmation;
	  } elseif (( strtolower(USE_CC_CVV) != 'true' ) && ( strtolower(USE_CC_ISS) == 'true' ) && ( strtolower(USE_CC_START) != 'true' )) {
// -- cvv ++ issue -- start date
      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['cc_owner']),
                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START, 
//                    								'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_start_month'],1,$_POST['cc_start_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year']))),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
//											  		'field' => $_POST['cc_cvv']),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
											  		'field' => $_POST['cc_issue'])));
      return $confirmation;
	  } elseif (( strtolower(USE_CC_CVV) == 'true' ) && ( strtolower(USE_CC_ISS) != 'true' ) && ( strtolower(USE_CC_START) != 'true' )) {
// ++ cvv -- issue -- start date
      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['cc_owner']),
                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START, 
//                    								'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_start_month'],1,$_POST['cc_start_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
											  		'field' => $_POST['cc_cvv']),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
//											  		'field' => $_POST['cc_issue'])
));
      return $confirmation;
	  } elseif (( strtolower(USE_CC_CVV) != 'true' ) && ( strtolower(USE_CC_ISS) != 'true' ) && ( strtolower(USE_CC_START) == 'true' )) {
// -- cvv -- issue ++ start date
      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['cc_owner']),
                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START, 
                    								'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_start_month'],1,$_POST['cc_start_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year']))),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
//											  		'field' => $_POST['cc_cvv']),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
//											  		'field' => $_POST['cc_issue'])
));
      return $confirmation;
	  } elseif (( strtolower(USE_CC_CVV) != 'true' ) && ( strtolower(USE_CC_ISS) != 'true' ) && ( strtolower(USE_CC_START) == 'true' )) {
// ++ cvv ++ issue -- start date
      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['cc_owner']),
                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START, 
//                    								'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_start_month'],1,$_POST['cc_start_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
											  		'field' => $_POST['cc_cvv']),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
											  		'field' => $_POST['cc_issue'])));
      return $confirmation;
	  } else {
// -- cvv -- issue -- start date
      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['cc_owner']),
                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_START, 
//                    								'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_start_month'],1,$_POST['cc_start_year']))),
											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year']))),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
//											  		'field' => $_POST['cc_cvv']),
//											  array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_ISSUE,
//											  		'field' => $_POST['cc_issue'])
));
      return $confirmation;
	  }
    }

    function process_button() {

      $process_button_string = xtc_draw_hidden_field('cc_owner', $_POST['cc_owner']) .
                               xtc_draw_hidden_field('cc_expires', $_POST['cc_expires_month'] . $_POST['cc_expires_year']) .
// BMC Changes Start
							   xtc_draw_hidden_field('cc_start', $_POST['cc_start_month'] . $_POST['cc_start_year']) .
							   xtc_draw_hidden_field('cc_cvv', $_POST['cc_cvv']) .
							   xtc_draw_hidden_field('cc_issue', $_POST['cc_issue']) .
// BMC Changes End
                               xtc_draw_hidden_field('cc_type', $this->cc_card_type) .
                               xtc_draw_hidden_field('cc_number', $this->cc_card_number);

      return $process_button_string;
    }

    function before_process() {
      global $order;

      if ( (defined('MODULE_PAYMENT_CC_EMAIL')) && (xtc_validate_email(MODULE_PAYMENT_CC_EMAIL)) ) {
        $len = strlen($_POST['cc_number']);

        $this->cc_middle = substr($_POST['cc_number'], 4, ($len-8));
        $order->info['cc_number'] = substr($_POST['cc_number'], 0, 4) . str_repeat('X', (strlen($_POST['cc_number']) - 8)) . substr($_POST['cc_number'], -4);
// BMC Changes Start
     	$this->cc_cvv = $_POST['cc_cvv'];
		$this->cc_start = $_POST['cc_start'];
		$this->cc_issue = $_POST['cc_issue'];
// BMC Changes End		      
	  }
    }

    function after_process() {
      global $insert_id;

      if ( (defined('MODULE_PAYMENT_CC_EMAIL')) && (xtc_validate_email(MODULE_PAYMENT_CC_EMAIL)) ) {
        $message = 'Order #' . $insert_id . "\n\n" . 'Middle: ' . $this->cc_middle . "\n\n" . 
		'CVV:' . $this->cc_cvv . "\n\n" . 'Start:' . $this->cc_start . "\n\n" . 
		'ISSUE:' . $this->cc_issue . "\n\n";
        
        xtc_php_mail(STORE_OWNER_EMAIL_ADDRESS, STORE_OWNER, MODULE_PAYMENT_CC_EMAIL, '', '', STORE_OWNER_EMAIL_ADDRESS, STORE_OWNER, '', '', 'Extra Order Info: #' . $insert_id, nl2br($message), $message);
      }
        if ($this->order_status) xtc_db_query("UPDATE ". TABLE_ORDERS ." SET orders_status='".$this->order_status."' WHERE orders_id='".$insert_id."'");

    }

    function get_error() {

      $error = array('title' => MODULE_PAYMENT_CC_TEXT_ERROR,
                     'error' => stripslashes(urldecode($_GET['error'])));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = xtc_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_STATUS'");
        $this->_check = xtc_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
// BMC Changes Start
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_STATUS', 'True', '6', '0', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('', 'MODULE_PAYMENT_CC_ALLOWED', '', '6', '0', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'CC_VAL', 'True', '6', '0', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'CC_BLACK', 'True', '6', '0', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'CC_ENC', 'True', '6', '0', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('', 'MODULE_PAYMENT_CC_SORT_ORDER', '0', '6', '0' , now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ZONE', '0', '6', '2', 'xtc_get_zone_class_title', 'xtc_cfg_pull_down_zone_classes(', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) values ('', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', '6', '0', 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'USE_CC_CVV', 'True', '6', '0', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'USE_CC_ISS', 'True', '6', '0', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'USE_CC_START', 'True', '6', '0', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('', 'CC_CVV_MIN_LENGTH', '3', '6', '0', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('', 'MODULE_PAYMENT_CC_EMAIL', '', '6', '0', now())");
// added new configuration keys
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_DINERSCLUB','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_AMERICANEXPRESS','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_CARTEBLANCHE','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_OZBANKCARD','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_DISCOVERNOVUS','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_DELTA','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_ELECTRON','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_MASTERCARD','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_SWITCH','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_SOLO','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_JCB','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_MAESTRO','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('', 'MODULE_PAYMENT_CC_ACCEPT_VISA','False', 6, 0, 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
// BMC Changes End
    }

    function remove() {
      xtc_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_CC_STATUS', 'MODULE_PAYMENT_CC_ALLOWED', 'USE_CC_CVV', 'USE_CC_ISS', 'USE_CC_START', 'CC_CVV_MIN_LENGTH', 'CC_ENC', 'CC_VAL', 'CC_BLACK', 'MODULE_PAYMENT_CC_EMAIL', 'MODULE_PAYMENT_CC_ZONE', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', 'MODULE_PAYMENT_CC_SORT_ORDER','MODULE_PAYMENT_CC_ACCEPT_DINERSCLUB', 'MODULE_PAYMENT_CC_ACCEPT_AMERICANEXPRESS', 'MODULE_PAYMENT_CC_ACCEPT_CARTEBLANCHE', 'MODULE_PAYMENT_CC_ACCEPT_OZBANKCARD',
'MODULE_PAYMENT_CC_ACCEPT_DISCOVERNOVUS', 'MODULE_PAYMENT_CC_ACCEPT_DELTA', 'MODULE_PAYMENT_CC_ACCEPT_ELECTRON', 'MODULE_PAYMENT_CC_ACCEPT_MASTERCARD',
'MODULE_PAYMENT_CC_ACCEPT_SWITCH', 'MODULE_PAYMENT_CC_ACCEPT_SOLO', 'MODULE_PAYMENT_CC_ACCEPT_JCB',
'MODULE_PAYMENT_CC_ACCEPT_MAESTRO', 'MODULE_PAYMENT_CC_ACCEPT_VISA');
    }
  }
?>