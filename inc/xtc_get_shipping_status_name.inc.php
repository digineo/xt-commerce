<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_get_shipping_status_name.inc.php,v 1.1 2004/02/22 13:20:29 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2003     nextcommerce (xtc_add_tax.inc.php,v 1.4 2003/08/24); www.nextcommerce.org

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

function xtc_get_shipping_status_name ($shipping_status_id) {

         $status_query=xtc_db_query("SELECT
                                     shipping_status_name,
                                     shipping_status_image
                                     FROM ".TABLE_SHIPPING_STATUS."
                                     where shipping_status_id = '".$shipping_status_id."'
                                     and language_id = '".(int)$_SESSION['languages_id']."'");
         $status_data=xtc_db_fetch_array($status_query);
         $shipping_statuses=array();
         $shipping_status=array('name'=>$status_data['shipping_status_name'],'image'=>$status_data['shipping_status_image']);

         return $shipping_status;



}
?>