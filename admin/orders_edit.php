<?php
/* --------------------------------------------------------------
   $Id: orders_edit.php,v 1.1

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(orders.php,v 1.27 2003/02/16); www.oscommerce.com
   (c) 2003	 nextcommerce (orders.php,v 1.7 2003/08/14); www.nextcommerce.org

   Released under the GNU General Public License 

   To do: Rabatte berücksichtigen
   --------------------------------------------------------------*/

  require('includes/application_top.php');

  require_once(DIR_FS_INC . 'xtc_oe_get_tax_rate.inc.php');
  require_once(DIR_FS_INC . 'xtc_oe_get_customers_status.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_tax_class_id.inc.php');
  require_once(DIR_FS_INC . 'xtc_oe_get_allow_tax.inc.php');
  require_once(DIR_FS_INC . 'xtc_oe_get_price_o_tax.inc.php');
  require_once(DIR_FS_INC . 'xtc_oe_get_price_i_tax.inc.php');
  require_once(DIR_FS_INC . 'xtc_oe_get_options_name.inc.php');
  require_once(DIR_FS_INC . 'xtc_oe_get_options_values_name.inc.php');


// Adressbearbeitung Anfang
if ($_GET['action'] == "address_edit") {
          $sql_data_array = array('customers_id' => xtc_db_prepare_input($_POST['customers_id']),
                                  'customers_company' => xtc_db_prepare_input($_POST['customers_company']),
                                  'customers_name' => xtc_db_prepare_input($_POST['customers_name']),
                                  'customers_street_address' => xtc_db_prepare_input($_POST['customers_street_address']),
                                  'customers_city' => xtc_db_prepare_input($_POST['customers_city']),
                                  'customers_postcode' => xtc_db_prepare_input($_POST['customers_postcode']),
                                  'customers_country' => xtc_db_prepare_input($_POST['customers_country']),
                                  'delivery_company' => xtc_db_prepare_input($_POST['delivery_company']),
                                  'delivery_name' => xtc_db_prepare_input($_POST['delivery_name']),
                                  'delivery_street_address' => xtc_db_prepare_input($_POST['delivery_street_address']),
                                  'delivery_city' => xtc_db_prepare_input($_POST['delivery_city']),
                                  'delivery_postcode' => xtc_db_prepare_input($_POST['delivery_postcode']),
                                  'delivery_country' => xtc_db_prepare_input($_POST['delivery_country']),
                                  'billing_company' => xtc_db_prepare_input($_POST['billing_company']),
                                  'billing_name' => xtc_db_prepare_input($_POST['billing_name']),
                                  'billing_street_address' => xtc_db_prepare_input($_POST['billing_street_address']),
                                  'billing_city' => xtc_db_prepare_input($_POST['billing_city']),
                                  'billing_postcode' => xtc_db_prepare_input($_POST['billing_postcode']),
                                  'billing_country' => xtc_db_prepare_input($_POST['billing_country']));

            $update_sql_data = array('last_modified' => 'now()');
            $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
            xtc_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = \'' . xtc_db_input($_POST['oID']) . '\'');

             xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'text=address&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}
// Adressbearbeitung Ende

// Artikel bearbeiten Anfang

if ($_GET['action'] == "product_edit") {

$allow_tax = xtc_oe_get_allow_tax($_POST['cID']);
$customers_status = xtc_oe_get_customers_status($_POST['cID']);

// select Order Currencie
$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');

  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status);

if ($_POST['products_price'] !=''){

if ($allow_tax == '1'){
$inp_price = $_POST['products_price'];
$final_price = ($_POST['products_price']*$_POST['products_quantity']);
}else{
$inp_price = xtc_oe_get_price_o_tax($_POST['products_price'], $_POST['products_tax'], 0);
$final_price = ($inp_price*$_POST['products_quantity']);
}

}else{
$tax_id=xtc_get_tax_class_id($_POST['products_id']);
$final_price=$xtPrice->xtcGetPrice($_POST['products_id'],
                                        $format=false,
                                        $_POST['products_quantity'],
                                        $tax_id,
                                        '');


$inp_price = $final_price;
}

          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['oID']),
                                  'products_id' => xtc_db_prepare_input($_POST['products_id']),
                                  'products_name' => xtc_db_prepare_input($_POST['products_name']),
                                  'products_price' => xtc_db_prepare_input($inp_price),
                                  'products_discount_made' => '',
                                  'final_price' => xtc_db_prepare_input($final_price),
                                  'products_tax' => xtc_db_prepare_input($_POST['products_tax']),
                                  'products_quantity' => xtc_db_prepare_input($_POST['products_quantity']),
                                  'allow_tax' => xtc_db_prepare_input($allow_tax));

            $update_sql_data = array('products_model' => xtc_db_prepare_input($_POST['products_model']));
            $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
            xtc_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array, 'update', 'orders_products_id = \'' . xtc_db_input($_POST['opID']) . '\'');

             xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=products&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}
