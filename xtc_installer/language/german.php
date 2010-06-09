<?php

/* --------------------------------------------------------------
   $Id: german.php 278 2007-03-22 09:54:02Z mzanier $   

   xt:Commerce - community made shopping
   http://www.xt:Commerce.com

   Copyright (c) 2003 xt:Commerce
   --------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (german.php,v 1.8 2003/08/13); www.nextcommerce.org
   
   Released under the GNU General Public License 
   --------------------------------------------------------------*/
// Global
define('_CHARSET', 'iso-8859-15');
// Box names
define('BOX_LANGUAGE', 'Sprache');
define('BOX_DB_CONNECTION', 'DB Verbindung');
define('BOX_WEBSERVER_SETTINGS', 'Webserver Einstellungen');
define('BOX_DB_IMPORT', 'DB Import');
define('BOX_WRITE_CONFIG', 'Schreiben der Konfigurationsdatei');
define('BOX_ADMIN_CONFIG', 'Administrator Konfiguration');
define('BOX_USERS_CONFIG', 'User Konfiguration');

define('PULL_DOWN_DEFAULT', 'Bitte Wählen Sie ein Land');

// Error messages
// index.php
define('SELECT_LANGUAGE_ERROR', 'Bitte wählen Sie eine Sprache!');
// install_step2,5.php
define('TEXT_CONNECTION_ERROR', 'Eine Testverbindung zur Datenbank war nicht erfolgreich.');
define('TEXT_CONNECTION_SUCCESS', 'Eine Testverbindung zur Datenbank war erfolgreich.');
define('TEXT_DB_ERROR', 'Folgender Fehler wurde zurückgegeben:');
define('TEXT_DB_ERROR_1', 'Bitte klicken Sie auf <i>Back</i> um Ihre Datenbankeinstellungen zu überprüfen.');
define('TEXT_DB_ERROR_2', 'Wenn Sie Hilfe zu Ihrer Datenbank benötigen, wenden Sie sich bitte an Ihren Provider.');
// install_step6.php
define('ENTRY_FIRST_NAME_ERROR', 'Vorname ist zu kurz');
define('ENTRY_LAST_NAME_ERROR', 'Nachname ist zu kurz');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'E-Mail Adresse ist zu kurz');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Bitte überprüfen Sie Ihre E-Mail Adresse');
define('ENTRY_STREET_ADDRESS_ERROR', 'Straße ist zu kurz');
define('ENTRY_POST_CODE_ERROR', 'Postleitzahl ist zu kurz');
define('ENTRY_CITY_ERROR', 'Stadt ist zu kurz');
define('ENTRY_COUNTRY_ERROR', 'Bitte überprüfen Sie das Bundesland');
define('ENTRY_STATE_ERROR', 'Bitte überprüfen Sie das Land');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Telefonnummer ist zu kurz');
define('ENTRY_PASSWORD_ERROR', 'Bitte überprüfen Sie das Passwort');
define('ENTRY_STORE_NAME_ERROR', 'Shop-Name ist zu kurz');
define('ENTRY_COMPANY_NAME_ERROR', 'Firmenname ist zu kurz');
define('ENTRY_EMAIL_ADDRESS_FROM_ERROR', 'E-Mail-From ist zu kurz');
define('ENTRY_EMAIL_ADDRESS_FROM_CHECK_ERROR', 'Bitte überprüfen Sie den E-Mail-From');
define('SELECT_ZONE_SETUP_ERROR', 'Wählen Sie Zone-Setup');


// index.php
define('TITLE_SELECT_LANGUAGE', 'Wählen Sie eine Sprache!');

