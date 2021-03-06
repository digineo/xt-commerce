<?php
  /* --------------------------------------------------------------
   $Id: install_finished.php 272 2007-03-21 16:38:37Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (install_finished.php,v 1.5 2003/08/17); www.nextcommerce.org
   
   Released under the GNU General Public License 
   --------------------------------------------------------------*/
  
  require('includes/application.php');
  require('../includes/configure.php'); 
  require_once(DIR_FS_INC.'xtc_draw_separator.inc.php');
 
  
  include('language/'.$_SESSION['language'].'.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>xt:Commerce Installer - Finished</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo _CHARSET; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo 'includes/style.css'; ?>" />
</head>
<body>
<img src='http://www.xt-commerce.com/_banner/adview.php?what=zone:25&amp;n=abc96f12' border='0' alt=''>
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
                <td><img src="images/icons/ok.gif"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="smallText"><img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_ADMIN_CONFIG; ?></td>
                <td><img src="images/icons/ok.gif"></td>
              </tr>
            </table>
</div>

<!-- body_text //-->
    <td class="boxCenter" width="550" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">

<tr>
<td>



      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="images/title_index.gif" border="0"><br />

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td class="main">
            <br />
            <?php echo TEXT_WELCOME_FINISHED; ?></font></td>
        </tr>
      </table>

      <p><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="images/break-el.gif" width="100%" height="1"></font></p>

      <table width="98%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td><h2 class="boxheader"><?php echo TITLE_SHOP_CONFIG; ?></td>
                <td>&nbsp;</td>
              </tr>
            </table>
                        
                        <p>&nbsp;</p>
            <p align="center"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><img src="images/logo.gif" width="185" height="95"><br />
              </strong></font><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo TEXT_SHOP_CONFIG_SUCCESS; ?><br />
              <br />
              <?php echo TEXT_TEAM; ?><br />
              </font></p>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="center"><a href="<?php echo '../index.php'; ?>" target="_blank"><img src="images/button_catalog.gif" border="0" alt="Catalog"></a></td>
                
              </tr>
            </table>
            <p align="center"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br />
              </font></p></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p><font size="1" face="Verdana, Arial, Helvetica, sans-serif"></font></p>
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