// Artikel bearbeiten Ende

// Artikel einfügen Anfang

if ($_GET['action'] == "product_ins") {

  $product_query = xtc_db_query("select p.products_model, p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . $_POST['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '2'");
  $product = xtc_db_fetch_array($product_query);

  $tax = xtc_oe_get_tax_rate($product['products_tax_class_id']);
  $customers_status = xtc_oe_get_customers_status($_POST['cID']);
  $tax_id=xtc_get_tax_class_id($_POST['products_id']);

// select Order Currencie
$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status);

  $final_price=$xtPrice->xtcGetPrice($_POST['products_id'],
                                        $format=false,
                                        $_POST['products_quantity'],
                                        $tax_id,
                                        '');

  $final_price=$xtPrice->xtcFormat($final_price,true);

  $inp_price = $final_price;
  $final_price*=$_POST['products_quantity'];
  $allow_tax = xtc_oe_get_allow_tax($_POST['cID']);

          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['oID']),
                                  'products_id' => xtc_db_prepare_input($_POST['products_id']),
                                  'products_name' => xtc_db_prepare_input($product['products_name']),
                                  'products_price' => xtc_db_prepare_input($inp_price),
                                  'products_discount_made' => '',
                                  'final_price' => xtc_db_prepare_input($final_price),
                                  'products_tax' => xtc_db_prepare_input($tax),
                                  'products_quantity' => xtc_db_prepare_input($_POST['products_quantity']),
                                  'allow_tax' => xtc_db_prepare_input($allow_tax));

            $insert_sql_data = array('products_model' => xtc_db_prepare_input($product['products_model']));
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);

             xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=products&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}
// Artikel einfügen Ende

// Versandkosten bearbeiten Anfang

if ($_GET['action'] == "shipping_edit") {
$customers_status = xtc_oe_get_customers_status($_POST['cID']);
$allow_tax = xtc_oe_get_allow_tax($_POST['cID']);

$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status);

if ($allow_tax == '1'){
$inp_price = $_POST['value'];
}else{
$inp_price = xtc_oe_get_price_o_tax($_POST['value'], $_POST['tax'], 0);
}

$text = $xtPrice->xtcFormat($inp_price,false);

          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['oID']),
                                  'title' => xtc_db_prepare_input($_POST['title']),
                                  'value' => xtc_db_prepare_input($inp_price));

            $update_sql_data = array('text' => $text);
            $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
            xtc_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array, 'update', 'orders_total_id = \'' . xtc_db_input($_POST['otID']) . '\'');

             xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=shipping&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}
// Versandkosten bearbeiten Ende

// Versandkosten Einfügen Anfang
if ($_GET['action'] == "shipping_ins") {

$customers_status = xtc_oe_get_customers_status($_POST['cID']);
$allow_tax = xtc_oe_get_allow_tax($_POST['cID']);

$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status);

if ($allow_tax == '1'){
$inp_price = $_POST['value'];
}else{
$inp_price = xtc_oe_get_price_o_tax($_POST['value'], $_POST['tax'], 0);
}

$text = $xtPrice->xtcFormat($inp_price,false);
$sort = MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER;


          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['oID']),
                                  'title' => xtc_db_prepare_input($_POST['title']),
                                  'text' => xtc_db_prepare_input($text),
                                  'value' => xtc_db_prepare_input($inp_price),
                                  'class' => 'ot_shipping');

            $insert_sql_data = array('sort_order' => $sort);
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);

             xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=shipping&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}
// Versandkosten Einfügen Ende

// Nachnahmegebühr bearbeiten Anfang
if ($_GET['action'] == "cod_edit") {

$customers_status = xtc_oe_get_customers_status($_POST['cID']);
$allow_tax = xtc_oe_get_allow_tax($_POST['cID']);

$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status);

if ($allow_tax == '1'){
$inp_price = $_POST['value'];
}else{
$inp_price = xtc_oe_get_price_o_tax($_POST['value'], $_POST['tax'], 0);
}

$text = $xtPrice->xtcFormat($inp_price,false);

          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['oID']),
                                  'title' => xtc_db_prepare_input($_POST['title']),
                                  'value' => xtc_db_prepare_input($inp_price));

            $update_sql_data = array('text' => $text);
            $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
            xtc_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array, 'update', 'orders_total_id = \'' . xtc_db_input($_POST['otID']) . '\'');

             xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=shipping&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}
