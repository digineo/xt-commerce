<?php
/*------------------------------------------------------------------------------
  $Id: uos_lastschrift_at_modul.php 6 2006-11-29 13:31:39Z mzanier $

  XTC-CC - Contribution for XT-Commerce http://www.xt-commerce.com
  modified by UNITES-ONLINE-SERVICES Payment interface
    @copyright 2006 by UNITES-ONLINE-SERVICES
    @subpackage uos_lastschrift_de_modul
    @author o.reinhard<o.reinhard@united-online-services.de

  -----------------------------------------------------------------------------
  based on:
  $Id: uos_lastschrift_at_modul.php 6 2006-11-29 13:31:39Z mzanier $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
------------------------------------------------------------------------------*/

  class uos_lastschrift_at_modul {
    var $code, $title, $description, $enabled;

		// class constructor
    function uos_lastschrift_at_modul() {
      global $order;

      $this->code = 'uos_lastschrift_at_modul';
      $this->title = MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_TEXT_DESCRIPTION;

      $this->sort_order = MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

    if (MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_DEMO != 'True') {
       $this->form_action_url = 'https://www.united-online-transfer.com/payment/shop.php';
      }else{
        $this->form_action_url = 'http://transfer.uos-test.com/payment/shop.php';
      }

    }

		// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ZONE > 0) ) {
        $check_flag = false;
        $check_query = xtc_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }

    function process_button() {
      global $order, $currencies, $xtPrice, $currency;

        $my_currency = MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_CURRENCY;
    	$amount = (int)($order->info['total'] * 100);
    	$key   = MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_KEY;
    	$param = "";
    	$desc  = STORE_NAME;
        $p_id  = MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ID;
        $go_url= xtc_href_link(FILENAME_CHECKOUT_PROCESS, '', 'NONSSL');
    	$sum = md5($p_id.$amount.$go_url.$desc.$param.$key);

         // Auswahl des Zahlungsmittel. Hier Lastschrift AT ohne UOT

        $uos_send['uos_payment']     = 27;          // Schlüssel 20 = Lastschrift AT OHNE United Online Transfer

        // Daten wandeln für die Übergabe der PersonenDaten wenn Info vorhanden
        $uos_send['cus_gender']     = $order->billing['cus_gender'];
        $uos_send['cus_title']      = $order->billing['cus_title'];
        $uos_send['cus_firstname']  = $order->billing[firstname];
        $uos_send['cus_lastname']   = $order->billing[lastname];
        $uos_send['cus_company']    = $order->billing[company];
        $uos_send['cus_nr']         = preg_replace('/[^0-9]*(.*)\\r*\\n*.*/', '$1', $order->billing[street_address]);
        $uos_send['cus_street']     = str_replace($uos_send['cus_nr'],'',$order->billing[street_address]);
        $uos_send['cus_extra']      = $order->billing[suburb];
        $uos_send['cus_zipcode']    = $order->billing[postcode];
        $uos_send['cus_city']       = $order->billing[city];
        $uos_send['cus_country']    = $order->billing[country][iso_code_2];
        #$uos_send['cus_dob']        = $order->billing['cus_dob'];
        $uos_send['cus_prephone']   = substr($order->customer[telephone],0,4);
        $uos_send['cus_phone']      = substr($order->customer[telephone],5);
        $uos_send['cus_email']      = $order->customer[email_address];

        $process_button_string = xtc_draw_hidden_field('uos_p', MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ID) .
                                 xtc_draw_hidden_field('uos_eu', $amount) .
                                 xtc_draw_hidden_field('uos_url', xtc_href_link(FILENAME_CHECKOUT_PROCESS, '', 'NONSSL')) .
                                 xtc_draw_hidden_field('uos_desc', STORE_NAME) .
                                 xtc_draw_hidden_field('mer_param', $param) .
                                 xtc_draw_hidden_field('uos_chk', $sum);
        //Übergabe Personendaten
        for($i=1;$i<=count($uos_send);$i++){
        $process_button_string.= xtc_draw_hidden_field(key($uos_send), current($uos_send)); //Erstellen der Personendaten
        next($uos_send);
        }
      return $process_button_string;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

	function admin_order($oID) {
		return false;
	}

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = xtc_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_STATUS'");
        $this->_check = xtc_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ( 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_STATUS', 'True', '6', '1', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_DEMO', 'False', '6', '1', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_MODUL_ALLOWED', '', '6', '0', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ( 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ID', '0','6', '2', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ( 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_KEY', '0', '6', '3', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ( 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_CURRENCY', 'EUR', '6', '6', 'xtc_cfg_select_option(array(\'EUR\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ( 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ZONE', '0', '6', '4', 'xtc_get_zone_class_title', 'xtc_cfg_pull_down_zone_classes(', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) values ( 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ORDER_STATUS_ID', '0', '6', '5', 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ( 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_SORT_ORDER', '0','6', '6', now())");
    }

    function remove() {
      xtc_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_STATUS','MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_DEMO', 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ID', 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_KEY', 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_CURRENCY','MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_MODUL_ALLOWED', 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ZONE', 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ORDER_STATUS_ID', 'MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_SORT_ORDER');
    }
  }
?>
