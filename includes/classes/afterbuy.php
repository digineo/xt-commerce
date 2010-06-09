<?php
/* -----------------------------------------------------------------------------------------
   $Id: afterbuy.php  

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(Coding Standards); www.oscommerce.com 

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


class xtc_afterbuy_functions {
      var $order_id;

      // constructor
function xtc_afterbuy_functions($order_id) {
               $this->order_id=$order_id;
}

function process_order() {

// ############ SETTINGS ################

   // PartnerID
   $PartnerID=AFTERBUY_PARTNERID;

   // your PASSWORD for your PartnerID
   $PartnerPass=AFTERBUY_PARTNERPASS;

   // Your Afterbuy USERNAME
   $UserID=AFTERBUY_USERID;

   // new Orderstatus ID of processed order
   $order_status=AFTERBUY_ORDERSTATUS;

// ######################################




	$oID=$this->order_id;
    $customer=array();
    $afterbuy_URL='https://www.afterbuy.de/afterbuy/ShopInterface.asp';

    // connect
    $ch = curl_init();

    // This is the URL that you want PHP to fetch.
    // You can also set this option when initializing a session with the curl_init()  function.
    curl_setopt($ch, CURLOPT_URL,"$afterbuy_URL");


    // curl_setopt($ch, CURLOPT_CAFILE, 'D:/curl-ca.crt');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    // Set this option to a non-zero value if you want PHP to do a regular HTTP POST.
    // This POST is a normal application/x-www-form-urlencoded  kind, most commonly used by HTML forms.
    curl_setopt($ch, CURLOPT_POST, 1);

    // get order data
    $o_query=xtc_db_query("SELECT * FROM ".TABLE_ORDERS." WHERE orders_id='".$oID."'");
    $oData=xtc_db_fetch_array($o_query);

    // customers Address
    $customer['id']=$oData['customers_id'];
    $customer['firma']=$oData['customers_company'];
    list($customer['vorname'],$customer['nachname']) = split(" ",ereg_replace("&","%38",$oData['customers_name']));
    $customer['strasse'] = ereg_replace(" ","%20",$oData['customers_street_address']);
    $customer['plz'] = $oData['customers_postcode'];
    $customer['ort'] = ereg_replace(" ","%20",$oData['customers_city']);
    $customer['tel'] = $oData['customers_telephone'];
    $customer['fax'] = "";
    $customer['mail'] = $oData['customers_email_address'];

        // get ISO code
    $ctr_query=xtc_db_query("SELECT countries_iso_code_2 FROM ".TABLE_COUNTRIES." WHERE  countries_name='".$oData['customers_country']."'");

    $crt_data=xtc_db_fetch_array($ctr_query);
    $customer['land']=$crt_data['countries_iso_code_2'];


    // get gender
    $c_query=xtc_db_query("SELECT customers_gender FROM ".TABLE_CUSTOMERS." WHERE customers_id='".$customer['id']."'");
    $c_data=xtc_db_fetch_array($c_query);
    switch ($c_data['customers_gender']) {
            case 'm':
                 $customer['gender']='Herr';
                 break;
            default:
                 $customer['gender']='Frau';
                 break;
    }


    // Delivery Address
    $customer['d_firma'] = $oData['delivery_company'];
    list($customer['d_vorname'],$customer['d_nachname']) = split(" ",ereg_replace("&","%38",$oData['delivery_name']));
    $customer['d_strasse'] = ereg_replace(" ","%20",$oData['delivery_street_address']);
    $customer['d_plz'] = $oData['delivery_postcode'];
    $customer['d_ort'] = ereg_replace(" ","%20",$oData['delivery_city']);

    // get ISO code
    $ctr_query=xtc_db_query("SELECT countries_iso_code_2 FROM ".TABLE_COUNTRIES." WHERE  countries_name='".$oData['delivery_country']."'");

    $crt_data=xtc_db_fetch_array($ctr_query);
    $customer['d_land']=$crt_data['countries_iso_code_2'];


    // get products related to order
    $p_query=xtc_db_query("SELECT * FROM ".TABLE_ORDERS_PRODUCTS." WHERE orders_id='".$oID."'");

    $p_count=xtc_db_num_rows($p_query);
     // init GET string
     $DATAstring = "Action=new&";
     $DATAstring .= "PartnerID=".$PartnerID."&";
     $DATAstring .= "PartnerPass=".$PartnerPass."&";
     $DATAstring .= "UserID=".$UserID."&";
     $DATAstring .= "Kbenutzername=" . $customer['id'] . "_XTC-ORDER_" . $oID . "&";
     $DATAstring .= "Kanrede=" . $customer['gender'] . "&";
     $DATAstring .= "KFirma=" . $customer['firma'] . "&";
     $DATAstring .= "KVorname=" . $customer['vorname'] . "&";
     $DATAstring .= "KNachname=" . $customer['nachname'] . "&";
     $DATAstring .= "KStrasse=" . $customer['strasse'] . "&";
     $DATAstring .= "KPLZ=" . $customer['plz'] . "&";
     $DATAstring .= "KOrt=" . $customer['ort'] . "&";
     $DATAstring .= "Ktelefon=" . $customer['tel'] . "&";
     $DATAstring .= "Kfax=&";
     $DATAstring .= "Kemail=" . $customer['mail'] . "&";
     $DATAstring .= "KLand=" . $customer['land'] . "&";
     $DATAstring .= "Lieferanschrift=1&";


     // Delivery Address
     $DATAstring .= "KLFirma=" . $customer['d_firma'] . "&";
     $DATAstring .= "KLVorname=" . $customer['d_vorname'] . "&";
     $DATAstring .= "KLNachname=" . $customer['d_nachname'] . "&";
     $DATAstring .= "KLStrasse=" . $customer['d_strasse'] . "&";
     $DATAstring .= "KLPLZ=" . $customer['d_plz'] . "&";
     $DATAstring .= "KLOrt=" . $customer['d_ort'] . "&";
     $DATAstring .= "KLLand=" . $customer['d_land'] . "&";


     // products_data
     $nr=0;
     $anzahl=0;
     while ($pDATA=xtc_db_fetch_array($p_query))  {
                $nr++;
                $artnr = $pDATA['products_model'];
                if ($artnr=='') $artnr=$pDATA['products_id'];
                $DATAstring .= "Artikelnr_" . $nr . "=" . $artnr . "&";
                $DATAstring .= "Artikelname_" . $nr . "=" . ereg_replace("&","%38",ereg_replace("\"","",ereg_replace(" ","%20",$pDATA['products_name']))) . "&";
                $price = ereg_replace("\.",",",$pDATA['products_price']);
                $tax = ereg_replace("\.",",",$pDATA['products_tax']);


                $DATAstring .= "ArtikelEPreis_" . $nr . "=" . $price . "&";
                $DATAstring .= "ArtikelMwst_" . $nr . "=" . $tax . "&";
                $DATAstring .= "ArtikelMenge_" . $nr . "=" . $pDATA['products_quantity'] . "&";
                $url=HTTP_SERVER . DIR_WS_CATALOG . 'product_info.php?products_id=' . $pDATA['products_id'];
                $DATAstring .= "ArtikelLink_" . $nr . "=" . $url . "&";
                $anzahl += $pDATA['products_quantity'];
     }



       $order_total_query=xtc_db_query("SELECT
                      class,
                      value,
                      sort_order
                      FROM ".TABLE_ORDERS_TOTAL."
                      WHERE orders_id='".$oID."'
                      ORDER BY sort_order ASC");

       $order_total=array();
        $zk='';
        $cod_fee='';
        $cod_flag=false;
        $discount_flag=false;
        $gv_flag=false;
        $gv='';
         while ($order_total_values = xtc_db_fetch_array($order_total_query)) {

              $order_total[]=array(
              'CLASS'=> $order_total_values['class'],
              'VALUE'=> $order_total_values['value']);

              // shippingcosts
              if ($order_total_values['class']=='ot_shipping') $shipping=$order_total_values['value'];
              // nachnamegeb¸hr
              if ($order_total_values['class']=='ot_cod_fee') {
              	$cod_flag=true;
              	$cod_fee=$order_total_values['value'];
              }
              // rabatt
              if ($order_total_values['class']=='ot_discount') {
              	$discount_flag=true;
              	$discount=$order_total_values['value'];
              }
              // Gutschein
              if ($order_total_values['class']=='ot_gv') {
              	$gv_flag=true;
              	$gv=$order_total_values['value'];
              }


         }

    // add cod as product
    if ($cod_flag) {
    // cod tax class
//    MODULE_ORDER_TOTAL_COD_TAX_CLASS
      $nr++;
       $DATAstring .= "Artikelnr_" . $nr . "=99999999&";
       $DATAstring .= "Artikelname_" . $nr . "=Nachname&";
       $cod_fee = ereg_replace("\.",",",$cod_fee);
       $DATAstring .= "ArtikelEPreis_" . $nr . "=" . $cod_fee . "&";
       $DATAstring .= "ArtikelMwst_" . $nr . "=" . $tax . "&";
       $DATAstring .= "ArtikelMenge_" . $nr . "=1&";
       $p_count++;
    }

    // rabatt
    if ($discount_flag) {
      $nr++;
       $DATAstring .= "Artikelnr_" . $nr . "=99999998&";
       $DATAstring .= "Artikelname_" . $nr . "=Rabatt&";
       $discount = ereg_replace("\.",",",$discount);
       $DATAstring .= "ArtikelEPreis_" . $nr . "=" . $discount . "&";
       $DATAstring .= "ArtikelMwst_" . $nr . "=" . $tax . "&";
       $DATAstring .= "ArtikelMenge_" . $nr . "=1&";
       $p_count++;
    }
    // Gutschein
    if ($gv_flag) {
      $nr++;
       $DATAstring .= "Artikelnr_" . $nr . "=99999997&";
       $DATAstring .= "Artikelname_" . $nr . "=Gutschein&";
       $gv = ereg_replace("\.",",",($gv*(-1)));
       $DATAstring .= "ArtikelEPreis_" . $nr . "=" . $gv . "&";
       $DATAstring .= "ArtikelMwst_" . $nr . "=0&";
       $DATAstring .= "ArtikelMenge_" . $nr . "=1&";
       $p_count++;
    }

    $DATAstring .= "PosAnz=".$p_count."&";

    $vK = ereg_replace("\.",",",$shipping);

    if ($oData['payment_method']=='cod') $oData['payment_method']='Nachname';

    $s_method=explode('(',$oData['shipping_method']);
    $s_method=str_replace(' ','%20',$s_method[0]);

    $DATAstring .= "kommentar=".$oData['comments']."&";
    $DATAstring .= "Versandart=".$s_method."&";
    $DATAstring .= "Versandkosten=" . $vK . "&";
    $DATAstring .= "NoVersandCalc=1&";
    $DATAstring .= "Zahlart=" . $oData['payment_method'] . "";



    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $DATAstring);
    $result = curl_exec($ch);

    if (ereg("<success>1</success>",$result)) {
    // result ok, mark order
    // extract ID from result
    $cdr=explode('<KundenNr>',$result);
    $cdr=explode('</KundenNr>',$cdr[1]);
    $cdr=$cdr[0];
    xtc_db_query("update ".TABLE_ORDERS." set afterbuy_success='1',afterbuy_id='".$cdr."' where orders_id='".$oID."'");

    //set new order status
    if ($order_status!='') {
    xtc_db_query("update ".TABLE_ORDERS." set orders_status='".$order_status."' where orders_id='".$oID."'");
    }
     } else {
    // mail to shopowner
    $mail_content='Fehler bei ‹bertragung der Bestellung: '.$oID.chr(13).chr(10).
                   'Folgende Fehlermeldung wurde vom afterbuy.de zur¸ckgegeben:'.chr(13).chr(10).$result;


    mail(EMAIL_BILLING_ADDRESS,"Afterbuy-Fehl¸bertragung",$mail_content);

}
// close session
curl_close ($ch);
}

// Funktion zum ‹berpr¸fen ob Bestellung bereits an Afterbuy gesendet.
function order_send() {

	$check_query=xtc_db_query("SELECT afterbuy_success FROM ".TABLE_ORDERS." WHERE orders_id='".$this->order_id."'");
    $data=xtc_db_fetch_array($check_query);

    if ($data['afterbuy_success']==1) return false;
    return true;


}


}

?>