// Nachnahmegebühr bearbeiten Ende

// Nachnahmegebühr Einfügen Anfang
if ($_GET['action'] == "cod_ins") {
$customers_status = xtc_oe_get_customers_status($_POST['cID']);
$allow_tax = xtc_oe_get_allow_tax($_POST['cID']);

$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status);

if ($allow_tax == '1'){
$inp_price = $_POST['value'];
}else{
$inp_price = xtc_oe_get_price_o_tax($_POST['value'], $_POST['tax'], 0);
}

$text = $xtPrice->xtcFormat($inp_price,false);
$sort = MODULE_ORDER_TOTAL_COD_SORT_ORDER;


          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['oID']),
                                  'title' => xtc_db_prepare_input($_POST['title']),
                                  'text' => xtc_db_prepare_input($text),
                                  'value' => xtc_db_prepare_input($inp_price),
                                  'class' => 'ot_cod_fee');

            $insert_sql_data = array('sort_order' => $sort);
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);

             xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=shipping&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}
// Nachnahmegebühr Einfügen Ende

// Produkt Optionen bearbeiten Anfang

if ($_GET['action'] == "product_option_edit") {



$allow_tax = $_POST['aTX'];
$customers_status = xtc_oe_get_customers_status($_POST['cID']);


$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status);



    // recalculate to standard currency
    if(PRICE_IS_BRUTTO == 'true'){
        $a_price = xtc_round(($_POST['options_values_price']/(1+($_POST['pTX']/100))), PRICE_PRECISION);
    }else{
        $a_price = $a1_price;
    }

    $a_price=$xtPrice->xtcRemoveCurr($a_price);

          $sql_data_array = array('products_options' => xtc_db_prepare_input($_POST['products_options']),
                                  'products_options_values' => xtc_db_prepare_input($_POST['products_options_values']),
                                  'options_values_price' => xtc_db_prepare_input($a_price));

            $update_sql_data = array('price_prefix' => xtc_db_prepare_input($_POST['prefix']));
            $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
            xtc_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array, 'update', 'orders_products_attributes_id = \'' . xtc_db_input($_POST['opAID']) . '\'');

     		$products_query = xtc_db_query("select
            products_id,
            products_price,
            products_tax_class_id
            from
            " . TABLE_PRODUCTS . "
            where
            products_id = '" . $_POST['pID'] . "'");

			$products = xtc_db_fetch_array($products_query);

            $products_a_query = xtc_db_query("select
            options_values_price,
            price_prefix
            from
            " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . "
            where
            orders_id = '" . $_POST['oID'] . "' and
            orders_products_id = '" . $_POST['opID'] . "'");

            while($products_a = xtc_db_fetch_array($products_a_query)){
            $total_price += $products_a['price_prefix'].$products_a['options_values_price'];
            };


$sa_price=$xtPrice->xtcFormat($total_price,false,$products['products_tax_class_id']);

$sp_price = $final_price=$xtPrice->xtcGetPrice($_POST['pID'],
                                        $format=false,
                                        $products['products_tax_class_id'],
                                        $tax_id,
                                        '');


$inp_price = ($sa_price + $sp_price);
$final_price = ($inp_price*$_POST['qTY']);


          $sql_data_array = array('products_price' => xtc_db_prepare_input($inp_price));
          $update_sql_data = array('final_price' => xtc_db_prepare_input($final_price));
          $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
          xtc_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array, 'update', 'orders_products_id = \'' . xtc_db_input($_POST['opID']) . '\'');

          xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=options&oID='.$_POST['oID'].'&cID='.$_POST['cID'].'&pID='.$_POST['pID'].'&pTX='.$_POST['pTX'].'&aTX='.$_POST['aTX'].'&qTY='.$_POST['qTY'].'&opID='.$_POST['opID']));
}

// Produkt Optionen bearbeiten Ende


// Produkt Optionen Einfügen Anfang

if ($_GET['action'] == "product_option_ins") {

$allow_tax = $_POST['aTX'];
$customers_status = xtc_oe_get_customers_status($_POST['cID']);

// select Order Currencie
$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status);

            $products_attributes_query = xtc_db_query("select
            products_attributes_id,
            products_id,
            options_id,
            options_values_id,
            options_values_price,
            price_prefix,
            attributes_model,
            attributes_stock,
            options_values_weight,
            weight_prefix,
            sortorder
            from
            " . TABLE_PRODUCTS_ATTRIBUTES . "
            where
            products_attributes_id = '" . $_POST['aID'] . "'");

            $products_attributes = xtc_db_fetch_array($products_attributes_query);

            $products_options = xtc_oe_get_options_name($products_attributes['options_id']);
            $products_options_values = xtc_oe_get_options_values_name($products_attributes['options_values_id']);

            $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['oID']),
                                    'orders_products_id' => xtc_db_prepare_input($_POST['opID']),
                                    'products_options' => xtc_db_prepare_input($products_options),
                                    'products_options_values' => xtc_db_prepare_input($products_options_values),
                                    'options_values_price' => xtc_db_prepare_input($products_attributes['options_values_price']));

            $insert_sql_data = array('price_prefix' => xtc_db_prepare_input($products_attributes['price_prefix']));
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);


