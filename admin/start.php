<?php

/* --------------------------------------------------------------
   $Id: start.php 291 2007-03-26 09:22:48Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project 
   (c) 2002-2003 osCommerce coding standards (a typical file) www.oscommerce.com
   (c) 2003      nextcommerce (start.php,1.5 2004/03/17); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/
  
require ('includes/application_top.php');
require_once 'includes/modules/carp/carp.php';
require_once(DIR_FS_INC.'xtc_validate_vatid_status.inc.php');

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
    <td class="main" valign="top">xt:Commerce News</td>
  </tr>
</table></td>
      </tr>
      <tr>
        <td>
        <?php include(DIR_WS_MODULES.FILENAME_SECURITY_CHECK); ?>
        </td>
        </tr>
                  

     <tr>
      <td style="border: 0px solid; border-color: #ffffff;">
        <table valign="top" width="100%" cellpadding="0" cellspacing="0">
        <tr><td width="50%">
<h2 class="boxheader">News</h2>
<div class="boxbody">      
<?php

CarpConf('iorder','link,date,desc');

        CarpConf('cborder','link,desc');
        CarpConf('caorder','image');
        CarpConf('bcb','<div style="font-size:110%; background:#fed; border:1px solid #999; padding:5px;">');
        CarpConf('acb','</div>');
        CarpConf('bca','<center>');
        CarpConf('aca','</center>');
		CarpConf('maxitems',5);
       
        // before each item
        CarpConf('bi','<br><div style="font-size:80%; font-family: verdana; background:#fed; border:1px solid #ff0000; padding:5px;">');
        
        // after each item
        CarpConf('ai','</div>');
		CarpShow('http://www.xt-commerce.com/backend_304.php');

?>
</div>
        </td>
        <td valign="top" align="center">
        <h2 class="boxheader">Statistics</h2>
		<div class="boxbody">   
<div class="tab-pane" id="mainTabPane">
  <script type="text/javascript"><!--
    var mainTabPane = new WebFXTabPane( document.getElementById( "mainTabPane" ) );
  //--></script>

<div class="tab-page" id="tab_general">
    <h2 class="tab"><?php echo BOX_HEADING_STATISTICS; ?></h2>
        <script type="text/javascript"><!--
      mainTabPane.addTabPage( document.getElementById( "orders_day" ) );
    //--></script>
        <?php
        include(DIR_WS_INCLUDES . 'graphs/orders_daily.php');
        echo xtc_image(DIR_WS_IMAGES . 'graphs/orders_daily.png');
        ?>
</div>       
<div class="tab-page" id="tab_general">
    <h2 class="tab"><?php echo BOX_ORDERS; ?></h2>
        <script type="text/javascript"><!--
      mainTabPane.addTabPage( document.getElementById( "latest_orders" ) );
    //--></script>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <?php
        $orders_query_raw = "select o.orders_id, o.orders_status, o.afterbuy_success, o.afterbuy_id, o.customers_name, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total from ".TABLE_ORDERS." o left join ".TABLE_ORDERS_TOTAL." ot on (o.orders_id = ot.orders_id), ".TABLE_ORDERS_STATUS." s where (o.orders_status = s.orders_status_id and s.language_id = '".$_SESSION['languages_id']."' and ot.class = 'ot_total') or (o.orders_status = '0' and ot.class = 'ot_total' and  s.orders_status_id = '1' and s.language_id = '".$_SESSION['languages_id']."') order by o.orders_id DESC LIMIT 0,20";
		$orders_query = xtc_db_query($orders_query_raw);
		while ($orders = xtc_db_fetch_array($orders_query)) { ?>
              <tr>
                <td class="dataTableContent" align="center"><?php echo xtc_datetime_short($orders['date_purchased']); ?></td>
                <td class="dataTableContent" align="right"><?php echo '<a href="' . xtc_href_link(FILENAME_ORDERS, xtc_get_all_get_params(array('oID', 'action')) . 'oID=' . $orders['orders_id'] . '&action=edit') . '">' . xtc_image(DIR_WS_ICONS . 'zoom.png', ICON_PREVIEW) . '</a>&nbsp;' . $orders['orders_id']; ?></td>
                <td class="dataTableContent"><?php echo $orders['customers_name']; ?></td>              
                <td class="dataTableContent" align="right"><?php echo strip_tags($orders['order_total']); ?></td>               
                <td class="dataTableContent" align="right"><?php if($orders['orders_status']!='0') { echo $orders['orders_status_name']; }else{ echo '<font color="#FF0000">'.TEXT_VALIDATING.'</font>';}?></td>          
              </tr>			
		<?php } ?>
    </table>
</div>            
<div class="tab-page" id="tab_general">
    <h2 class="tab"><?php echo BOX_CUSTOMERS; ?></h2>
        <script type="text/javascript"><!--
      mainTabPane.addTabPage( document.getElementById( "latest_customers" ) );
    //--></script>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <?php
		$customers_query_raw = "select
	                                c.account_type,
	                                c.customers_id,
	                                c.customers_vat_id,
	                                c.customers_vat_id_status,
	                                c.customers_lastname,
	                                c.customers_firstname,
	                                c.customers_email_address,
	                                a.entry_country_id,
	                                c.customers_status,
	                                c.member_flag,
	                                ci.customers_info_date_account_created
	                                from
	                                ".TABLE_CUSTOMERS." c ,
	                                ".TABLE_ADDRESS_BOOK." a,
	                                ".TABLE_CUSTOMERS_INFO." ci
	                                Where
	                                c.customers_id = a.customers_id
	                                and c.customers_default_address_id = a.address_book_id
	                                and ci.customers_info_id = c.customers_id
	                                group by c.customers_id
	                                order by ci.customers_info_date_account_created DESC LIMIT 0,20";       


        $customers_query = xtc_db_query($customers_query_raw);
        $customers_statuses_array = xtc_get_customers_statuses();
		while ($customers = xtc_db_fetch_array($customers_query)) { ?>
              <tr>
               <td class="dataTableContent" align="left" width="100"><?php echo xtc_date_short($customers['customers_info_date_account_created']); ?></td> 		
               
               <td class="dataTableContent" align="left" width="20"><?php echo '<a href="' . xtc_href_link(FILENAME_CUSTOMERS, xtc_get_all_get_params(array ('cID')).'cID='.$customers['customers_id']) . '">' . xtc_image(DIR_WS_ICONS . 'zoom.png', ICON_PREVIEW) . '</a>&nbsp;'; ?></td>
               <td class="dataTableContent" ><b><?php echo $customers['customers_lastname']; ?></b></td>
                <td class="dataTableContent" ><?php echo $customers['customers_firstname']; ?></td>
                <td class="dataTableContent" align="left"><?php echo $customers_statuses_array[$customers['customers_status']]['text'] . ' (' . $customers['customers_status'] . ')' ; ?></td>
                <?php if (ACCOUNT_COMPANY_VAT_CHECK == 'true') {?>
                <td class="dataTableContent" align="left">&nbsp;
                <?php
		if ($customers['customers_vat_id']) {
			echo $customers['customers_vat_id'].'<br /><span style="font-size:8pt"><nobr>('.xtc_validate_vatid_status($customers['customers_id']).')</nobr></span>';
		}
?>
                </td>
                </tr>	
                <?php } ?>
                	<?php } ?>
       </table> 
</div>          
        
        
 </div>       
        </div>     
        </td></tr>
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