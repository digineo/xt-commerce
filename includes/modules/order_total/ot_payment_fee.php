<?php
/* -----------------------------------------------------------------------------------------
   $Id: ot_payment_fee.php 97 2007-01-17 15:19:56Z mzanier $

   xt:Commerce - Shopsoftware
   http://www.xt-commerce.com

   Copyright (c) 2007 xt:Commerce
   -----------------------------------------------------------------------------------------

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


  class ot_payment_fee {
    var $title, $output;

    function ot_payment_fee() {
 		
      $this->code = 'ot_payment_fee';
      $this->title = MODULE_ORDER_TOTAL_PAYMENT_FEE_TITLE;
      $this->description = MODULE_ORDER_TOTAL_PAYMENT_FEE_DESCRIPTION;
      $this->enabled = ((MODULE_ORDER_TOTAL_PAYMENT_FEE_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_ORDER_TOTAL_PAYMENT_FEE_SORT_ORDER;


      $this->output = array();
    }

    function process() {
      global $order, $xtPrice;

			if (MODULE_ORDER_TOTAL_PAYMENT_FEE_STATUS=='true') {
			if (defined(MODULE_PAYMENT_.strtoupper($order->info['payment_class'])._COST)) {
			$cost = constant(MODULE_PAYMENT_.strtoupper($order->info['payment_class'])._COST);

        	$cost_table = split("[:,]" , $cost);
        	for ($i=0; $i<sizeof($cost_table); $i+=2) {
          	if ($order->info['total'] <= $cost_table[$i]) {
            	$percentage = $cost_table[$i+1];
            	break;
          	}
        	}
		
			$prefix = '+';
//            if ($percentage<0) $prefix='-';
			
			$payment_fee = $order->info['total']/100*$percentage;

//			echo 'total:'.$order->info['total'];


            $payment_fee_tax = xtc_get_tax_rate(MODULE_ORDER_TOTAL_PAYMENT_FEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
            $payment_fee_tax_description = xtc_get_tax_description(MODULE_ORDER_TOTAL_PAYMENT_FEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
        	$payment_fee = $xtPrice->xtcFormat($payment_fee,false,0,true);
        	
//        	echo 'fee:'.$payment_fee;
        if ($_SESSION['customers_status']['customers_status_show_price_tax'] == 1) {
			$fee_tax = $xtPrice->xtcGetTax($payment_fee,$payment_fee_tax);
            $order->info['tax'] += $fee_tax;
			$order->info['tax_groups'][TAX_ADD_TAX . "$payment_fee_tax_description"] += $fee_tax;
            $order->info['total'] += $payment_fee;
            $payment_fee_value= $payment_fee;
            $payment_fee= $xtPrice->xtcFormat($payment_fee_value,true);
        }
        if ($_SESSION['customers_status']['customers_status_show_price_tax'] == 0 && $_SESSION['customers_status']['customers_status_add_tax_ot'] == 1) {
            $order->info['tax'] += xtc_add_tax($payment_fee, $payment_fee_tax)-$payment_fee;
            $order->info['tax_groups'][TAX_NO_TAX . "$payment_fee_tax_description"] += xtc_add_tax($payment_fee, $payment_fee_tax)-$payment_fee;
            $payment_fee_value=$payment_fee;
            $payment_fee= $xtPrice->xtcFormat($payment_fee,true);
            $order->info['subtotal'] += $payment_fee_value;
            $order->info['total'] += $payment_fee_value;
        }
        if (!$payment_fee_value) {
           $payment_fee_value=$payment_fee;
           $order->info['total'] += $payment_fee_value;
           $payment_fee= $xtPrice->xtcFormat($payment_fee,true);
          
        }
                      
            $this->output[] = array('title' => $this->title . '('.$prefix.$percentage.'%) :',
                                    'text' => $payment_fee,
                                    'value' => $payment_fee_value);
			}
    }
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = xtc_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_PAYMENT_FEE_STATUS'");
        $this->_check = xtc_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_PAYMENT_FEE_STATUS', 'MODULE_ORDER_TOTAL_PAYMENT_FEE_SORT_ORDER', 'MODULE_ORDER_TOTAL_PAYMENT_FEE_TAX_CLASS');
    }

    function install() {
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_ORDER_TOTAL_PAYMENT_FEE_STATUS', 'true', '6', '0', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_PAYMENT_FEE_SORT_ORDER', '36', '6', '0', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_ORDER_TOTAL_PAYMENT_FEE_TAX_CLASS', '0', '6', '0', 'xtc_get_tax_class_title', 'xtc_cfg_pull_down_tax_classes(', now())");
    }

    function remove() {
      xtc_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>