<?php
/* -----------------------------------------------------------------------------------------
   $Id: tracking.php,v 1.0 2004/04/26 12:28:47 gwinger Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

$ref_url = parse_url($_SERVER['HTTP_REFERER']);
 
 if (!isset($_SESSION[tracking]['refID'])) $_SESSION[tracking]['refID'] = $_GET['refID'];
 if (!isset($_SESSION[tracking]['http_referer'])) $_SESSION[tracking]['http_referer'] = $ref_url;		
 if (!isset($_SESSION[tracking]['date'])) $_SESSION[tracking]['date'] = (date ("Y-m-d H:i:s"));
 if (!isset($_SESSION[tracking]['browser'])) $_SESSION[tracking]['browser'] = $_SERVER["HTTP_USER_AGENT"];
 if (!isset($_SESSION[tracking]['ip'])) $_SESSION[tracking]['ip'] = $_SERVER["REMOTE_ADDR"];


    $i = count($_SESSION[tracking]['pageview_history']);
 if ($i > 6){
    array_shift ($_SESSION[tracking]['pageview_history']);     
    $_SESSION[tracking]['pageview_history'][6] = $ref_url; 
 } else {
    $_SESSION[tracking]['pageview_history'][$i] = $ref_url; 
 }

 if ($_SESSION[tracking]['pageview_history'][$i] == $_SESSION[tracking]['http_referer']) array_shift ($_SESSION[tracking]['pageview_history']);
	

 if ($_GET['products_id']) {
   	
 $i = count($_SESSION[tracking]['products_history']);
 if ($i > 6){
    array_shift ($_SESSION[tracking]['products_history']);     
$_SESSION[tracking]['products_history'][6] = $_GET['products_id'];
$_SESSION[tracking]['products_history'] = array_unique($_SESSION[tracking]['products_history']);
} else {	
$_SESSION[tracking]['products_history'][$i] = $_GET['products_id']; 
$_SESSION[tracking]['products_history'] = array_unique($_SESSION[tracking]['products_history']);
}	

}
?>