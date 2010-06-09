<?php

/* --------------------------------------------------------------
   $Id: products_attributes.php 226 2007-03-06 14:27:16Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(products_attributes.php,v 1.48 2002/11/22); www.oscommerce.com 
   (c) 2003	 nextcommerce (products_attributes.php,v 1.10 2003/08/18); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/

require ('includes/application_top.php');
$languages = xtc_get_languages();

if ($_GET['action']) {
	$page_info = 'option_page=' . $_GET['option_page'] . '&value_page=' . $_GET['value_page'] . '&attribute_page=' . $_GET['attribute_page'];
	switch ($_GET['action']) {
		case 'add_product_options' :
			for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
				$option_name = $_POST['option_name'];
				xtc_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, products_options_name, language_id) values ('" . $_POST['products_options_id'] . "', '" . $option_name[$languages[$i]['id']] . "', '" . $languages[$i]['id'] . "')");
			}
			xtc_redirect(xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
			break;
		case 'add_product_option_values' :
			for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
				$value_name = $_POST['value_name'];
				$value_desc = $_POST['value_description'];

				xtc_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name, products_options_values_description) values ('" . $_POST['value_id'] . "', '" . $languages[$i]['id'] . "', '" . $value_name[$languages[$i]['id']] . "', '" . $value_desc[$languages[$i]['id']] . "')");

			}

			//prepare products_image filename
			if ($image = xtc_try_upload('value_image', DIR_FS_CATALOG_IMAGES . 'product_options/', '777', '')) {
				$pname_arr = explode('.', $image->filename);
				$nsuffix = array_pop($pname_arr);
				$value_image_name = $_POST['value_id'] . '_0.' . $nsuffix;

				rename(DIR_FS_CATALOG_IMAGES . 'product_options/' . $image->filename, DIR_FS_CATALOG_IMAGES . 'product_options/' . $value_image_name);
				$data = array ();
				$data['products_options_values_id'] = xtc_db_prepare_input($_POST['value_id']);
				$data['image_nr'] = '0';
				$data['image_name'] = xtc_db_prepare_input($value_image_name);
				xtc_db_perform(TABLE_PRODUCTS_OPTIONS_IMAGES, $data);
			}

			//MO_PICS
			for ($img = 0; $img < MO_PICS; $img++) {
				if ($pIMG = & xtc_try_upload('mo_pics_' . $img, DIR_FS_CATALOG_IMAGES . 'product_options/', '777', '')) {
					$pname_arr = explode('.', $pIMG->filename);
					$nsuffix = array_pop($pname_arr);
					$value_image_name = $_POST['value_id'] . '_' . ($img +1) . '.' . $nsuffix;

					rename(DIR_FS_CATALOG_IMAGES . 'product_options/' . $pIMG->filename, DIR_FS_CATALOG_IMAGES . 'product_options/' . $value_image_name);
					//get data & write to table
					$mo_img = array (
						'products_options_values_id' => xtc_db_prepare_input($_POST['value_id']
					), 'image_nr' => xtc_db_prepare_input($img +1), 'image_name' => xtc_db_prepare_input($products_image_name));
					xtc_db_perform(TABLE_PRODUCTS_OPTIONS_IMAGES, $mo_img);

				}
			}

			xtc_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_id, products_options_values_id) values ('" . $_POST['option_id'] . "', '" . $_POST['value_id'] . "')");
			xtc_redirect(xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
			break;
		case 'add_product_attributes' :
			xtc_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " values ('', '" . $_POST['products_id'] . "', '" . $_POST['options_id'] . "', '" . $_POST['values_id'] . "', '" . $_POST['value_price'] . "', '" . $_POST['price_prefix'] . "')");
			$products_attributes_id = xtc_db_insert_id();
			if ((DOWNLOAD_ENABLED == 'true') && $_POST['products_attributes_filename'] != '') {
				xtc_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " values (" . $products_attributes_id . ", '" . $_POST['products_attributes_filename'] . "', '" . $_POST['products_attributes_maxdays'] . "', '" . $_POST['products_attributes_maxcount'] . "')");
			}
			xtc_redirect(xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
			break;
		case 'update_option_name' :
			for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
				$option_name = $_POST['option_name'];
				xtc_db_query("update " . TABLE_PRODUCTS_OPTIONS . " set products_options_name = '" . $option_name[$languages[$i]['id']] . "' where products_options_id = '" . $_POST['option_id'] . "' and language_id = '" . $languages[$i]['id'] . "'");
			}
			xtc_redirect(xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
			break;
		case 'update_value' :
			$value_name = $_POST['value_name'];
			$value_desc = $_POST['value_description'];

			for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
				xtc_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES . " set products_options_values_name = '" . $value_name[$languages[$i]['id']] . "',products_options_values_description = '" . $value_desc[$languages[$i]['id']] . "'  where products_options_values_id = '" . $_POST['value_id'] . "' and language_id = '" . $languages[$i]['id'] . "'");
			}

			//prepare products_image filename
			if ($image = xtc_try_upload('value_image', DIR_FS_CATALOG_IMAGES . 'product_options/', '777', '')) {
				$pname_arr = explode('.', $image->filename);
				$nsuffix = array_pop($pname_arr);
				$value_image_name = $_POST['value_id'] . '_0.' . $nsuffix;

				rename(DIR_FS_CATALOG_IMAGES . 'product_options/' . $image->filename, DIR_FS_CATALOG_IMAGES . 'product_options/' . $value_image_name);
				$data = array ();
				$data['products_options_values_id'] = xtc_db_prepare_input($_POST['value_id']);
				$data['image_nr'] = '0';
				$data['image_name'] = xtc_db_prepare_input($value_image_name);
				// image already exists ?
				$_imgQuery = xtc_db_query("SELECT count(*) as count FROM " . TABLE_PRODUCTS_OPTIONS_IMAGES . " WHERE image_nr='0' and products_options_values_id='" . $data['products_options_values_id'] . "'");
				$_imgQuery = xtc_db_fetch_array($_imgQuery);
				if ($_imgQuery['count'] > 0) {

				} else {
					xtc_db_perform(TABLE_PRODUCTS_OPTIONS_IMAGES, $data);
				}
			}

			for ($img = 0; $img < MO_PICS; $img++) {
				if ($pIMG = & xtc_try_upload('mo_pics_' . $img, DIR_FS_CATALOG_IMAGES . 'product_options/', '777', '')) {
					$pname_arr = explode('.', $pIMG->filename);
					$nsuffix = array_pop($pname_arr);
					$value_image_name = $_POST['value_id'] . '_' . ($img +1) . '.' . $nsuffix;

					rename(DIR_FS_CATALOG_IMAGES . 'product_options/' . $pIMG->filename, DIR_FS_CATALOG_IMAGES . 'product_options/' . $value_image_name);
					//get data & write to table
					$mo_img = array (
						'products_options_values_id' => xtc_db_prepare_input($_POST['value_id']
					), 'image_nr' => xtc_db_prepare_input($img +1), 'image_name' => xtc_db_prepare_input($value_image_name));
					//				if ($action == 'insert') {

					$_imgQuery = xtc_db_query("SELECT count(*) as count FROM " . TABLE_PRODUCTS_OPTIONS_IMAGES . " WHERE image_nr='" . ($img +1) . "' and products_options_values_id='" . xtc_db_prepare_input($_POST['value_id']) . "'");
					$_imgQuery = xtc_db_fetch_array($_imgQuery);
					if ($_imgQuery['count'] > 0) {

					} else {
						xtc_db_perform(TABLE_PRODUCTS_OPTIONS_IMAGES, $mo_img);
					}

				}
			}

			if ($_POST['del_mo_pic'] != '') {
				foreach ($_POST['del_mo_pic'] AS $dummy => $val) {

					@ xtc_del_image_options_file($val);
					xtc_db_query("DELETE FROM " . TABLE_PRODUCTS_OPTIONS_IMAGES . "
														               WHERE products_options_values_id = '" . xtc_db_input($_POST['value_id']) . "' AND image_name  = '" . $val . "'");

				}
			}

			//are we asked to delete some pics?
			if ($_POST['del_pic'] != '') {
				@ xtc_del_image_options_file($products_data['del_pic']);
				//			xtc_db_query("UPDATE ".TABLE_PRODUCTS_OPTIONS_IMAGES."
				//								                 SET products_options_values_id = ''
				//									               WHERE products_options_values_id    = '".xtc_db_input($_POST['del_pic'])."'");
				xtc_db_query("DELETE FROM " . TABLE_PRODUCTS_OPTIONS_IMAGES . "
													               WHERE products_options_values_id = '" . xtc_db_input($_POST['value_id']) . "' AND image_name  = '" . $val . "'");
			}

			xtc_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " set products_options_id = '" . $_POST['option_id'] . "' where products_options_values_id = '" . $_POST['value_id'] . "'");
			xtc_redirect(xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
			break;
		case 'update_product_attribute' :
			xtc_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_id = '" . $_POST['products_id'] . "', options_id = '" . $_POST['options_id'] . "', options_values_id = '" . $_POST['values_id'] . "', options_values_price = '" . $_POST['value_price'] . "', price_prefix = '" . $_POST['price_prefix'] . "' where products_attributes_id = '" . $_POST['attribute_id'] . "'");
			if ((DOWNLOAD_ENABLED == 'true') && $_POST['products_attributes_filename'] != '') {
				xtc_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " 
				                        set products_attributes_filename='" . $_POST['products_attributes_filename'] . "',
				                            products_attributes_maxdays='" . $_POST['products_attributes_maxdays'] . "',
				                            products_attributes_maxcount='" . $_POST['products_attributes_maxcount'] . "'
				                        where products_attributes_id = '" . $_POST['attribute_id'] . "'");
			}
			xtc_redirect(xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
			break;
		case 'delete_option' :

			$del_options = xtc_db_query("select products_options_values_id from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . $_GET['option_id'] . "'");
			while ($del_options_values = xtc_db_fetch_array($del_options)) {
				xtc_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . $_GET['option_id'] . "'");
			}
			xtc_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . $_GET['option_id'] . "'");
			xtc_db_query("delete from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . $_GET['option_id'] . "'");

			xtc_redirect(xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
			break;
		case 'delete_value' :
			xtc_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . $_GET['value_id'] . "'");
			xtc_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . $_GET['value_id'] . "'");
			xtc_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_values_id = '" . $_GET['value_id'] . "'");
			xtc_redirect(xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
			break;
		case 'delete_attribute' :
			xtc_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_attributes_id = '" . $_GET['attribute_id'] . "'");
			// Added for DOWNLOAD_ENABLED. Always try to remove attributes, even if downloads are no longer enabled
			xtc_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . $_GET['attribute_id'] . "'");
			xtc_redirect(xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
			break;
	}
}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['language_charset']; ?>"> 
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript"><!--
function go_option() {
  if (document.option_order_by.selected.options[document.option_order_by.selected.selectedIndex].value != "none") {
    location = "<?php echo xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_page=' . ($_GET['option_page'] ? $_GET['option_page'] : 1)); ?>&option_order_by="+document.option_order_by.selected.options[document.option_order_by.selected.selectedIndex].value;
  }
}
//--></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td class="columnLeft2" width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td class="boxCenter" width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
<!-- options and values//-->
            <td valign="top" width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
<!-- value //-->
<?php

if ($_GET['action'] == 'delete_option_value') { // delete product option value
	$values = xtc_db_query("select products_options_values_id, products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . $_GET['value_id'] . "' and language_id = '" . $_SESSION['languages_id'] . "'");
	$values_values = xtc_db_fetch_array($values);
?>
              <tr>
                <td colspan="3" class="pageHeading">&nbsp;<?php echo $values_values['products_options_values_name']; ?>&nbsp;</td>
                <td>&nbsp;<?php echo xtc_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '53'); ?>&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="3"><?php echo xtc_black_line(); ?></td>
                  </tr>
<?php

	$products = xtc_db_query("select p.products_id, pd.products_name, po.products_options_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS . " po, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $_SESSION['languages_id'] . "' and po.language_id = '" . $_SESSION['languages_id'] . "' and pa.products_id = p.products_id and pa.options_values_id='" . $_GET['value_id'] . "' and po.products_options_id = pa.options_id order by pd.products_name");
	if (xtc_db_num_rows($products)) {
?>
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3"><?php echo xtc_black_line(); ?></td>
                  </tr>
<?php

		while ($products_values = xtc_db_fetch_array($products)) {
			$rows++;
?>
                  <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
                    <td align="center" class="smallText">&nbsp;<?php echo $products_values['products_id']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_name']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_options_name']; ?>&nbsp;</td>
                  </tr>
<?php

		}
?>
                  <tr>
                    <td colspan="3"><?php echo xtc_black_line(); ?></td>
                  </tr>
                  <tr>
                    <td class="main" colspan="3"><br /><?php echo TEXT_WARNING_OF_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td class="main" align="right" colspan="3"><br /><?php echo xtc_button_link(BUTTON_CANCEL, xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&value_page=' . $_GET['value_page'] . '&attribute_page=' . $attribute_page, 'NONSSL'));?>&nbsp;</td>
                  </tr>
<?php

	} else {
?>
                  <tr>
                    <td class="main" colspan="3"><br /><?php echo TEXT_OK_TO_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td class="main" align="right" colspan="3"><br /><?php echo xtc_button_link(BUTTON_DELETE, xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_value&value_id=' . $_GET['value_id'], 'NONSSL')); ?>&nbsp;&nbsp;&nbsp;<?php echo xtc_button_link(BUTTON_CANCEL, xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&option_page=' . $option_page . '&value_page=' . $_GET['value_page'] . '&attribute_page=' . $attribute_page, 'NONSSL'));?>&nbsp;</td>
                  </tr>
<?php

	}
?>
              	</table></td>
              </tr>
<?php

} else {
?>
              <tr>
                <td colspan="3" class="pageHeading"><table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="80" rowspan="2"><?php echo xtc_image(DIR_WS_ICONS.'folder_grey.png'); ?></td>
    <td class="pageHeading"><?php echo HEADING_TITLE_VAL; ?></td>
  </tr>
  <tr>
    <td class="main" valign="top">xt:Commerce Products</td>
  </tr>
</table></td>
                             <td colspan="2" align="right"><br>
<table border="0">
	<tr>
	<td class="main">
<form name="search" action="<?php echo FILENAME_PRODUCTS_ATTRIBUTES; ?>" method="GET">
<?php echo TEXT_SEARCH; ?><input type="text" name="search_optionsname" size="20" value="<?php echo $_GET['search_optionsname'];?>">
</form>
		</td>
	</tr>
</table>
								</td</tr>
              <tr>
                <td colspan="4" class="smallText">
<?php

	$per_page = MAX_ROW_LISTS_OPTIONS;
	if (isset ($_GET['search_optionsname'])) {
		$values = "select distinct 
								pov.products_options_values_id, 
								pov.products_options_values_name, 
								pov2po.products_options_id 
							from " . TABLE_PRODUCTS_OPTIONS . " po,
								" . TABLE_PRODUCTS_OPTIONS_VALUES . " pov 
								left join " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po 
								on pov.products_options_values_id = pov2po.products_options_values_id 
							where pov.language_id = '" . $_SESSION['languages_id'] . "' 
							and pov2po.products_options_id = po.products_options_id
							and (po.products_options_name LIKE '%" . $_GET['search_optionsname'] . "%' or pov.products_options_values_name LIKE '%" . $_GET['search_optionsname'] . "%')
							order by pov.products_options_values_id";
	} else {
		$values = "select 
								pov.products_options_values_id, 
								pov.products_options_values_name, 
								pov2po.products_options_id 
							from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov 
								left join " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po 
								on pov.products_options_values_id = pov2po.products_options_values_id 
							where pov.language_id = '" . $_SESSION['languages_id'] . "' 
							order by pov.products_options_values_id";
	}
	if (!$_GET['value_page']) {
		$_GET['value_page'] = 1;
	}
	$prev_value_page = $_GET['value_page'] - 1;
	$next_value_page = $_GET['value_page'] + 1;

	$value_query = xtc_db_query($values);

	$value_page_start = ($per_page * $_GET['value_page']) - $per_page;
	$num_rows = xtc_db_num_rows($value_query);

	if ($num_rows <= $per_page) {
		$num_pages = 1;
	} else
		if (($num_rows % $per_page) == 0) {
			$num_pages = ($num_rows / $per_page);
		} else {
			$num_pages = ($num_rows / $per_page) + 1;
		}
	$num_pages = (int) $num_pages;

	$values = $values . " LIMIT $value_page_start, $per_page";

	// Previous
	if ($prev_value_page) {
		echo '<a href="' . xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_order_by=' . $option_order_by . '&value_page=' . $prev_value_page . '&search_optionsname=' . $_GET['search_optionsname']) . '"> &lt;&lt; </a> | ';
	}

	for ($i = 1; $i <= $num_pages; $i++) {
		if ($i != $_GET['value_page']) {
			echo '<a href="' . xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_order_by=' . $option_order_by . '&value_page=' . $i . '&search_optionsname=' . $_GET['search_optionsname']) . '">' . $i . '</a> | ';
		} else {
			echo '<b><font color="#ff0000">' . $i . '</font></b> | ';
		}
	}

	// Next
	if ($_GET['value_page'] != $num_pages) {
		echo '<a href="' . xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_order_by=' . $option_order_by . '&value_page=' . $next_value_page . '&search_optionsname=' . $_GET['search_optionsname']) . '"> &gt;&gt;</a> ';
	}
?>
                </td>
              </tr>
              <tr>
                <td colspan="4"><?php echo xtc_black_line(); ?></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_VALUE; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4"><?php echo xtc_black_line(); ?></td>
              </tr>
<?php

	$next_id = 1;
	$values = xtc_db_query($values);
	while ($values_values = xtc_db_fetch_array($values)) {
		$options_name = xtc_options_name($values_values['products_options_id']);
		$values_name = $values_values['products_options_values_name'];
		$rows++;
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php

		if (($_GET['action'] == 'update_option_value') && ($_GET['value_id'] == $values_values['products_options_values_id'])) {
			echo xtc_draw_form('values', FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_value&value_page=' . $_GET['value_page'], 'post', 'enctype="multipart/form-data"');
			$inputs = '';
?>
                <td align="center" class="smallText" colspan="4">
                
<hr size="4" noshade>                
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent" width="100"><?php echo $values_values['products_options_values_id']; ?><input type="hidden" name="value_id" value="<?php echo $values_values['products_options_values_id']; ?>"></td>
    <td class="dataTableHeadingContent" width="150"><b><?php echo TABLE_HEADING_OPT_NAME; ?></b></td>
    <td class="dataTableHeadingContent" width="1"><select name="option_id"> 

<?php

			$options = xtc_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $_SESSION['languages_id'] . "' order by products_options_name");
			while ($options_values = xtc_db_fetch_array($options)) {
				echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '"';
				if ($values_values['products_options_id'] == $options_values['products_options_id']) {
					echo ' selected';
				}
				echo '>' . $options_values['products_options_name'] . '</option>';
			}
?>
	</select>
	</td>
   </tr>
  <tr class="dataTableRowSelected">
    <td class="dataTableContent" width="100">&nbsp;</td>
    <td class="dataTableContent" width="150"><b><?php echo TABLE_HEADING_OPT_IMAGE; ?></b></td>
    <td class="dataTableContent">
    <?php include(DIR_WS_MODULES.'options_images.php'); ?>
    </td>
  </tr> 
<?php


			for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {

				$value_name = xtc_db_query("select products_options_values_name, products_options_values_description from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . $values_values['products_options_values_id'] . "' and language_id = '" . $languages[$i]['id'] . "'");
				$value_name = xtc_db_fetch_array($value_name);
				$flag = xtc_image(DIR_WS_LANGUAGES . $languages[$i]['directory'] . '/admin/images/' . $languages[$i]['image']);
				$inputs = $flag . '&nbsp;<input type="text" name="value_name[' . $languages[$i]['id'] . ']" size="15" value="' . $value_name['products_options_values_name'] . '">&nbsp;<br />';

				$inputs_desc = $flag . '&nbsp;<textarea name="value_description[' . $languages[$i]['id'] . ']" cols="50" rows="4">' . $value_name['products_options_values_description'] . '</textarea>&nbsp;<br />';
?>
  <tr class="dataTableRowSelected">
    <td class="dataTableContent" width="100">&nbsp;</td>
    <td class="dataTableContent" width="150"><b><?php echo TABLE_HEADING_OPT_VALUE; ?></b></td>
    <td class="dataTableContent"><?php echo $inputs; ?></td>
  </tr>
  <tr class="dataTableRowSelected">
    <td class="dataTableContent" width="100">&nbsp;</td>
    <td class="dataTableContent" width="150"><b><?php echo TABLE_HEADING_OPT_DESC; ?></b></td>
    <td class="dataTableContent"><?php echo $inputs_desc; ?></td>
  </tr>
<?php

			}
?>
<tr class="dataTableRowSelected">
	<td align="center" colspan="3" class="dataTableContent">&nbsp;<?php echo xtc_button(BUTTON_UPDATE); ?>&nbsp;<?php echo xtc_button_link(BUTTON_CANCEL, xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'value_page='.$_GET['value_page'], 'NONSSL')); ?>&nbsp;</td>
</tr>
</table>
<hr size="4" noshade>
</td>
<?php

			echo '</form>';
		} else {
?>
                <td align="center" class="smallText">&nbsp;<?php echo $values_values["products_options_values_id"]; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo $options_name; ?>&nbsp;</td>
                <td class="smallText">&nbsp;<?php echo $values_name; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo xtc_button_link(BUTTON_EDIT, xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option_value&value_id=' . $values_values['products_options_values_id'] . '&value_page=' . $_GET['value_page'], 'NONSSL')); ?>&nbsp;&nbsp;<?php echo xtc_button_link(BUTTON_DELETE, xtc_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_option_value&value_id=' . $values_values['products_options_values_id'], 'NONSSL')); ?>&nbsp;</td>
<?php

		}
		$max_values_id_query = xtc_db_query("select max(products_options_values_id) + 1 as next_id from " . TABLE_PRODUCTS_OPTIONS_VALUES);
		$max_values_id_values = xtc_db_fetch_array($max_values_id_query);
		$next_id = $max_values_id_values['next_id'];
	}
?>
              </tr>
              <tr>
                <td colspan="4"><?php echo xtc_black_line(); ?></td>
              </tr>
<?php

	if ($_GET['action'] != 'update_option_value') {
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php

		echo xtc_draw_form('values', FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_option_values&value_page=' . $_GET['value_page'], 'post', 'enctype="multipart/form-data"');
?>
<td colspan="4">
<hr size="4" noshade>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
 <tr class="dataTableRowSelected">
    <td class="dataTableContent" width="100"><?php echo $next_id; ?></td>
    <td class="dataTableContent" width="150"><b><?php echo TABLE_HEADING_OPT_NAME; ?></b></td>
    <td class="dataTableContent"><select name="option_id">
<?php

		$options = xtc_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $_SESSION['languages_id'] . "' order by products_options_name");
		while ($options_values = xtc_db_fetch_array($options)) {
			echo '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
		}
?>
                </select><input type="hidden" name="value_id" value="<?php echo $next_id; ?>"></td>
                </tr>
  <tr class="dataTableRowSelected">
    <td class="dataTableContent" width="100">&nbsp;</td>
    <td class="dataTableContent" width="150"><b><?php echo TABLE_HEADING_OPT_IMAGE; ?></b></td>
    <td class="dataTableContent">
    <?php include(DIR_WS_MODULES.'options_images.php'); ?>
    </td>
  </tr>                

<?php


		$inputs = '';
		for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
			$flag = xtc_image(DIR_WS_LANGUAGES . $languages[$i]['directory'] . '/admin/images/' . $languages[$i]['image']);
			$inputs = $flag . '&nbsp;<input type="text" name="value_name[' . $languages[$i]['id'] . ']" size="15">&nbsp;<br />';
			$inputs_image = $flag . '&nbsp;' . xtc_draw_file_field('value_image' . $i) . '&nbsp;<br />';
			$inputs_desc = $flag . '&nbsp;<textarea name="value_description[' . $languages[$i]['id'] . ']" cols="50" rows="4"></textarea>&nbsp;<br />';
?>

  <tr class="dataTableRowSelected">
    <td class="dataTableContent" width="100">&nbsp;</td>
    <td class="dataTableContent" width="150"><b><?php echo TABLE_HEADING_OPT_VALUE; ?></b></td>
    <td class="dataTableContent"><?php echo $inputs; ?></td>
  </tr>
  <tr class="dataTableRowSelected">
    <td class="dataTableContent" width="100">&nbsp;</td>
    <td class="dataTableContent" width="150"><b><?php echo TABLE_HEADING_OPT_DESC; ?></b></td>
    <td class="dataTableContent"><?php echo $inputs_desc; ?></td>
  </tr>
<?php


		}
?>
<tr class="dataTableRowSelected">
<td align="center" class="dataTableContent" colspan="3">&nbsp;<?php echo xtc_button(BUTTON_INSERT); ?>&nbsp;</td>
</tr>
</table>
<hr size="4" noshade>
</td>                
                             
<?php

		echo '</form>';
?>
              </tr>
<?php

	}
}
?>
            </table></td>
          </tr>
        </table></td>
<!-- option value eof //-->
      </tr> 

 
    </table></td>
<!-- products_attributes_eof //-->
  </tr>
</table>
<!-- body_text_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>