$products_query = xtc_db_query("select products_id, products_price, products_tax_class_id from " . TABLE_PRODUCTS . " where products_id = '" . $_POST['pID'] . "'");
$products = xtc_db_fetch_array($products_query);

$products_a_query = xtc_db_query("select options_values_price, price_prefix from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . $_POST['oID'] . "' and orders_products_id = '" . $_POST['opID'] . "'");
while($products_a = xtc_db_fetch_array($products_a_query)){
$total_price += $products_a['price_prefix'].$products_a['options_values_price'];
};


$sa_price=$xtPrice->xtcFormat($total_price,false,$products['products_tax_class_id']);
$sp_price = $final_price=$xtPrice->xtcGetPrice($_POST['pID'],
                                        $format=false,
                                        $products['products_tax_class_id'],
                                        $tax_id,
                                        '');

$inp_price = ($sa_price + $sp_price);
$final_price = ($inp_price*$_POST['qTY']);


          $sql_data_array = array('products_price' => xtc_db_prepare_input($inp_price));
          $update_sql_data = array('final_price' => xtc_db_prepare_input($final_price));
          $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
          xtc_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array, 'update', 'orders_products_id = \'' . xtc_db_input($_POST['opID']) . '\'');

          xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=options&oID='.$_POST['oID'].'&cID='.$_POST['cID'].'&pID='.$_POST['pID'].'&pTX='.$_POST['pTX'].'&aTX='.$_POST['aTX'].'&qTY='.$_POST['qTY'].'&opID='.$_POST['opID']));
}

// Produkt Optionen Einfügen Ende



// Berechnung der Bestellung Anfang
if ($_GET['action'] == "save_order") {
// Werte für alle Berechnungen
$customers_status = xtc_oe_get_customers_status($_POST['cID']);
$allow_tax = xtc_oe_get_allow_tax($_POST['cID']);


// Errechne neue Zwischensumme für die Bestellung Anfang
  $products_query = xtc_db_query("select SUM(final_price) as subtotal_final from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $_POST['orders_id'] . "' ");
  $products = xtc_db_fetch_array($products_query);
  $subtotal_final = $products['subtotal_final'];


  // select Order Currencie
  $curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['orders_id']."'");
  $curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status);


  $subtotal_text=$xtPrice->xtcFormat($subtotal_final,true);

  xtc_db_query("update " . TABLE_ORDERS_TOTAL . " set text = '" . $subtotal_text . "', value = '" . $subtotal_final . "' where orders_id = '" . $_POST['orders_id'] . "' and class = 'ot_subtotal' ");
// Errechne neue Zwischensumme für die Bestellung Ende


// Errechne neue Netto Zwischensumme für die Bestellung Anfang
if ($allow_tax == '0'){
  $subtotal_no_tax_value_query = xtc_db_query("select SUM(value) as subtotal_no_tax_value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $_POST['orders_id'] . "' and class != 'ot_tax' and class != 'ot_total' and class != 'ot_subtotal_no_tax' and class != 'ot_coupon' and class != 'ot_gv'");
  $subtotal_no_tax_value = xtc_db_fetch_array($subtotal_no_tax_value_query);
  $subtotal_no_tax_final = $subtotal_no_tax_value['subtotal_no_tax_value'];
  $subtotal_no_tax_text=$xtPrice->xtcFormat($subtotal_no_tax_final,true);
//  $subtotal_no_tax_text = $currencies->format(xtc_round($subtotal_no_tax_final,PRICE_PRECISION));
  xtc_db_query("update " . TABLE_ORDERS_TOTAL . " set text = '" . $subtotal_no_tax_text . "', value = '" . $subtotal_no_tax_final . "' where orders_id = '" . $_POST['orders_id'] . "' and class = 'ot_subtotal_no_tax' ");
}
// Errechne neue Netto Zwischensumme für die Bestellung Ende


// Errechne neue MWSt. für die Bestellung Anfang
  // Produkte
  $products_query = xtc_db_query("select final_price, products_tax from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $_POST['orders_id'] . "' ");
  while($products = xtc_db_fetch_array($products_query)){

if ($allow_tax == '1'){
$tax_rate = $products['products_tax'];
$nprice = xtc_oe_get_price_o_tax($products['final_price'], $products['products_tax'], 0);
$bprice = $products['final_price'];
$tax = ($bprice - $nprice);
}else{
$tax_rate = '=';
$nprice = $products['final_price'];
$bprice = xtc_oe_get_price_i_tax($products['final_price'], $products['products_tax'], 0);
$tax = '0';
}
          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['orders_id']),
                                  'n_price' => xtc_db_prepare_input($nprice),
                                  'b_price' => xtc_db_prepare_input($bprice),
                                  'tax' => xtc_db_prepare_input($tax),
                                  'tax_rate' => xtc_db_prepare_input($tax_rate));


            $insert_sql_data = array('class' => 'products');
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_RECALCULATE, $sql_data_array);
  }
  // Produkte Ende


  // Shipping

