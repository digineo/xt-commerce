<?php

/* --------------------------------------------------------------
   $Id: options_images.php 242 2007-03-08 13:34:57Z mzanier $

   xt:Commerce - Shopsoftware
   http://www.xt-commerce.com

   Copyright (c) 2007 xt:Commerce


   Released under the GNU General Public License
   --------------------------------------------------------------*/
defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

//include needed functions
require_once (DIR_FS_INC.'xtc_get_options_mo_images.inc.php');
// action=update_option_value
$img_query = "SELECT * FROM ".TABLE_PRODUCTS_OPTIONS_IMAGES." WHERE products_options_values_id='".xtc_db_prepare_input($_GET['value_id'])."'";
$img_query = xtc_db_query($img_query);
$_imgData=array();
while ($_img = xtc_db_fetch_array($img_query)) {
	$_imgData[$_img['image_nr']]=$_img['image_name'];
}

// show images
//if ($_GET['action'] == 'new_product') {

	// display images fields:
//	echo '<tr><td colspan="4">'.xtc_draw_separator('pixel_trans.gif', '1', '10').'</td></tr>';

	if ($_imgData[0]!='') {
		echo xtc_image(DIR_WS_CATALOG_IMAGES.'product_options/'.$_imgData[0], 'Image 1').'<br />';
		echo xtc_draw_selection_field('del_pic', 'checkbox', $_imgData[0]).' '.TABLE_TEXT_DELETE.'<br />';
	}

	echo xtc_draw_file_field('value_image').'<br>';
//	.xtc_draw_separator('pixel_trans.gif', '24', '15').'&nbsp;'.$pInfo->products_image.xtc_draw_hidden_field('products_previous_image_0', $pInfo->products_image);
//
//	if ($pInfo->products_image != '') {
//		echo '</tr><tr><td align="center" class="main" valign="middle">'.xtc_draw_selection_field('del_pic', 'checkbox', $pInfo->products_image).' '.TEXT_DELETE.'</td></tr></table>';
//	} else {
//		echo '</td></tr>';
//	}

	// display MO PICS
	if (MO_PICS > 0) {
		$mo_images = xtc_get_options_mo_images(xtc_db_prepare_input($_GET['value_id']));
//		print_r ($mo_images);
		for ($i = 0; $i < MO_PICS; $i ++) {
			if ($mo_images[$i]["image_name"]) {
				echo xtc_image(DIR_WS_CATALOG_IMAGES.'product_options/'.$mo_images[$i]["image_name"], 'Image '. ($i +1)).'<br />';
			} 
			echo '<br />'.TEXT_OPTIONS_IMAGE.' '. ($i +1).'<br />'.xtc_draw_file_field('mo_pics_'.$i).'<br />'.xtc_draw_separator('pixel_trans.gif', '24', '15').'&nbsp;'.$mo_images[$i]["image_name"].xtc_draw_hidden_field('products_previous_image_'. ($i +1), $mo_images[$i]["image_name"]);
			if (isset ($mo_images[$i]["image_name"])) {
				echo xtc_draw_selection_field('del_mo_pic[]', 'checkbox', $mo_images[$i]["image_name"]).' '.TABLE_TEXT_DELETE.'<br />';
			} 
		}
	}

//}
?>