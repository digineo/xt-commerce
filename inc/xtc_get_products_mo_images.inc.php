<?PHP
/* -----------------------------------------------------------------------------------------
   $Id: xtc_get_products_mo_images.inc.php,v 0.1 2004/06/25 21:47:50 Novalis Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2004 XT-Commerce
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   
   function xtc_get_products_mo_images($products_id = ''){
   $mo_query = "select image_id, image_nr, image_name from " . TABLE_PRODUCTS_IMAGES . " where products_id = '" . $products_id ."' ORDER BY image_nr";

   if ( DB_CACHE == 'true' ) {
      $products_mo_images_query = xtc_db_query($mo_query);
   } else {
      $products_mo_images_query = xtc_db_query($mo_query);
   }
      
   while ($row=xtc_db_fetch_array($products_mo_images_query)) $results[($row['image_nr']-1)] = $row;
   return $results;
   }
   
   ?>