$tax_check = ORDERS_EDIT_TAX_STATUS;
$tax_value = ORDERS_EDIT_TAX_VALUE;

  $shipping_query = xtc_db_query("select value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $_POST['orders_id'] . "' and class='ot_shipping' ");
  $shipping = xtc_db_fetch_array($shipping_query);

if ($allow_tax == '1'){

if ($tax_check =='true'){
$tax_rate = $tax_value;
$nprice = xtc_oe_get_price_o_tax($shipping['value'], $tax_value, 0);
$bprice = $shipping['value'];
$tax = ($bprice - $nprice);
}else{
$tax_rate = '0';
$nprice = $shipping['value'];
$bprice = $shipping['value'];
$tax = '0';
}

}else{

$tax_rate = '0';
$nprice = $shipping['value'];
$bprice = $shipping['value'];
$tax = '0';

}
          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['orders_id']),
                                  'n_price' => xtc_db_prepare_input($nprice),
                                  'b_price' => xtc_db_prepare_input($bprice),
                                  'tax' => xtc_db_prepare_input($tax),
                                  'tax_rate' => xtc_db_prepare_input($tax_rate));


            $insert_sql_data = array('class' => 'shipping');
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_RECALCULATE, $sql_data_array);

  // Shipping Ende


  // COD

$tax_check = MODULE_ORDER_TOTAL_TAX_STATUS;
$tax_value = MODULE_ORDER_TOTAL_COD_TAX_CLASS;

  $cod_query = xtc_db_query("select value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $_POST['orders_id'] . "' and class='ot_cod_fee' ");
  $cod = xtc_db_fetch_array($cod_query);

if ($allow_tax == '1'){

if ($tax_check =='true'){
$tax_rate = xtc_oe_get_tax_rate($tax_value);
$nprice = xtc_oe_get_price_o_tax($cod['value'], $tax_value, 1);
$bprice = $cod['value'];
$tax = ($bprice - $nprice);
}else{
$tax_rate = '0';
$nprice = $cod['value'];
$bprice = $cod['value'];
$tax = '0';
}

}else{

$tax_rate = '0';
$nprice = $cod['value'];
$bprice = $cod['value'];
$tax = '0';

}
          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['orders_id']),
                                  'n_price' => xtc_db_prepare_input($nprice),
                                  'b_price' => xtc_db_prepare_input($bprice),
                                  'tax' => xtc_db_prepare_input($tax),
                                  'tax_rate' => xtc_db_prepare_input($tax_rate));


            $insert_sql_data = array('class' => 'shipping');
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_RECALCULATE, $sql_data_array);

  // COD Ende

  // Coupon

$tax_check = MODULE_ORDER_TOTAL_COUPON_INC_TAX;
$tax_value = MODULE_ORDER_TOTAL_COUPON_TAX_CLASS;

  $coupon_query = xtc_db_query("select value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $_POST['orders_id'] . "' and class='ot_coupon' ");
  $coupon = xtc_db_fetch_array($coupon_query);

if ($allow_tax == '1'){

if ($tax_check =='true'){
$tax_rate = xtc_oe_get_tax_rate($tax_value);
$nprice = xtc_oe_get_price_o_tax($coupon['value'], $tax_value, 1);
$bprice = $coupon['value'];
$tax = ($bprice - $nprice);
}else{
$tax_rate = '0';
$nprice = $coupon['value'];
$bprice = $coupon['value'];
$tax = '0';
}

}else{

if ($tax_check =='true'){
$tax_rate = xtc_oe_get_tax_rate($tax_value);
$nprice = $coupon['value'];
$bprice = xtc_oe_get_price_i_tax($coupon['value'], $tax_value, 1);
$tax = ($bprice - $nprice);
}else{
$tax_rate = '0';
$nprice = $coupon['value'];
$bprice = $coupon['value'];
$tax = '0';
}

}
          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['orders_id']),
                                  'n_price' => xtc_db_prepare_input(($nprice*-1)),
                                  'b_price' => xtc_db_prepare_input(($bprice*-1)),
                                  'tax' => xtc_db_prepare_input(($tax*-1)),
                                  'tax_rate' => xtc_db_prepare_input($tax_rate));


            $insert_sql_data = array('class' => 'discount');
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_RECALCULATE, $sql_data_array);

  // Coupon Ende


  // GV

