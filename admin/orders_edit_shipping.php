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


<!-- Versandkostenbearbeitung Anfang //-->
<?php
  $shipping_query = xtc_db_query("select * from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $_GET['oID'] . "' and class = 'ot_shipping' ");
  $shipping = xtc_db_fetch_array($shipping_query);

?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent" width="40%"><b><?php echo TEXT_SHIPPING . '&nbsp;' . TEXT_DESC;?></b></td>
<td class="dataTableHeadingContent" width="10%"><b><?php echo TEXT_VALUE;?></b></td>
<td class="dataTableHeadingContent" width="10%"><b><?php echo TEXT_TAX;?></b></td>
<td class="dataTableHeadingContent" width="20%">&nbsp;</td>
<td class="dataTableHeadingContent" width="20%">&nbsp;</td>
</tr>
<?php
if ($shipping['value'] !=''){
?>
<tr class="dataTableRow">
<?php
echo xtc_draw_form('shipping_edit', FILENAME_ORDERS_EDIT, 'action=shipping_edit', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('otID', $shipping['orders_total_id']);
?>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('title', $shipping['title'], 'size="50"');?></td>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('value', $shipping['value'], 'size="10"');?></td>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('tax', '16', 'size="10"');?></td>
<td class="dataTableContent" align="left">
<?php
echo xtc_image_submit('button_save.gif', TEXT_EDIT,'style="cursor:hand" ');
?>
</form>
</td>
<td class="dataTableContent" align="left">
<?php
echo xtc_draw_form('shipping_del', FILENAME_ORDERS_EDIT, 'action=shipping_del', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('otID', $shipping['orders_total_id']);
echo xtc_image_submit('button_delete.gif', TEXT_DELETE,'style="cursor:hand" ');
?>
</form>
</td>
</tr>
</table>
<br /><br />
<?php } ?>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent" width="20%">&nbsp;</td>
<td class="dataTableHeadingContent" width="40%"><b><?php echo TEXT_SHIPPING . '&nbsp;' . TEXT_DESC;?></b></td>
<td class="dataTableHeadingContent" width="10%"><b><?php echo TEXT_VALUE;?></b></td>
<td class="dataTableHeadingContent" width="10%"><b><?php echo TEXT_TAX;?></b></td>
<td class="dataTableHeadingContent" width="20%">&nbsp;</td>
</tr>
<tr class="dataTableRow">
<td class="dataTableContent" align="left"><?php echo TEXT_INS;?></td>
<?php
echo xtc_draw_form('shipping_ins', FILENAME_ORDERS_EDIT, 'action=shipping_ins', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
?>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('title', '', 'size="50"');?></td>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('value', '', 'size="10"');?></td>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('tax', '16', 'size="10"');?></td>
<td class="dataTableContent" align="left">
<?php
echo xtc_image_submit('button_save.gif', TEXT_EDIT,'style="cursor:hand" ');
?>
</td>
</form>
</tr>
</table>
<br /><br />
<!-- Versandkostenbearbeitung Ende //-->


<!-- Nachnahmebearbeitung Anfang //-->
<?php
$cod_status = MODULE_ORDER_TOTAL_COD_STATUS;

if ($cod_status == 'true'){

  $cod_query = xtc_db_query("select * from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $_GET['oID'] . "' and class = 'ot_cod_fee' ");
  $cod = xtc_db_fetch_array($cod_query);
  if ($cod['value'] !=''){
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent" width="40%"><b><?php echo TEXT_COD_COSTS . '&nbsp;' . TEXT_DESC;?></b></td>
<td class="dataTableHeadingContent" width="10%"><b><?php echo TEXT_VALUE;?></b></td>
<td class="dataTableHeadingContent" width="10%"><b><?php echo TEXT_TAX;?></b></td>
<td class="dataTableHeadingContent" width="20%">&nbsp;</td>
<td class="dataTableHeadingContent" width="20%">&nbsp;</td>
</tr>
<tr class="dataTableRow">
<?php
echo xtc_draw_form('cod', FILENAME_ORDERS_EDIT, 'action=cod_edit', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('otID', $cod['orders_total_id']);
?>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('title', $cod['title'], 'size="50"');?></td>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('value', $cod['value'], 'size="10"');?></td>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('tax', '16', 'size="10"');?></td>
<td class="dataTableContent" align="left">
<?php
echo xtc_image_submit('button_save.gif', TEXT_EDIT,'style="cursor:hand" ');
?>
</form>
</td>
<td class="dataTableContent" align="left">
<?php
echo xtc_draw_form('cod_del', FILENAME_ORDERS_EDIT, 'action=cod_del', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('otID', $cod['orders_total_id']);
echo xtc_image_submit('button_delete.gif', TEXT_DELETE,'style="cursor:hand" ');
?>
</form>
</td>
</tr>
</table>
<br /><br />
<?php } ?>


<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent" width="20%">&nbsp;</td>
<td class="dataTableHeadingContent" width="40%"><b><?php echo TEXT_COD_COSTS  . '&nbsp;' . TEXT_DESC;?></b></td>
<td class="dataTableHeadingContent" width="10%"><b><?php echo TEXT_VALUE;?></b></td>
<td class="dataTableHeadingContent" width="10%"><b><?php echo TEXT_TAX;?></b></td>
<td class="dataTableHeadingContent" width="20%">&nbsp;</td>
</tr>

<tr class="dataTableRow">
<td class="dataTableContent" align="left"><?php echo TEXT_INS;?></td>
<?php
echo xtc_draw_form('cod_ins', FILENAME_ORDERS_EDIT, 'action=cod_ins', 'post');
echo xtc_draw_hidden_field('cID', $_GET['cID']);
echo xtc_draw_hidden_field('oID', $_GET['oID']);
?>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('title', '', 'size="50"');?></td>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('value', '', 'size="10"');?></td>
<td class="dataTableContent" align="left"><?php echo xtc_draw_input_field('tax', '16', 'size="10"');?></td>
<td class="dataTableContent" align="left">
<?php
echo xtc_image_submit('button_save.gif', TEXT_EDIT,'style="cursor:hand" ');
?>
</td>
</form>
</tr>
</table>
<br /><br />
<?php } ?>
<!-- Nachnahmebearbeitung Ende //-->
















