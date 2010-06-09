<?php

/* -----------------------------------------------------------------------------------------
   $Id: luupws.php 192 2007-02-24 16:24:52Z mzanier $   

   xt:Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2002-2003 osCommerce(LUUPws.php, v3.0 2005/11/15); www.oscommerce.com 

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

define('MODULE_PAYMENT_LUUPWS_TEXT_COUNTRIES', 'DEU|Deutschland');

define('MODULE_PAYMENT_LUUPWS_TEXT_TITLE', '<font color="#ff0000"><b>LUUPAY</b></font>');
define('MODULE_PAYMENT_LUUPWS_TEXT_TITLE_SHOP', '<font color="#2A0075"><b>LUUPAY</b></font> : Dein Geld wird mobil. Einfach, schnell und sicher!');
define('MODULE_PAYMENT_LUUPWS_TEXT_DESCRIPTION', ' LUUPAY Konto<br><br><b>!Achtung!</b> Als xt:Commerce User erhalten Sie Sonderkonditionen, Details siehe <a href="http://www.xt-commerce.com/index.php?option=com_content&task=view&id=28&Itemid=43" target="_new">[Link]</a>');
define('MODULE_PAYMENT_LUUPWS_TEXT_LINK_REGISTER', 'Mit LUUPAY ganz einfach per Lastschrift, per Kreditkarte (Visa, Mastercard) oder mit Deinem LUUPAY-Geldbeutel bezahlen! Deine Daten sind bei LUUPAY sicher verwahrt und der H&auml;ndler bekommt Deine Zahlungsdaten nicht mitgeteilt. Diese werden vertrauensw&uuml;rdig &uuml;ber LUUPAY abgewickelt. LUUPAY ist ein E-Geld-Institut und die Abwicklung erfolgt &uuml;ber Dein kostenfreies LUUPAY-Konto. Keine laufenden Kosten, keine Kontof&uuml;hrungskosten, keine Verpflichtungen und kein Abonnement. Noch kein Kunde? Einfach <a href="https://www.luupay.de/Signup.aspx?c=de" target="_blank"><span style="font-weight: normal;"><u>hier anmelden</u></span></a>.');

// labels, etc
define('MODULE_PAYMENT_LUUPWS_TEXT_REGISTERED_IN', 'Registriert in:');
define('MODULE_PAYMENT_LUUPWS_TEXT_USERID', 'Handynummer / Benutzername:');
define('MODULE_PAYMENT_LUUPWS_TEXT_PIN', 'LUUPAY-PIN:');
define('MODULE_PAYMENT_LUUPWS_TEXT_VERIFICATION_CODE', 'LUUPAY-Verifizierungscode:');

define('MODULE_PAYMENT_LUUPWS_TEXT_CONTINUE', 'Weiter');

define('MODULE_PAYMENT_LUUPWS_TEXT_STEP1', 'Schritt 1 von 2:');
define('MODULE_PAYMENT_LUUPWS_TEXT_STEP2', 'Schritt 2 von 2:');
define('MODULE_PAYMENT_LUUPWS_TEXT_STEP1_DESCRIPTION', '<b>Hier Deine Handynummer oder LUUPAY-Benutzernamen und Deinen LUUPAY-PIN eingeben!</b>');
define('MODULE_PAYMENT_LUUPWS_TEXT_STEP2_DESCRIPTION', '<b>LUUPAY hat Dir soeben Deinen Verifizierungscode f&uuml;r diese Bestellung auf Dein Handy geschickt. Einfach hier eingeben.</b>');

// javascript validation
define('MODULE_PAYMENT_LUUPWS_TEXT_JS_FILL_USER', ' * Du musst Deine Handynummer oder Deinen Benutzernamen eingeben\n');
define('MODULE_PAYMENT_LUUPWS_TEXT_JS_FILL_PIN', ' * Du musst Deine LUUPAY-PIN eingeben (4 Ziffern)\n');
define('MODULE_PAYMENT_LUUPWS_TEXT_JS_FILL_CODE', ' * Du musst den LUUPAY-Verifizierungscode eingeben (8 Ziffern)\n');

// error texts
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_NO_EURO_CONVERSION_VALUE', 'Falsche Waehrung - keine Umrechnung in Euro moeglich');
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_MESSAGE', 'Versuch fehlgeschlagen: ');
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_UNKNOWN', 'Unbekannter Fehler');
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_101', 'LUUPAY kann die Anfrage nicht bearbeiten. Fehlende Daten.');
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_201', 'Der Haendler konnte nicht identifiziert werden.');
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_202', 'Du hast einen falschen Benutzernamen oder LUUPAY-PIN eingegeben. Bitte versuche es erneut. Falls Du noch nicht bei LUUPAY registriert bist, gehe auf https://www.luupay.de/Signup.aspx?c=de .');
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_203', 'Ungueltiger Verifizierungscode');
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_206', 'Ein Fehler ist aufgetreten beim Haendler. Bitte den Haendler benachrichtigen.');
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_301', 'Die Transaktion konnte nicht beendet werden. Vielleicht langt Dein Guthaben nicht aus. Gehe zu www.luupay.de und Ueberpruefe Deinen Kontostand');
define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_401', 'LUUPAY interner Fehler');

define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR', 'Fehler im Bezahlvorgang!');
//define('MODULE_PAYMENT_LUUPWS_TEXT_ERROR_MESSAGE', 'Beim Bearbeiten deiner Transaktion ist ein Fehler aufgetreten, bitte versuche es erneut.');

// infobox text
define('MODULE_BOXES_LUUP_TITLE', 'Bezahlt mit');

define('MODULE_PAYMENT_LUUPWS_STATUS_TITLE', 'LUUPAY Modul aktivieren');
define('MODULE_PAYMENT_LUUPWS_STATUS_DESC', 'M&ouml;chten Sie Zahlungen per LUUPAY akzeptieren?');

define('MODULE_PAYMENT_LUUPWS_MERCHANT_ID_TITLE', 'H&auml;ndler ID');
define('MODULE_PAYMENT_LUUPWS_MERCHANT_ID_DESC', 'Ihre LUUPAY Shop ID');

define('MODULE_PAYMENT_LUUPWS_MERCHANT_KEY_TITLE', 'H&auml;ndler Passwort');
define('MODULE_PAYMENT_LUUPWS_MERCHANT_KEY_DESC', 'Ihr LUUPAY H&auml;ndler Passwort');

define('MODULE_PAYMENT_LUUPWS_TESTMODE_TITLE', 'Testmodus');
define('MODULE_PAYMENT_LUUPWS_TESTMODE_DESC', 'Testmodus mit Testw&auml;hrung');

define('MODULE_PAYMENT_LUUPWS_PAYMENT_COLLECTION_TITLE', 'Payment type');
define('MODULE_PAYMENT_LUUPWS_PAYMENT_COLLECTION_DESC', 'Select payment collection type');

define('MODULE_PAYMENT_LUUPWS_USE_DB_TITLE', 'Uses admin extension');
define('MODULE_PAYMENT_LUUPWS_USE_DB_DESC', 'Is the LUUPAY admin extension installed?');

// Admin extension
define('MODULE_PAYMENT_LUUPWS_ADMIN_ORDERS_TEXT_STATUS', 'Zahlungsstatus:');
define('MODULE_PAYMENT_LUUPWS_ADMIN_ORDERS_TEXT_TRANSACTION_ID', 'Transaktions ID:');
define('MODULE_PAYMENT_LUUPWS_ADMIN_ORDERS_TEXT_ACTION', 'Zahlung aktualisieren:');
define('MODULE_PAYMENT_LUUPWS_ADMIN_ORDERS_TEXT_FAILED', '<span class="messageStackError">Webservice Error</span>');
define('MODULE_PAYMENT_LUUPWS_ADMIN_ORDERS_TEXT_CANCELLED', '<span class="messageStackSuccess">Zahlung wurde storniert</span>');
define('MODULE_PAYMENT_LUUPWS_ADMIN_ORDERS_TEXT_REFUNDED', '<span class="messageStackSuccess">Zahlung wurde erstattet</span>');
define('MODULE_PAYMENT_LUUPWS_ADMIN_ORDERS_TEXT_COMPLETED', '<span class="messageStackSuccess">Zahlung wurde durchgef&uuml;hrt</span>');
define('MODULE_PAYMENT_LUUPWS_ADMIN_ORDERS_BUTTON_REFUND', '<input type="submit" name="luup_request" value="Refund">');
define('MODULE_PAYMENT_LUUPWS_ADMIN_ORDERS_BUTTON_PENDING', '<input type="submit" name="luup_request" value="Collect">&nbsp;<input type="submit" name="luup_request" value="Cancel">');

define('MODULE_PAYMENT_LUUPWS_COST_TITLE', _MODULES_PAYMENT_FEE_TITLE);
define('MODULE_PAYMENT_LUUPWS_COST_DESC', _MODULES_PAYMENT_FEE_DESC);
define('MODULE_PAYMENT_LUUPWS_ZONE_TITLE', _MODULES_ZONE_TITLE);
define('MODULE_PAYMENT_LUUPWS_ZONE_DESC', _MODULES_ZONE_DESC);
define('MODULE_PAYMENT_LUUPWS_ALLOWED_TITLE', _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_PAYMENT_LUUPWS_ALLOWED_DESC', _MODULES_ZONE_ALLOWED_DESC);
define('MODULE_PAYMENT_LUUPWS_SORT_ORDER_TITLE', _MODULES_SORT_ORDER_TITLE);
define('MODULE_PAYMENT_LUUPWS_SORT_ORDER_DESC', _MODULES_SORT_ORDER_DESC);
define('MODULE_PAYMENT_LUUPWS_ORDER_STATUS_ID_TITLE', _MODULES_SET_ORDER_STATUS_TITLE);
define('MODULE_PAYMENT_LUUPWS_ORDER_STATUS_ID_DESC', _MODULES_SET_ORDER_STATUS_DESC);
?>