$tax_check = MODULE_ORDER_TOTAL_GV_INC_TAX;
$tax_value = MODULE_ORDER_TOTAL_GV_TAX_CLASS;

  $gv_query = xtc_db_query("select value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $_POST['orders_id'] . "' and class='ot_gv' ");
  $gv = xtc_db_fetch_array($gv_query);

if ($allow_tax == '1'){

if ($tax_check =='true'){
$tax_rate = xtc_oe_get_tax_rate($tax_value);
$nprice = xtc_oe_get_price_o_tax($gv['value'], $tax_value, 1);
$bprice = $gv['value'];
$tax = ($bprice - $nprice);
}else{
$tax_rate = '0';
$nprice = $gv['value'];
$bprice = $gv['value'];
$tax = '0';
}

}else{

if ($tax_check =='true'){
$tax_rate = xtc_oe_get_tax_rate($tax_value);
$nprice = $gv['value'];
$bprice = xtc_oe_get_price_i_tax($gv['value'], $tax_value, 1);
$tax = ($bprice - $nprice);
}else{
$tax_rate = '0';
$nprice = $gv['value'];
$bprice = $gv['value'];
$tax = '0';
}

}
          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['orders_id']),
                                  'n_price' => xtc_db_prepare_input(($nprice*-1)),
                                  'b_price' => xtc_db_prepare_input(($bprice*-1)),
                                  'tax' => xtc_db_prepare_input(($tax*-1)),
                                  'tax_rate' => xtc_db_prepare_input($tax_rate));


            $insert_sql_data = array('class' => 'discount');
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_RECALCULATE, $sql_data_array);

  // GV Ende

  // Alte UST Löschen
            xtc_db_query("delete from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . xtc_db_input($_POST['orders_id']) . "' and class='ot_tax'");
  // Alte UST Löschen ENDE

  // Neue UST Zusammenrechnen und in die DB Schreiben

  $ust_query = xtc_db_query("select tax_rate, SUM(tax) as tax_value_new from " . TABLE_ORDERS_RECALCULATE . " where orders_id = '" . $_POST['orders_id'] . "' and tax !='0' GROUP by tax_rate ");
  while($ust = xtc_db_fetch_array($ust_query)){

  $ust_desc_query = xtc_db_query("select tax_description from " . TABLE_TAX_RATES . " where tax_rate = '" . $ust['tax_rate'] . "'");
  $ust_desc = xtc_db_fetch_array($ust_desc_query);

$title = $ust_desc['tax_description'];

if ($ust['tax_value_new']){
$text=$xtPrice->xtcFormat($ust['tax_value_new'],true);



          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['orders_id']),
                                  'title' => xtc_db_prepare_input($title),
                                  'text' => xtc_db_prepare_input($text),
                                  'value' => xtc_db_prepare_input($ust['tax_value_new']),
                                  'class' => 'ot_tax');

            $insert_sql_data = array('sort_order' => MODULE_ORDER_TOTAL_TAX_SORT_ORDER);
            $sql_data_array = xtc_array_merge($sql_data_array, $insert_sql_data);
            xtc_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
}

}
       xtc_db_query("delete from " . TABLE_ORDERS_RECALCULATE . " where orders_id = '" . xtc_db_input($_POST['orders_id']) . "'");

  // Neue UST Zusammenrechnen und in die DB Schreiben ENDE


// Errechne neue MWSt. für die Bestellung Ende

// Errechne neue Gesamtsumme für die Bestellung Anfang

