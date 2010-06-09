<?php
/* --------------------------------------------------------------
   $Id: csv_backend.php 281 2007-03-23 01:15:32Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommercecoding standards (a typical file) www.oscommerce.com

   Released under the GNU General Public License
   --------------------------------------------------------------*/

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'import.php');
  require(DIR_WS_CLASSES . 'class.export.php');

  $export = new export();
  require_once(DIR_FS_INC . 'xtc_format_filesize.inc.php');

  define('FILENAME_CSV_BACKEND','csv_backend.php');

  switch ($_GET['action']) {

      case 'upload':
        $upload_file=xtc_db_input($_POST['file_upload']);
        if ($upload_file = &xtc_try_upload('file_upload',DIR_FS_CATALOG.'import/')) {
            $$upload_file_name=$upload_file->filename;
        }
      break;

      case 'import':
           $handler = new xtcImport($_POST['select_file']);
           $mapping=$handler->map_file($handler->generate_map());
           $import=$handler->import($mapping);
      break;

      case 'export':
      
      	$export->start($_POST['selected_export']);
      	if ($_POST['export']=='yes') $export->sendFile($_POST['selected_export']);
            
      break;

      case 'save':


		  $configuration_query = xtc_db_query("select configuration_key,configuration_id, configuration_value, use_function,set_function from " . TABLE_CONFIGURATION . " where configuration_group_id = '20' order by sort_order");
          while ($configuration = xtc_db_fetch_array($configuration_query))
              xtc_db_query("UPDATE ".TABLE_CONFIGURATION." SET configuration_value='".$_POST[$configuration['configuration_key']]."' where configuration_key='".$configuration['configuration_key']."'");
		
               xtc_redirect(FILENAME_CSV_BACKEND);
        break;
  }



  $cfg_group_query = xtc_db_query("select configuration_group_title from " . TABLE_CONFIGURATION_GROUP . " where configuration_group_id = '20'");
  $cfg_group = xtc_db_fetch_array($cfg_group_query);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['language_charset']; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript" src="includes/general.js"></script>

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
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="80" rowspan="2"><?php echo xtc_image(DIR_WS_ICONS.'update.png'); ?></td>
    <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
  </tr>
  <tr>
    <td class="main" valign="top">xt:Commerce Tools</td>
  </tr>
</table></td>
      </tr>
      <tr>
        <td class="main">
        <table width="100%">
            <tr class="dataTableHeadingRow">
                <td width="150" align="center">
                <a class="button" href="#" onClick="toggleBox('config');"><?php echo CSV_SETUP; ?></a>
                </td>
                <td width="1">|
                </td>
                <td>
                </td>
            </tr>
        </table>
<div id="config" class="longDescription">
<?php echo xtc_draw_form('configuration', FILENAME_CSV_BACKEND, 'gID=20&action=save'); ?>
            <table width="100%"  border="0" cellspacing="0" cellpadding="4">
