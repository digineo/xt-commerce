<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_validate_vatid.inc.php

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

// die Hauptfunktion
function validate_vatid($uistid)
{
	/******************************************************************
	* config                                                          *
	******************************************************************/

      $live_check = ACCOUNT_COMPANY_VAT_LIVE_CHECK;

	// Folgende Zeichen entfernen ignorieren
	$remove = array(' ', '-', '/', '\\', '.', ':', ',');

	// Die Rueckgabewerte. Bitte nach eigenem Gusto bestimmen!
	$results = array(0 => '0', 1 => '1', 8 => '8', 9 => '9');
    //$results = array(0 => 'false', 1 => 'true', 8 => 'unknown country', 9 => 'unknown algorithm');
	// Leerzeichen und Zeilenumbrueche entfernen
	$uistid = trim(chop($uistid));

    // Überprüfung ob Eigene USTid vorhanden und live check gewünscht wird.

    if (($eustid)&&($live_check==true)){
    $live_check = true;
    }else{
    $live_check = false;
    }

	/* end config
	******************************************************************/
		
	// sonderzeichen entfernen
	for($i = 0; $i < count($remove); $i++)
	{
		$uistid = str_replace($remove[$i], '', $uistid);
	} // end for($i = 0; $i < count($remove)); $i++)

	// land bestimmen
	$country = strtolower(substr($uistid, 0, 2));
	
	// je nach land anders behandeln
	switch($country)
	{
		case 'ad': // andorra
			return $results[9];

		case 'be': // belgien
			return $results[checkUstID_be($uistid)];

		case 'bg': // bulgarien
			return $results[9];

		case 'dk': // daenemark
			return $results[checkUstId_dk($uistid)];
			
		case 'de': // deutschland
			return $results[checkUstId_de($uistid)];
			
		case 'ee': // estland
			return $results[checkUstId_ee($uistid)];

		case 'fi': // finnland
			return $results[checkUstId_fi($uistid)];

		case 'fr': // frankreich
			return $results[checkUstId_fr($uistid)];

		case 'gi': // gibraltar
			return $results[9];

		case 'el': // griechenland
			return $results[checkUstId_el($uistid)];

		case 'gb': // grossbrittanien
        case 'uk': // grossbrittanien
			return $results[checkUstId_gb($uistid)];
			
		case 'ie': // irland
			return $results[checkUstId_ie($uistid)];

		case 'is': // island
			return $results[9];

		case 'it': // italien
			return $results[checkUstId_it($uistid)];

		case 'lv': // lettland
			return $results[checkUstId_lv($uistid)];

		case 'lt': // litauen
			return $results[checkUstId_lt($uistid)];

		case 'lu': // luxemburg
			return $results[checkUstId_lu($uistid)];

		case 'mt': // malta
			return $results[checkUstId_mt($uistid)];

		case 'nl': // niederlande
			return $results[checkUstId_nl($uistid)];

		case 'no': // norwegen
			return $results[9];
			
		case 'at': // oesterreich
			return $results[checkUstId_at($uistid)];

		case 'pl': // polen
			return $results[checkUstId_pl($uistid)];

		case 'pt': // portugal
			return $results[checkUstId_pt($uistid)];

		case 'ro': // rumaenien
			return $results[9];

		case 'se': // schweden
			return $results[checkUstId_se($uistid)];
		
		case 'ch': // schweiz
			return $results[9];

		case 'sk': // slowakai
			return $results[checkUstId_sk($uistid)];

		case 'si': // slowenien
		case 'sl': // welches ist richtig?
			return $results[checkUstId_si($uistid)];

		case 'es': // spanien
			return $results[checkUstId_es($uistid)];

		case 'cz': // tschechien
			return $results[checkUstId_cz($uistid)];

		case 'hu': // ungarn
			return $results[checkUstId_hu($uistid)];

		case 'cy': // zypern
			return $results[9];

        case 'r0': // canadian LUHN-10 code checking
        case 'r1':
        case 'r2':
        case 'r3':
        case 'r4':
        case 'r5':
        case 'r6':
        case 'r7':
        case 'r8':
        case 'r9':
            return $results[checkUstId_c($uistid)];

		default:
			return $results[8];
	} // end switch($country)
} // end function checkUstID($uistid)


/********************************************************************
* landesabhaengige Hilfsfunktionen zur Berechnung                   *
********************************************************************/

// Canada
function checkUstID_c($uistid)
{
    if(strlen($uistid) != 10)
        return 0;

    // LUHN-10 code http://www.ee.unb.ca/tervo/ee4253/luhn.html

    $id=substr($uistid,1);
    $checksum=0;
    for ($i=9;$i>0;$i--)
    {
      $digit=$uistid{$i};
      if ($i%2==1) $digit*=2;
      if ($digit>=10)
      {
       $checksum+=$digit-10+1;
      } else {
        $checksum+=$digit;
      }
    }
    if(modulo($checksum,10) == 0)
        return 1;

    return 0;
} // Canada

