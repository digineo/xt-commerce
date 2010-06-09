<?php
/* --------------------------------------------------------------
   $Id: stocks_traffic.php 243 2007-03-08 13:35:19Z mzanier $

   xt:Commerce - Shopsoftware
   http://www.xt-commerce.com

   Copyright (c) 2007 xt:Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(orders_status.php,v 1.19 2003/02/06); www.oscommerce.com
   (c) 2003	 nextcommerce (orders_status.php,v 1.9 2003/08/18); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/

  require('includes/application_top.php');

  switch ($_GET['action']) {
    case 'insert':
    case 'save':
      $stocks_traffic_id = xtc_db_prepare_input($_GET['oID']);

      $languages = xtc_get_languages();
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $stocks_traffic_name_array = $_POST['stocks_traffic_name'];
        $stocks_traffic_percentage = $_POST['stocks_traffic_percentage'];
        $language_id = $languages[$i]['id'];

        $sql_data_array = array('stocks_traffic_name' => xtc_db_prepare_input($stocks_traffic_name_array[$language_id]));

        if ($_GET['action'] == 'insert') {
          if (!xtc_not_null($stocks_traffic_id)) {
            $next_id_query = xtc_db_query("select max(stocks_traffic_id) as stocks_traffic_id from " . TABLE_STOCKS_TRAFFIC . "");
            $next_id = xtc_db_fetch_array($next_id_query);
            $stocks_traffic_id = $next_id['stocks_traffic_id'] + 1;
          }

          $insert_sql_data = array('stocks_traffic_id' => $stocks_traffic_id,
          							'stocks_traffic_percentage' => $stocks_traffic_percentage,
                                   'language_id' => $language_id);
          $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
          xtc_db_perform(TABLE_STOCKS_TRAFFIC, $sql_data_array);
        } elseif ($_GET['action'] == 'save') {
          xtc_db_perform(TABLE_STOCKS_TRAFFIC, $sql_data_array, 'update', "stocks_traffic_id = '" . xtc_db_input($stocks_traffic_id) . "' and language_id = '" . $language_id . "'");
        }
      }

      if ($stocks_traffic_image = &xtc_try_upload('stocks_traffic_image',DIR_WS_ICONS)) {
        xtc_db_query("update " . TABLE_STOCKS_TRAFFIC . " set stocks_traffic_image = '" . $stocks_traffic_image->filename . "' where stocks_traffic_id = '" . xtc_db_input($stocks_traffic_id) . "'");
      }

      xtc_redirect(xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $stocks_traffic_id));
      break;

    case 'deleteconfirm':
      $oID = xtc_db_prepare_input($_GET['oID']);

      xtc_db_query("delete from " . TABLE_STOCKS_TRAFFIC . " where stocks_traffic_id = '" . xtc_db_input($oID) . "'");

      xtc_redirect(xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page']));
      break;

    case 'delete':
      $oID = xtc_db_prepare_input($_GET['oID']);


      $remove_status = true;
      if ($oID == DEFAULT_STOCKS_TRAFFIC_ID) {
        $remove_status = false;
        $messageStack->add(ERROR_REMOVE_DEFAULT_STOCKS_TRAFFIC, 'error');
      } else {

      }
      break;
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['language_charset']; ?>"> 
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
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
    <td class="boxCenter" width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="80" rowspan="2"><?php echo xtc_image(DIR_WS_ICONS.'boot.png'); ?></td>
    <td class="pageHeading"><?php echo BOX_STOCKS_TRAFFIC; ?></td>
  </tr>
  <tr>
    <td class="main" valign="top">xt:Commerce Configuration</td>
  </tr>
</table></td>
      </tr>
      <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
              <td class="dataTableHeadingContent" width="10%"><?php echo TABLE_HEADING_STOCKS_TRAFFIC; ?></td>
              <td class="dataTableHeadingContent" width="10%"><?php echo TABLE_HEADING_STOCKS_PERCENTAGE; ?></td>
                <td class="dataTableHeadingContent" width="80%%">&nbsp;</td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $stocks_traffic_query_raw = "select * from " . TABLE_STOCKS_TRAFFIC . " where language_id = '" . $_SESSION['languages_id'] . "' order by stocks_traffic_percentage DESC";
  $stocks_traffic_split = new splitPageResults($_GET['page'], '20', $stocks_traffic_query_raw, $stocks_traffic_query_numrows);
  $stocks_traffic_query = xtc_db_query($stocks_traffic_query_raw);
  while ($stocks_traffic = xtc_db_fetch_array($stocks_traffic_query)) {
    if (((!$_GET['oID']) || ($_GET['oID'] == $stocks_traffic['stocks_traffic_id'])) && (!$oInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
      $oInfo = new objectInfo($stocks_traffic);
    }

    if ( (is_object($oInfo)) && ($stocks_traffic['stocks_traffic_id'] == $oInfo->stocks_traffic_id) ) {
      echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $oInfo->stocks_traffic_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $stocks_traffic['stocks_traffic_id']) . '\'">' . "\n";
    }



      			echo '<td class="dataTableContent" align="left">';
                       if ($stocks_traffic['stocks_traffic_image'] != '') {
                           echo xtc_image(DIR_WS_ICONS . $stocks_traffic['stocks_traffic_image'] , IMAGE_ICON_INFO);
                           }
                           echo '</td>';
      echo '<td class="dataTableContent">' . round($stocks_traffic['stocks_traffic_percentage'],2) . '%</td>' . "\n";
      echo '<td class="dataTableContent">' . $stocks_traffic['stocks_traffic_name'] . '</td>' . "\n";
    
?>
                <td class="dataTableContent" align="right"><?php if ( (is_object($oInfo)) && ($stocks_traffic['stocks_traffic_id'] == $oInfo->stocks_traffic_id) ) { echo xtc_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $stocks_traffic['stocks_traffic_id']) . '">' . xtc_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $stocks_traffic_split->display_count($stocks_traffic_query_numrows, '20', $_GET['page'], TEXT_DISPLAY_NUMBER_OF_STOCKS_TRAFFIC); ?></td>
                    <td class="smallText" align="right"><?php echo $stocks_traffic_split->display_links($stocks_traffic_query_numrows, '20', MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (substr($_GET['action'], 0, 3) != 'new') {
?>
                  <tr>
                    <td colspan="3" align="right"><?php echo '<a class="button" onClick="this.blur();" href="' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&action=new') . '">' . BUTTON_INSERT . '</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_STOCKS_TRAFFIC . '</b>');

      $contents = array('form' => xtc_draw_form('status', FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&action=insert', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);

      $stocks_traffic_inputs_string = '';
      $languages = xtc_get_languages();
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $stocks_traffic_inputs_string .= '<br />' . xtc_image(DIR_WS_LANGUAGES.$languages[$i]['directory'].'/admin/images/'.$languages[$i]['image']) . '&nbsp;' . xtc_draw_input_field('stocks_traffic_name[' . $languages[$i]['id'] . ']');
      }
      $contents[] = array('text' => '<br />' . TEXT_INFO_STOCKS_TRAFFIC_IMAGE . '<br />' . xtc_draw_file_field('stocks_traffic_image'));
      $contents[] = array('text' => TABLE_HEADING_STOCKS_PERCENTAGE.'<br />' .xtc_draw_input_field('stocks_traffic_percentage'));
      $contents[] = array('text' => '<br />' . TABLE_HEADING_STOCKS_TRAFFIC . $stocks_traffic_inputs_string);
      $contents[] = array('align' => 'center', 'text' => '<br /><input type="submit" class="button" onClick="this.blur();" value="' . BUTTON_INSERT . '"/> <a class="button" onClick="this.blur();" href="' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page']) . '">' . BUTTON_CANCEL . '</a>');
      break;

    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_STOCKS_TRAFFIC . '</b>');

      $contents = array('form' => xtc_draw_form('status', FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $oInfo->stocks_traffic_id  . '&action=save', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);

      $stocks_traffic_inputs_string = '';
      $languages = xtc_get_languages();
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $stocks_traffic_inputs_string .= '<br />' . xtc_image(DIR_WS_LANGUAGES.$languages[$i]['directory'].'/admin/images/'.$languages[$i]['image']) . '&nbsp;' . xtc_draw_input_field('stocks_traffic_name[' . $languages[$i]['id'] . ']', xtc_get_stocks_traffic_name($oInfo->stocks_traffic_id, $languages[$i]['id']));
      }
      $contents[] = array('text' => '<br />' . TABLE_HEADING_STOCKS_TRAFFIC . '<br />' . xtc_draw_file_field('stocks_traffic_image',$oInfo->stocks_traffic_image));
      $contents[] = array('text' => TABLE_HEADING_STOCKS_PERCENTAGE.'<br />' .xtc_draw_input_field('stocks_traffic_percentage',$oInfo->stocks_traffic_percentage));
      $contents[] = array('text' => '<br />' . TEXT_INFO_STOCKS_TRAFFIC_NAME . $stocks_traffic_inputs_string);
      $contents[] = array('align' => 'center', 'text' => '<br /><input type="submit" class="button" onClick="this.blur();" value="' . BUTTON_UPDATE . '"/> <a class="button" onClick="this.blur();" href="' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $oInfo->stocks_traffic_id) . '">' . BUTTON_CANCEL . '</a>');
      break;

    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_STOCKS_TRAFFIC . '</b>');

      $contents = array('form' => xtc_draw_form('status', FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $oInfo->stocks_traffic_id  . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $oInfo->stocks_traffic_name . '</b>');
      if ($remove_status) $contents[] = array('align' => 'center', 'text' => '<br /><input type="submit" class="button" onClick="this.blur();" value="' . BUTTON_DELETE . '"/> <a class="button" onClick="this.blur();" href="' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $oInfo->stocks_traffic_id) . '">' . BUTTON_CANCEL . '</a>');
      break;

    default:
      if (is_object($oInfo)) {
        $heading[] = array('text' => '<b>' . $oInfo->stocks_traffic_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a class="button" onClick="this.blur();" href="' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $oInfo->stocks_traffic_id . '&action=edit') . '">' . BUTTON_EDIT . '</a> <a class="button" onClick="this.blur();" href="' . xtc_href_link(FILENAME_STOCKS_TRAFFIC, 'page=' . $_GET['page'] . '&oID=' . $oInfo->stocks_traffic_id . '&action=delete') . '">' . BUTTON_DELETE . '</a>');

        $stocks_traffic_inputs_string = '';
        $languages = xtc_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $stocks_traffic_inputs_string .= '<br />' . xtc_image(DIR_WS_LANGUAGES.$languages[$i]['directory'].'/admin/images/'.$languages[$i]['image']) . '&nbsp;' . xtc_get_stocks_traffic_name($oInfo->stocks_traffic_id, $languages[$i]['id']);
        }

        $contents[] = array('text' => $stocks_traffic_inputs_string);
      }
      break;
  }

  if ( (xtc_not_null($heading)) && (xtc_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>