<?php
  $configuration_query = xtc_db_query("select configuration_key,configuration_id, configuration_value, use_function,set_function from " . TABLE_CONFIGURATION . " where configuration_group_id = '20' order by sort_order");

  while ($configuration = xtc_db_fetch_array($configuration_query)) {
    if (xtc_not_null($configuration['use_function'])) {
      $use_function = $configuration['use_function'];
      if (ereg('->', $use_function)) {
        $class_method = explode('->', $use_function);
        if (!is_object(${$class_method[0]})) {
          include(DIR_WS_CLASSES . $class_method[0] . '.php');
          ${$class_method[0]} = new $class_method[0]();
        }
        $cfgValue = xtc_call_function($class_method[1], $configuration['configuration_value'], ${$class_method[0]});
      } else {
        $cfgValue = xtc_call_function($use_function, $configuration['configuration_value']);
      }
    } else {
      $cfgValue = $configuration['configuration_value'];
    }

    if (((!$_GET['cID']) || (@$_GET['cID'] == $configuration['configuration_id'])) && (!$cInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
      $cfg_extra_query = xtc_db_query("select configuration_key,configuration_value, date_added, last_modified, use_function, set_function from " . TABLE_CONFIGURATION . " where configuration_id = '" . $configuration['configuration_id'] . "'");
      $cfg_extra = xtc_db_fetch_array($cfg_extra_query);
      
      $cInfo_array = xtc_array_merge($configuration, $cfg_extra);
      $cInfo = new objectInfo($cInfo_array);
    }
    if ($configuration['set_function']) {
        eval('$value_field = ' . $configuration['set_function'] . '"' . htmlspecialchars($configuration['configuration_value']) . '");');
      } else {
        $value_field = xtc_draw_input_field($configuration['configuration_key'], $configuration['configuration_value'],'size=40');
      }
   // add

   if (strstr($value_field,'configuration_value')) $value_field=str_replace('configuration_value',$configuration['configuration_key'],$value_field);

   echo '
  <tr>
    <td width="300" valign="top" class="dataTableContent"><b>'.constant(strtoupper($configuration['configuration_key'].'_TITLE')).'</b></td>
    <td valign="top" class="dataTableContent">
    <table width="100%"  border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td style="background-color:#FCF2CF ; border: 1px solid; border-color: #CCCCCC;" class="dataTableContent">'.$value_field.'</td>
      </tr>
    </table>
    <br />'.constant(strtoupper( $configuration['configuration_key'].'_DESC')).'</td>
  </tr>
  ';

  }
?>
            </table>
<?php echo '<input type="submit" class="button" onClick="this.blur();" value="' . BUTTON_SAVE . '"/>'; ?></form>
</div>
<?php

if ($_POST['selected_export']!='') echo ($export->showStats($_POST['selected_export']));

?>
<table width="100%"  border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td class="pageHeading">IMPORT</td>
  </tr>
  <tr>
    <td class="boxCenter"><?php echo TEXT_IMPORT; ?>
      <table width="100%"  border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td class="dataTableHeadingContent"><?php echo UPLOAD; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
<?php
echo xtc_draw_form('upload',FILENAME_CSV_BACKEND,'action=upload','POST','enctype="multipart/form-data"');
echo xtc_draw_file_field('file_upload');
echo '<br/><input type="submit" class="button" onClick="this.blur();" value="' . BUTTON_UPLOAD . '"/>';
?>
</form>
          </td>
        </tr>
        <tr>
          <td></td>
          <td  class="dataTableHeadingContent"><?php echo SELECT; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          <?php
          $files=array();
          echo xtc_draw_form('import',FILENAME_CSV_BACKEND,'action=import','POST','enctype="multipart/form-data"');
             if ($dir= opendir(DIR_FS_CATALOG.'import/')){
             while  (($file = readdir($dir)) !==false) {
                if (is_file(DIR_FS_CATALOG.'import/'.$file) and ($file !=".htaccess") and ($file !="index.html"))
                {
                    $size=filesize(DIR_FS_CATALOG.'import/'.$file);
                    $files[]=array(
                        'id' => $file,
                        'text' => $file.' | '.xtc_format_filesize($size));
                }
             }
             closedir($dir);
            }
            if (count($files)==0) $files[]=array('id'=>'1','text'=>'-- no File --');
          echo xtc_draw_pull_down_menu('select_file',$files,'');
          echo '<br/><input type="submit" class="button" onClick="this.blur();" value="' . BUTTON_IMPORT . '"/>';

          ?></form>
</td>
        </tr>
      </table>      <p>&nbsp; </p></td>
  </tr>
</table>


<table width="100%"  border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td class="pageHeading">Export</td>
  </tr>
  <tr>
    <td class="boxCenter">
      <table width="100%"  border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td class="main">
<?php

echo xtc_draw_form('export_select',FILENAME_CSV_BACKEND,'action=select','get');
echo TEXT_EXPORT.' '.$export->dropDown().'</form>';

echo xtc_draw_form('export',FILENAME_CSV_BACKEND,'action=export','POST','enctype="multipart/form-data"');

if (isset($_GET['select_export']) && $_GET['select_export']!='') {
echo $export->selection($_GET['select_export']);
echo 'Version: '.$export->getVersion($_GET['select_export']);	
}

echo EXPORT_TYPE.'<br>'.
xtc_draw_hidden_field('selected_export', $_GET['select_export']).
xtc_draw_radio_field('export', 'no',false).EXPORT_NO.'<br>'.
xtc_draw_radio_field('export', 'yes',true).EXPORT_YES.'<br>';
echo '<br/><input type="submit" class="button" onClick="this.blur();" value="' . BUTTON_EXPORT . '"/>';
?>
</form>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>

</td>
        </tr>
      </table>      <p>&nbsp; </p></td>
  </tr>
</table>

</td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>