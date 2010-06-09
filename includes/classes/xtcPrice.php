<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtcPrice.php,v 1.1 2003/09/06 22:13:53 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(currencies.php,v 1.15 2003/03/17); www.oscommerce.com
   (c) 2003         nextcommerce (currencies.php,v 1.9 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/



class xtcPrice {
 var $currencies;

 // class constructor
 function xtcPrice($currency,$cGroup) {
  
  $this->currencies=array();
  $this->cStatus=array();
  $this->actualGroup=$cGroup;
  $this->actualCurr=$currency;

  // select Currencies

       $currencies_query = "SELECT *
                                    FROM
                                         " . TABLE_CURRENCIES;
       $currencies_query = xtDBquery($currencies_query);
      while ($currencies = xtc_db_fetch_array(&$currencies_query,true)) {
        $this->currencies[$currencies['code']] = array('title' => $currencies['title'],
                                                       'symbol_left' => $currencies['symbol_left'],
                                                       'symbol_right' => $currencies['symbol_right'],
                                                       'decimal_point' => $currencies['decimal_point'],
                                                       'thousands_point' => $currencies['thousands_point'],
                                                       'decimal_places' => $currencies['decimal_places'],
                                                       'value' => $currencies['value']);
      }
      // select Customers Status data
      $customers_status_query = "SELECT *
                                        FROM
                                             " . TABLE_CUSTOMERS_STATUS . "
                                        WHERE
                                             customers_status_id = '" . $this->actualGroup . "' AND language_id = '" . $_SESSION['languages_id'] . "'";
      $customers_status_query = xtDBquery(&$customers_status_query);
      $customers_status_value = xtc_db_fetch_array(&$customers_status_query,true);
            $this->cStatus= array(
                    'customers_status_id' => $this->actualGroup,
                    'customers_status_name' => $customers_status_value['customers_status_name'],
                    'customers_status_image' => $customers_status_value['customers_status_image'],
                    'customers_status_public' => $customers_status_value['customers_status_public'],
                    'customers_status_discount' => $customers_status_value['customers_status_discount'],
                    'customers_status_ot_discount_flag' => $customers_status_value['customers_status_ot_discount_flag'],
                    'customers_status_ot_discount' => $customers_status_value['customers_status_ot_discount'],
                    'customers_status_graduated_prices' => $customers_status_value['customers_status_graduated_prices'],
                    'customers_status_show_price' => $customers_status_value['customers_status_show_price'],
                    'customers_status_show_price_tax' => $customers_status_value['customers_status_show_price_tax'],
                    'customers_status_add_tax_ot' => $customers_status_value['customers_status_add_tax_ot'],
                    'customers_status_payment_unallowed' => $customers_status_value['customers_status_payment_unallowed'],
                    'customers_status_shipping_unallowed' => $customers_status_value['customers_status_shipping_unallowed'],
                    'customers_status_discount_attributes' => $customers_status_value['customers_status_discount_attributes'],
                    'customers_fsk18' => $customers_status_value['customers_fsk18'],
                    'customers_fsk18_display' => $customers_status_value['customers_fsk18_display']
                                );


 }

 // get products Price
 function xtcGetPrice($pID,$format=true,$qty,$tax_class,$pPrice) {

        // check if group is allowed to see prices
        if ($this->cStatus['customers_status_show_price'] == '0') return $this->xtcShowNote();

        // get Tax rate
        $products_tax=xtc_get_tax_rate($tax_class);
        if ($this->cStatus['customers_status_show_price_tax'] =='0') $products_tax='';


        // add taxes
        if ($pPrice==0) $pPrice=$this->getPprice($pID);
        $pPrice = $this->xtcAddTax($pPrice,$products_tax);

        // check specialprice
        if ($sPrice = $this->xtcCheckSpecial($pID)) return $this->xtcFormatSpecial($this->xtcAddTax($sPrice,$products_tax),$pPrice,$format);

        // check Product Discount
        if ($discount = $this->xtcCheckDiscount($pID)) return $this->xtcFormatSpecialDiscount($discount,$pPrice,$format);

        // check graduated+Group Price
        if ($this->cStatus['customers_status_graduated_prices']=='1'){
        if ($sPrice = $this->xtcGetGraduatedPrice($pID,$qty)) return $this->xtcFormatSpecialGraduated($this->xtcAddTax($sPrice,$products_tax),$pPrice,$format);
        }

        return $this->xtcFormat($pPrice,$format);

 }

 function getPprice($pID) {

     $pQuery="SELECT products_price FROM ".TABLE_PRODUCTS." WHERE products_id='".$pID."'";
     $pQuery = xtDBquery($pQuery);
     $pData=xtc_db_fetch_array(&$pQuery,true);
     return $pData['products_price'];

 }

 function xtcAddTax($price,$tax) {
    $price=$price+$price/100*$tax;
    $price = $this->xtcCalculateCurr($price);
    return $price;
 }

 function xtcCheckDiscount($pID) {

  // check if group got discount
  if ($this->cStatus['customers_status_discount'] != '0.00' ) {

   $discount_query="SELECT products_discount_allowed FROM ".TABLE_PRODUCTS." WHERE products_id = '".$pID."'";
   $discount_query = xtDBquery($discount_query);
   $dData=xtc_db_fetch_array(&$discount_query,true);

   $discount = $dData['products_discount_allowed'];
   if ($this->cStatus['customers_status_discount'] < $discount) $discount =  $this->cStatus['customers_status_discount'];
   if ($discount == '0.00') return false;
   return $discount;

  }
   return false;
 }


 function xtcGetGraduatedPrice($pID,$qty) {
        $graduated_price_query="SELECT max(quantity) as qty
                                FROM personal_offers_by_customers_status_".$this->cStatus['customers_status_id']."
                                WHERE products_id='".$pID."'
                                AND quantity<='".$qty."'";
        $graduated_price_query = xtDBquery($graduated_price_query);
        $graduated_price_data=xtc_db_fetch_array(&$graduated_price_query,true);
        if ($graduated_price_data['qty']) {
        $graduated_price_query="SELECT personal_offer
                                FROM personal_offers_by_customers_status_".$this->cStatus['customers_status_id']."
                                WHERE products_id='".$pID."'
                                AND quantity='".$graduated_price_data['qty']."'";
        $graduated_price_query = xtDBquery($graduated_price_query);
        $graduated_price_data=xtc_db_fetch_array(&$graduated_price_query,true);

        $sPrice=$graduated_price_data['personal_offer'];
        if ($sPrice != 0.00 ) return $sPrice;
        } else {
            return;
        }


 }


 function xtcShowNote() {
   return '<font size="-1">'.NOT_ALLOWED_TO_SEE_PRICES.'</font>';
 }

 function xtcCheckSpecial($pID) {
    $product_query = "select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . $pID . "' and status";
    $product_query = xtDBquery($product_query);
    $product = xtc_db_fetch_array(&$product_query,true);

    return $product['specials_new_products_price'];

 }

  function xtcCalculateCurr($price) {
        return $this->currencies[$this->actualCurr]['value']*$price;
 }

 function xtcRemoveCurr($price) {

     // check if used Curr != DEFAULT curr
     if (DEFAULT_CURRENCY!=$this->actualCurr) {
      return $price*(1/$this->currencies[$this->actualCurr]['value']);
     } else {
      return $price;
     }

 }


 /*
 *
 *    Format Functions
 *
 *
 *
 */

  function xtcFormat($price,$format,$tax_class=0,$curr=false) {

      if ($curr) $price=$this->xtcCalculateCurr($price);

  if ($tax_class!=0)   {
   $products_tax=xtc_get_tax_rate($tax_class);
   if ($this->cStatus['customers_status_show_price_tax'] =='0') $products_tax='';
   $price=$this->xtcAddTax($price,$products_tax);
  }

  if ($format) {
   $price=number_format($price,$this->currencies[$this->actualCurr]['decimal_places'], $this->currencies[$this->actualCurr]['decimal_point'], $this->currencies[$this->actualCurr]['thousands_point']);
   $price = $this->currencies[$this->actualCurr]['symbol_left']. ' '.$price.' '.$this->currencies[$this->actualCurr]['symbol_right'];
   return $price;

  } else {

   return $price;

  }

 }

 function xtcFormatSpecialDiscount($discount,$pPrice,$format) {
    $sPrice =  $pPrice-($pPrice / 100)*$discount;
   if ($format) {
    return '<font size="-1" color="#ff0000">Statt <s>'
                .$this->xtcFormat($pPrice,$format).
                '</s></font><br>Nur '
                .$this->xtcFormat($sPrice,$format).
                '<br><font size="-1">Sie Sparen '
                .$discount.
                '%';
   } else {
    return $sPrice;
   }
 }

function xtcFormatSpecial($sPrice,$pPrice,$format) {
  if ($format) {
  return '<font size="-1" color="#ff0000">Statt <s>'
        .$this->xtcFormat($pPrice,$format).
        '</s></font><br>Nur '.
        $this->xtcFormat($sPrice,$format);
  } else {
   return $sPrice;
  }
 }

function xtcFormatSpecialGraduated($sPrice,$pPrice,$format) {
  if ($format) {
   if ($sPrice != $pPrice) {
   return '<font size="-1" color="#ff0000">UVP <s>'.$this->xtcFormat($pPrice,$format).'</s></font><br>Ihr Preis '.$this->xtcFormat($sPrice,$format);
   } else {
   return 'Ab '.$this->xtcFormat($sPrice,$format);
   }
  } else {
   return $sPrice;
  }
}

function get_decimal_places($code) {
      return $this->currencies[$this->actualCurr]['decimal_places'];
    }


}

?>