<?php
/*
  $Id: post.php,  2007-01-02 14:38:44Y SUN $

   xt:Commerce - community made shopping
   http://www.xt-commerce.com
   http://www.xt-commerce.tw   
   http://www.xt-commerce.cn


   Copyright (c) 2007 xt:Commerce Shopsoftware  
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(information.php,v 1.6 2003/02/10); www.oscommerce.com 
   (c) 2003	 nextcommerce (content.php,v 1.2 2003/08/21); www.nextcommerce.org   
   (c) 2003	 xt-commerce  www.xt-commerce.com
   Released under the GNU General Public License 
---------------------------------------------------------------------------------------*/

  class post {
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function post() {
      global $order;

      $this->code = 'post';
      $this->title = MODULE_SHIPPING_POST_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_POST_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_POST_SORT_ORDER;
      $this->icon = DIR_WS_ICONS . 'post.gif';
      $this->tax_class = MODULE_SHIPPING_POST_TAX_CLASS;
      $this->enabled = ((MODULE_SHIPPING_POST_STATUS == 'True') ? true : false);

      if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_POST_ZONE > 0) ) {
        $check_flag = false;
        $check_query = xtc_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_POST_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while ($check = xtc_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
$this->types = array('TIME0'=>MODULE_SHIPPING_POST_TEXT_TIME0,
                           'TIME1'=>MODULE_SHIPPING_POST_TEXT_TIME1
						   
						   );
    }

// class methods
    function quote($method = '') {
      global $order, $cart, $shipping_weight, $shipping_num_boxes;

      if (MODULE_SHIPPING_POST_MODE == 'price') {
        $order_total = $cart->show_total();
      } else {
        $order_total = $shipping_weight;
      }

      $table_cost = split("[:,]" , MODULE_SHIPPING_POST_COST);
      $size = sizeof($table_cost);
      for ($i=0, $n=$size; $i<$n; $i+=2) {
        if ($order_total <= $table_cost[$i]) {
          $shipping = $table_cost[$i+1];
          break;
        }
      }

      if (MODULE_SHIPPING_POST_MODE == 'weight') {
        $shipping = $shipping * $shipping_num_boxes;
      }

      $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_POST_TEXT_TITLE);
		$methods = array();
		if ($method) {
			$i = substr($method,strlen($method)-1) ;
				$methods[] = array('id' => 'TIME'.$i,
								 'title' => $this->types['TIME'.$i],
								 'cost' => $shipping + MODULE_SHIPPING_POST_HANDLING);
		} else {
			$qsize = sizeof($this->types);
			for ($i=0; $i<$qsize; $i++) {
			  //list($type, $time) = each($this->types[$i]);
			  $methods[] = array('id' => 'TIME'.$i,
								 'title' => $this->types['TIME'.$i],
								 'cost' => $shipping + MODULE_SHIPPING_POST_HANDLING);
			}
		}
        $this->quotes['methods'] = $methods;
      if ($this->tax_class > 0) {
        $this->quotes['tax'] = xtc_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (xtc_not_null($this->icon)) $this->quotes['icon'] = xtc_image($this->icon, $this->title);

      return $this->quotes;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = xtc_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_POST_STATUS'");
        $this->_check = xtc_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_SHIPPING_POST_STATUS', 'True', '6', '0', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_SHIPPING_POST_COST', '25:8.50,50:5.50,10000:0.00', '6', '0', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_SHIPPING_POST_MODE', 'weight', '6', '0', 'xtc_cfg_select_option(array(\'weight\', \'price\'), ', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_SHIPPING_POST_HANDLING', '0', '6', '0', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_SHIPPING_POST_TAX_CLASS', '0', '6', '0', 'xtc_get_tax_class_title', 'xtc_cfg_pull_down_tax_classes(', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_SHIPPING_POST_ZONE', '0', '6', '0', 'xtc_get_zone_class_title', 'xtc_cfg_pull_down_zone_classes(', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_SHIPPING_POST_SORT_ORDER', '0', '6', '0', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_SHIPPING_POST_ALLOWED', '', '6', '0', now())");
    }

    function remove() {
      xtc_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_SHIPPING_POST_STATUS', 'MODULE_SHIPPING_POST_COST', 'MODULE_SHIPPING_POST_MODE', 'MODULE_SHIPPING_POST_HANDLING', 'MODULE_SHIPPING_POST_TAX_CLASS', 'MODULE_SHIPPING_POST_ZONE', 'MODULE_SHIPPING_POST_SORT_ORDER', 'MODULE_SHIPPING_POST_ALLOWED');
    }
  }
?>
