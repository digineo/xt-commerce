<?php
/* --------------------------------------------------------------
   $Id: start.php,v 1.5 2004/03/17 16:31:26 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project 
   (c) 2002-2003 osCommerce coding standards (a typical file) www.oscommerce.com
   (c) 2003     nextcommerce (start.php,1.5 2004/03/17); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/

  require('includes/application_top.php');
  require_once 'includes/classes/carp.php';
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['language_charset']; ?>"> 
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<style type="text/css">
.h2 {
  font-family: Trebuchet MS,Palatino,Times New Roman,serif;
  font-size: 13pt;
  font-weight: bold;
}

.h3 {
  font-family: Verdana,Arial,Helvetica,sans-serif;
  font-size: 9pt;
  font-weight: bold;
}
</style> 

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
    <td width="80" rowspan="2"><?php echo xtc_image(DIR_WS_ICONS.'heading_news.gif'); ?></td>
    <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
  </tr>
  <tr>
    <td class="main" valign="top">XTC Central</td>
  </tr>
</table></td>
      </tr>
      <tr>
        <td>
        <?php include(DIR_WS_MODULES.FILENAME_SECURITY_CHECK); ?>
        </td>
      <tr>
      <td style="border: 1px solid; border-color: #ffffff;">
        <table valign="top" width="100%" cellpadding="5" cellspacing="5">
        
<?php
CarpConf('linkdiv', '<div class="main" style="background:#cccccc; padding:5px; font-weight: bold;">');
CarpConf('linkstyle', 'text-decoration:none');
CarpConf('linkclass', 'newslink');
CarpConf('showdesc|showcdesc', 1);
CarpConf('maxitems', 5);
CarpConf('cclass', 'h2');
CarpConf('postitem','');
CarpConf('poweredby','');
CarpShow('http://www.xt-commerce.com/backend.php', 'xt-news.cache');
CarpConfReset();


CarpConf('linkdiv','<div style="background:#cccccc; width:185; padding:2px; border-width:1px; border-style:solid; border-color:#333333;">');
CarpConf('linkstyle','text-decoration:none');
CarpConf('linkclass','h3');
CarpConf('showdesc|showctitle|showcdesc',1);
CarpConf('maxitems',10);
CarpConf('cclass','h2');
CarpConf('postitems','');
CarpConf('poweredby','');
//CarpShow("http://www.xt-commerce.com/modules/xp_syndication/mods/mylinks_rss.php","xt-links.cache");
CarpConfReset();
?>
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
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>