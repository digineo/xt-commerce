<?php

/* -----------------------------------------------------------------------------------------
   $Id: xtc_get_options_mo_images.inc.php 70 2007-01-07 14:19:12Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2004 XT-Commerce
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

function xtc_get_options_mo_images($id = '') {
	$mo_query = "select * from " . TABLE_PRODUCTS_OPTIONS_IMAGES . " where products_options_values_id = '" . $id . "' ORDER BY image_nr";

	$products_mo_images_query = xtc_db_query($mo_query);

	while ($row = xtc_db_fetch_array($products_mo_images_query, true))
		$results[$row['image_nr']-1] = $row;
	if (is_array($results)) {
		return $results;
	} else {
		return false;
	}
}
?>