<?php
  /* --------------------------------------------------------------
   $Id: install_step5.php 274 2007-03-22 09:00:34Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (install_step5.php,v 1.25 2003/08/24); www.nextcommerce.org
   (c) 2002-2003 osCommerce www.oscommerce.com
   
   Released under the GNU General Public License 
   --------------------------------------------------------------*/

   require('includes/application.php');
   require_once(DIR_FS_INC.'xtc_draw_separator.inc.php');

   include('language/'.$_SESSION['language'].'.php');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>xt:Commerce Installer - STEP 5 / Write Config Files</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo _CHARSET; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo 'includes/style.css'; ?>" />
</head>
<body>

<div id="header">
		<div id="logo"><?php echo xtc_image('../admin/images/logo_black.jpg', 'xt:Commerce'); ?></div>
		<div id="buttons">
		<?php echo xtc_draw_separator('pixel_trans.gif', 5, 5); ?>
		<?php echo '<a href="http://www.xt-commerce.com/index.php" target="_new" class="headerLink">'. xtc_image( '../admin/images/top_support.gif', '', '', '').'</a>'; ?>
</div>
</div>



<table border="0" width="800" cellspacing="2" cellpadding="2">
  <tr>
    <td class="columnLeft2" width="250" valign="top">
<!-- left_navigation //-->

<h2 class="boxheader">xt:Commerce Installation</h2>
<div class="boxbody">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="10">&nbsp;</td>
                <td width="135" class="smallText"><img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_LANGUAGE; ?></td>
                <td width="35"><img src="images/icons/ok.gif"></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="smallText"><img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_DB_CONNECTION; ?></td>
                <td><img src="images/icons/ok.gif"></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="smallText">
                  &nbsp;&nbsp;&nbsp;<img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_DB_IMPORT; ?></td>
                <td><img src="images/icons/ok.gif"></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="smallText"><img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_WEBSERVER_SETTINGS; ?></td>
                <td><img src="images/icons/ok.gif"></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="smallText">&nbsp;&nbsp;&nbsp;<img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_WRITE_CONFIG; ?></td>
                <td>&nbsp;</td>
              </tr>
            </table>
</div>

<!-- body_text //-->
    <td class="boxCenter" width="550" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">

<tr>
<td>



      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td class="main"><img src="images/title_index.gif" border="0"><br />



     <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td class="main">
            <br />
            <?php echo TEXT_WELCOME_STEP5; ?></font></td>
        </tr>
      </table>

      <table width="98%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class"main">
  
  
<table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td><h2 class="boxheader"><?php echo TITLE_WEBSERVER_CONFIGURATION; ?></h2></td>
                <td>&nbsp;</td>
              </tr>
            </table>