if ($allow_tax =='1'){
  $total_query = xtc_db_query("select SUM(value) as value_new from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$_POST['orders_id'] . "' and class!='ot_coupon' and class!='ot_gv' and class!='ot_tax' and class!='ot_total'");
}else{
  $total_query = xtc_db_query("select SUM(value) as value_new from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$_POST['orders_id'] . "' and class!='ot_coupon' and class!='ot_gv' and class!='ot_subtotal_no_tax' and class!='ot_total'");
}
  $total = xtc_db_fetch_array($total_query);

  // check if there is a Gift voucher in order
  $gift_query = xtc_db_query("SELECT value FROM ". TABLE_ORDERS_TOTAL. " WHERE orders_id = '".(int)$_POST['orders_id']."' and class='ot_gv'");
  $gift_data = xtc_db_fetch_array($gift_query);

  if (isset($gift_data['value'])) $total['value_new']-=$gift_data['value'];
  // end gift

  // check if there us a voucher coupon
  $coupon_query = xtc_db_query("SELECT value,title FROM ". TABLE_ORDERS_TOTAL. " WHERE orders_id = '".(int)$_POST['orders_id']."' and class='ot_coupon'");
  $coupon_data = xtc_db_fetch_array($coupon_query);

  // get coupon Code
  if (isset($coupon_data['value'])) {

      $code=explode(":", $coupon_data['title']);
      $code=$code[1];
      // query for couponcode to check if its % or ammount
      $c_query = xtc_db_query("SELECT coupon_type,coupon_amount FROM ". TABLE_COUPONS ." WHERE coupon_code = '".$code."'");
      $c_data = xtc_db_fetch_array($c_query);

      if ($c_data['coupon_type'] == 'P') {

         $coup_ammount = $total['value_new']/100*$c_data['coupon_amount'];
         $total['value_new']-=$coup_ammount;

         $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['orders_id']),
                                  'value' => xtc_db_prepare_input($coup_ammount));

         $text=$xtPrice->xtcFormat($coup_ammount,true);

         $update_sql_data = array('text' => '<b><font color="ff0000">- '.$text.'</font></b>');
         $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
         xtc_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array, 'update', 'orders_id = \'' . xtc_db_input($_POST['orders_id']) . '\' and class="ot_coupon"');


      } else {

         $total['value_new']-=$c_data['coupon_amount'];

      }




  }

$text=$xtPrice->xtcFormat($total['value_new'],true);


          $sql_data_array = array('orders_id' => xtc_db_prepare_input($_POST['orders_id']),
                                  'value' => xtc_db_prepare_input($total['value_new']));

            $update_sql_data = array('text' => $text);
            $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
            xtc_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array, 'update', 'orders_id = \'' . xtc_db_input($_POST['orders_id']) . '\' and class="ot_total"');



            xtc_redirect(xtc_href_link(FILENAME_ORDERS, 'action=edit&oID=' . $_POST['orders_id']));
}
// Errechne neue Gesamtsumme für die Bestellung Ende

// Löschfunktionen Anfang

