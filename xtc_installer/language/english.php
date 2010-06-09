<?php

/* --------------------------------------------------------------
   $Id: english.php 276 2007-03-22 09:16:03Z mzanier $   

   xt:Commerce - community made shopping
   http://www.xt-Commerce.com

   Copyright (c) 2003 xt:Commerce
   --------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (english.php,v 1.8 2003/08/13); www.nextcommerce.org
   
   Released under the GNU General Public License 
   --------------------------------------------------------------*/
// Global
define('_CHARSET', 'iso-8859-15');
// Box names
define('BOX_LANGUAGE', 'Language');
define('BOX_DB_CONNECTION', 'DB Connection');
define('BOX_WEBSERVER_SETTINGS', 'Webserver Settings');
define('BOX_DB_IMPORT', 'DB Import');
define('BOX_WRITE_CONFIG', 'Write config files');
define('BOX_ADMIN_CONFIG', 'Administrator config');
define('BOX_USERS_CONFIG', 'User config');

define('PULL_DOWN_DEFAULT', 'Please select a Country!');

// Error messages
// index.php
define('SELECT_LANGUAGE_ERROR', 'Please select a language!');
// install_step2,5.php
define('TEXT_CONNECTION_ERROR', 'A test connection made to the database was NOT successful.');
define('TEXT_CONNECTION_SUCCESS', 'A test connection made to the database was successful.');
define('TEXT_DB_ERROR', 'The error message returned is:');
define('TEXT_DB_ERROR_1', 'Please click on the <i>Back</i> graphic to review your database server settings.');
define('TEXT_DB_ERROR_2', 'If you require help with your database server settings, please consult your hosting company.');
// install_step6.php
define('ENTRY_FIRST_NAME_ERROR', 'Firstname to short');
define('ENTRY_LAST_NAME_ERROR', 'Lastname to short');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Email to short');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Check Email Format');
define('ENTRY_STREET_ADDRESS_ERROR', 'Street to short');
define('ENTRY_POST_CODE_ERROR', 'Post Code to short');
define('ENTRY_CITY_ERROR', 'City to short');
define('ENTRY_COUNTRY_ERROR', 'Check Country');
define('ENTRY_STATE_ERROR', 'Check State');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Telephone number to short');
define('ENTRY_PASSWORD_ERROR', 'Check Password');
define('ENTRY_STORE_NAME_ERROR', 'Store name to short');
define('ENTRY_COMPANY_NAME_ERROR', 'Company name to short');
define('ENTRY_EMAIL_ADDRESS_FROM_ERROR', 'Email-From to short');
define('ENTRY_EMAIL_ADDRESS_FROM_CHECK_ERROR', 'Check Email-From Format');
define('SELECT_ZONE_SETUP_ERROR', 'Select Zone setup');


// index.php
define('TITLE_SELECT_LANGUAGE', 'Select your language!');

