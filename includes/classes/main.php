<?php
/* -----------------------------------------------------------------------------------------
   $Id: main.php 1140 2005-08-10 10:16:00Z mz $ 

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2005 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(Coding Standards); www.oscommerce.com 

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/
 
 class main {
 	
 	function main () {
 		$this->SHIPPING = array();
 		
 		
 		
 		
 				// prefetch shipping status
		$status_query=xtDBquery("SELECT
                                     shipping_status_name,
                                     shipping_status_image,shipping_status_id
                                     FROM ".TABLE_SHIPPING_STATUS."
                                     where language_id = '".(int)$_SESSION['languages_id']."'");
         
         while ($status_data=xtc_db_fetch_array($status_query,true)) {
         	$this->SHIPPING[$status_data['shipping_status_id']]=array('name'=>$status_data['shipping_status_name'],'image'=>$status_data['shipping_status_image']);
         }
         
         
 	}
 	
 	function getShippingStatusName($id) {
 		return $this->SHIPPING[$id]['name'];
 	}
 	function getShippingStatusImage($id) {
 		return 'admin/images/icons/'.$this->SHIPPING[$id]['image'];
 	}
 	
 	
 }
 
 
?>
