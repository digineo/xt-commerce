<?php
    /*
        $Id: uos_lastschrift_at_modul.php 12 2006-12-16 18:59:00Z mzanier $
        
   xt:Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce
   -----------------------------------------------------------------------------------------

        UNITES-ONLINE-SERVICES Payment interface
        @copyright 2006 by UNITES-ONLINE-SERVICES
        @subpackage uos_lastschrift_at_modul
        @author o.reinhard<o.reinhard@united-online-services.de>

        Contribution based on:
        osCommerce, Open Source E-Commerce Solutions
        http://www.oscommerce.com

        Released under the GNU General Public License
    */

  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_TEXT_TITLE', '<img src="https://www.united-online-transfer.com/images/_icon_ec-card.gif" align="middle" > Direct Debit (Austria)');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_TEXT_DESCRIPTION', 'UOS Direct Debit Austria Modul<br><br><b>!Achtung!</b> Als xt:Commerce User erhalten Sie Sonderkonditionen, Details siehe <a href="http://www.xt-commerce.com/index.php?option=com_content&task=view&id=57&Itemid=75" target="_new">[Link]</a>');;
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_MODUL_TEXT_TITLE', '<img src="https://www.united-online-transfer.com/images/_icon_ec-card.gif" align="middle" > Direct Debit (Austria)');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_MODUL_TEXT_DESCRIPTION', 'UOS Direct Debit Austria Modul');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_STATUS_TITLE','Activat this UOS Module');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ID_TITLE','Project-ID');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_KEY_TITLE','Security-Key');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_CURRENCY_TITLE','Currency');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ZONE_TITLE','Taxes zone');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ORDER_STATUS_ID_TITLE','Set order status');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_SORT_ORDER_TITLE','View sequence.');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_STATUS_DESC','Do you want to use UOS?');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ID_DESC','The project ID you received from UOS as your shop ID.');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_KEY_DESC','The security key you received from UOS as a signature for the data transmission.');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_CURRENCY_DESC','The currency you want to use with UOS.');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ZONE_DESC','What order status should be set, after finishing the payment.');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_ORDER_STATUS_ID_DESC','What order status should be set, after finishing the payment.');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_SORT_ORDER_DESC','sequence order of all payments types.');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_DEMO_DESC','Demo mode activate!');
  define('MODULE_PAYMENT_UOS_LASTSCHRIFT_AT_DEMO_TITLE','Demo mode on true means that the booking is on the testarea.');
  
  define('MODULE_PAYMENT_UOS_GP_MODUL_ALLOWED_TITLE' , 'Allowed zones');
define('MODULE_PAYMENT_UOS_GP_MODUL_ALLOWED_DESC' , 'Please enter the zones <b>separately</b> which should be allowed to use this modul (e. g. AT,DE (leave empty if you want to allow all zones))');
  
?>