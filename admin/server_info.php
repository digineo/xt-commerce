<?php
/* --------------------------------------------------------------
   $Id: server_info.php 233 2007-03-07 11:23:11Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(server_info.php,v 1.4 2003/03/17); www.oscommerce.com 
   (c) 2003	nextcommerce (server_info.php,v 1.7 2003/08/18); www.nextcommerce.org
   (c) 2005 Joomla - Open Source Matters, admin.admin.html.php 5612 2006-11-01

   Released under the GNU General Public License 
   --------------------------------------------------------------*/

  require('includes/application_top.php');

  $system = xtc_get_system_information();
  
  function get_php_setting($val, $colour=0, $yn=1) {
		$r =  (ini_get($val) == '1' ? 1 : 0);

		if ($colour) {
			if ($yn) {
				$r = $r ? '<span style="color: green;">ON</span>' : '<span style="color: red;">OFF</span>';
			} else {
				$r = $r ? '<span style="color: red;">ON</span>' : '<span style="color: green;">OFF</span>';
			}

			return $r;
		} else {
			return $r ? 'ON' : 'OFF';
		}
	}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['language_charset']; ?>"> 
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link type="text/css" rel="stylesheet" href="includes/javascript/tabpane/css/luna/tab.css" />
<script type="text/javascript" src="includes/javascript/tabpane/js/tabpane.js"></script>
<style type="text/css">

