<?php
/* --------------------------------------------------------------
   $Id: customers_status.php,v 1.5 2004/04/28 10:37:05 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(customers.php,v 1.76 2003/05/04); www.oscommerce.com 
   (c) 2003	 nextcommerce (customers_status.php,v 1.12 2003/08/14); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/

define('HEADING_TITLE', 'Kundengruppen');

define('ENTRY_CUSTOMERS_FSK18','Kauf von FSK18 Artikel Sperren?');
define('ENTRY_CUSTOMERS_FSK18_DISPLAY','Anzeige von FSK18 Artikeln?');
define('ENTRY_CUSTOMERS_STATUS_ADD_TAX','UST in Rechnung ausweisen');
define('ENTRY_CUSTOMERS_STATUS_BT_PERMISSION','Per Bankeinzug');
define('ENTRY_CUSTOMERS_STATUS_CC_PERMISSION','Per Kreditkarte');
define('ENTRY_CUSTOMERS_STATUS_COD_PERMISSION','Per Nachnahme');
define('ENTRY_CUSTOMERS_STATUS_DISCOUNT_ATTRIBUTES','Rabatt');
define('ENTRY_CUSTOMERS_STATUS_PAYMENT_UNALLOWED','Geben Sie unerlaubte Zahlungsweisen ein');
define('ENTRY_CUSTOMERS_STATUS_PUBLIC','&Ouml;ffentlich');
define('ENTRY_CUSTOMERS_STATUS_SHIPPING_UNALLOWED','Geben Sie unerlaubte Versandarten ein');
define('ENTRY_CUSTOMERS_STATUS_SHOW_PRICE','Preis');
define('ENTRY_CUSTOMERS_STATUS_SHOW_PRICE_TAX','Preise inkl. MwSt.');
define('ENTRY_GRADUATED_PRICES','Staffelpreise');
define('ENTRY_NO','Nein');
define('ENTRY_OT_XMEMBER', 'Kundenrabatt auf Gesamtbestellwert? :');
define('ENTRY_YES','Ja');

define('ERROR_REMOVE_DEFAULT_CUSTOMER_STATUS', 'Fehler: Die Standard Kundengruppe kann nicht gel&ouml;scht werden. Bitte legen Sie zuerst eine andere Standard Kundengruppe an, und versuchen Sie es erneut.');
define('ERROR_REMOVE_DEFAULT_CUSTOMERS_STATUS','ACHTUNG! Eine Standard Kundengruppe kann nicht gel&ouml;scht werden');
define('ERROR_STATUS_USED_IN_CUSTOMERS', 'Error: Diese Kundengruppe ist zur Zeit bei Kunden in Verwendung.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Error: Diese Kundengruppe wird zur Zeit in der Bestell&uuml;bersicht verwendet.');

define('YES','ja');
define('NO','nein');

define('TABLE_HEADING_ACTION','Aktion');
define('TABLE_HEADING_CUSTOMERS_GRADUATED','Staffelpreis');
define('TABLE_HEADING_CUSTOMERS_STATUS','Kundengruppe');
define('TABLE_HEADING_CUSTOMERS_UNALLOW','nicht erlaubte Zahlungweisen');
define('TABLE_HEADING_CUSTOMERS_UNALLOW_SHIPPING','nicht erlaubte Versandarten');
define('TABLE_HEADING_DISCOUNT','Rabatt');
define('TABLE_HEADING_TAX_PRICE','Preis / MwSt.');

define('TAX_NO','exkl.');
define('TAX_YES','inkl.');

define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS_STATUS', 'Vorhandene Kundengruppen:');

define('TEXT_INFO_CUSTOMERS_FSK18_DISPLAY_INTRO','<b>FSK18 Artikel</b>');
define('TEXT_INFO_CUSTOMERS_FSK18_INTRO','<b>FSK18 Sperre</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_ADD_TAX_INTRO','<b>Falls Preis inkl. Steuer = auf "Nein" setzen</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_BT_PERMISSION_INTRO', '<b>M&ouml;chten Sie erlauben, daﬂ diese Kundengruppe per Bankeinzug bezahlen darf?</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_CC_PERMISSION_INTRO', '<b>M&ouml;chten Sie erlauben, daﬂ diese Kundengruppe per Kreditkarte bezahlen darf?</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_COD_PERMISSION_INTRO', '<b>M&ouml;chten Sie erlauben, daﬂ diese Kundengruppe per Nachnahme bezahlen darf?</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_DISCOUNT_ATTRIBUTES_INTRO','<b>Rabatt auf Artikel Attribute</b><br>(Max. % Rabatt auf einen Artikel anwenden)');
define('TEXT_INFO_CUSTOMERS_STATUS_DISCOUNT_OT_XMEMBER_INTRO','<b>Rabatt auf gesamte Bestellung</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_DISCOUNT_PRICE', 'Rabatt (0 bis 100%):');
define('TEXT_INFO_CUSTOMERS_STATUS_DISCOUNT_PRICE_INTRO', 'Maximaler Rabatt auf Produkte (abh‰ngig von Rabatt eingestellt bei Produkt).');
define('TEXT_INFO_CUSTOMERS_STATUS_GRADUATED_PRICES_INTRO','<b>Staffelpreise</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_IMAGE', 'Kundengruppen-Bild:');
define('TEXT_INFO_CUSTOMERS_STATUS_NAME','<b>Gruppenname</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_PAYMENT_UNALLOWED_INTRO','<b>Nicht erlaubte Zahlungsweisen</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_PUBLIC_INTRO','<b>Gruppe &Ouml;ffentlich ?</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_SHIPPING_UNALLOWED_INTRO','<b>Nicht erlaubte Versandarten</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_SHOW_PRICE_INTRO','<b>Preisanzeige im Shop</b>');
define('TEXT_INFO_CUSTOMERS_STATUS_SHOW_PRICE_TAX_INTRO', 'M&ouml;chten Sie die Preise inklusive oder exklusive Steuer anzeigen?');

define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, daﬂ Sie diese Kundengruppe l&ouml;schen wollen?');
define('TEXT_INFO_EDIT_INTRO', 'Bitte nehmen Sie alle n&ouml;tigen Einstellungen vor');
define('TEXT_INFO_INSERT_INTRO', 'Bitte erstellen Sie einen neue Kundengruppe mit den gew&uuml;nschten Einstellungen');

define('TEXT_INFO_HEADING_DELETE_CUSTOMERS_STATUS', 'Kundengruppe l&ouml;schen');
define('TEXT_INFO_HEADING_EDIT_CUSTOMERS_STATUS','Gruppendaten bearbeiten');
define('TEXT_INFO_HEADING_NEW_CUSTOMERS_STATUS', 'Neue Kundengruppe');
?>