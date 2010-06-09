<?php
/* -----------------------------------------------------------------------------------------
   $Id: product_reviews.php,v 1.8 2004/06/03 14:52:49 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(product_reviews.php,v 1.47 2003/02/13); www.oscommerce.com 
   (c) 2003	 nextcommerce (product_reviews.php,v 1.12 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/


  // create smarty elements
  $module_smarty = new Smarty;
  $module_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
  // include boxes
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_image_button.inc.php');
  require_once(DIR_FS_INC . 'xtc_row_number_format.inc.php');
  require_once(DIR_FS_INC . 'xtc_date_short.inc.php');

     $info_smarty->assign('options',$products_options_data);
    $reviews_query = xtc_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . (int)$_GET['products_id'] . "'");
    $reviews = xtc_db_fetch_array($reviews_query);
    if ($reviews['count'] > 0) {

      //fsk18 lock
  $fsk_lock='';
  if ($_SESSION['customers_status']['customers_fsk18_display']=='0') $fsk_lock=' and p.products_fsk18!=1';
  
  $product_info_reviews_query = xtc_db_query("select pd.products_name from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS . " p on pd.products_id = p.products_id where pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_status = '1' ".$fsk_lock." and pd.products_id = '" . (int)$_GET['products_id'] . "'");
  if (!xtc_db_num_rows($product_info_reviews_query)) xtc_redirect(xtc_href_link(FILENAME_REVIEWS));
  $product_info_reviews = xtc_db_fetch_array($product_info_reviews_query);


  $reviews_query = xtc_db_query("select
                                 r.reviews_rating,
                                 r.reviews_id,
                                 r.customers_name,
                                 r.date_added,
                                 r.last_modified,
                                 r.reviews_read,
                                 rd.reviews_text
                                 from " . TABLE_REVIEWS . " r,
                                 ".TABLE_REVIEWS_DESCRIPTION ." rd
                                 where r.products_id = '" . (int)$_GET['products_id'] . "'
                                 and  r.reviews_id=rd.reviews_id
                                 and rd.languages_id = '".$_SESSION['languages_id']."'
                                 order by reviews_id DESC");
  if (xtc_db_num_rows($reviews_query)) {
    $row = 0;
    $data_reviews=array();
    while ($reviews = xtc_db_fetch_array($reviews_query)) {
      $row++;
     $data_reviews[]=array(
                           'AUTHOR'=>$reviews['customers_name'],
                           'DATE'=>xtc_date_short($reviews['date_added']),
                           'RATING'=>xtc_image('templates/' . CURRENT_TEMPLATE . '/img/stars_' . $reviews['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])),
                           'TEXT'=>$reviews['reviews_text']);
    if ($row==PRODUCT_REVIEWS_VIEW) break;
    }
  }

  $module_smarty->assign('BUTTON_WRITE','<a href="' . xtc_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'products_id=' . $_GET['products_id']) . '">' . xtc_image_button('button_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW) . '</a>');


  $module_smarty->assign('language', $_SESSION['language']);
  $module_smarty->assign('module_content',$data_reviews);
  $module_smarty->caching = 0;
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/products_reviews.html');


  $info_smarty->assign('MODULE_products_reviews',$module);

}

?>