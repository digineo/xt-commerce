<?php
/* --------------------------------------------------------------
   $Id: orders_edit.php,v 1.0

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   XTC-Bestellbearbeitung:
   http://www.xtc-webservice.de / Matthias Hinsche
   info@xtc-webservice.de

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(orders.php,v 1.27 2003/02/16); www.oscommerce.com 
   (c) 2003	 nextcommerce (orders.php,v 1.7 2003/08/14); www.nextcommerce.org

   Released under the GNU General Public License 

   To do: Erweitern auf Artikelmerkmale, Rabatte und Gutscheine
   --------------------------------------------------------------*/
   require_once(DIR_FS_INC .'xtc_get_tax_rate.inc.php');
   require_once(DIR_FS_INC .'xtc_get_tax_class_id.inc.php');
// select Order Currencie
$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_GET['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status['customers_status_id']);

?>
<!-- Artikelbearbeitung Anfang //-->

<?php
  $products_query = xtc_db_query("select * from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . $_GET['oID'] . "' and orders_products_id = '" . $_GET['opID'] . "'");
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">

<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCT_OPTION;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCT_OPTION_VALUE;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRICE;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRICE_PREFIX;?></b></td>
<td class="dataTableHeadingContent">&nbsp;</td>
<td class="dataTableHeadingContent">&nbsp;</td>
<td class="dataTableHeadingContent">&nbsp;</td>
</tr>

<?php
while($products = xtc_db_fetch_array($products_query)) {
?>
<tr class="dataTableRow">
<?php
echo xtc_draw_form('product_option_edit', FILENAME_ORDERS_EDIT, 'action=product_option_edit', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('pID', $_GET['pID']);
echo xtc_draw_hidden_field('pTX', $_GET['pTX']);
echo xtc_draw_hidden_field('aTX', $_GET['aTX']);
echo xtc_draw_hidden_field('qTY', $_GET['qTY']);
echo xtc_draw_hidden_field('opID', $_GET['opID']);
echo xtc_draw_hidden_field('opAID', $products['orders_products_attributes_id']);

$brutto = PRICE_IS_BRUTTO;
if($brutto == 'true'){
$options_values_price = $xtPrice->xtcFormat($xtPrice->xtcCalculateCurr(($products['options_values_price']*(1+($_GET['pTX']/100)))),false);
}else{
$options_values_price = $xtPrice->xtcFormat($xtPrice->xtcCalculateCurr($products['options_values_price']), false);
}

?>
<td class="dataTableContent"><?php echo xtc_draw_input_field('products_options', $products['products_options'], 'size="20"');?></td>
<td class="dataTableContent"><?php echo xtc_draw_input_field('products_options_values', $products['products_options_values'], 'size="20"');?></td>
<td class="dataTableContent"><?php echo xtc_draw_input_field('options_values_price',$options_values_price, 'size="10"');?></td>
<td class="dataTableContent"><?php echo $products['price_prefix'];?></td>
<td class="dataTableContent">
<SELECT name="prefix">
<OPTION value="+">+
<OPTION value="-">-
</SELECT>
</td>
<td class="dataTableContent">
<?php
echo xtc_image_submit('button_save.gif', TEXT_EDIT,'style="cursor:hand" ');
?>
</form>
</td>

<td class="dataTableContent">
<?php
echo xtc_draw_form('product_option_delete', FILENAME_ORDERS_EDIT, 'action=product_option_delete', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('pID', $_GET['pID']);
echo xtc_draw_hidden_field('pTX', $_GET['pTX']);
echo xtc_draw_hidden_field('aTX', $_GET['aTX']);
echo xtc_draw_hidden_field('qTY', $_GET['qTY']);
echo xtc_draw_hidden_field('opID', $_GET['opID']);
echo xtc_draw_hidden_field('opAID', $products['orders_products_attributes_id']);
echo xtc_image_submit('button_delete.gif', TEXT_DELETE,'style="cursor:hand" ');
?>
</form>
</td>
</tr>
<?php
}
?>
</table>
<br /><br />
<!-- Artikelbearbeitung Ende //-->



<!-- Artikel Einfügen Anfang //-->

<table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
     $products_query = xtc_db_query("select
     products_attributes_id,
     products_id,
     options_id,
     options_values_id,
     options_values_price,
     price_prefix
     from
     " . TABLE_PRODUCTS_ATTRIBUTES . "
     where
     products_id = '" . $_GET['pID'] . "'
     order by
     sortorder");

?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">

<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCT_ID;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_QUANTITY;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCT;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRICE;?></b></td>
<td class="dataTableHeadingContent">&nbsp;</td>
</tr>

<?php
while($products = xtc_db_fetch_array($products_query)) {
?>
<tr class="dataTableRow">
<?php
echo xtc_draw_form('product_option_ins', FILENAME_ORDERS_EDIT, 'action=product_option_ins', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('pID', $_GET['pID']);
echo xtc_draw_hidden_field('pTX', $_GET['pTX']);
echo xtc_draw_hidden_field('aTX', $_GET['aTX']);
echo xtc_draw_hidden_field('qTY', $_GET['qTY']);
echo xtc_draw_hidden_field('opID', $_GET['opID']);
echo xtc_draw_hidden_field('aID', $products['products_attributes_id']);

$brutto = PRICE_IS_BRUTTO;
if($brutto == 'true'){
$options_values_price = xtc_round(($products['options_values_price']*(1+($_GET['pTX']/100))), PRICE_PRECISION);
}else{
$options_values_price = xtc_round($products['options_values_price'], PRICE_PRECISION);
}

?>
<td class="dataTableContent"><?php echo $products['products_attributes_id'];?></td>
<td class="dataTableContent"><?php echo xtc_oe_get_options_name($products['options_id']);?></td>
<td class="dataTableContent"><?php echo xtc_oe_get_options_values_name($products['options_values_id']);?></td>
<td class="dataTableContent">
<?php echo xtc_draw_hidden_field('options_values_price', $products['options_values_price']);?>
<?php echo $xtPrice->xtcFormat($xtPrice->xtcCalculateCurr($options_values_price),true);?>
</td>
<td class="dataTableContent">
<?php
echo xtc_image_submit('button_insert.gif', TEXT_EDIT,'style="cursor:hand" ');
?>
</form>
</td>
</tr>
<?php
}
?>
</table>

<br /><br />
<!-- Artikel Einfügen Ende //-->










