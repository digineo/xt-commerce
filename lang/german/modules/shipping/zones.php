<?php
/* -----------------------------------------------------------------------------------------
   $Id: zones.php,v 1.2 2004/04/01 14:19:26 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(zones.php,v 1.3 2002/04/17); www.oscommerce.com 
   (c) 2003	 nextcommerce (zones.php,v 1.4 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

define('MODULE_SHIPPING_ZONES_TEXT_TITLE', 'Versandkosten nach Zonen');
define('MODULE_SHIPPING_ZONES_TEXT_DESCRIPTION', 'Versandkosten Zonenbasierend');
define('MODULE_SHIPPING_ZONES_TEXT_WAY', 'Versand nach:');
define('MODULE_SHIPPING_ZONES_TEXT_UNITS', 'kg');
define('MODULE_SHIPPING_ZONES_INVALID_ZONE', 'Es ist kein Versand in dieses Land m&ouml;glich!');
define('MODULE_SHIPPING_ZONES_UNDEFINED_RATE', 'Die Versandkosten k&ouml;nnen im Moment nicht berechnet werden.');

define('MODULE_SHIPPING_ZONES_STATUS_TITLE' , 'Versandkosten nach Zonen Methode aktivieren');
define('MODULE_SHIPPING_ZONES_STATUS_DESC' , 'M&ouml;chten Sie Versandkosten nach Zonen anbieten?');
define('MODULE_SHIPPING_ZONES_ALLOWED_TITLE' , 'Erlaubte Versandzonen');
define('MODULE_SHIPPING_ZONES_ALLOWED_DESC' , 'Geben Sie <b>einzeln</b> die Zonen an, in welche ein Versand möglich sein soll. (z.B. AT,DE (lassen Sie dieses Feld leer, wenn Sie alle Zonen erlauben wollen))');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_TITLE' , 'Steuerklasse');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_DESC' , 'Folgende Steuerklasse an Versandkosten anwenden');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_TITLE' , 'Sortierreihenfolge');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_DESC' , 'Reihenfolge der Anzeige');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_TITLE' , 'Zone 1 L&auml;nder');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_DESC' , 'Durch Komma getrennte Liste von ISO L&auml;ndercodes (2 Zeichen), welche Teil von Zone 1 sind.');
define('MODULE_SHIPPING_ZONES_COST_1_TITLE' , 'Zone 1 Versandkosten');
define('MODULE_SHIPPING_ZONES_COST_1_DESC' , 'Versandkosten nach Zone 1 Bestimmungsorte, basierend auf einer Gruppe von max. Bestellgewichten. Beispiel: 3:8.50,7:10.50,... Gewicht von kleiner oder gleich 3 w&uuml;rde 8.50 für die Zone 1 Bestimmungsl&auml;nder kosten.');
define('MODULE_SHIPPING_ZONES_HANDLING_1_TITLE' , 'Zone 1 Handling Geb&uuml;hr');
define('MODULE_SHIPPING_ZONES_HANDLING_1_DESC' , 'Handling Geb&uuml;hr für diese Versandzone');
?>