.center {text-align: center;}
.center table { margin-left: auto; margin-right: auto; text-align: left;}
.center th { text-align: center !important; }
td, th {  solid #000000; font-size: 75%; vertical-align: baseline;}
h1 {font-size: 150%;}
h2 {font-size: 125%;}
.p {text-align: left;}
.e {background-color: #ccccff; font-weight: bold; color: #000000;}
.h {background-color: #9999cc; font-weight: bold; color: #000000;}
.v {background-color: #cccccc; color: #000000;}
.vr {background-color: #cccccc; text-align: right; color: #000000;}
hr {width: 600px; background-color: #cccccc; border: 0px; height: 1px; color: #000000;}
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
    <td class="boxCenter" width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo xtc_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td align="center">
 <div class="tab-pane" id="mainTabPane">
  <script type="text/javascript"><!--
    var mainTabPane = new WebFXTabPane( document.getElementById( "mainTabPane" ) );
  //--></script>
  
  
  
  <div class="tab-page" id="tab_general">
    <h2 class="tab">System Info</h2>
        <script type="text/javascript"><!--
      mainTabPane.addTabPage( document.getElementById( "system_info" ) );
    //--></script>
<table class="main">
			<tr>
				<td colspan="2">
					<?php
					// show security setting check
					//josSecurityCheck();
					?>
				</td>
			</tr>
			<tr>
				<td valign="top" width="250">
					<strong>PHP built On:</strong>
				</td>
				<td>
					<?php echo php_uname(); ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Database Version:</strong>
				</td>
				<td>
					<?php echo $system['db_version']; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Database Host:</strong>
				</td>
				<td>
					<?php echo $system['db_server'] . ' (' . $system['db_ip'] . ')'; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>PHP Version:</strong>
				</td>
				<td>
					<?php echo phpversion(); ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Web Server:</strong>
				</td>
				<td>
					<?php echo $system['http_server']; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>WebServer to PHP interface:</strong>
				</td>
				<td>
					<?php echo php_sapi_name(); ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>xt:Commerce Version:</strong>
				</td>
				<td>
					<?php echo PROJECT_VERSION.' - &copy; xt:Commerce GbR <a href="http://www.xt-commerce.com" target="_blank">www.xt-commerce.com</a>'; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>User Agent:</strong>
				</td>
				<td>
					<?php echo phpversion() <= '4.2.1' ? getenv( 'HTTP_USER_AGENT' ) : $_SERVER['HTTP_USER_AGENT'];?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="height: 10px;">
				</td>
			</tr>
			<tr>
				<td valign="top">
					<strong>Relevant PHP Settings:</strong>
				</td>
				<td>
					<table class="main" cellspacing="1" cellpadding="1" border="0">
					<tr>
						<td>
							Register Globals:
						</td>
						<td style="font-weight: bold;">
							<?php echo get_php_setting('register_globals',1,0); ?>
						</td>
						<td>
							<?php $img = ((ini_get('register_globals')) ? 'icon_stop.gif' : 'icon_accept.gif'); ?>
							<img src="../images/<?php echo $img; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							Magic Quotes:
						</td>
						<td style="font-weight: bold;">
							<?php echo get_php_setting('magic_quotes_gpc',1,1); ?>
						</td>
						<td>
							<?php $img = (!(ini_get('magic_quotes_gpc')) ? 'icon_stop.gif' : 'icon_accept.gif'); ?>
							<img src="../images/<?php echo $img; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							Safe Mode:
						</td>
						<td style="font-weight: bold;">
							<?php echo get_php_setting('safe_mode',1,0); ?>
						</td>
						<td>
							<?php $img = ((ini_get('safe_mode')) ? 'icon_stop.gif' : 'icon_accept.gif'); ?>
							<img src="../images/<?php echo $img; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							File Uploads:
						</td>
						<td style="font-weight: bold;">
							<?php echo get_php_setting('file_uploads',1,1); ?>
						</td>
						<td>
							<?php $img = ((!ini_get('file_uploads')) ? 'icon_stop.gif' : 'icon_accept.gif'); ?>
							<img src="../images/<?php echo $img; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							Session auto start:
						</td>
						<td style="font-weight: bold;">
							<?php echo get_php_setting('session.auto_start',1,0); ?>
						</td>
						<td>
							<?php $img = ((ini_get('session.auto_start')) ? 'icon_stop.gif' : 'icon_accept.gif'); ?>
							<img src="../images/<?php echo $img; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							cURL enabled:
						</td>
						<td style="font-weight: bold;">
						<?php echo extension_loaded('cURL')?'Yes':'No'; ?>
						</td>
						<td>
							<?php $img = ((extension_loaded('cURL')!='1') ? 'icon_stop.gif' : 'icon_accept.gif'); ?>
							<img src="../images/<?php echo $img; ?>" />
						</td>
					</tr>
					<tr>
						<td>
							Session save path:
						</td>
						<td style="font-weight: bold;" colspan="2">
							<?php echo (($sp=ini_get('session.save_path'))?$sp:'none'); ?>
						</td>
					</tr>
					<tr>
						<td>
							Output Buffering:
						</td>
						<td style="font-weight: bold;">
							<?php echo get_php_setting('output_buffering'); ?>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
							Open basedir:
						</td>
						<td style="font-weight: bold;" colspan="2">
							<?php echo (($ob = ini_get('open_basedir')) ? $ob : 'none'); ?>
						</td>
					</tr>
					<tr>
						<td>
							Display Errors:
						</td>
						<td style="font-weight: bold;" colspan="2">
							<?php echo get_php_setting('display_errors'); ?>
						</td>
					</tr>
					<tr>
						<td>
							XML enabled:
						</td>
						<td style="font-weight: bold;" colspan="2">
						<?php echo extension_loaded('xml')?'Yes':'No'; ?>
						</td>
					</tr>
					<tr>
						<td>
							Zlib enabled:
						</td>
						<td style="font-weight: bold;" colspan="2">
							<?php echo extension_loaded('zlib')?'Yes':'No'; ?>
						</td>
					</tr>
					<tr>
						<td>
							Disabled Functions:
						</td>
						<td style="font-weight: bold;" colspan="2">
							<?php echo (($df=ini_get('disable_functions'))?$df:'none'); ?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
</div>       
  
  <div class="tab-page" id="tab_general">
    <h2 class="tab">PHP Info</h2>
        <script type="text/javascript"><!--
      mainTabPane.addTabPage( document.getElementById( "php_info" ) );
    //--></script>  
  			<table class="main">
			<tr>
				<td>
				<?php
    ob_start();
    phpinfo();
    $phpinfo = ob_get_contents();
    ob_end_clean();

    $phpinfo = str_replace('border: 1px', '', $phpinfo);
    ereg("(<style type=\"text/css\">{1})(.*)(</style>{1})", $phpinfo, $regs);
    ereg("(<body>{1})(.*)(</body>{1})", $phpinfo, $regs);
    echo $regs[2];

				?>
				</td>
			</tr>
			</table>
  
  
  </div>           

            </td>
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
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>