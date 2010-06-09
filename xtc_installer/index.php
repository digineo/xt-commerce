<?php
  /* --------------------------------------------------------------
   $Id: index.php 272 2007-03-21 16:38:37Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (index.php,v 1.18 2003/08/17); www.nextcommerce.org
   
   Released under the GNU General Public License 
   --------------------------------------------------------------*/
   
  require('includes/application.php');

  // include needed functions
  require_once(DIR_FS_INC.'xtc_image.inc.php');
  require_once(DIR_FS_INC.'xtc_draw_separator.inc.php');
  require_once(DIR_FS_INC.'xtc_redirect.inc.php');
  require_once(DIR_FS_INC.'xtc_href_link.inc.php');
  
  include('language/german.php');


 define('HTTP_SERVER','');
 define('HTTPS_SERVER','');
 define('DIR_WS_CATALOG','');

   $messageStack = new messageStack();

    $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    $process = true;

        
        $_SESSION['language'] = xtc_db_prepare_input($_POST['LANGUAGE']);

    $error = false;


      if ( ($_SESSION['language'] != 'german') && ($_SESSION['language'] != 'english') ) {
        $error = true;

        $messageStack->add('index', SELECT_LANGUAGE_ERROR);
        }
        

                    if ($error == false) {
                        xtc_redirect(xtc_href_link('install_step1.php', '', 'NONSSL'));
                }
        }


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
<div class="boxbody"><ul class="contentlist">
<li><?php echo xtc_image('images/icon_arrow.gif').BOX_LANGUAGE; ?></li>
</ul>
</div>

<!-- body_text //-->
    <td class="boxCenter" width="550" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">

<tr>
<td>



      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td class="main"><img src="images/title_index.gif" border="0"><br />
            <table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><br />                  <table width="100%"  border="0" cellpadding="2" cellspacing="2" style="border: 1px solid; border-color: #4CC534;" bgcolor="#C2FFB6">
                  <tr>
                    <td width="1"><img src="images/install.gif" border="0"></td>
                    <td class="main"><a href="http://www.xt-commerce.com/forum/showthread.php?t=35187" target="_blank">Installationsanleitung auf www.xt-commerce.com</a></td>
                  </tr>
                  <tr>
                    <td width="1"><img src="images/install.gif" border="0"></td>
                    <td class="main"><a href="http://www.xtcommerce-shop.com/product_info.php?products_id=1&utm_source=installer&utm_medium=link" target="_blank">xt:Commerce Support</a></td>
                  </tr>
                </table></td>
              </tr>
            </table>
            <br /><br /><?php echo TEXT_WELCOME_INDEX; ?><br />
            <br /></td>
        </tr>
        <tr>
