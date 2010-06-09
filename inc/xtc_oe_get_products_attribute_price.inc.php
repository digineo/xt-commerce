<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_get_products_attribute_price.inc.php  

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   XTC-Bestellbearbeitung:
   http://www.xtc-webservice.de / Matthias Hinsche
   info@xtc-webservice.de

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (xtc_get_products_attribute_price.inc.php,v 1.8 2003/08/14); www.nextcommerce.org
   
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

function xtc_oe_get_products_attribute_price($attribute_price,$tax_class,$price_special,$quantity,$prefix,$calculate_currencies='true', $customer_status)
	{

  $customers_status_query = xtc_db_query("select * from " . TABLE_CUSTOMERS_STATUS . " where customers_status_id = '" . $customer_status . "' ");
  $customers_status = xtc_db_fetch_array($customers_status_query);

		if ($customers_status['customers_status_show_price'] == '1') {
			$attribute_tax=xtc_get_tax_rate($tax_class);
		// check if user is allowed to see tax rates
				if ($customers_status['customers_status_show_price_tax'] =='0') {
				$attribute_tax='';
				}
		// add tax
		$price_string=(xtc_add_tax($attribute_price,$attribute_tax))*$quantity;
		if ($customers_status['customers_status_discount_attributes']=='0') {
		// format price & calculate currency
		$price_string=xtc_format_price($price_string,$price_special,$calculate_currencies);
			if ($price_special=='1') {
				$price_string = ' '.$prefix.' '.$price_string.' ';
			}
			} else {
			$discount=$customers_status['customers_status_discount'];
			$rabatt_string = $price_string - ($price_string/100*$discount);
			$price_string=xtc_format_price($price_string,$price_special,$calculate_currencies);
			$rabatt_string=xtc_format_price($rabatt_string,$price_special,$calculate_currencies);
			if ($price_special=='1' && $price_string != $rabatt_string) {
				$price_string = ' '.$prefix.'<font color="ff0000"><s>'.$price_string.'</s></font> '.$rabatt_string.' ';
			} else {
			
			$price_string=$rabatt_string;
			if ($price_special=='1') $price_string=' '.$prefix.' '.$price_string;
			}
			}
		} else {
		$price_string= '  ' .NOT_ALLOWED_TO_SEE_PRICES;
		}
		return $price_string;
	} ?>