// belgien
function checkUstID_be($uistid)
{
	if(strlen($uistid) != 11)
		return 0;

	$checkvals = (int) substr($uistid, 2, -2);
	$checksum = (int) substr($uistid, -2);

	if(97 - modulo($checkvals, 97) != $checksum)
		return 0;

	return 1;
} // end belgien


// daenemark
function checkUstID_dk($uistid)
{
	if(strlen($uistid) != 10)
		return 0;

	$weights = array(2, 7, 6, 5, 4, 3, 2, 1);
	$checksum = 0;

	for($i = 0; $i < 8; $i++)
		$checksum += (int) $uistid[$i+2] * $weights[$i];
	if(modulo($checksum, 11) > 0)
		return 0;

	return 1;
} // end daenemark


// deutschland
function checkUstID_de($uistid)
{
	if(strlen($uistid) != 11)
		return 0;

	$prod = 10;
	$checkval = 0;
	$checksum = (int) substr($uistid, -1);

	for($i = 2; $i < 10; $i++)
	{
		$checkval = modulo((int) $uistid[$i] + $prod, 10);
		if($checkval == 0)
			$checkval = 10;
		$prod = modulo($checkval * 2, 11);
	} // end for($i = 2; $i < 10; $i++)
	$prod = $prod == 1 ? 11 : $prod;
	if(11 - $prod != $checksum)
		return 0;

	return 1;
} // end deutschland


// estland
function checkUstID_ee($uistid)
{

    if(strlen($uistid) != 11)
        return 0;
    if(!is_numeric(substr($uistid, 2)))
        return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }
} // end estland

// finnland
function checkUstID_fi($uistid)
{
	if(strlen($uistid) != 10)
		return 0;

	$weights = array(7, 9, 10, 5, 8, 4, 2);
	$checkval = 0;
	$checksum = (int) substr($uistid, -1);

	for($i = 0; $i < 8; $i++)
		$checkval += (int) $uistid[$i+2] * $weights[$i];

	if(11 - modulo($checkval, 11) != $checksum)
		return 0;
	
	return 1;
} // end finnland
	

// frankreich
function checkUstID_fr($uistid)
{
	if(strlen($uistid) != 13)
		return 0;
	if(!is_numeric(substr($uistid), 4))
		return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }
    
} // end frankreich


// griechenland
function checkUstID_el($uistid)
{
	if(strlen($uistid) != 11)
		return 0;

	$checksum = substr($uistid, -1);
	$checkval = 0;
	
	for($i = 1; $i <= 8; $i++)
		$checkval += (int) $uistid[10-$i] * pow(2, $i);
	$checkval = modulo($checkval, 11) > 9 ? 0 : modulo($checkval, 11);
	if($checkval != $checksum)
		return 0;
	
	return 1;
} // end griechenland


// grossbrittanien
function checkUstID_gb($uistid)
{
	if(strlen($uistid) != 11 && strlen($uistid) != 14)
		return 0;
	if(!is_numeric(substr($uistid, 2)))
		return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }


} // end grossbrittanien


/********************************************
* irland                                    *
********************************************/
// irland switch
function checkUstID_ie($uistid)
{
	if(strlen($uistid) != 10)
		return 0;
	if(!checkUstID_ie_new($uistid) && !checkUstID_ie_old($uistid))
		return 0;

	return 1;
} // end irland switch

// irland alte methode
function checkUstID_ie_old($uistid)
{
	// in neue form umwandeln
	$transform = array(substr($uistid, 0, 2), '0', substr($uistid, 4, 5), $uistid[2], $uistid[9]);
	$uistid = join('', $transform);

	// nach neuer form pruefen
	return checkUstID_ie_new($uistid);
} // end irland alte methode

// irland neue methode
function checkUstID_ie_new($uistid)
{
	$checksum = strtoupper(substr($uistid, -1));
	$checkval = 0;
	$checkchar = 'A';
	for($i = 2; $i <= 8; $i++)
		$checkval += (int) $uistid[10-$i] * $i;
	$checkval = modulo($checkval, 23);
	if($checkval == 0)
	{
		$checkchar = 'W';
	}	else {
		for($i = $checkval-1; $i > 0; $i--)
			$checkchar++;
	}
	if($checkchar != $checksum)
		return false;
	
	return true;
}	// end irland neue methode
/* end irland
********************************************/


// italien
function checkUstID_it($uistid)
{
	if(strlen($uistid) != 13)
		return 0;
	
	$checksum = (int) substr($uistid, -1);
	$checkval = 0;
	for($i = 0; $i <= 9 ; $i++)
		//echo $uistid[11-$i];
		$checkval += (int) $uistid[11-$i] * (is_even($i) ? 2 : 1);
	if($checksum != modulo($checkval, 10))
		return 0;
	
	return 1;
} // end italien