define('TEXT_WELCOME_INDEX', '<b>Willkommen zu xt:Commerce</b><br /><br />xt:Commerce ist eine Open-Source e-commerce Lösung, die ständig vom xt:Commerce Team und einer grossen Gemeinschaft weiterentwickelt wird.<br /> Seine out-of-the-box Installation erlaubt es dem Shop-Besitzer seinen Online-Shop mit einem Minimum an Aufwand und Kosten zu installieren, zu betreiben und zu verwalten.<br /><br />xt:Commerce ist auf jedem System lauffähig, welches eine PHP Umgebung (ab PHP 4.1) und mySQL zur Verfügung stellt, wie zum Beispiel Linux, Solaris, BSD, und Microsoft Windows.');
define('TEXT_WELCOME_STEP1', '<b>Datenbank- und Webservereinstellungen</b><br /><br />Der Installer benötigt hier einige Informationen bezüglich Ihrer Datenbank und Ihrer Verzeichnisstruktur.');
define('TEXT_WELCOME_STEP2', '<b>Datenbank Installation</b><br /><br />Der xt:Commerce Installer installiert automatisch die xt:Commerce-Datenbank.');
define('TEXT_WELCOME_STEP3', '<b>Datenbank Import.</b><br /><br />Die Daten der xt:Commerce Datenbank werden automatisch in die Datenbank importiert.');
define('TEXT_WELCOME_STEP4', '<b>Konfiguration der xt:Commerce Konfig-Dateien</b><br /><br /><b>Wenn bereits configure Dateien aus einer früheren Installation vorhanden sind, wird xt:Commerce diese Löschen.</b><br /><br />Der Installer schreibt die automatisch die Konfigurationsdateien für die Dateistruktur und die Datenbankanbindung.<br /><br />Sie können zwischen verschiedenen Session-Handling_systemen wählen.');
define('TEXT_WELCOME_STEP5', '<b>Webserver Konfiguration</b><br /><br />');
define('TEXT_WELCOME_STEP6', '<b>Grundsätzliche Shopkonfiguration</b><br /><br />Der Installer richtet den Admin-Account ein und schreibt noch diverse Daten in die Datenbank.<br />Die angegebenen Daten für <b>Country</b> und <b>Post Code</b> werden für die Versand und Steuerberechnungen genutzt.<br /><br />Wenn Sie wünschen, kann xtcommerce automatisch die Zonen, Steuersätze und Steuerklassen für Versand und Verkauf innerhalb der EU einrichten.<br />Markieren Sie nur <b>automatisches Einstellen der Steuerzonen</b> - <b>YES</b>.');
define('TEXT_WELCOME_FINISHED', '<b>xt:Commerce Installation erfolgreich!</b><br /><br />Der Installer hat nun die Grundfunktionen Ihres Shops eingerichtet. Melden Sie sich im Catalog mit Ihrem Admin-Account an und wechseln in den Admin_bereich, um die komplette Konfiguration Ihres Shops vorzunehmen.');

// install_step1.php

define('TITLE_CUSTOM_SETTINGS', 'Installations Optionen');
define('TEXT_IMPORT_DB', 'Importiere die xt:Commerce Datenbank');
define('TEXT_IMPORT_DB_LONG', 'Importiere die xt:Commerce Datenbankstruktur, welche die Tabellen und Beispieldaten enthält.');
define('TEXT_AUTOMATIC', 'Automatische Konfiguration');
define('TEXT_AUTOMATIC_LONG', 'Ihre Informationen bezüglich Webserver und Datenbank werden automatisch in die benötigten Catalog und Admin Konfigurations-Dateien geschrieben..');
define('TITLE_DATABASE_SETTINGS', 'Datenbank Informationen');
define('TEXT_DATABASE_SERVER', 'Datenbankserver');
define('TEXT_DATABASE_SERVER_LONG', 'Der Datenbankserver kann entweder in Form eines Hostnamens, wie zum Beispiel <i>db1.myserver.com</i> oder <i>localhost</i>, oder als IP-Adresse, wie <i>192.168.0.1</i> angegeben werden.');
define('TEXT_USERNAME', 'Benutzername');
define('TEXT_USERNAME_LONG', 'Der Benutzername, der zum konnektieren der Datenbank benötigt wird, wie zum Beispiel <i>mysql_10</i>.<br /><br />Bemerkung: Wenn die xt:Commerce Datenbank Importiert werden soll (wenn oben ausgewählt), muss der Benutzer CREATE und DROP Rechte für die Datenbank haben. Sollten hier Probleme auftreten, kann Ihnen Ihr Provider weiterhelfen.');
define('TEXT_PASSWORD', 'Passwort');
define('TEXT_PASSWORD_LONG', 'Das Passwort wird zusammen mit dem Benutzernamen zum Verbindungsaufbau zur Datenbank benutzt.');
define('TEXT_DATABASE', 'Datenbank');
define('TEXT_DATABASE_LONG', 'Der Name der Datenbank, in die die Tabellen eingefügt werden sollen.<br /><b>ACHTUNG:</b> Es muss bereits eine leere Datenbank vorhanden sein, falls nicht -> leere Datenbank mit phpMyAdmin erstellen!');
define('TITLE_WEBSERVER_SETTINGS', 'Webserver Informationen');
define('TEXT_WS_ROOT', 'Webserver Root Verzeichnis');
define('TEXT_WS_ROOT_LONG', 'Das Verzeichnis, in das die Webseiten gespeichert werden, zum Beispiel <i>/home/myname/public_html</i>.');
define('TEXT_WWW_ADDRESS','WWW Address');

// install_step2.php

define('TEXT_PROCESS_1', 'Bitte setzten Sie die Installation nun fort, um die Datenbank zu Importieren.');
define('TEXT_PROCESS_2', 'Dieser Vorgang nimmt einige Zeit in Anspruch. Es ist wichtig, dass Sie den Vorgang nun nicht unterbrechen, weil sonst die Datenbank möglicherweise nicht korrekt installiert wird.');

// install_step3.php

