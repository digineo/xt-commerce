<?php
/* -----------------------------------------------------------------------------------------
   $Id: ot_loworderfee.php,v 1.3 2004/04/21 17:54:46 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(ot_loworderfee.php,v 1.11 2003/02/14); www.oscommerce.com 
   (c) 2003	 nextcommerce (ot_loworderfee.php,v 1.7 2003/08/24); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   

  class ot_loworderfee {
    var $title, $output;

    function ot_loworderfee($price) {
      $this->code = 'ot_loworderfee';
      $this->title = MODULE_ORDER_TOTAL_LOWORDERFEE_TITLE;
      $this->description = MODULE_ORDER_TOTAL_LOWORDERFEE_DESCRIPTION;
      $this->enabled = ((MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER;
      $this->Price=$price;

      $this->output = array();
    }

    function process() {
      global $order, $currencies;

      if (MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE == 'true') {
        switch (MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION) {
          case 'national':
            if ($order->delivery['country_id'] == STORE_COUNTRY) $pass = true; break;
          case 'international':
            if ($order->delivery['country_id'] != STORE_COUNTRY) $pass = true; break;
          case 'both':
            $pass = true; break;
          default:
            $pass = false; break;
        }

        if ( ($pass == true) && ( ($order->info['total'] - $order->info['shipping_cost']) < MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER) ) {
          $tax = xtc_get_tax_rate(MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
          $tax_description = xtc_get_tax_description(MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);

          $order->info['tax'] += xtc_calculate_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax);
          $order->info['tax_groups']["$tax_description"] += xtc_calculate_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax);
          $order->info['total'] += MODULE_ORDER_TOTAL_LOWORDERFEE_FEE + xtc_calculate_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax);

          $this->output[] = array('title' => $this->title . ':',
                                  'text' => $this->Price->xtcFormat(xtc_add_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax), true),
                                  'value' => xtc_add_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax));
        }
      }
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = xtc_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS'");
        $this->_check = xtc_db_num_rows($check_query);
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS');
    }

    function install() {
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'true', '6', '1','xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', '4', '6', '2', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'false', '6', '3', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, date_added) values ('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', '50','6', '4', 'currencies->format', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, date_added) values ('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', '5','6', '5', 'currencies->format', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'both','6', '6', 'xtc_cfg_select_option(array(\'national\', \'international\', \'both\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', '0','6', '7', 'xtc_get_tax_class_title', 'xtc_cfg_pull_down_tax_classes(', now())");
    }

    function remove() {
      xtc_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>