define('TEXT_WELCOME_INDEX', '<b>Welcome to xt:Commerce</b><br /><br />xt:Commerce is an open source e-commerce solution under on going development by the xt:Commerce Team and its community.<br /> Its feature packed out-of-the-box installation allows store owners to setup, run, and maintain their online stores with minimum effort and with no costs involved.<br /> xt:Commerce combines open source solutions to provide a free and open development platform, which includes the powerful PHP web scripting language, the stable Apache web server, and the fast MySQL database server.<br /><br />With no restrictions or special requirements, xt:Commerce can be installed on any PHP4 enabled web server, on any environment that PHP and MySQL supports, which includes Linux, Solaris, BSD, and Microsoft Windows environments.<br /><br /><b>Willkommen zu xt:Commerce</b><br /><br />xt:Commerce ist eine Open-Source e-commerce Lösung, die ständig vom xt:Commerce Team und einer grossen Gemeinschaft weiterentwickelt wird.<br /> Seine out-of-the-box Installation erlaubt es dem Shop-Besitzer seinen Online-Shop mit einem Minimum an Aufwand und Kosten zu installieren, zu betreiben und zu verwalten.<br /><br />xt:Commerce ist auf jedem System lauffähig, welches eine PHP Umgebung (ab PHP 4.1) und mySQL zur Verfügung stellt, wie zum Beispiel Linux, Solaris, BSD, und Microsoft Windows.');
define('TEXT_WELCOME_STEP1', '<b>Main database and webserver settings</b><br /><br />Please enter your Database and webserver settings.<br />');
define('TEXT_WELCOME_STEP2', '<b>Install database</b><br /><br />The xt:Commerce installer will automatically install the xt:Commerce database.');
define('TEXT_WELCOME_STEP3', '<b>Database import.</b><br /><br />');
define('TEXT_WELCOME_STEP4', '<b>Configure xt:Commerce main files</b><br /><br /><b>If there are old configure files from a further installation, xt:Commerce wiill delete them</b><br /><br />The installer will set up the configuration files with the main parameters for database and file structur.<br /><br />You can choose between different session handling systems.');
define('TEXT_WELCOME_STEP5', '<b>Webserver Configuration</b><br /><br />');
define('TEXT_WELCOME_STEP6', '<b>Basic shop configuration</b><br /><br />The installer will create the admin account and will perform some db actions.<br /> The given informations for <b>Country</b> and <b>Post Code</b> are used for shipping and tax callculations.<br /><br />If you wish, xtcommerce can automatically setup the zones,tax-rates and tax-classes for delivering/selling within the European Union.<br />Just set <b>setup zones for EU</b> to <b>YES</b>.');
define('TEXT_WELCOME_FINISHED', '<b>xt:Commerce installation successful!</b>');
// install_step1.php

define('TITLE_CUSTOM_SETTINGS', 'Custom Settings');
define('TEXT_IMPORT_DB', 'Import xt:Commerce Database');
define('TEXT_IMPORT_DB_LONG', 'Import the xt:Commerce database structure which includes tables and sample data.');
define('TEXT_AUTOMATIC', 'Automatic Configuration');
define('TEXT_AUTOMATIC_LONG', 'The information you submit regarding the web server and database server will be automatically saved into both xt:Commerce Shop and Administration Tool configuration files.');
define('TITLE_DATABASE_SETTINGS', 'Database Settings');
define('TEXT_DATABASE_SERVER', 'Database Server');
define('TEXT_DATABASE_SERVER_LONG', 'The database server can be in the form of a hostname, such as <i>db1.myserver.com</i>, or as an IP address, such as <i>192.168.0.1</i>.');
define('TEXT_USERNAME', 'Username');
define('TEXT_USERNAME_LONG', 'The username is used to connect to the database server. An example username is <i>mysql_10</i>.<br /><br />Note: If the xtcommerce Database is to be imported (selected above), the account used to connect to the database server needs to have Create and Drop permissions.');
define('TEXT_PASSWORD', 'Password');
define('TEXT_PASSWORD_LONG', 'The password is used together with the username, which forms the database user account.');
define('TEXT_DATABASE', 'Database');
define('TEXT_DATABASE_LONG', 'The database used to hold the catalog data. An example database name is <i>xtcommerce</i>.<br /><b>ATTENTION:</b> xt:Commerce need an empty Database to perform Installation.');
define('TITLE_WEBSERVER_SETTINGS', 'Webserver Settings');
define('TEXT_WS_ROOT', 'Webserver Root Directory');
define('TEXT_WS_ROOT_LONG', 'The directory where your web pages are being served from, usually <i>/home/myname/public_html</i>.');
define('TEXT_WWW_ADDRESS','WWW Address');
// install_step2.php

define('TEXT_PROCESS_1', 'Please continue the installation process to execute the database import procedure.');
define('TEXT_PROCESS_2', 'It is important this procedure is not interrupted, otherwise the database may end up corrupt.');
define('TEXT_PROCESS_3', 'The file to import must be located and named at: ');