// lettland
function checkUstID_lv($uistid)
{

    if(strlen($uistid) != 13)
        return 0;
    if(!is_numeric(substr($uistid, 2)))
        return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }
} // end lettland

// litauen
function checkUstID_lt($uistid)
{

    if((strlen($uistid) != 13)||(strlen($uistid) != 11))
        return 0;
    if(!is_numeric(substr($uistid, 2)))
        return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }
} // end litauen

// luxemburg
function checkUstID_lu($uistid)
{
	if(strlen($uistid) != 10)
		return 0;

	$checksum = (int) substr($uistid, -2);
	$checkval = (int) substr($uistid, 2, 6);
	if(modulo($checkval, 89) != $checksum)
		return 0;
	
	return 1;
} // luxemburg

// malta
function checkUstID_mt($uistid)
{

    if(strlen($uistid) != 10)
        return 0;
    if(!is_numeric(substr($uistid, 2)))
        return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }
} // end malta

// niederlande
function checkUstID_nl($uistid)
{
	if(strlen($uistid) != 14)
		return 0;
	if(strtoupper($uistid[11]) != 'B')
		return 0;
	if((int) $uistid[12] == 0 || (int) $uistid[13] == 0)
		return 0;

	$checksum = (int) $uistid[10];
	$checkval = 0;

	for($i=2; $i<=9; $i++)
		$checkval += (int) $uistid[11-$i] * $i;
	$checkval = modulo($checkval, 11)	> 9 ? 0 : modulo($checkval, 11);
	
	if($checkval != $checksum)
		return 0;
		
	return 1;
} // end niederlande


// oesterreich
function checkUstID_at($uistid)
{
	if(strlen($uistid) != 11)
		return 0;
	if(strtoupper($uistid[2]) != 'U')
		return 0;
		
	$checksum = (int) $uistid[10];
	$checkval = 0;
	
	for($i=3; $i<10; $i++)
		$checkval += cross_summa((int) $uistid[$i] * (is_even($i) ? 2 : 1));
	$checkval = substr((string) (96 - $checkval), -1);
	
	if($checksum != $checkval)
		return 0;
			
	return 1;
} // end oesterreich


// polen
function checkUstID_pl($uistid)
{
	if(strlen($uistid) != 12)
		return 0;
	
	$weights = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
	$checksum = (int) $uistid[11];
	$checkval = 0;
	for($i=0; $i<count($weights); $i++)
		$checkval += (int) $uistid[$i+2] * $weights[$i];
	$checkval = modulo($checkval, 11);
	
	if($checkval != $checksum)
		return 0;
	
	return 1;
} // end polen


// portugal
function checkUstID_pt($uistid)
{
	if(strlen($uistid) != 11)
		return 0;
	
	$checksum = (int) $uistid[10];
	$checkval = 0;

	for($i=2; $i<10; $i++)
	{
		$checkval += (int) $uistid[11-$i] * $i;
	}
	$checkval = (11 - modulo($checkval, 11)) > 9 ? 0 : (11 - modulo($checkval, 11));
	if($checksum != $checkval)
		return 0;
	
	return 1;
} // end portugal


// schweden
function checkUstID_se($uistid)
{
	if(strlen($uistid) != 14)
		return 0;
	if((int) substr($uistid, -2) < 1 || (int) substr($uistid, -2) > 94)
		return 0;
	$checksum = (int) $uistid[11];
	$checkval = 0;
	
	for($i=0; $i<10; $i++)
		$checkval += cross_summa((int) $uistid[10-$i] * (is_even($i) ? 2 : 1));
	if($checksum != (modulo($checkval, 10) == 0 ? 0 : 10 - modulo($checkval, 10)))
		return 0;

	$checkval = 0;
	for($i=0; $i<13; $i++)
		$checkval += (int) $uistid[13-$i] * (is_even($i) ? 2 : 1);
	if(modulo($checkval, 10) > 0)
		return 0;
	
	return 1;
} // end schweden	

// slowakische republik
function checkUstID_sk($uistid)
{
    if(strlen($uistid) != 12)
        return 0;
    if(!is_numeric(substr($uistid, 2)))
        return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }


} // end slowakische republik

// slowenien
function checkUstID_si($uistid)
{
	if(strlen($uistid) != 10)
		return 0;
	if((int) $uistid [2] == 0)
		return 0;
	
	$checksum = (int) $uistid[9];
	$checkval = 0;

	for($i=2; $i<=8; $i++)
		$checkval += (int) $uistid[10-$i] * $i;
	$checkval = modulo($checkval, 11) == 10 ? 0 : 11 - modulo($checkval, 11);
	if($checksum != $checkval)
		return 0;
	
	return 1;
} // end slowenien


