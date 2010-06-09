<?php
/*
 * Update Script for xt:Commerce Database
 * xt:Commerce Version 3.0.4 SP1 -> 3.0.4 SP2
 * 
 * (c) 2006 xt:Commerce GbR, http://www.xt-commerce.com
 * 
 */
 
$id=1;
define('Q'.$id, "INSERT INTO configuration (configuration_id,  configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES   ('', 'REVOCATION_ID', '', 17, 14, NULL, '2003-12-05 05:01:41', NULL, NULL)");
define('_Q'.$id,  'adding revocation option to configuration (1)');

$id ++;
define('Q'.$id, "INSERT INTO configuration (configuration_id,  configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES   ('', 'DISPLAY_REVOCATION_ON_CHECKOUT', 'true', 17, 13, NULL, '', NULL, 'xtc_cfg_select_option(array(\'true\', \'false\'),')");
define('_Q'.$id,  'adding revocation option to configuration (2)');

$id ++;
define('Q'.$id, "ALTER TABLE orders_products ADD `products_shipping_time` varchar(255) DEFAULT '' NOT NULL");
define('_Q'.$id,  'adding products_shipping_time to orders_products');

$id ++;
define('Q'.$id, "ALTER TABLE admin_access ADD `econda` varchar(255) DEFAULT '' NOT NULL");
define('_Q'.$id,  'adding econda to admin_access');

$id ++;
define('Q'.$id, "UPDATE admin_access SET econda=1");
define('_Q'.$id,  'updating permissions for econda');

$id ++;
define('Q'.$id, "INSERT INTO configuration (configuration_id,  configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES   ('', 'TRACKING_ECONDA_ACTIVE', 'false',  23, 1, NULL, '', NULL, 'xtc_cfg_select_option(array(\'true\', \'false\'),')");
define('_Q'.$id,  'adding econda option to configuration (2)');

$id ++;
define('Q'.$id, "INSERT INTO configuration (configuration_id,  configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES   ('', 'TRACKING_ECONDA_ID','',  23, 2, NULL, '', NULL, NULL)");
define('_Q'.$id,  'adding econda option to configuration (2)');


// update categories permissions
$query = "SELECT orders_id, currency FROM orders";
$query = xtc_db_query($query);

$curr = "SELECT code, value FROM currencies";
$curr = xtc_db_query($curr);
while ($curr_data = xtc_db_fetch_array($curr)) {
	$currencies[$curr_data['code']] = $curr_data['value']; 
}
	
$orders = 0;
while ($data = xtc_db_fetch_array($query)) {
	$orders++;
	$update_query = "UPDATE orders SET currency_value='".$currencies[$data['currency']]."' WHERE orders_id = '".$data['orders_id']."'";
	xtc_db_query($update_query);
}

define('COUNT', $id);
?>