<?php
    reset($_POST);
    while (list($key, $value) = each($_POST)) {
      if ($key != 'x' && $key != 'y') {
        if (is_array($value)) {
          for ($i=0; $i<sizeof($value); $i++) {
            echo xtc_draw_hidden_field_installer($key . '[]', $value[$i]);
          }
        } else {
          echo xtc_draw_hidden_field_installer($key, $value);
        }
      }
    }
   
   // paths
   
   $dir_fs_document_root = $_POST['DIR_FS_WWW_ROOT'];
  if ((substr($dir_fs_document_root, -1) != '\\') && (substr($dir_fs_document_root, -1) != '/')) {
    if (strrpos($dir_fs_document_root, '\\') !== false) {
      $dir_fs_document_root .= '\\';
    } else {
      $dir_fs_document_root .= '/';
    }
  }

  $http_url = parse_url($_POST['WWW_ADDRESS']);
  $http_server = $http_url['scheme'] . '://' . $http_url['host'];
  $http_catalog = $http_url['path'];
  if (isset($http_url['port']) && !empty($http_url['port'])) {
    $http_server .= ':' . $http_url['port'];
  }

  if (substr($http_catalog, -1) != '/') {
    $http_catalog .= '/';
  }
   
   
    $file_contents = '<?php' . "\n" .
                     '/* --------------------------------------------------------------' . "\n" .
                     '' . "\n" .
                     '  xt:Commerce - community made shopping' . "\n" .
                     '  http://www.xt-commerce.com' . "\n" .
                     '' . "\n" .
                     '   Copyright (c) 2007 xt:Commerce' . "\n" .
                     '  --------------------------------------------------------------' . "\n" .
                     '  based on:' . "\n" . 
                     '  (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)' . "\n" . 
                     '  (c) 2002-2003 osCommerce (configure.php,v 1.13 2003/02/10); www.oscommerce.com' . "\n" . 
                     '' . "\n" .
                     '  Released under the GNU General Public License' . "\n" . 
                     '  --------------------------------------------------------------*/' . "\n" .
                     '' . "\n" .
                     '// Define the webserver and path parameters' . "\n" .
                     '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                     '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                     '  define(\'HTTP_SERVER\', \'' . $http_server . '\'); // eg, http://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'HTTPS_SERVER\', \'' . $http_server . '\'); // eg, https://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'ENABLE_SSL\', ' .  'false' . '); // secure webserver for checkout procedure?' . "\n" .
                     '  define(\'DIR_WS_CATALOG\', \'' . $http_catalog . '\'); // absolute path required' . "\n" .
                     '  define(\'DIR_FS_DOCUMENT_ROOT\', \'' . $dir_fs_document_root  . '\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root  . '\');' . "\n" .
                     '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                     '  define(\'DIR_WS_ORIGINAL_IMAGES\', DIR_WS_IMAGES .\'product_images/original_images/\');' . "\n" .
                     '  define(\'DIR_WS_THUMBNAIL_IMAGES\', DIR_WS_IMAGES .\'product_images/thumbnail_images/\');' . "\n" .
                     '  define(\'DIR_WS_INFO_IMAGES\', DIR_WS_IMAGES .\'product_images/info_images/\');' . "\n" .
                     '  define(\'DIR_WS_POPUP_IMAGES\', DIR_WS_IMAGES .\'product_images/popup_images/\');' . "\n" .
                     '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                     '  define(\'DIR_WS_INCLUDES\',DIR_FS_DOCUMENT_ROOT. \'includes/\');' . "\n" .
                     '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                     '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                     '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                     '  define(\'DIR_WS_LANGUAGES\', DIR_FS_CATALOG . \'lang/\');' . "\n" .
                     '' . "\n" .
                     '  define(\'DIR_WS_DOWNLOAD_PUBLIC\', DIR_WS_CATALOG . \'pub/\');' . "\n" .
                     '  define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');' . "\n" .
                     '  define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');' . "\n" .
                     '  define(\'DIR_FS_INC\', DIR_FS_CATALOG . \'inc/\');' . "\n" .
                     '' . "\n" .
                     '// define our database connection' . "\n" .
                     '  define(\'DB_SERVER\', \'' . $_POST['DB_SERVER'] . '\'); // eg, localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'DB_SERVER_USERNAME\', \'' . $_POST['DB_SERVER_USERNAME'] . '\');' . "\n" .
                     '  define(\'DB_SERVER_PASSWORD\', \'' . $_POST['DB_SERVER_PASSWORD']. '\');' . "\n" .
                     '  define(\'DB_DATABASE\', \'' . $_POST['DB_DATABASE']. '\');' . "\n" .
                     '  define(\'USE_PCONNECT\', \'' . (($_POST['USE_PCONNECT'] == 'true') ? 'true' : 'false') . '\'); // use persistent connections?' . "\n" .
                     '  define(\'STORE_SESSIONS\', \'' . (($_POST['STORE_SESSIONS'] == 'files') ? '' : 'mysql') . '\'); // leave empty \'\' for default handler or set to \'mysql\'' . "\n" .                     '?>';
    $fp = fopen(DIR_FS_CATALOG . 'includes/configure.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);

    $fp = fopen(DIR_FS_CATALOG . 'includes/configure.org.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);
    
//create a configure.php
    $file_contents = '<?php' . "\n" .
                     '/* --------------------------------------------------------------' . "\n" .
                     '' . "\n" .
                     '  XT-Commerce - community made shopping' . "\n" .
                     '  http://www.xt-commerce.com' . "\n" .
                     '' . "\n" .
                     '   Copyright (c) 2003 XT-Commerce' . "\n" .
                     '  --------------------------------------------------------------' . "\n" .
                     '  based on:' . "\n" . 
                     '  (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   
  
' . "\n" . 
                     '  (c) 2002-2003 osCommerce (configure.php,v 1.14 2003/02/21); www.oscommerce.com' . "\n" . 
                     '' . "\n" .
                     '  Released under the GNU General Public License' . "\n" . 
                     '  --------------------------------------------------------------*/' . "\n" .
                     '' . "\n" .
                     '// Define the webserver and path parameters' . "\n" .
                     '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                     '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                     '  define(\'HTTP_SERVER\', \'' . $http_server . '\'); // eg, http://localhost or - https://localhost should not be empty for productive servers' . "\n" .
                     '  define(\'HTTP_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                     '  define(\'HTTPS_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                     '  define(\'ENABLE_SSL_CATALOG\', \'false\'); // secure webserver for catalog module' . "\n" .
                     '  define(\'DIR_FS_DOCUMENT_ROOT\', \'' . $dir_fs_document_root  . '\'); // where the pages are located on the server' . "\n" .
                     '  define(\'DIR_WS_ADMIN\', \'' . $http_catalog .'admin/' . '\'); // absolute path required' . "\n" .
                     '  define(\'DIR_FS_ADMIN\', \'' . $dir_fs_document_root .'admin/' . '\'); // absolute pate required' . "\n" .
                     '  define(\'DIR_WS_CATALOG\', \'' . $http_catalog . '\'); // absolute path required' . "\n" .
                     '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root  . '\'); // absolute path required' . "\n" .
                     '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_IMAGES\', DIR_FS_CATALOG . \'images/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_ORIGINAL_IMAGES\', DIR_FS_CATALOG_IMAGES .\'product_images/original_images/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_THUMBNAIL_IMAGES\', DIR_FS_CATALOG_IMAGES .\'product_images/thumbnail_images/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_INFO_IMAGES\', DIR_FS_CATALOG_IMAGES .\'product_images/info_images/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_POPUP_IMAGES\', DIR_FS_CATALOG_IMAGES .\'product_images/popup_images/\');' . "\n" .
                     '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_IMAGES\', DIR_WS_CATALOG . \'images/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_ORIGINAL_IMAGES\', DIR_WS_CATALOG_IMAGES .\'product_images/original_images/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_THUMBNAIL_IMAGES\', DIR_WS_CATALOG_IMAGES .\'product_images/thumbnail_images/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_INFO_IMAGES\', DIR_WS_CATALOG_IMAGES .\'product_images/info_images/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_POPUP_IMAGES\', DIR_WS_CATALOG_IMAGES .\'product_images/popup_images/\');' . "\n" .
                     '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                     '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                     '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                     '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                     '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                     '  define(\'DIR_WS_LANGUAGES\', DIR_WS_CATALOG. \'lang/\');' . "\n" .
                     '  define(\'DIR_FS_LANGUAGES\', DIR_FS_CATALOG. \'lang/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_MODULES\', DIR_FS_CATALOG . \'includes/modules/\');' . "\n" .
                     '  define(\'DIR_FS_BACKUP\', DIR_FS_ADMIN . \'backups/\');' . "\n" .
                     '  define(\'DIR_FS_INC\', DIR_FS_CATALOG . \'inc/\');' . "\n" .
                     '  define(\'DIR_WS_FILEMANAGER\', DIR_WS_MODULES . \'fckeditor/editor/filemanager/browser/default/\');' . "\n" .
                     '' . "\n" .
                     '// define our database connection' . "\n" .
                     '  define(\'DB_SERVER\', \'' . $_POST['DB_SERVER'] . '\'); // eg, localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'DB_SERVER_USERNAME\', \'' . $_POST['DB_SERVER_USERNAME'] . '\');' . "\n" .
                     '  define(\'DB_SERVER_PASSWORD\', \'' . $_POST['DB_SERVER_PASSWORD']. '\');' . "\n" .
                     '  define(\'DB_DATABASE\', \'' . $_POST['DB_DATABASE']. '\');' . "\n" .
                     '  define(\'USE_PCONNECT\', \'' . (($_POST['USE_PCONNECT'] == 'true') ? 'true' : 'false') . '\'); // use persisstent connections?' . "\n" .
                     '  define(\'STORE_SESSIONS\', \'' . (($_POST['STORE_SESSIONS'] == 'files') ? '' : 'mysql') . '\'); // leave empty \'\' for default handler or set to \'mysql\'' . "\n" .
                     '' . "\n" .
 '?>';
    $fp = fopen(DIR_FS_CATALOG . 'admin/includes/configure.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);
    
    $fp = fopen(DIR_FS_CATALOG . 'admin/includes/configure.org.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);

?>
<center>
<br />
<div class="main">
            <?php echo TEXT_WS_CONFIGURATION_SUCCESS; ?></div></center>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="center"><a href="install_step6.php"><img src="images/button_continue.gif" width="77" height="23" border="0"></a></td>
              </tr>
            </table>
</form>

  
  </td>
        </tr>
      </table>
      
    </td>
  </tr>
</table>
      
      
      
      
      </td>
</tr>
    </table></td>
  </tr>
  <tr>
  <td>
  </td>
  <td>
<table border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="center" class="smallText"><?php
/*
  The following copyright announcement is in compliance
  to section 2c of the GNU General Public License, and
  thus can not be removed, or can only be modified
  appropriately.

  Please leave this comment intact together with the
  following copyright announcement.

*/
?>eCommerce Engine Copyright &copy; 2004-2007 <a href="http://www.xt-commerce.com" target="_blank">xt:Commerce GbR</a><br>
xt:Commerce provides no warranty and is redistributable under the <a href="http://www.fsf.org/licenses/gpl.txt" target="_blank">GNU General Public License</a></td>
  </tr>
  <tr>
    <td><?php echo xtc_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5'); ?></td>
  </tr>
  <tr>
    <td align="center" class="smallText">Powered by <a href="http://www.xt-commerce.com" target="_blank">xt:Commerce eCommerce Engine</a></td>
  </tr>
</table>
  </td>
  </tr>
</table>
</body>
</html>