// spanien
function checkUstID_es($uistid)
{
	if(strlen($uistid) != 11)
		return 0;

	$allowed = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'Q');
	$checkval = false;

	for($i=0; $i<count($allowed); $i++)
	{
		if(strtoupper($uistid[2]) == $allowed[$i])
			$checkval = true;
	} // end for($i=0; $i<count($allowed); $i++)
	if(!$checkval)
		return 0;
		
	$checksum = (int) $uistid[10];
	$checkval = 0;

	for($i=2; $i<=8; $i++)
		$checkval += cross_summa((int) $uistid[11-$i] * (is_even($i) ? 2 : 1));
	if($checksum != 10 - modulo($checkval, 10))
		return 0;

	return 1;
} // end spanien

// tschechien
function checkUstID_cz($uistid)
{

    if((strlen($uistid) != 10)||(strlen($uistid) != 11)||(strlen($uistid) != 12))
        return 0;
    if(!is_numeric(substr($uistid, 2)))
        return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }
} // end tschechien

// ungarn
function checkUstID_hu($uistid)
{

    if(strlen($uistid) != 10)
        return 0;
    if(!is_numeric(substr($uistid, 2)))
        return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }
} // end ungarn

// zypern
function checkUstID_cy($uistid)
{

    if(strlen($uistid) != 11)
        return 0;

   if ($live_check=true){

   return live($uistid);

   }else{
    return 9; // es gibt keinen algorithmus
   }
} // end zypern

/*******************************************************************/


/********************************************************************
* mathematische Hilfsfunktionen                                     *
********************************************************************/
// modulo berechnet den rest einer division von $val durch $param
function modulo($val, $param)
{
	return $val - (floor($val / $param) * $param);
} // end function modulo($val, $param)


// stellt fest, ob eine zahl gerade ist
function is_even($val)
{
	return ($val/2 == floor($val/2)) ? true : false;
} // end function is_even($val)

// errechnet die quersumme von $val
function cross_summa($val)
{
	$val = (string) $val;
	$sum = 0;
	for($i=0; $i<strlen($val); $i++)
		$sum += (int) $val[$i];
	return $sum;
} // end function cross_summa((string) $val)
/*******************************************************************/

/********************************************************************
* Live Check                                     *
********************************************************************/
// Live Check überprüft die USTid beim Bundesamt für Finanzen
function live($abfrage_nummer)
{

$eigene_nummer = STORE_OWNER_VAT_ID;

/* Hier wird der String für den POST per URL aufgebaut */
$ustid_post="eigene_id=".$eigene_nummer."&abfrage_id=".$abfrage_nummer."";

/* Zur Verbindung mit dem Server wird CURL verwendet */
/* mit curl_init wird zunächst die URL festgelegt */

$ch = curl_init ("http://wddx.bff-online.de//ustid.php?".$ustid_post."");

/* Hier werden noch einige Parameter für CURL gesetzt */
curl_setopt ($ch, CURLOPT_HEADER, 0); /* Header nicht in die Ausgabe */
curl_setopt ($ch, CURLOPT_NOBODY, 0); /* Ausgabe nicht in die HTML-Seite */
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); /* Umleitung der Ausgabe in eine Variable ermöglichen */

/* Aufruf von CURL und Ausgabe mit WDDX deserialisieren */

$des_out = wddx_deserialize (curl_exec($ch));
curl_close ($ch);

/* Die deserialisierte Ausgabe in ein Array schreiben */

while (list($key, $val) = each($des_out)) {
  $ergebnis[$key] = $val;
}

 if ($ergebnis[fehler_code] == '200'){
   return 1;
 }elseif($ergebnis[fehler_code] == '201'){
   return 0;
 }elseif($ergebnis[fehler_code] == '202'){
   return 0;
 }elseif($ergebnis[fehler_code] == '203'){
   return 0;
 }elseif($ergebnis[fehler_code] == '204'){
   return 0;
 }elseif($ergebnis[fehler_code] == '205'){
   return 9;
 }elseif($ergebnis[fehler_code] == '206'){
   return 9;
 }elseif($ergebnis[fehler_code] == '207'){
   return 9;
 }elseif($ergebnis[fehler_code] == '208'){
   return 9;
 }elseif($ergebnis[fehler_code] == '209'){
   return 0;
 }elseif($ergebnis[fehler_code] == '210'){
   return 0;
 }elseif($ergebnis[fehler_code] == '666'){
   return 9;
 }elseif($ergebnis[fehler_code] == '777'){
   return 9;
 }elseif($ergebnis[fehler_code] == '888'){
   return 9;
 }elseif($ergebnis[fehler_code] == '999'){
   return 9;
 }else{
   return 9;
 }

} // end function Live
/*******************************************************************/
?>