define('TEXT_TITLE_ERROR', 'Der folgende Fehler ist aufgetreten:');
define('TEXT_TITLE_SUCCESS', 'Der Datenbank-Import war erfolgreich.');

// install_step4.php
define('TITLE_WEBSERVER_CONFIGURATION', 'Webserver Informationen:');
define('TITLE_STEP4_ERROR', 'Der folgenden Fehler ist aufgetreten:');
define('TEXT_STEP4_ERROR', '<b>Die Konfigurationsdateien existieren nicht, oder deren Rechte sind nicht richtig gesetzt.</b><br /><br />Bitte Führen Sie folgende Aktionen durch: ');
define('TEXT_STEP4_ERROR_1', 'Wenn <i>chmod 706</i> nicht funktioniert, versuchen Sie <i>chmod 777</i>.');
define('TEXT_STEP4_ERROR_2', 'Wenn Sie diese Installationsroutine in einer Windows Umgebung ausführen, versuchen Sie das Umbenennen der entsprechenden Dateien.');
define('TEXT_VALUES', 'Die Konfiguarations-Werte werden nun in die Dateien geschrieben:');
define('TITLE_CHECK_CONFIGURATION', 'Bitte prüfen Sie Ihre Webserver Informationen');
define('TITLE_CHECK_DATABASE', 'Bitte überprüfen Sie Ihre Datenbank Informationen');
define('TEXT_PERSIST', 'Benutze Persistente Verbindung');
define('TEXT_PERSIST_LONG', 'Hält eine Verbindung zur Datenbank für längere Zeit aufrecht. Auf den meisten geteilten Servern ist diese Funktion nicht möglich.');
define('TEXT_SESS_FILE', 'Speichere Sessions in Dateien.');
define('TEXT_SESS_DB', 'Speichere Sessions in der Datenbank');
define('TEXT_SESS_LONG', 'Das Verzeichnis, in welches PHP die Session-Dateien speichert.');

// install_step5.php

define('TEXT_WS_CONFIGURATION_SUCCESS', '<strong>xt:Commerce</strong> Webserver Konfiguration war erfolgreich');

// install_step6.php

define('TITLE_ADMIN_CONFIG', 'Administrator Konfiguration');
define('TEXT_REQU_INFORMATION', '* erforderliche Information');
define('TEXT_FIRSTNAME', 'Vorname:');
define('TEXT_LASTNAME', 'Nachname:');
define('TEXT_EMAIL', 'E-Mail Adresse:');
define('TEXT_EMAIL_LONG', 'E-Mail Adresse, an die eine separate Mail bei Bestellungen gesendet werden soll.');
define('TEXT_STREET', 'Straße:');
define('TEXT_POSTCODE', 'PLZ:');
define('TEXT_CITY', 'Stadt:');
define('TEXT_STATE', 'Bundesland/Province:');
define('TEXT_COUNTRY', 'Land:');
define('TEXT_COUNTRY_LONG', 'Wird benutzt für Versand und Steuern.');
define('TEXT_TEL', 'Telefonnummer:');
define('TEXT_PASSWORD', 'Passwort:');
define('TEXT_PASSWORD_CONF', 'Passwort Bestätigung:');
define('TITLE_SHOP_CONFIG', 'Shop Konfiguration');
define('TEXT_STORE', 'Shop Name:');
define('TEXT_STORE_LONG', 'Der Name des Shops.');
define('TEXT_EMAIL_FROM', 'E-Mail From');
define('TEXT_EMAIL_FROM_LONG', 'Die E-Mail Adresse, die in den Bestellungen als From benutzt wird.');
define('TITLE_ZONE_CONFIG', 'Zonen Konfiguration');
define('TEXT_ZONE', 'automatisches Einstellen der Steuerzonen?');
define('TITLE_ZONE_CONFIG_NOTE', 'xt:Commerce kann die Zonen automatisch installieren, sofern Sich Ihr Shop in der EU befindet.');
define('TITLE_SHOP_CONFIG_NOTE', 'Information for grundlegende Shopeinstellungen');
define('TITLE_ADMIN_CONFIG_NOTE', 'Informationen für Admin/Superuser');
define('TEXT_ZONE_NO', 'Nein');
define('TEXT_ZONE_YES', 'Ja');
define('TEXT_COMPANY', 'Firmenname');

// install_fnished.php

define('TEXT_SHOP_CONFIG_SUCCESS', '<strong>xt:Commerce</strong> Shop Konfiguration war erfolgreich');
define('TEXT_TEAM', 'Vielen Dank, dass Sie sich für xt:Commerce entschieden haben. Besuchen Sie uns auf der xt:Commerce Supportseite <a href="http://www.xt:Commerce.com">http://www.xt:Commerce.com</a><br />Alles Gute und viel Erfolg wünscht Ihnen das gesamte xt:Commerce Team.');
?>