<?php
/* --------------------------------------------------------------
   $Id: install_step1.php 276 2007-03-22 09:16:03Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(install.php,v 1.7 2002/08/14); www.oscommerce.com 
   (c) 2003	 nextcommerce (install_step1.php,v 1.10 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/
  
  require('includes/application.php');

  include('language/'.$_SESSION['language'].'.php');
  require_once(DIR_FS_INC.'xtc_image.inc.php');
  require_once(DIR_FS_INC.'xtc_draw_separator.inc.php');
  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>xt:Commerce Installer - Welcome</title>
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
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="smallText"><img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_WEBSERVER_SETTINGS; ?></td>
                <td>&nbsp;</td>
              </tr>
            </table>
</div>

<!-- left_navigation_eof //-->
    </td>
<!-- body_text //-->
    <td class="boxCenter" width="550" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">

<tr>
<td>



      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td class="main"><img src="images/title_index.gif" border="0"><br />

			<br />
    		<?php echo TEXT_WELCOME_STEP1; ?>


      <p><img src="images/break-el.gif" width="100%" height="1"></p>

      <form name="install" method="post" action="install_step2.php">
            <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tr>
    <td class="main"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                  <td><h2 class="boxheader"><?php echo TITLE_CUSTOM_SETTINGS; ?></h2></td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              <p><?php echo xtc_draw_checkbox_field_installer('install[]', 'database', true); ?>
                <b><?php echo TEXT_IMPORT_DB; ?></b><br />
                <?php echo TEXT_IMPORT_DB_LONG; ?></p>
              <p><?php echo xtc_draw_checkbox_field_installer('install[]', 'configure', true); ?> 
                <b><?php echo TEXT_AUTOMATIC; ?></b><br />
                <?php echo TEXT_AUTOMATIC_LONG; ?></p>

</td>
  </tr>
</table>
        <br />
        <img src="images/break-el.gif" width="100%" height="1">
                <br />
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td class="main">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><h2 class="boxheader"><?php echo TITLE_DATABASE_SETTINGS; ?></h2></td>
                  <td>&nbsp;</td>
                </tr>
              </table>

              <p><b><?php echo TEXT_DATABASE_SERVER; ?></b><br />
                <?php echo xtc_draw_input_field_installer('DB_SERVER'); ?><br />
                <?php echo TEXT_DATABASE_SERVER_LONG; ?></p>
              <p><b><?php echo TEXT_USERNAME; ?></b><br />
                <?php echo xtc_draw_input_field_installer('DB_SERVER_USERNAME'); ?><br />
                <?php echo TEXT_USERNAME_LONG; ?></p>
              <p><b><?php echo TEXT_PASSWORD; ?></b><br />
                <?php echo xtc_draw_input_field_installer('DB_SERVER_PASSWORD'); ?><br />
                <?php echo TEXT_PASSWORD_LONG; ?></p>
              <p><b><?php echo TEXT_DATABASE; ?></b><br />
                <?php echo xtc_draw_input_field_installer('DB_DATABASE'); ?><br />
                <?php echo TEXT_DATABASE_LONG; ?></p></td>
          </tr>
        </table>
                <br />
                <img src="images/break-el.gif" width="100%" height="1">
                <br />
                <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td class="main"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                  <td><h2 class="boxheader"><?php echo TITLE_WEBSERVER_SETTINGS; ?> </h2></td>
                  <td>&nbsp;</td>
                </tr>
              </table> 
                 <p><b>WWW Address</b><br />
                <?php echo xtc_draw_input_field_installer('WWW_ADDRESS', $_www_location,'','size=60'); ?><br />
                </p>
                <p><b><?php echo TEXT_WS_ROOT; ?></b><br />
                <?php echo xtc_draw_input_field_installer('DIR_FS_WWW_ROOT', $_dir_fs_www_root,'','size=60'); ?><br />
                <?php echo TEXT_WS_ROOT_LONG; ?></p>
                 </td>
          </tr>
        </table>
<br />
<img src="images/break-el.gif" width="100%" height="1">
<br />
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancel"></a></td>
    <td align="center"><input type="image" src="images/button_continue.gif" border="0" alt="Continue"></td>
  </tr>
</table>
</form>
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