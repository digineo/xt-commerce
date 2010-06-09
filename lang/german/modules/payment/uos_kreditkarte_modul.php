<?php
    /*
        $Id: uos_kreditkarte_modul.php 21 2006-12-25 14:31:15Z mzanier $
        
   xt:Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce
   -----------------------------------------------------------------------------------------

        UNITES-ONLINE-SERVICES Payment interface
        @copyright 2006 by UNITES-ONLINE-SERVICES
        @subpackage uos_kreditkarte_modul
        @author o.reinhard<o.reinhard@united-online-services.de>

        Contribution based on:
        osCommerce, Open Source E-Commerce Solutions
        http://www.oscommerce.com

        Released under the GNU General Public License
    */

  define('MODULE_PAYMENT_UOS_KREDITKARTE_TEXT_TITLE', '<img src="https://www.united-online-transfer.com/images/formular/_icon_visa.gif" align="middle" > <img src="https://www.united-online-transfer.com/images/formular/_icon_mastercard.gif" align="middle" > Kreditkarte International');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_TEXT_DESCRIPTION', 'UOS Kreditkarte Modul<br><br><b>!Achtung!</b> Als xt:Commerce User erhalten Sie Sonderkonditionen, Details siehe <a href="http://www.xt-commerce.com/index.php?option=com_content&task=view&id=57&Itemid=75" target="_new">[Link]</a>');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_MODUL_TEXT_TITLE', '<img src="https://www.united-online-transfer.com/images/formular/_icon_visa.gif" align="middle" > <img src="https://www.united-online-transfer.com/images/formular/_icon_mastercard.gif" align="middle" > Kreditkarte International');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_MODUL_TEXT_DESCRIPTION', 'UOS Kreditkarte Modul');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_STATUS_TITLE','Aktivieren dieses U O S Modules');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_ID_TITLE','Project-ID');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_KEY_TITLE','Security-Key');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_CURRENCY_TITLE','W?hrung');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_ZONE_TITLE','Steuer Zone');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_ORDER_STATUS_ID_TITLE','Bestell Status setzen');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_SORT_ORDER_TITLE','Anzeige Reihenfolge.');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_STATUS_DESC','Wollen Sie U O S nutzen?');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_ID_DESC','Die Projekt ID die Sie von U O S als Shop ID bekommen haben.');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_KEY_DESC','Den Security-Key den Sie von U O S zur Segnierung der Daten¸bertragung bekommen haben.');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_CURRENCY_DESC','Die W?hrung die Sie bei U O S nutzen m?chten.');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_ZONE_DESC','Wenn Sie hiereine Zone einstellen wird diese Payment nur f¸r diese genutzt werden.');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_ORDER_STATUS_ID_DESC','Angabe welcher Bestellstatus gesetz werden soll, nach Abschluss des Zahlvorgangs.');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_SORT_ORDER_DESC','Reihenfolge der Anzeige aller Zahlsysteme. Die Kleinste zuerst.');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_DEMO_TITLE','Demo Modus auf True bedeutet, dass Sie ¸ber unsere Testumgebung buchen.');
  define('MODULE_PAYMENT_UOS_KREDITKARTE_DEMO_DESC','Demo Modus aktivieren!');
  
  define('MODULE_PAYMENT_UOS_KREDITKARTE_MODUL_ALLOWED_TITLE', 'Erlaubte Zonen');
define('MODULE_PAYMENT_UOS_KREDITKARTE_MODUL_ALLOWED_DESC', 'Geben Sie <b>einzeln</b> die Zonen an, welche f&uuml;r dieses Modul erlaubt sein sollen. (z.B. AT,DE (wenn leer, werden alle Zonen erlaubt))');
  
?>