<?php
  // permission check to prevent DAU faults.
 $error_flag=false;
 $message='';
 $ok_message='';

 // config files
 if (!is_writeable(DIR_FS_CATALOG . 'includes/configure.php')) {
    $error_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'includes/configure.php<br />';
 }
  if (!is_writeable(DIR_FS_CATALOG . 'includes/configure.org.php')) {
    $error_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'includes/configure.org.php<br />';
 }
  if (!is_writeable(DIR_FS_CATALOG . 'admin/includes/configure.php')) {
    $error_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'admin/includes/configure.php<br />';
 }
  if (!is_writeable(DIR_FS_CATALOG . 'admin/includes/configure.org.php')) {
    $error_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'admin/includes/configure.org.php<br />';
 }
 $status='OK';
 if ($error_flag==true) $status='<b><font color="ff0000">ERROR</font></b>';
 $ok_message.='FILE Permissions .............................. '.$status.'<br /><hr noshade>';

 // smarty folders
 $folder_flag==false;
 
    if (!is_writeable(DIR_FS_CATALOG . 'admin/rss/xt-news.cache')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'admin/rss/xt-news.cache<br />';
 }
 
   if (!is_writeable(DIR_FS_CATALOG . 'templates_c/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'templates_c/<br />';
 }
    if (!is_writeable(DIR_FS_CATALOG . 'cache/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'cache/<br />';
 }

     if (!is_writeable(DIR_FS_CATALOG . 'admin/rss/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'admin/rss/<br />';
 }

      if (!is_writeable(DIR_FS_CATALOG . 'admin/images/graphs')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'admin/images/graphs<br />';
 }

    if (!is_writeable(DIR_FS_CATALOG . 'admin/backups/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'admin/backups/<br />';
 }

 // image folders
      if (!is_writeable(DIR_FS_CATALOG . 'images/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'images/<br />';
 }
     if (!is_writeable(DIR_FS_CATALOG . 'images/categories/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'images/categories/<br />';
 }
     if (!is_writeable(DIR_FS_CATALOG . 'images/banner/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'images/banner/<br />';
 }
     if (!is_writeable(DIR_FS_CATALOG . 'images/product_images/info_images/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'images/product_images/info_images/<br />';
 }
     if (!is_writeable(DIR_FS_CATALOG . 'images/product_images/original_images/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'images/product_images/original_images/<br />';
 }
     if (!is_writeable(DIR_FS_CATALOG . 'images/product_images/popup_images/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'images/product_images/popup_images/<br />';
 }
      if (!is_writeable(DIR_FS_CATALOG . 'images/product_images/thumbnail_images/')) {
    $error_flag=true;
    $folder_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'images/product_images/thumbnail_images/<br />';
 }
 
   if (!is_writeable(DIR_FS_CATALOG . 'admin/rss/xt-news.cache')) {
    $error_flag=true;
    $message .= 'WRONG PERMISSION on '.DIR_FS_CATALOG . 'admin/rss/xt-news.cache<br />';
 }

 $status='OK';
 if ($folder_flag==true) $status='<b><font color="ff0000">ERROR</font></b>';
 $ok_message.='FOLDER Permissions .............................. '.$status.'<br /><hr noshade>';

 // check PHP-Version

 $php_flag==false;
 if (xtc_check_version()!=1) {
     $error_flag=true;
     $php_flag=true;
    $message .='<b>ATTENTION!, your PHP Version is to old, xt:Commerce requires atleast PHP 4.1.3.</b><br /><br />
                 Your php Version: <b><?php echo phpversion(); ?></b><br /><br />
                 XT-Commerce wont work on this server, update PHP or change Server.';
 }

 $status='OK';
 if ($php_flag==true) $status='<b><font color="ff0000">ERROR</font></b>';
 $ok_message.='PHP VERSION .............................. '.$status.'<br /><hr noshade>';


 $gd=gd_info();

 if ($gd['GD Version']=='') $gd['GD Version']='<b><font color="ff0000">ERROR NO GDLIB FOUND!</font></b>';

 $status=$gd['GD Version'].' <br />  if GDlib Version < 2+ , klick here for further instructions';

 // display GDlibversion
 $ok_message.='GDlib VERSION .............................. '.$status.'<br /><hr noshade>';

 if ($gd['GIF Read Support']==1 or $gd['GIF Support']==1) {
 $status='OK';
 } else {
 $status='<b><font color="ff0000">ERROR</font></b><br />You don\'t have GIF support within your GDlib, you won\'t be able to use GIF images, and GIF overlayfunctions in XT-Commerce!';
 }
 $ok_message.='GDlib GIF-Support .............................. '.$status.'<br /><hr noshade>';

if ($error_flag==true) {
?>
        <td style="border: 1px solid; border-color: #ff0000;" bgcolor="#FFCCCC">
<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>Attention:<br /></b>
<?php echo $message; ?>
</font>
</td>
<?php } ?>
</tr>
<tr>
<?php
if ($ok_message!='') {
?>
<td height="20"></td></tr><tr>
<td style="border: 1px solid; border-color: #4CC534;" bgcolor="#C2FFB6">
<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>Checking:<br /></b>
<?php echo $ok_message; ?>
</font>
</td>
<?php } ?>
</tr>

      </table>
      <p><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="images/break-el.gif" width="100%" height="1"></font></p>


      <table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td class="main">
            <h2 class="boxheader"><?php echo TITLE_SELECT_LANGUAGE; ?></h2></font></strong><br />
            <img src="images/break-el.gif" width="100%" height="1"><br />
                                                        <?php
  if ($messageStack->size('index') > 0) {
?><br />
<table border="0" cellpadding="0" cellspacing="0" bgcolor="f3f3f3">
            <tr>
              <td><?php echo $messageStack->output('index'); ?></td>
  </tr>
</table>


<?php
  }
?>
            </font> <form name="language" method="post" action="index.php">

              <table width="300" border="0" cellpadding="0" cellspacing="4">
                <tr>
                  <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="images/icons/arrow02.gif" width="13" height="6">Deutsch</font></td>
                  <td><img src="images/icons/icon-deu.gif" width="30" height="16">
                    <?php echo xtc_draw_radio_field_installer('LANGUAGE', 'german'); ?> 
                  </td>
                </tr>
                <tr>
                  <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="images/icons/arrow02.gif" width="13" height="6">English</font></td>
                  <td><img src="images/icons/icon-eng.gif" width="30" height="16">
                    <?php echo xtc_draw_radio_field_installer('LANGUAGE', 'english'); ?> </td>
                </tr>
              </table>

              <input type="hidden" name="action" value="process">
              <p> <?php if ($error_flag==false) { ?><input type="image" src="images/button_continue.gif" border="0" alt="Continue"> <?php } ?><br />
                <br />
              </p>
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