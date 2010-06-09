<?php
/* -----------------------------------------------------------------------------------------
   $Id: metatags.php,v 1.9 2004/06/13 15:21:58 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2003	 nextcommerce (metatags.php,v 1.7 2003/08/14); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/


?>
<meta name="robots" content="<?php echo META_ROBOTS; ?>">
<meta name="language" content="<?php echo $language; ?>">
<meta name="author" content="<?php echo META_AUTHOR; ?>">
<meta name="publisher" content="<?php echo META_PUBLISHER; ?>">
<meta name="company" content="<?php echo META_COMPANY; ?>">
<meta name="page-topic" content="<?php echo META_TOPIC; ?>">
<meta name="reply-to" content="<?php echo META_REPLY_TO; ?>">
<meta name="distribution" content="global">
<meta name="revisit-after" content="<?php echo META_REVISIT_AFTER; ?>">
<?php
if (strstr($PHP_SELF, FILENAME_PRODUCT_INFO)) {
$product_meta_query = xtc_db_query("select pd.products_name,p.products_model,pd.products_meta_title,pd.products_meta_description , pd.products_meta_keywords,pd.products_meta_title from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
$product_meta = xtc_db_fetch_array($product_meta_query);
?>
<META NAME="description" CONTENT="<?php echo $product_meta['products_meta_description']; ?>">
<META NAME="keywords" CONTENT="<?php echo $product_meta['products_meta_keywords']; ?>">
<title><?php echo TITLE.' - '.$product_meta['products_meta_title'].' '.$product_meta['products_name'].' '.$product_meta['products_model']; ?></title>
<?php
} else {
if ($_GET['cPath']) {
if (strpos($_GET['cPath'],'_')=='1') {
$arr=explode('_',xtc_input_validation($_GET['cPath'],'cPath',''));
$_cPath=$arr[1];
} else {
$_cPath=(int)$_GET['cPath'];
}
$categories_meta_query=xtc_db_query("SELECT categories_meta_keywords,
                                            categories_meta_description,
                                            categories_meta_title,
                                            categories_name
                                            FROM ".TABLE_CATEGORIES_DESCRIPTION."
                                            WHERE categories_id='".$_cPath."' and
                                            language_id='".$_SESSION['languages_id']."'");
$categories_meta = xtc_db_fetch_array($categories_meta_query);
if ($categories_meta['categories_meta_keywords']=='') {
$categories_meta['categories_meta_keywords']=META_KEYWORDS;
}
if ($categories_meta['categories_meta_description']=='') {
$categories_meta['categories_meta_description']=META_DESCRIPTION;
}
if ($categories_meta['categories_meta_title']=='') {
$categories_meta['categories_meta_title']=$categories_meta['categories_name'];
}
?>
<META NAME="description" CONTENT="<?php echo $categories_meta['categories_meta_description']; ?>">
<META NAME="keywords" CONTENT="<?php echo $categories_meta['categories_meta_keywords']; ?>">
<title><?php echo TITLE.' - '.$categories_meta['categories_meta_title']; ?></title>
<?php
} else {
?>
<META NAME="description" CONTENT="<?php echo META_DESCRIPTION; ?>">
<META NAME="keywords" CONTENT="<?php echo META_KEYWORDS; ?>">
<title><?php echo TITLE; ?></title>
<?php
}
}
?>