if ($_GET['action'] == "product_delete") {



			$products_attributes_query = xtc_db_query("select orders_products_attributes_id from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_products_id = '" . xtc_db_input($_POST['opID']) . "'");
//            if (!xtc_db_num_rows(products_attributes_query)) {
//            }else{
            xtc_db_query("delete from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_products_id = '" . xtc_db_input($_POST['opID']) . "'");
//            }

            xtc_db_query("delete from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . xtc_db_input($_POST['oID']) . "' and orders_products_id = '" . xtc_db_input($_POST['opID']) . "'");

            xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=products&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}

if ($_GET['action'] == "product_option_delete") {

        // select Order Currencie
$curr_query=xtc_db_query("SELECT currency FROM ".TABLE_ORDERS." WHERE orders_id='".(int)$_POST['oID']."'");
$curr_data=xtc_db_fetch_array($curr_query);

  require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
  $xtPrice = new xtcPrice($curr_data['currency'],$customers_status['customers_status_id']);

            xtc_db_query("delete from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . xtc_db_input($_POST['oID']) . "' and orders_products_attributes_id = '" . xtc_db_input($_POST['opAID']) . "'");

$products_query = xtc_db_query("select products_id, products_price, products_tax_class_id from " . TABLE_PRODUCTS . " where products_id = '" . $_POST['pID'] . "'");
$products = xtc_db_fetch_array($products_query);

$products_a_query = xtc_db_query("select options_values_price, price_prefix from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . $_POST['oID'] . "' and orders_products_id = '" . $_POST['opID'] . "'");
while($products_a = xtc_db_fetch_array($products_a_query)){
$total_price += $products_a['price_prefix'].$products_a['options_values_price'];
};


$sa_price=$xtPrice->xtcFormat($total_price,false,$products['products_tax_class_id']);
$sp_price=$xtPrice->xtcGetPrice($_POST['pID'],
                                        $format=false,
                                        1,
                                        $products['products_tax_class_id'],
                                        '');


$inp_price = ($sa_price + $sp_price);
$final_price = ($inp_price*$_POST['qTY']);


          $sql_data_array = array('products_price' => xtc_db_prepare_input($inp_price));
          $update_sql_data = array('final_price' => xtc_db_prepare_input($final_price));
          $sql_data_array = xtc_array_merge($sql_data_array, $update_sql_data);
          xtc_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array, 'update', 'orders_products_id = \'' . xtc_db_input($_POST['opID']) . '\'');


             xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=products&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}

if ($_GET['action'] == "shipping_del") {
            xtc_db_query("delete from " . TABLE_ORDERS_TOTAL . " where orders_total_id = '" . xtc_db_input($_POST['otID']) . "'");
            xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=shipping&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}

if ($_GET['action'] == "cod_del") {
            xtc_db_query("delete from " . TABLE_ORDERS_TOTAL . " where orders_total_id = '" . xtc_db_input($_POST['otID']) . "'");
            xtc_redirect(xtc_href_link(FILENAME_ORDERS_EDIT, 'edit_action=shipping&cID='.$_POST['cID'].'&oID=' . $_POST['oID']));
}

// Löschfunktionen Ende


?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo TABLE_HEADING;?></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
  <tr>
<td>
<!-- Anfang //-->
<br><br>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent" align="left">
<?php
echo xtc_draw_form('select_address', FILENAME_ORDERS_EDIT, '', 'GET');
echo xtc_draw_hidden_field('edit_action', 'address');
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('cID', $_GET[cID]);
echo xtc_image_submit('button_orders_address_edit.gif', TEXT_EDIT_ADDRESS,'style="cursor:hand" ');
?>
</form>
</td>
<td class="dataTableHeadingContent" align="left">
<?php
echo xtc_draw_form('select_products', FILENAME_ORDERS_EDIT, '', 'GET');
echo xtc_draw_hidden_field('edit_action', 'products');
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('cID', $_GET[cID]);
echo xtc_image_submit('button_orders_products_edit.gif', TEXT_EDIT_PRODUCTS,'style="cursor:hand" ');
?>
</form>
</td>
<td class="dataTableHeadingContent" align="left">
<?php
echo xtc_draw_form('select_shipping', FILENAME_ORDERS_EDIT, '', 'GET');
echo xtc_draw_hidden_field('edit_action', 'shipping');
echo xtc_draw_hidden_field('oID', $_GET['oID']);
echo xtc_draw_hidden_field('cID', $_GET[cID]);
echo xtc_image_submit('button_orders_shipping_edit.gif', TEXT_EDIT_SHIPPING,'style="cursor:hand" ');
?>
</form>
</td>
<td class="dataTableHeadingContent" align="left">
<?php
//echo xtc_draw_form('select_gift', FILENAME_ORDERS_EDIT, '', 'GET');
//echo xtc_draw_hidden_field('edit_action', 'gift');
//echo xtc_draw_hidden_field('oID', $_GET['oID']);
//echo xtc_draw_hidden_field('cID', $_GET[cID]);
//echo xtc_image_submit('button_orders_gift_edit.gif', TEXT_EDIT_GIFT,'style="cursor:hand" ');
?>
</form>
</td>
</tr>
</table>

<!-- Meldungen Anfang //-->
<br><br>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr>
<td class="main">
<b>
<?php
if($_GET['text']=='address'){
echo TEXT_EDIT_ADDRESS_SUCCESS;
}
?>
</b>
</td>
</tr>
</table>
<!-- Meldungen Ende //-->
<?php
if ($_GET['edit_action']=='address'){
  include('orders_edit_address.php');
} elseif ($_GET['edit_action']=='products'){
  include('orders_edit_products.php');
} elseif ($_GET['edit_action']=='shipping'){
  include('orders_edit_shipping.php');
} elseif ($_GET['edit_action']=='options'){
  include('orders_edit_options.php');
}
?>

<!-- Bestellung Sichern Anfang //-->
<br><br>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr class="dataTableRow">
<td class="dataTableContent" align="right">
<?php
echo TEXT_SAVE_ORDER;
echo xtc_draw_form('save_order', FILENAME_ORDERS_EDIT, 'action=save_order', 'post');
echo xtc_draw_hidden_field('customers_status_id', $address[customers_status]);
echo xtc_draw_hidden_field('orders_id', $_GET['oID']);
echo xtc_draw_hidden_field('cID', $_GET[cID]);
echo xtc_image_submit('button_save.gif', TEXT_BUTTON_SAVE_ORDER,'style="cursor:hand" ');
?>
</form>
</td>
</tr>

</table>
<br><br>
<!-- Bestellung Sichern Ende //-->


<!-- Ende //-->
</td>
  </tr>

<!-- body_text_eof //-->
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>