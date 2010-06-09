<?php
/* --------------------------------------------------------------
   $Id$

   xt:Commerce - Shopsoftware
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce
   --------------------------------------------------------------

   Released under the GNU General Public License
   --------------------------------------------------------------*/


class psmBilligerDe {
	var $title, $filename, $stats;

	function psmBilligerDe() {
		$this->title = 'PSM - Billiger.de';
		$this->time_start = time();
		$this->counter = 0;
		$this->failed = 0;
		$this->Version = '1.0';
		$this->seperator = ";";
		$this->filename = 'billiger.csv';

	}

	function start() {
		global $export;

		@ xtc_set_time_limit(0);
		require (DIR_FS_CATALOG . DIR_WS_CLASSES . 'xtcPrice.php');
		$xtPrice = new xtcPrice($_POST['currencies'], $_POST['status']);


		$export_query = "SELECT
		                             p.products_id,
		                             pd.products_name,
		                             pd.products_description,
		                             p.products_model,p.products_ean,
		                             p.products_image,
		                             p.products_date_available,
		                             p.products_shippingtime,
		                             p.products_discount_allowed,
		                             pd.products_meta_keywords,
		                             p.products_tax_class_id,
		                             p.products_date_added,
		                             m.manufacturers_name
		                         FROM
		                             " . TABLE_PRODUCTS . " p LEFT JOIN
		                             " . TABLE_MANUFACTURERS . " m
		                           ON p.manufacturers_id = m.manufacturers_id LEFT JOIN
		                             " . TABLE_PRODUCTS_DESCRIPTION . " pd
		                           ON p.products_id = pd.products_id AND
		                            pd.language_id = '" . $_SESSION['languages_id'] . "' LEFT JOIN
		                             " . TABLE_SPECIALS . " s
		                           ON p.products_id = s.products_id
		                         WHERE
		                           p.products_status = 1
		                         ORDER BY
		                            p.products_date_added DESC,
		                            pd.products_name";

		$query = xtc_db_query($export_query);
		$fp = fopen(DIR_FS_DOCUMENT_ROOT . 'export/' . $_POST['filename'], "w+");
		$heading = 'artikelid;hersteller_marke;bezeichnung;kategorie;"beschreibung";bild_klein;deeplink;lieferzeit;lieferkosten;preis;product_ean' . "\n";
		fputs($fp, $heading);

		$this->SHIPPING = array();

		$status_query=xtc_db_query("SELECT
                                     shipping_status_name,
                                     shipping_status_image,shipping_status_id
                                     FROM ".TABLE_SHIPPING_STATUS."
                                     where language_id = '".(int)$_SESSION['languages_id']."'");
         
         while ($status_data=xtc_db_fetch_array($status_query)) {
         	$this->SHIPPING[$status_data['shipping_status_id']]=array('name'=>$status_data['shipping_status_name'],'image'=>$status_data['shipping_status_image']);
         }

		while ($products = xtc_db_fetch_array($query)) {

			$products_price = $xtPrice->xtcGetPrice($products['products_id'], $format = false, 1, $products['products_tax_class_id'], '');
			// get product categorie
			$categorie_query = xtc_db_query("SELECT
			                                            categories_id
			                                            FROM " . TABLE_PRODUCTS_TO_CATEGORIES . "
			                                            WHERE products_id='" . $products['products_id'] . "'");
			while ($categorie_data = xtc_db_fetch_array($categorie_query)) {
				$categories = $categorie_data['categories_id'];
			}
			
			// description
			$products_description = strip_tags($products['products_description']);         
            $products_description = str_replace("<br>"," ",$products_description);
            $products_description = str_replace("<br />"," ",$products_description);
            $products_description = str_replace(chr(13)," ",$products_description);
            $products_description = str_replace(";",", ",$products_description);
            $products_description = str_replace("\"","'",$products_description);
            $products_description = substr($products_description, 0, 2000);

			$cat = $export->buildCAT($categories);

			if ($products['products_image'] != '') {
				$image = HTTP_CATALOG_SERVER . DIR_WS_CATALOG_THUMBNAIL_IMAGES . $products['products_image'];
			} else {
				$image = '';
			}

			$content = $products['products_id'] . ';' .
			$products['manufacturers_name'] . ';' .
			$products['products_name'] . ';' .
			substr($cat, 0, strlen($cat) - 2) . ';' .
			'"'.$products_description.'"' . ';' .
			$image . ';' .
			HTTP_CATALOG_SERVER . DIR_WS_CATALOG . 'product_info.php?'.$_POST['campaign'].xtc_product_link($products['products_id'], $products['products_name']) . ";".
			$this->SHIPPING[$products['products_shippingtime']]['name'] . ';' .
			$_POST['shipping'] . ';' .
			number_format($products_price,2,'.','') . ';' .
			$products['products_ean'] . "\n";

			$this->counter++;
			fputs($fp, $content);

		}

		fclose($fp);

		$this->stats = array (
			array (
				'title' => 'Products exported',
				'value' => $this->counter
			),
			array (
				'title' => 'Time',
				'value' => $export->calcElapsedTime($this->time_start
			)
		));
	}

	function selection() {
		global $export;

		$customers_statuses_array = xtc_get_customers_statuses();


		$form_data = array ();
		$form_data = array_merge($form_data, array (
			array (
				'title' => FILENAME,
				'field' => xtc_draw_input_field('filename',
				$this->filename
			)
		)));
		$form_data = array_merge($form_data, array (
			array (
				'title' => CURRENCY,
				'field' => $export->getCurrencies()
			)
		));
		$form_data = array_merge($form_data, array (
			array (
				'title' => CUSTOMERS_GROUP,
				'field' => xtc_draw_pull_down_menu('status',
				$customers_statuses_array,
				'1'
			)
		)));
		$form_data = array_merge($form_data, array (
			array (
				'title' => CAMPAIGN,
				'field' => xtc_draw_pull_down_menu('campaign',
				$export->getCampaigns()
			)
		)));
		$form_data = array_merge($form_data, array (
			array (
				'title' => 'Shipping:',
				'field' => xtc_draw_input_field('shipping',
				'0'
			)
		)));

		return $form_data;

	}
}
?>