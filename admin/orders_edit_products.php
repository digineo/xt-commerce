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
?>


<!-- Artikelbearbeitung Anfang //-->
<?php
  $products_query = xtc_db_query("select * from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $_GET['oID'] . "' ");
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">

<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCT_ID;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_QUANTITY;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCT;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCTS_MODEL;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_TAX;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRICE;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_FINAL;?></b></td>
<td class="dataTableHeadingContent">&nbsp;</td>
<td class="dataTableHeadingContent">&nbsp;</td>
</tr>

<?php
while($products = xtc_db_fetch_array($products_query)) {
?>
<tr class="dataTableRow">
<?php
echo xtc_draw_form('product_edit', FILENAME_ORDERS_EDIT, 'action=product_edit', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('opID', $products[orders_products_id]);
?>
<td class="dataTableContent"><?php echo xtc_draw_input_field('products_id', $products['products_id'], 'size="5"');?></td>
<td class="dataTableContent"><?php echo xtc_draw_input_field('products_quantity', $products['products_quantity'], 'size="2"');?></td>
<td class="dataTableContent"><?php echo xtc_draw_input_field('products_name', $products['products_name'], 'size="20"');?></td>
<td class="dataTableContent"><?php echo xtc_draw_input_field('products_model', $products['products_model'], 'size="10"');?></td>
<td class="dataTableContent"><?php echo xtc_draw_input_field('products_tax', $products['products_tax'], 'size="6"');?></td>
<td class="dataTableContent"><?php echo xtc_draw_input_field('products_price', $products['products_price'], 'size="10"');?></td>
<td class="dataTableContent"><?php echo $products['final_price'];?></td>
<td class="dataTableContent">
<?php
echo xtc_image_submit('button_save.gif', TEXT_EDIT,'style="cursor:hand" ');
?>
</form>
</td>

<td class="dataTableContent">
<?php
echo xtc_draw_form('product_delete', FILENAME_ORDERS_EDIT, 'action=product_delete', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('pID', $products['products_id']);
echo xtc_draw_hidden_field('opID', $products[orders_products_id]);
echo xtc_image_submit('button_delete.gif', TEXT_DELETE,'style="cursor:hand" ');
?>
</form>
</td>
</tr>

<tr class="dataTableRow">
<td class="dataTableContent" colspan="8">&nbsp;</td>

<td class="dataTableContent">
<?php
echo xtc_draw_form('select_options', FILENAME_ORDERS_EDIT, '', 'GET');
echo xtc_draw_hidden_field('edit_action', 'options');
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('pID', $products['products_id']);
echo xtc_draw_hidden_field('pTX', $products['products_tax']);
echo xtc_draw_hidden_field('aTX', $products['allow_tax']);
echo xtc_draw_hidden_field('qTY', $products['products_quantity']);
echo xtc_draw_hidden_field('opID', $products['orders_products_id']);
echo xtc_image_submit('button_edit_attributes.gif', TEXT_EDIT_PRODUCTS,'style="cursor:hand" ');
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

<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent" colspan="2"><b><?php echo TEXT_PRODUCT_SEARCH;?></b></td>
</tr>

<tr class="dataTableRow">
<?php
echo xtc_draw_form('product_search', FILENAME_ORDERS_EDIT, '', 'get');
echo xtc_draw_hidden_field('edit_action', 'products');
echo xtc_draw_hidden_field('action', 'product_search');
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('cID', $_POST['cID']);
?>
<td class="dataTableContent" width="40"><?php echo xtc_draw_input_field('search', '', 'size="30"');?></td>
<td class="dataTableContent">
<?php
echo xtc_image_submit('button_search.gif', TEXT_EDIT,'style="cursor:hand" ');
?>
</td>
</form>
</tr>
</table>
<br /><br />
<?php
if ($_GET['action'] =='product_search') {

     $products_query = xtc_db_query("select
     p.products_id,
     p.products_model,
     pd.products_name,
     p.products_image,
     p.products_status
     from
     " . TABLE_PRODUCTS . " p,
     " . TABLE_PRODUCTS_DESCRIPTION . " pd
     where
     p.products_id = pd.products_id
     and pd.language_id = '" . $_SESSION['languages_id'] . "' and
     (pd.products_name like '%" . $_GET['search'] . "%' OR p.products_model = '" . $_GET['search'] . "') order by pd.products_name");

?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">

<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCT_ID;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_QUANTITY;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCT;?></b></td>
<td class="dataTableHeadingContent"><b><?php echo TEXT_PRODUCTS_MODEL;?></b></td>
<td class="dataTableHeadingContent">&nbsp;</td>
</tr>

<?php
while($products = xtc_db_fetch_array($products_query)) {
?>
<tr class="dataTableRow">
<?php
echo xtc_draw_form('product_ins', FILENAME_ORDERS_EDIT, 'action=product_ins', 'post');
echo xtc_draw_hidden_field('cID', $_POST['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('products_id', $products[products_id]);
?>
<td class="dataTableContent"><?php echo $products[products_id];?></td>
<td class="dataTableContent"><?php echo xtc_draw_input_field('products_quantity', $products[products_quantity], 'size="2"');?></td>
<td class="dataTableContent"><?php echo $products[products_name];?></td>
<td class="dataTableContent"><?php echo $products[products_model];?></td>
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
<?php } ?>
<br /><br />
<!-- Artikel Einfügen Ende //-->














