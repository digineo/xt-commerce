<?php
/* --------------------------------------------------------------
   $Id$

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce
   --------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommercecoding standards (a typical file) www.oscommerce.com

   Released under the GNU General Public License
   --------------------------------------------------------------*/

class products {
	var $title, $options, $filename,$stats;

	function products() {
		$this->title = 'Products';
		$this->options = true;

		$this->catDepth = 6;
		$this->Version = '1.0';
		$this->languages = $this->get_lang();
		$this->filename = 'products.csv';
		$this->CAT = array ();
		$this->PARENT = array ();
		$this->counter = 0;
		$this->time_start = time();
		$this->man = $this->getManufacturers();
		$this->TextSign = CSV_TEXTSIGN;
		$this->seperator = CSV_SEPERATOR;
		if (CSV_SEPERATOR == '')
			$this->seperator = "\t";
		if (CSV_SEPERATOR == '\t')
			$this->seperator = "\t";
		$this->Groups = xtc_get_customers_statuses();
		$this->stats=array();
	}

	function start() {

		if (isset ($_POST['filename']) && $_POST['filename'] != '')
			$this->filename = xtc_db_input($_POST['filename']);

		$fp = fopen(DIR_FS_DOCUMENT_ROOT.'export/'.$this->filename, "w+");
		$heading = $this->TextSign.'XTSOL'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_model'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_stock'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_sorting'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_shipping'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_tpl'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_manufacturer'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_fsk18'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_priceNoTax'.$this->TextSign.$this->seperator;
		
		
		for ($i = 0, $n= sizeof($this->Groups); $i < $n; $i ++) {
			if (isset($this->Groups[$i]['id']))
				$heading .= $this->TextSign.'p_priceNoTax.'.$this->Groups[$i]['id'].$this->TextSign.$this->seperator;
		}
		if (GROUP_CHECK == 'true') {
			for ($i = 0, $n= sizeof($this->Groups); $i < $n; $i ++) {
				if (isset($this->Groups[$i]['id']))
					$heading .= $this->TextSign.'p_groupAcc.'.$this->Groups[$i]['id'].$this->TextSign.$this->seperator;
			}
		}
		$heading .= $this->TextSign.'p_tax'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_status'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_weight'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_ean'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_disc'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_opttpl'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_vpe'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_vpe_status'.$this->TextSign.$this->seperator;
		$heading .= $this->TextSign.'p_vpe_value'.$this->TextSign.$this->seperator;
		// product images

		for ($i = 1; $i < MO_PICS + 1; $i ++) {
			$heading .= $this->TextSign.'p_image.'.$i.$this->TextSign.$this->seperator;
			;
		}

		$heading .= $this->TextSign.'p_image'.$this->TextSign;

		// add lang fields
		for ($i = 0; $i < sizeof($this->languages); $i ++) {
			$heading .= $this->seperator.$this->TextSign;
			$heading .= 'p_name.'.$this->languages[$i]['code'].$this->TextSign.$this->seperator;
			$heading .= $this->TextSign.'p_desc.'.$this->languages[$i]['code'].$this->TextSign.$this->seperator;
			$heading .= $this->TextSign.'p_shortdesc.'.$this->languages[$i]['code'].$this->TextSign.$this->seperator;
			$heading .= $this->TextSign.'p_meta_title.'.$this->languages[$i]['code'].$this->TextSign.$this->seperator;
			$heading .= $this->TextSign.'p_meta_desc.'.$this->languages[$i]['code'].$this->TextSign.$this->seperator;
			$heading .= $this->TextSign.'p_meta_key.'.$this->languages[$i]['code'].$this->TextSign.$this->seperator;
			$heading .= $this->TextSign.'p_keywords.'.$this->languages[$i]['code'].$this->TextSign.$this->seperator;
			$heading .= $this->TextSign.'p_url.'.$this->languages[$i]['code'].$this->TextSign;

		}
		// add categorie fields
		for ($i = 0; $i < $this->catDepth; $i ++)
			$heading .= $this->seperator.$this->TextSign.'p_cat.'.$i.$this->TextSign;

		$heading .= "\n";

		fputs($fp, $heading);
		// content
		$export_query = "SELECT
										                             *
										                         FROM
										                             ".TABLE_PRODUCTS;

		$export_query = xtc_db_query($export_query);
		while ($export_data = xtc_db_fetch_array($export_query)) {

			$this->counter++;
			$line = $this->TextSign.'XTSOL'.$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_model'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_quantity'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_sort'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_shippingtime'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['product_template'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$this->man[$export_data['manufacturers_id']].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_fsk18'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_price'].$this->TextSign.$this->seperator;
			// group prices  Qantity:Price::Quantity:Price
			
			
			for ($i = 0, $n = sizeof($this->Groups); $i<$n; $i ++) {
				if (isset($this->Groups[$i]['id'])) {
				$price_query = "SELECT * FROM ".TABLE_PERSONAL_OFFERS_BY.$this->Groups[$i]['id']." WHERE products_id = '".$export_data['products_id']."'ORDER BY quantity";
				$price_query = xtc_db_query($price_query);
				$groupPrice = '';
				while ($price_data = xtc_db_fetch_array($price_query)) {
					if ($price_data['personal_offer'] > 0) {
						$groupPrice .= $price_data['quantity'].':'.$price_data['personal_offer'].'::';
					}
				}
				$groupPrice .= ':';
				$groupPrice = str_replace(':::', '', $groupPrice);
				if ($groupPrice == ':')
					$groupPrice = "";
				$line .= $this->TextSign.$groupPrice.$this->TextSign.$this->seperator;
				}
			}

			// group permissions
			if (GROUP_CHECK == 'true') {
				for ($i = 0, $n = sizeof($this->Groups); $i<$n; $i ++) {
					if (isset($this->Groups[$i]['id']))
						$line .= $this->TextSign.$export_data['group_permission_'.$this->Groups[$i]['id']].$this->TextSign.$this->seperator;
				}
			}

			$line .= $this->TextSign.$export_data['products_tax_class_id'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_status'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_weight'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_ean'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_discount_allowed'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['options_template'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_vpe'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_vpe_status'].$this->TextSign.$this->seperator;
			$line .= $this->TextSign.$export_data['products_vpe_value'].$this->TextSign.$this->seperator;

			if (MO_PICS > 0) {
				$mo_query = "SELECT * FROM ".TABLE_PRODUCTS_IMAGES." WHERE products_id='".$export_data['products_id']."'";
				$mo_query = xtc_db_query($mo_query);
				$img = array ();
				while ($mo_data = xtc_db_fetch_array($mo_query)) {
					$img[$mo_data['image_nr']] = $mo_data['image_name'];
				}

			}

			// product images
			for ($i = 1; $i < MO_PICS + 1; $i ++) {
				if (isset ($img[$i])) {
					$line .= $this->TextSign.$img[$i].$this->TextSign.$this->seperator;
				} else {
					$line .= $this->TextSign."".$this->TextSign.$this->seperator;
				}
			}

			$line .= $this->TextSign.$export_data['products_image'].$this->TextSign.$this->seperator;

			for ($i = 0; $i < sizeof($this->languages); $i ++) {
				$lang_query = xtc_db_query("SELECT * FROM ".TABLE_PRODUCTS_DESCRIPTION." WHERE language_id='".$this->languages[$i]['id']."' and products_id='".$export_data['products_id']."'");
				$lang_data = xtc_db_fetch_array($lang_query);
				$lang_data['products_description'] = str_replace("\n", "", $lang_data['products_description']);
				$lang_data['products_short_description'] = str_replace("\n", "", $lang_data['products_short_description']);
				$lang_data['products_description'] = str_replace("\r", "", $lang_data['products_description']);
				$lang_data['products_short_description'] = str_replace("\r", "", $lang_data['products_short_description']);
				$lang_data['products_description'] = str_replace(chr(13), "", $lang_data['products_description']);
				$lang_data['products_short_description'] = str_replace(chr(13), "", $lang_data['products_short_description']);
				$line .= $this->TextSign.$lang_data['products_name'].$this->TextSign.$this->seperator;
				$line .= $this->TextSign.$lang_data['products_description'].$this->TextSign.$this->seperator;
				$line .= $this->TextSign.$lang_data['products_short_description'].$this->TextSign.$this->seperator;
				$line .= $this->TextSign.$lang_data['products_meta_title'].$this->TextSign.$this->seperator;
				$line .= $this->TextSign.$lang_data['products_meta_description'].$this->TextSign.$this->seperator;
				$line .= $this->TextSign.$lang_data['products_meta_keywords'].$this->TextSign.$this->seperator;
				$line .= $this->TextSign.$lang_data['products_keywords'].$this->TextSign.$this->seperator;
				$line .= $this->TextSign.$lang_data['products_url'].$this->TextSign.$this->seperator;

			}
			$cat_query = xtc_db_query("SELECT categories_id FROM ".TABLE_PRODUCTS_TO_CATEGORIES." WHERE products_id='".$export_data['products_id']."'");
			$cat_data = xtc_db_fetch_array($cat_query);

			$line .= $this->buildCAT($cat_data['categories_id']);
			$line .= $this->TextSign;
			$line .= "\n";
			fputs($fp, $line);
		}

		fclose($fp);
		/*
		if (COMPRESS_EXPORT=='true') {
			$backup_file = DIR_FS_DOCUMENT_ROOT.'export/' . $this->filename;
			exec(LOCAL_EXE_ZIP . ' -j ' . $backup_file . '.zip ' . $backup_file);
		   unlink($backup_file);
		}
		*/
		$this->stats = array (array('title'=>'Products exported','value'=>$this->counter),array('title'=>'Time','value'=>$export->calcElapsedTime($this->time_start)));
	}
	
	function selection () {
 			
 			$form_data = array();
 			$form_data = array_merge($form_data, array (array ('title' => FILENAME, 'field' => xtc_draw_input_field('filename', $this->filename))));
		
 			return $form_data;
 			
 			
 		}

	/**
	*   Get installed languages
	*   @return array
	*/
	function get_lang() {

		$languages_query = "select languages_id, name, code, image, directory from ".TABLE_LANGUAGES;
		$languages_query = xtc_db_query($languages_query);
		while ($languages = xtc_db_fetch_array($languages_query)) {
			$languages_array[] = array ('id' => $languages['languages_id'], 'name' => $languages['name'], 'code' => $languages['code']);
		}

		return $languages_array;
	}


	function buildCAT($catID) {

		if (isset ($this->CAT[$catID])) {
			return $this->CAT[$catID];
		} else {
			$cat = array ();
			$tmpID = $catID;

			while ($this->getParent($catID) != 0 || $catID != 0) {
				$cat_select = xtc_db_query("SELECT categories_name FROM ".TABLE_CATEGORIES_DESCRIPTION." WHERE categories_id='".$catID."' and language_id='".$this->languages[0]['id']."'");
				$cat_data = xtc_db_fetch_array($cat_select);
				$catID = $this->getParent($catID);
				$cat[] = $cat_data['categories_name'];

			}
			$catFiller = '';
			for ($i = $this->catDepth - count($cat); $i > 0; $i --) {
				$catFiller .= $this->TextSign.$this->TextSign.$this->seperator;
			}
			$catFiller .= $this->TextSign;
			$catStr = '';
			for ($i = count($cat); $i > 0; $i --) {
				$catStr .= $this->TextSign.$cat[$i -1].$this->TextSign.$this->seperator;
			}
			$this->CAT[$tmpID] = $catStr.$catFiller;
			return $this->CAT[$tmpID];
		}
	}

	/**
	*   Get the tax_class_id to a given %rate
	*   @return array
	*/
	function getTaxRates() // must be optimazed (pre caching array)
	{
		$tax = array ();
		$tax_query = xtc_db_query("Select
										                                      tr.tax_class_id,
										                                      tr.tax_rate,
										                                      ztz.geo_zone_id
										                                      FROM
										                                      ".TABLE_TAX_RATES." tr,
										                                      ".TABLE_ZONES_TO_GEO_ZONES." ztz
										                                      WHERE
										                                      ztz.zone_country_id='".STORE_COUNTRY."'
										                                      and tr.tax_zone_id=ztz.geo_zone_id
										                                      ");

		while ($tax_data = xtc_db_fetch_array($tax_query)) {
			$tax[$tax_data['tax_class_id']] = $tax_data['tax_rate'];
		}
		return $tax;

	}

	/**
	*   Prefetch Manufactrers
	*   @return array
	*/
	function getManufacturers() {
		$man = array ();
		$man_query = "SELECT
												                                manufacturers_name,manufacturers_id 
												                                FROM
												                                ".TABLE_MANUFACTURERS;
		$man_query = xtc_db_query($man_query);
		while ($man_data = xtc_db_fetch_array($man_query)) {
			$man[$man_data['manufacturers_id']] = $man_data['manufacturers_name'];
		}
		return $man;
	}

	/**
	*   Return Parent ID for a given categories id
	*   @return int
	*/
	function getParent($catID) {
		if (isset ($this->PARENT[$catID])) {
			return $this->PARENT[$catID];
		} else {
			$parent_query = xtc_db_query("SELECT parent_id FROM ".TABLE_CATEGORIES." WHERE categories_id='".$catID."'");
			$parent_data = xtc_db_fetch_array($parent_query);
			$this->PARENT[$catID] = $parent_data['parent_id'];
			return $parent_data['parent_id'];
		}
	}

}
?>