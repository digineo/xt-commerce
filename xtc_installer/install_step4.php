<?php
  /* --------------------------------------------------------------
   $Id: install_step4.php 272 2007-03-21 16:38:37Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(install_4.php,v 1.9 2002/08/19); www.oscommerce.com
   (c) 2003	 nextcommerce (install_step4.php,v 1.14 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/
   require('includes/application.php');
   require_once(DIR_FS_INC.'xtc_draw_separator.inc.php');

   include('language/'.$_SESSION['language'].'.php');
  

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>xt:Commerce Installer - STEP 4 / Webserver Configuration</title>
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
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;<img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_WRITE_CONFIG; ?></font></td>
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
          <td><img src="images/title_index.gif" border="0"><br />



      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td class="main">
            <br />
            <?php echo TEXT_WELCOME_STEP4; ?></font></td>
        </tr>
      </table>



      <table width="98%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="main"><br /><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td><h2 class="boxheader"><?php echo TITLE_WEBSERVER_CONFIGURATION; ?></h2></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?php
  if ( ( (file_exists(DIR_FS_CATALOG . 'includes/configure.php')) && (!is_writeable(DIR_FS_CATALOG . 'includes/configure.php')) ) || ( (file_exists(DIR_FS_CATALOG . 'admin/includes/configure.php')) && (!is_writeable(DIR_FS_CATALOG . 'admin/includes/configure.php')) ) || ( (file_exists(DIR_FS_CATALOG . 'admin/includes/local/configure.php')) && (!is_writeable(DIR_FS_CATALOG . 'admin/includes/local/configure.php')) ) || ( (file_exists(DIR_FS_CATALOG . 'includes/local/configure.php')) && (!is_writeable(DIR_FS_CATALOG . 'includes/local/configure.php')) )) {
?>
            <p><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="images/icons/error.gif" width="16" height="16"> 
              <strong><font color="#FF0000" size="2"><?php echo TITLE_STEP4_ERROR; ?></font></strong></font></p>
            <p>
            <div class="boxMe"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo TEXT_STEP4_ERROR; ?></font>
              <ul class="boxMe">
                <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif">cd <?php echo DIR_FS_CATALOG; ?>admin/includes/</font></li>
                <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif">touch configure.php</font></li>
                <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif">chmod 706 configure.php</font></li>
                <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif">chmod 706 configure.org.php</font></li>
              </ul>
              <ul class="boxMe">
                <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif">cd 
                  <?php echo DIR_FS_CATALOG; ?>includes/</font></li>
                <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif">touch 
                  configure.php</font></li>

                <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif">chmod
                  706 configure.php</font> </li>
                  <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif">chmod 706 configure.org.php</font></li>
              </ul>
            </div>
            <font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp; </font><font size="1">
<p class="noteBox"><font face="Verdana, Arial, Helvetica, sans-serif"><?php echo TEXT_STEP4_ERROR_1; ?></font></p>
            <p class="noteBox"><font face="Verdana, Arial, Helvetica, sans-serif"><?php echo TEXT_STEP4_ERROR_2; ?></font></p>
            </font>
            <form name="install" action="install_step4.php" method="post">
              <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
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
?>
              </font>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr> 
                  <td align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancel"></a></font></td>
                  <td align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <input type="image" src="images/button_retry.gif" border="0" alt="Retry">
                    </font></td>
                </tr>
              </table>
            </form>

            <?php
  } else {
?>
            
            <form name="install" action="install_step5.php" method="post">
              <p><?php echo TEXT_VALUES; ?><br />
                <br />
                includes/configure.php<br />
                includes/configure.org.php<br />
                admin/includes/configure.php<br />
                admin/includes/configure.org.php<br />
              </p>

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
?>

              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                  <td><h2 class="boxheader"><?php echo TITLE_DATABASE_SETTINGS; ?></h2></td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              <p><?php echo xtc_draw_checkbox_field_installer('USE_PCONNECT', 'true'); ?> 
                <b><?php echo TEXT_PERSIST; ?></b><br />
                <?php echo TEXT_PERSIST_LONG; ?></p>
              <p><?php echo xtc_draw_radio_field_installer('STORE_SESSIONS', 'files', false); ?> 
                <b><?php echo TEXT_SESS_FILE; ?></b><br />
                <?php echo xtc_draw_radio_field_installer('STORE_SESSIONS', 'mysql',true); ?> 
                <b><?php echo TEXT_SESS_DB; ?></b><br />
                <?php echo TEXT_SESS_LONG; ?></p>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancel"></a></td>
    <td align="center"><input type="hidden" name="install[]" value="configure"><input type="image" src="images/button_continue.gif" border="0" alt="Continue"></td>
  </tr>
</table>

</form>

<?php
  }
?>             
                  </td>
        </tr>
      </table>    
    <p>&nbsp;</p></td>
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