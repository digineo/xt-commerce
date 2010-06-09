<?php
  /* --------------------------------------------------------------
   $Id: install_step2.php 274 2007-03-22 09:00:34Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(install_2.php,v 1.4 2002/08/12); www.oscommerce.com 
   (c) 2003	 nextcommerce (install_step2.php,v 1.16 2003/08/1); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/

  require('includes/application.php');

  // include needed functions
  require_once(DIR_FS_INC.'xtc_redirect.inc.php');
  require_once(DIR_FS_INC.'xtc_href_link.inc.php');
  require_once(DIR_FS_INC.'xtc_not_null.inc.php');
  require_once(DIR_FS_INC.'xtc_draw_separator.inc.php');

  include('language/'.$_SESSION['language'].'.php');
  

  if (xtc_in_array('database', $_POST['install'])) {
   // do nothin  
  } else {
   xtc_redirect('install_step4.php');
  }
  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>xt:Commerce Installer - STEP 2 / DB Connection</title>
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
                <td>
                <?php                
                // test database connection and write permissions                                            
                if (xtc_in_array('database', $_POST['install'])) {
                                         
                   $db = array();
                   $db['DB_SERVER'] = trim(stripslashes($_POST['DB_SERVER']));
                   $db['DB_SERVER_USERNAME'] = trim(stripslashes($_POST['DB_SERVER_USERNAME']));
                   $db['DB_SERVER_PASSWORD'] = trim(stripslashes($_POST['DB_SERVER_PASSWORD']));
                   $db['DB_DATABASE'] = trim(stripslashes($_POST['DB_DATABASE']));
               
                   $db_error = false;
                   xtc_db_connect_installer($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD']);
               
                   if (!$db_error) {
                     xtc_db_test_create_db_permission($db['DB_DATABASE']);
                   }    
                                  
                   if ($db_error) {
                        echo ('<img src="images/icons/exclamation.png">');        
                       } else {
                        echo ('<img src="images/icons/ok.gif">');
                       }
                }
                
                ?>
                </td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="smallText"> 
                  &nbsp;&nbsp;&nbsp;<img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_DB_IMPORT; ?></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="smallText"><img src="images/icons/arrow02.gif" width="13" height="6"><?php echo BOX_WEBSERVER_SETTINGS; ?></td>
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
            <?php echo TEXT_WELCOME_STEP2; ?></td>
        </tr>
      </table>

      <p><img src="images/break-el.gif" width="100%" height="1"></p>

      <table width="98%" border="0" cellpadding="0" cellspacing="0"> 
      <tr>
    <td class="main"> 
      <?php
  if (xtc_in_array('database', $_POST['install'])) {
    $db = array();
    $db['DB_SERVER'] = trim(stripslashes($_POST['DB_SERVER']));
    $db['DB_SERVER_USERNAME'] = trim(stripslashes($_POST['DB_SERVER_USERNAME']));
    $db['DB_SERVER_PASSWORD'] = trim(stripslashes($_POST['DB_SERVER_PASSWORD']));
    $db['DB_DATABASE'] = trim(stripslashes($_POST['DB_DATABASE']));

    $db_error = false;
    xtc_db_connect_installer($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD']);

    if (!$db_error) {
      xtc_db_test_create_db_permission($db['DB_DATABASE']);
    }

    if ($db_error) {
?>
      <br />
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td><h2 class="boxheader"><?php echo TEXT_CONNECTION_ERROR; ?></h2></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="98%">
<tr><td class="main">
          <p>&nbsp;</p>
          <p><?php echo TEXT_DB_ERROR; ?></p>
          <p class="boxme">
          <table border="0" cellpadding="0" cellspacing="0" bgcolor="f3f3f3">
            <tr>
              <td class="main"><b><?php echo $db_error; ?></b></td>
  </tr>
</table>
          </font></p> 
          <p><?php echo TEXT_DB_ERROR_1; ?></p>
          <p><?php echo TEXT_DB_ERROR_2; ?></p>

<form name="install" action="install_step1.php" method="post">

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

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancel"></a></td>
    <td align="center"><input type="image" src="images/button_back.gif" border="0" alt="Back"></td>
  </tr>
</table>
</td></tr></table>
</form>
<?php
    } else {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td><h2 class="boxheader"><?php echo TEXT_CONNECTION_SUCCESS; ?></h2></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p><?php echo TEXT_PROCESS_1; ?></p>
<p><?php echo TEXT_PROCESS_2; ?></p>


<form name="install" action="install_step3.php" method="post">

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

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="install_step1.php"><img src="images/button_cancel.gif" border="0" alt="Cancel"></a></td>
    <td align="center"><input type="image" src="images/button_continue.gif" border="0" alt="Continue"></td>
  </tr>
</table>

</form>


<?php
    }
  }
?>
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