// install_step3.php

define('TEXT_TITLE_ERROR', 'The following error has occurred:');
define('TEXT_TITLE_SUCCESS', 'The database import was successful!');

// install_step4.php
define('TITLE_WEBSERVER_CONFIGURATION', 'Webserver Configuration:');
define('TITLE_STEP4_ERROR', 'The following error has occurred:');
define('TEXT_STEP4_ERROR', '<b>The configuration files do not exist, or permission levels are not set.</b><br /><br />Please perform the following actions: ');
define('TEXT_STEP4_ERROR_1', 'If <i>chmod 706</i> does not work, please try <i>chmod 777</i>.');
define('TEXT_STEP4_ERROR_2', 'If you are running this installation procedure under a Microsoft Windows environment, try renaming the existing configuration file so a new file can be created.');
define('TEXT_VALUES', 'The configuration values will be written to:');
define('TITLE_CHECK_CONFIGURATION', 'Please check your web-server informations');
define('TITLE_CHECK_DATABASE', 'Please check your database-server informations');
define('TEXT_PERSIST', 'Enable Persistent Connections');
define('TEXT_PERSIST_LONG', 'Enable persistent database connections. Please disable this if you are on a shared server.');
define('TEXT_SESS_FILE', 'Store Sessions as Files');
define('TEXT_SESS_DB', 'Store Sessions in the Database');
define('TEXT_SESS_LONG', 'The location to store PHPs sessions files.');

// install_step5.php

define('TEXT_WS_CONFIGURATION_SUCCESS', '<strong>xt:Commerce</strong> Webserver configuration was successful');

// install_step6.php

define('TITLE_ADMIN_CONFIG', 'Administrator configuration');
define('TEXT_REQU_INFORMATION', '* required information');
define('TEXT_FIRSTNAME', 'First Name:');
define('TEXT_LASTNAME', 'Last Name:');
define('TEXT_EMAIL', 'E-Mail Address:');
define('TEXT_EMAIL_LONG', '(for receiving orders)');
define('TEXT_STREET', 'Street Address:');
define('TEXT_POSTCODE', 'Post Code:');
define('TEXT_CITY', 'City:');
define('TEXT_STATE', 'State/Province:');
define('TEXT_COUNTRY', 'Country:');
define('TEXT_COUNTRY_LONG', 'Will be used for shipping and tax');
define('TEXT_TEL', 'Telephone  Number:');
define('TEXT_PASSWORD', 'Password:');
define('TEXT_PASSWORD_CONF', 'Password Confirmation:');
define('TITLE_SHOP_CONFIG', 'Shop configuration');
define('TEXT_STORE', 'Store Name:');
define('TEXT_STORE_LONG', '(The name of my store)');
define('TEXT_EMAIL_FROM', 'E-Mail From');
define('TEXT_EMAIL_FROM_LONG', '(The e-mail adress used in (sent) e-mails)');
define('TITLE_ZONE_CONFIG', 'Zone configuration');
define('TEXT_ZONE', 'Set up zones for EU?');
define('TITLE_ZONE_CONFIG_NOTE', 'xt:Commerce can automatically setup the right Zone-Setup if your store is located within the EU.');
define('TITLE_SHOP_CONFIG_NOTE', 'Information for basic Shop configuration');
define('TITLE_ADMIN_CONFIG_NOTE', 'Information for Admin/Superuser');
define('TEXT_ZONE_NO', 'No');
define('TEXT_ZONE_YES', 'Yes');
define('TEXT_COMPANY', 'Company name');


define('TITLE_CHMOD', 'Setting rights on files');
// install_fnished.php

define('TEXT_SHOP_CONFIG_SUCCESS', '<strong>xt:Commerce</strong> Shop configuration was successful.');
define('TEXT_TEAM', 'The xt:Commerce dev Team.<br /><a href="http://www.xt:Commerce.com">xt:Commerce support site</a>');
?>