<?php
/* -----------------------------------------------------------------------------------------
   $Id: product_navigator.php,v 1.4 2004/04/05 16:50:00 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


   $module_smarty = new Smarty;
   $module_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');

   $products_cat_query=xtc_db_query("SELECT
                                     categories_id
                                     FROM ".TABLE_PRODUCTS_TO_CATEGORIES."
                                     WHERE products_id='".(int)$_GET['products_id']."'");
   $products_cat=xtc_db_fetch_array($products_cat_query);

   // select products
   //fsk18 lock
  $fsk_lock='';
  if ($_SESSION['customers_status']['customers_fsk18_display']=='0') {
  $fsk_lock=' and p.products_fsk18!=1';
  }
   $products_query=xtc_db_query("SELECT
                                 pc.products_id
                                 FROM ".TABLE_PRODUCTS_TO_CATEGORIES." pc,
                                 ".TABLE_PRODUCTS." p

                                 WHERE categories_id='".$products_cat['categories_id']."'
                                 and p.products_id=pc.products_id
                                 and p.products_status=1
                                 ".$fsk_lock);
   $i=0;
   while ($products_data=xtc_db_fetch_array($products_query)) {
   $p_data[$i]=array('pID'=>$products_data['products_id']);
   if ($products_data['products_id']==$_GET['products_id']) $actual_key=$i;
   $i++;

   }

   // check if array key = first
   if ($actual_key==0) {
   // aktuel key = first product
   } else {
   $prev_id=$actual_key-1;
   $prev_link=xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $p_data[$prev_id]['pID']);
    // check if prev id = first
    if ($prev_id!=0) $first_link=xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $p_data[0]['pID']);
    }

   // check if key = last
   if ($actual_key==(sizeof($p_data)-1)) {
   // actual key is last
   } else {
   $next_id=$actual_key+1;
   $next_link=xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' .$p_data[$next_id]['pID']);
    // check if next id = last
    if ($next_id!=(sizeof($p_data)-1)) $last_link=xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' .$p_data[(sizeof($p_data)-1)]['pID']);
    
   }
   $module_smarty->assign('FIRST',$first_link);
   $module_smarty->assign('PREVIOUS',$prev_link);
   $module_smarty->assign('NEXT',$next_link);
   $module_smarty->assign('LAST',$last_link);

   $module_smarty->assign('PRODUCTS_COUNT',count($p_data));
   $module_smarty->assign('language', $_SESSION['language']);
   
   $module_smarty->caching = 0;
   $product_navigator= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/product_navigator.html');



  	$info_smarty->assign('PRODUCT_NAVIGATOR',$product_navigator);



?>