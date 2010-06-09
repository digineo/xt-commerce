<?php
/* --------------------------------------------------------------
   $Id: start.php,v 1.2 2004/04/01 14:19:26 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (start.php,v 1.1 2003/08/19); www.nextcommerce.org
   
   Released under the GNU General Public License 
   --------------------------------------------------------------*/
 
  define('HEADING_TITLE','Willkommen');  
  define('ATTENTION_TITLE','! ACHTUNG !');
  
  // text for Warnings:
  define('TEXT_FILE_WARNING','<b>WARNUNG:</b><br>Folgende Dateien sind vom Server beschreibbar. Bitte &auml;ndern Sie die Zugriffsrechte (Permissions) dieser Datei aus Sicherheitsgr&uuml;nden. <b>(444)</b> in unix, <b>(read-only)</b> in Win32.');
  define('TEXT_FOLDER_WARNING','<b>WARNUNG:</b><br>Folgende Verzeichnisse m&uuml;ssen vom Server beschreibbar sein. Bitte &auml;ndern Sie die Zugriffsrechte (Permissions) dieser Verzeichnisse. <b>(777)</b> in unix, <b>(read-write)</b> in Win32.');
?>