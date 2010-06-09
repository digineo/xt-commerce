<?php
/* -----------------------------------------------------------------------------------------
   $Id: german.php,v 1.13 2004/06/06 17:20:36 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(german.php,v 1.119 2003/05/19); www.oscommerce.com 
   (c) 2003  nextcommerce (german.php,v 1.25 2003/08/25); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat try 'de_DE'
// on FreeBSD try 'de_DE.ISO_8859-15'
// on Windows try 'de' or 'German'
setlocale(LC_TIME, 'de_DE@euro', 'de_DE', 'de-DE', 'de', 'ge', 'de_DE.ISO_8859-1', 'German','de_DE.ISO_8859-15');
define('DATE_FORMAT_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A, %d. %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y');  // this is used for strftime()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

// page title
define('TITLE', STORE_NAME);

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function xtc_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="de"');

define('HEADER_TITLE_TOP', 'Startseite');
define('HEADER_TITLE_CATALOG', 'Katalog');

 // text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');
define('MALE_ADDRESS', 'Herr');
define('FEMALE_ADDRESS', 'Frau');

// text for date of birth example
define('DOB_FORMAT_STRING', 'tt.mm.jjjj');

// text for quick purchase
define('IMAGE_BUTTON_ADD_QUICK', 'Schnellkauf!');
define('BOX_ADD_PRODUCT_ID_TEXT', 'Bitte geben Sie die Artikelnummer aus unserem Katalog ein.');

// text for gift voucher redeeming
define('IMAGE_REDEEM_GIFT','Gutschein Einl&ouml;sen!');

define('BOX_TITLE_STATISTICS','Statistik:');
define('BOX_ENTRY_CUSTOMERS','Kunden');
define('BOX_ENTRY_PRODUCTS','Artikel');
define('BOX_ENTRY_REVIEWS','Bewertungen');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_SEARCH_TEXT', 'Verwenden Sie Stichworte um einen speziellen Artikel zu finden.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Erweiterte Suche');

// reviews box text in includes/boxes/reviews.php
define('BOX_REVIEWS_WRITE_REVIEW', 'Bewerten Sie diesen Artikel!');
define('BOX_REVIEWS_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s von 5 Sternen!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_SHOPPING_CART_EMPTY', '0 Artikel');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_NOTIFICATIONS_NOTIFY', 'Benachrichtigen Sie mich &uuml;ber Aktuelles zum Artikel <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Benachrichtigen Sie mich nicht mehr zum Artikel <b>%s</b>');

// manufacturer box text
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Mehr Artikel');

define('BOX_HEADING_ADD_PRODUCT_ID','In den Korb legen');
define('BOX_HEADING_SEARCH','Suchen!');

define('BOX_INFORMATION_CONTACT', 'Kontakt');


// pull down default text
define('PULL_DOWN_DEFAULT', 'Bitte w&auml;hlen');
define('TYPE_BELOW', 'Bitte unten eingeben');

// javascript messages
define('JS_ERROR', 'Notwendige Angaben fehlen!\n Bitte richtig ausf&uuml;llen.\n\n');

define('JS_REVIEW_TEXT', '* Der Text muss mindestens aus ' . REVIEW_TEXT_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_REVIEW_RATING', '* Geben Sie Ihre Bewertung ein.\n');
define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Bitte w&auml;hlen Sie eine Zahlungsweise f&uuml;r Ihre Bestellung.\n');
define('JS_ERROR_SUBMITTED', 'Diese Seite wurde bereits best&auml;tigt. Klicken Sie bitte OK und warten bis der Prozess durchgef&uuml;hrt wurde.');
define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte w&auml;hlen Sie eine Zahlungsweise f&uuml;r Ihre Bestellung.');
define('CATEGORY_COMPANY', 'Firmendaten');
define('CATEGORY_PERSONAL', 'Ihre pers&ouml;nlichen Daten');
define('CATEGORY_ADDRESS', 'Ihre Adresse');
define('CATEGORY_CONTACT', 'Ihre Kontaktinformationen');
define('CATEGORY_OPTIONS', 'Optionen');
define('CATEGORY_PASSWORD', 'Ihr Passwort');

define('ENTRY_COMPANY', 'Firmenname:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Anrede:');
define('ENTRY_GENDER_ERROR', 'Bitte w&auml;hlen Sie Ihre Anrede aus.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', 'Ihr Vorname muss aus mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', 'Ihr Nachname muss aus mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Ihr Geburtsdatum muss im Format TT.MM.JJJJ (zB. 21.05.1970) eingeben werden');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (zB. 21.05.1970)');
define('ENTRY_EMAIL_ADDRESS', 'eMail-Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Ihre eMail-Adresse muss aus mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Ihre eingegebene eMail-Adresse ist fehlerhaft - bitte &uuml;berpr&uuml;fen Sie diese.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Ihre eingegebene eMail-Adresse existiert bereits in unserer Datenbank - bitte melden Sie sich mit dieser an, oder erstellen Sie ein neues Konto mit einer neuen eMail-Adresse.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Strasse/Nr.:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Strasse/Nr muss aus mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Stadtteil:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', 'Ihre Postleitzahl muss aus mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CITY_ERROR', 'Ort muss aus mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Bundesland:');
define('ENTRY_STATE_ERROR', 'Ihr Bundesland muss aus mindestens ' . ENTRY_STATE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STATE_ERROR_SELECT', 'Bitte w&auml;hlen Sie ihr Bundesland aus der Liste aus.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', 'Bitte w&auml;hlen Sie ihr Land aus der Liste aus.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Ihre Telefonnummer muss aus mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Telefaxnummer:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'abonniert');
define('ENTRY_NEWSLETTER_NO', 'nicht abonniert');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Passwort:');
define('ENTRY_PASSWORD_ERROR', 'Ihr Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Ihre Passw&ouml;rter stimmen nicht &uuml;berein.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Best&auml;tigung:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Aktuelles Passwort:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Ihr Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_NEW', 'Neues Passwort:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Ihr neues Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Ihre Passw&ouml;rter stimmen nicht &uuml;berein.');
define('PASSWORD_HIDDEN', '--VERSTECKT--');


// constants for use in xtc_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seiten:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zeige <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zeige <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zeige <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Zeige <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> neuen Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zeige <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Angeboten)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'erste Seite');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'vorherige Seite');
define('PREVNEXT_TITLE_NEXT_PAGE', 'n&auml;chste Seite');
define('PREVNEXT_TITLE_LAST_PAGE', 'letzte Seite');
define('PREVNEXT_TITLE_PAGE_NO', 'Seite %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorhergehende %d Seiten');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'N&auml;chste %d Seiten');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;ERSTE');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;vorherige]');
define('PREVNEXT_BUTTON_NEXT', '[n&auml;chste&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'LETZTE&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Neue Adresse');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adressbuch');
define('IMAGE_BUTTON_BACK', 'Zur&uuml;ck');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Adresse &auml;ndern');
define('IMAGE_BUTTON_CHECKOUT', 'Kasse');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Bestellung best&auml;tigen');
define('IMAGE_BUTTON_CONTINUE', 'Weiter');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Einkauf fortsetzen');
define('IMAGE_BUTTON_DELETE', 'L&ouml;schen');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Daten &auml;ndern');
define('IMAGE_BUTTON_HISTORY', 'Bestell&uuml;bersicht');
define('IMAGE_BUTTON_LOGIN', 'Anmelden');
define('IMAGE_BUTTON_IN_CART', 'In den Warenkorb');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Benachrichtigungen');
define('IMAGE_BUTTON_QUICK_FIND', 'Schnellsuche');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Benachrichtigungen l&ouml;schen');
define('IMAGE_BUTTON_REVIEWS', 'Bewertungen');
define('IMAGE_BUTTON_SEARCH', 'Suchen');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Versandoptionen');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Weiterempfehlen');
define('IMAGE_BUTTON_UPDATE', 'Aktualisieren');
define('IMAGE_BUTTON_UPDATE_CART', 'Warenkorb aktualisieren');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Bewertung schreiben');
define('IMAGE_BUTTON_ADMIN', 'Admin'); 
define('IMAGE_BUTTON_PRODUCT_EDIT', 'Produkt bearbeiten');

define('SMALL_IMAGE_BUTTON_DELETE', 'L&ouml;schen');
define('SMALL_IMAGE_BUTTON_EDIT', '&Auml;ndern');
define('SMALL_IMAGE_BUTTON_VIEW', 'Anzeigen');

define('ICON_ARROW_RIGHT', 'Zeige mehr');
define('ICON_CART', 'In den Warenkorb');
define('ICON_SUCCESS', 'Erfolg');
define('ICON_WARNING', 'Warnung');

define('TEXT_GREETING_PERSONAL', 'Sch&ouml;n, dass Sie wieder da sind, <span class="greetUser">%s!</span> M&ouml;chten Sie sich unsere <a style="text-decoration:underline;" href="%s">neuen Artikel</a> ansehen?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Wenn Sie nicht %s sind, melden Sie sich bitte <a style="text-decoration:underline;" href="%s">hier</a> mit Ihren Anmeldedaten an.</small>');
define('TEXT_GREETING_GUEST', 'Herzlich Willkommen <span class="greetUser">Gast!</span> M&ouml;chten Sie sich <a style="text-decoration:underline;" href="%s">anmelden</a>? Oder wollen Sie ein <a style="text-decoration:underline;" href="%s">Kundenkonto</a> er&ouml;ffnen?');

define('TEXT_SORT_PRODUCTS', 'Sortierung der Artikel ist ');
define('TEXT_DESCENDINGLY', 'absteigend');
define('TEXT_ASCENDINGLY', 'aufsteigend');
define('TEXT_BY', ' nach ');

define('TEXT_REVIEW_BY', 'von %s');
define('TEXT_REVIEW_WORD_COUNT', '%s Worte');
define('TEXT_REVIEW_RATING', 'Bewertung: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Hinzugef&uuml;gt am: %s');
define('TEXT_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor.');

define('TEXT_NO_NEW_PRODUCTS', 'Zur Zeit gibt es keine neuen Artikel.');

define('TEXT_UNKNOWN_TAX_RATE', 'Unbekannter Steuersatz');

define('TEXT_REQUIRED', '<span class="errorText">erforderlich</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>Fehler:</small> Die eMail kann nicht &uuml;ber den angegebenen SMTP-Server verschickt werden. Bitte kontrollieren Sie die Einstellungen in der php.ini Datei und f&uuml;hren Sie notwendige Korrekturen durch!</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warnung: Das Installationverzeichnis ist noch vorhanden auf: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/xtc_installer. Bitte l&ouml;schen Sie das Verzeichnis aus Gr&uuml;nden der Sicherheit!');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warnung: XT-Commerce kann in die Konfigurationsdatei schreiben: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. Das stellt ein m&ouml;gliches Sicherheitsrisiko dar - bitte korrigieren Sie die Benutzerberechtigungen zu dieser Datei!');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis f&uuml;r die Sessions existiert nicht: ' . xtc_session_save_path() . '. Die Sessions werden nicht funktionieren bis das Verzeichnis erstellt wurde!');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warnung: XT-Commerce kann nicht in das Sessions Verzeichnis schreiben: ' . xtc_session_save_path() . '. Die Sessions werden nicht funktionieren bis die richtigen Benutzerberechtigungen gesetzt wurden!');
define('WARNING_SESSION_AUTO_START', 'Warnung: session.auto_start ist aktiviert (enabled) - Bitte deaktivieren (disabled) Sie dieses PHP Feature in der php.ini und starten Sie den WEB-Server neu!');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis f&uuml;r den Artikel Download existiert nicht: ' . DIR_FS_DOWNLOAD . '. Diese Funktion wird nicht funktionieren bis das Verzeichnis erstellt wurde!');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Das "G&uuml;ltig bis" Datum ist ung&uuml;ltig. Bitte korrigieren Sie Ihre Angaben.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Die "Kreditkarten-Nummer", die Sie angegeben haben, ist ung&uuml;ltig. Bitte korrigieren Sie Ihre Angaben.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Die ersten 4 Ziffern Ihrer Kreditkarte sind: %s Wenn diese Angaben stimmen, wird dieser Kartentyp leider nicht akzeptiert. Bitte korrigieren Sie Ihre Angaben gegebenfalls.');

//  conditions check
define('ERROR_CONDITIONS_NOT_ACCEPTED', 'Sofern Sie unsere Allgemeinen Gesch&auml;ftsbedingungen nicht akzeptieren, k&ouml;nnen wir Ihre Bestellung bedauerlicherweise nicht entgegennehmen!');

define('SUB_TITLE_OT_DISCOUNT','Rabatt:');
define('SUB_TITLE_SUB_NEW','Summe:');

define('NOT_ALLOWED_TO_SEE_PRICES','Sie k&ouml;nnen als Gast (bzw mit Ihrem derzeitigen Status) keine Preise sehen');
define('NOT_ALLOWED_TO_ADD_TO_CART','Sie k&ouml;nnen als Gast (bzw mit Ihrem derzeitigen Status) keine Artikel in den Warenkorb legen');

define('BOX_LOGINBOX_HEADING', 'Willkommen zur&uuml;ck!');
define('BOX_LOGINBOX_EMAIL', 'eMail-Adresse:');
define('BOX_LOGINBOX_PASSWORD', 'Passwort:');
define('IMAGE_BUTTON_LOGIN', 'Anmelden');
define('BOX_ACCOUNTINFORMATION_HEADING','Information');
define('BOX_NEWSLETTER_EMAIL', 'eMail-Adresse:');
define('BOX_LOGINBOX_STATUS','Kundengruppe:');
define('BOX_LOGINBOX_INCL','Alle Preise inkl. UST');
define('BOX_LOGINBOX_EXCL','Alle Preise exkl. UST');
define('TAX_ADD_TAX','inkl. ');
define('TAX_NO_TAX','zzgl. ');
define('BOX_LOGINBOX_DISCOUNT','Artikelrabatt');
define('BOX_LOGINBOX_DISCOUNT_TEXT','Rabatt');
define('BOX_LOGINBOX_DISCOUNT_OT','');

define('NOT_ALLOWED_TO_SEE_PRICES_TEXT','Sie haben keine Erlaubnis Preise zu sehen, erstellen Sie bitte ein Kundenkonto.');

define('TEXT_DOWNLOAD','Download');
define('TEXT_VIEW','Ansehen');

define('TEXT_BUY', '1 x \'');
define('TEXT_NOW', '\' bestellen');
define('TEXT_GUEST','Gast');
define('TEXT_NO_PURCHASES', 'Sie haben noch keine Bestellungen get&auml;tigt.');


// Warnings
define('SUCCESS_ACCOUNT_UPDATED', 'Ihr Konto wurde erfolgreich aktualisiert.');
define('SUCCESS_NEWSLETTER_UPDATED', 'Ihre Newsletter Abonnements wurden erfolgreich aktualisiert!');
define('SUCCESS_NOTIFICATIONS_UPDATED', 'Ihre Artikelbenachrichtigungen wurden erfolgreich aktualisiert!');
define('SUCCESS_PASSWORD_UPDATED', 'Ihr Passwort wurde erfolgreich ge&auml;ndert!');
define('ERROR_CURRENT_PASSWORD_NOT_MATCHING', 'Das eingegebene Passwort stimmt nicht mit dem gespeichertem Passwort &uuml;berein. Bitte versuchen Sie es noch einmal.');
define('TEXT_MAXIMUM_ENTRIES', '<span class="errorText"><b>Hinweis:</b></span> Ihnen stehen %s Adressbucheintr&auml;ge zur Verf&uuml;gung!');
define('SUCCESS_ADDRESS_BOOK_ENTRY_DELETED', 'Der ausgew&auml;hlte Eintrag wurde erfolgreich gel&ouml;scht.');
define('SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED', 'Ihr Adressbuch wurde erfolgreich aktualisiert!');
define('WARNING_PRIMARY_ADDRESS_DELETION', 'Die Standardadresse kann nicht gel&ouml;scht werden. Bitte erst eine andere Standardadresse w&auml;hlen. Danach kann der Eintrag gel&ouml;scht werden.');
define('ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY', 'Dieser Adressbucheintrag ist nicht vorhanden.');
define('ERROR_ADDRESS_BOOK_FULL', 'Ihr Adressbuch kann keine weiteren Adressen aufnehmen. Bitte l&ouml;schen Sie eine nicht mehr ben&ouml;tigte Adresse. Danach k&ouml;nnen Sie einen neuen Eintrag speichern.');

//Advanced Search
define('ENTRY_CATEGORIES', 'Kategorien:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Unterkategorien mit einbeziehen');
define('ENTRY_MANUFACTURERS', 'Hersteller:');
define('ENTRY_PRICE_FROM', 'Preis ab:');
define('ENTRY_PRICE_TO', 'Preis bis:');
define('TEXT_ALL_CATEGORIES', 'Alle Kategorien');
define('TEXT_ALL_MANUFACTURERS', 'Alle Hersteller');
define('JS_AT_LEAST_ONE_INPUT', '* Eines der folgenden Felder muss ausgef&uuml;llt werden:\n    Stichworte\n    Datum hinzugef&uuml;gt von\n    Datum hinzugef&uuml;gt bis\n    Preis ab\n    Preis bis\n');
define('JS_INVALID_FROM_DATE', '* Unzul&auml;ssiges von Datum\n');
define('JS_INVALID_TO_DATE', '* Unzul&auml;ssiges bis Datum\n');
define('JS_TO_DATE_LESS_THAN_FROM_DATE', '* Das von Datum muss gr&ouml;sser oder gleich bis jetzt sein\n');
define('JS_PRICE_FROM_MUST_BE_NUM', '* Preis ab, muss eine Zahl sein\n');
define('JS_PRICE_TO_MUST_BE_NUM', '* Preis bis, muss eine Zahl sein\n');
define('JS_PRICE_TO_LESS_THAN_PRICE_FROM', '* Preis bis muss gr&ouml;sser oder gleich Preis ab sein.\n');
define('JS_INVALID_KEYWORDS', '* Suchbegriff unzul&auml;ssig\n');
define('TEXT_NO_PRODUCTS', 'Es wurden keine Artikel gefunden, die den Suchkriterien entsprechen.');
define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>ACHTUNG:</b></font></small> Wenn Sie bereits ein Konto besitzen, melden Sie sich bitte <a style="text-decoration:underline;" href="%s"><b>hier</b></a> an.');
define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>FEHLER:</b></font> Keine &Uuml;bereinstimmung der eingebenen \'eMail-Adresse\' und/oder dem \'Passwort\'.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>ACHTUNG:</b></font> Ihre Eingaben werden automatisch mit Ihrem Kundenkonto verkn&uuml;pft. <a href="javascript:session_win();">[Mehr Information]</a>');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>ACHTUNG:</b></font> Die eingegebene eMail-Adresse ist nicht registriert. Bitte versuchen Sie es noch einmal.');
define('TEXT_PASSWORD_SENT', 'Ein neues Passwort wurde per eMail verschickt.');
define('TEXT_PRODUCT_NOT_FOUND', 'Artikel wurde nicht gefunden!');
define('TEXT_MORE_INFORMATION', 'F&uuml;r weitere Informationen, besuchen Sie bitte die <a style="text-decoration:underline;" href="%s" onclick="window.open(this.href); return false;">Homepage</a> zu diesem Artikel.');
define('TEXT_DATE_ADDED', 'Diesen Artikel haben wir am %s in unseren Katalog aufgenommen.');
define('TEXT_DATE_AVAILABLE', '<font color="#ff0000">Dieser Artikel wird voraussichtlich ab dem %s wieder vorr&auml;tig sein.</font>');
define('TEXT_CART_EMPTY', 'Sie haben noch nichts in Ihrem Warenkorb.');
define('SUB_TITLE_SUB_TOTAL', 'Zwischensumme:');
define('SUB_TITLE_TOTAL', 'Summe:');

define('OUT_OF_STOCK_CANT_CHECKOUT', 'Die mit ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' markierten Artikel sind leider nicht in der von Ihnen gew&uuml;nschten Menge auf Lager.<br />Bitte reduzieren Sie Ihre Bestellmenge f&uuml;r die gekennzeichneten Artikel. Vielen Dank');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Die mit ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' markierten Artikel sind leider nicht in der von Ihnen gew&uuml;nschten Menge auf Lager.<br />Die bestellte Menge wird kurzfristig von uns geliefert, wenn Sie es w&uuml;nschen nehmen wir auch eine Teillieferung vor.');

define('HEADING_TITLE_TELL_A_FRIEND', 'Empfehlen Sie \'%s\' weiter');
define('HEADING_TITLE_ERROR_TELL_A_FRIEND', 'Artikel weiterempfehlen');
define('ERROR_INVALID_PRODUCT', 'Das von Ihnen gew&auml;hlte Artikel wurde nicht gefunden!');

define('NAVBAR_TITLE_ACCOUNT', 'Ihr Konto');
define('NAVBAR_TITLE_1_ACCOUNT_EDIT', 'Ihr Konto');
define('NAVBAR_TITLE_2_ACCOUNT_EDIT', 'Ihre pers&ouml;nliche Daten &auml;ndern');
define('NAVBAR_TITLE_1_ACCOUNT_HISTORY', 'Ihr Konto');
define('NAVBAR_TITLE_2_ACCOUNT_HISTORY', 'Ihre get&auml;tigten Bestellungen');
define('NAVBAR_TITLE_1_ACCOUNT_HISTORY_INFO', 'Ihr Konto');
define('NAVBAR_TITLE_2_ACCOUNT_HISTORY_INFO', 'Get&auml;tigte Bestellung');
define('NAVBAR_TITLE_3_ACCOUNT_HISTORY_INFO', 'Bestellnummer %s');
define('NAVBAR_TITLE_1_ACCOUNT_NEWSLETTERS', 'Ihr Konto');
define('NAVBAR_TITLE_2_ACCOUNT_NEWSLETTERS', 'Newsletter Abonnements');
define('NAVBAR_TITLE_1_ACCOUNT_NOTIFICATIONS', 'Ihr Konto');
define('NAVBAR_TITLE_2_ACCOUNT_NOTIFICATIONS', 'Artikelbenachrichtungen');
define('NAVBAR_TITLE_1_ACCOUNT_PASSWORD', 'Ihr Konto');
define('NAVBAR_TITLE_2_ACCOUNT_PASSWORD', 'Passwort &auml;ndern');
define('NAVBAR_TITLE_1_ADDRESS_BOOK', 'Ihr Konto');
define('NAVBAR_TITLE_2_ADDRESS_BOOK', 'Adressbuch');
define('NAVBAR_TITLE_1_ADDRESS_BOOK_PROCESS', 'Ihr Konto');
define('NAVBAR_TITLE_2_ADDRESS_BOOK_PROCESS', 'Adressbuch');
define('NAVBAR_TITLE_ADD_ENTRY_ADDRESS_BOOK_PROCESS', 'Neuer Eintrag');
define('NAVBAR_TITLE_MODIFY_ENTRY_ADDRESS_BOOK_PROCESS', 'Eintrag &auml;ndern');
define('NAVBAR_TITLE_DELETE_ENTRY_ADDRESS_BOOK_PROCESS', 'Eintrag l&ouml;schen');
define('NAVBAR_TITLE_ADVANCED_SEARCH', 'Erweiterte Suche');
define('NAVBAR_TITLE1_ADVANCED_SEARCH', 'Erweiterte Suche');
define('NAVBAR_TITLE2_ADVANCED_SEARCH', 'Suchergebnisse');
define('NAVBAR_TITLE_1_CHECKOUT_CONFIRMATION', 'Kasse');
define('NAVBAR_TITLE_2_CHECKOUT_CONFIRMATION', 'Best&auml;tigung');
define('NAVBAR_TITLE_1_CHECKOUT_PAYMENT', 'Kasse');
define('NAVBAR_TITLE_2_CHECKOUT_PAYMENT', 'Zahlungsweise');
define('NAVBAR_TITLE_1_PAYMENT_ADDRESS', 'Kasse');
define('NAVBAR_TITLE_2_PAYMENT_ADDRESS', 'Rechnungsadresse &auml;ndern');
define('NAVBAR_TITLE_1_CHECKOUT_SHIPPING', 'Kasse');
define('NAVBAR_TITLE_2_CHECKOUT_SHIPPING', 'Versandinformationen');
define('NAVBAR_TITLE_1_CHECKOUT_SHIPPING_ADDRESS', 'Kasse');
define('NAVBAR_TITLE_2_CHECKOUT_SHIPPING_ADDRESS', 'Versandadresse &auml;ndern');
define('NAVBAR_TITLE_1_CHECKOUT_SUCCESS', 'Kasse');
define('NAVBAR_TITLE_2_CHECKOUT_SUCCESS', 'Erfolg');
define('NAVBAR_TITLE_CONTACT_US', 'Kontakt');
define('NAVBAR_TITLE_CREATE_ACCOUNT', 'Konto erstellen');
define('NAVBAR_TITLE_1_CREATE_ACCOUNT_SUCCESS', 'Konto erstellen');
define('NAVBAR_TITLE_2_CREATE_ACCOUNT_SUCCESS', 'Erfolg');
if ($navigation->snapshot['page'] == FILENAME_CHECKOUT_SHIPPING) {
  define('NAVBAR_TITLE_LOGIN', 'Bestellen');
} else {
  define('NAVBAR_TITLE_LOGIN', 'Anmelden');
}
define('NAVBAR_TITLE_LOGOFF','Auf Wiedersehen');
define('NAVBAR_TITLE_1_PASSWORD_FORGOTTEN', 'Anmelden');
define('NAVBAR_TITLE_2_PASSWORD_FORGOTTEN', 'Passwort vergessen');
define('NAVBAR_TITLE_PRODUCTS_NEW', 'Neue Artikel');
define('NAVBAR_TITLE_SHOPPING_CART', 'Warenkorb');
define('NAVBAR_TITLE_SPECIALS', 'Angebote');
define('NAVBAR_TITLE_COOKIE_USAGE', 'Cookie-Nutzung');
define('NAVBAR_TITLE_PRODUCT_REVIEWS', 'Bewertungen');
define('NAVBAR_TITLE_TELL_A_FRIEND', 'Artikel weiterempfehlen');
define('NAVBAR_TITLE_REVIEWS_WRITE', 'Bewertungen');
define('NAVBAR_TITLE_REVIEWS','Bewertungen');
define('NAVBAR_TITLE_SSL_CHECK', 'Sicherheitshinweis');
define('NAVBAR_TITLE_CREATE_GUEST_ACCOUNT','Konto erstellen');
define('NAVBAR_TITLE_PASSWORD_DOUBLE_OPT','Passwort vergessen?');
// Newsletter
define('NAVBAR_TITLE_NEWSLETTER','Newsletter');
define('TEXT_INFO_START','Tragen Sie sich in unseren kostenlosen Newsletter ein!');
define('TEXT_NEWSLETTER','Sie m&ouml;chten immer auf dem Laufenden bleiben?<br />Kein Problem, tragen Sie sich in unseren Newsletter ein und Sie sind immer auf dem neuesten Stand.');
define('TEXT_EMAIL_INPUT','Ihre eMail-Adresse wurde in unser System eingetragen.<br />Gleichzeitig wurde Ihnen vom System eine eMail mit einem Aktivierungslink geschickt. Bitte klicken Sie nach dem Erhalt der eMail auf den Link um Ihre Eintragung zu best&auml;tigen. Ansonsten bekommen Sie keinen Newsletter von uns zugestellt!');

define('TEXT_WRONG_CODE','<font color="FF0000">Ihr eingegebener Sicherheitscode stimmte nicht mit dem angezeigten Code &Uuml;berein. Bitte versuchen Sie es erneut.</font>');
define('TEXT_EMAIL_EXIST_NO_NEWSLETTER','<font color="FF0000">Diese eMail-Adresse existiert bereits in unserer Datenbank ist aber noch nicht f&uuml;r den Empfang des Newsletters freigeschalten!</font>');
define('TEXT_EMAIL_EXIST_NEWSLETTER','<font color="FF0000">Diese eMail-Adresse existiert bereits in unserer Datenbank und ist f&uuml;r den Newsletterempfang bereits freigeschalten!</font>');
define('TEXT_EMAIL_NOT_EXIST','<font color="FF0000">Diese eMail-Adresse existiert nicht in unserer Datenbank!</font>');
define('TEXT_EMAIL_DEL','Ihre eMail-Adresse wurde aus unserer Newsletterdatenbank gel&ouml;scht.');
define('TEXT_EMAIL_DEL_ERROR','<font color="FF0000">Es ist ein Fehler aufgetreten, Ihre eMail-Adresse wurde nicht gel&ouml;scht!</font>');
define('TEXT_EMAIL_ACTIVE','<font color="FF0000">Ihre eMail-Adresse wurde erfolgreich f&uuml;r den Newsletterempfang freigeschalten!</font>');
define('TEXT_EMAIL_ACTIVE_ERROR','<font color="FF0000">Es ist ein Fehler aufgetreten, Ihre eMail-Adresse wurde nicht freigeschalten!</font>');
define('TEXT_EMAIL_SUBJECT','Ihre Newsletteranmeldung');
define('TEXT_CUSTOMER_GUEST','Gast');

define('TEXT_EMAIL_SUCCESSFUL_SENT','Ihre eMail wurde erfolgreich versandt!');
define('TEXT_LINK_MAIL_SENDED','Ihre Anfrage nach einem neuen Passwort muss von Ihnen erst best&auml;tigt werden.<br />Deshalb wurde Ihnen vom System eine eMail mit einem Best&auml;tigungslink geschickt. Bitte klicken Sie nach dem Erhalt der eMail auf den Link und eine weitere eMail mit Ihrem neuen Anmelde-Passwort zu erhalten. Andernfalls wird Ihnen das neue Passwort nicht zugestellt oder eingerichtet!');
define('TEXT_PASSWORD_MAIL_SENDED','Eine eMail mit einem neuen Anmelde-Passwort wurde Ihnen soeben zugestellt.<br />Bitte &auml;ndern Sie nach Ihrer n&auml;chsten Anmeldung Ihr Passwort wie gew&uuml;nscht.');
define('TEXT_CODE_ERROR','Bitte geben Sie Ihre eMail-Adresse und den Sicherheitscode erneut ein. <br />Achten Sie dabei auf Tippfehler!');
define('TEXT_EMAIL_ERROR','Bitte geben Sie Ihre eMail-Adresse und den Sicherheitscode erneut ein. <br />Achten Sie dabei auf Tippfehler!');
define('TEXT_NO_ACCOUNT','Leider m&uuml;ssen wir Ihnen mitteilen, dass Ihre Anfrage f&uuml;r ein neues Anmelde-Passwort entweder ung&uuml;ltig war oder abgelaufen ist.<br />Bitte versuchen Sie es erneut.');
define('HEADING_PASSWORD_FORGOTTEN','Passwort erneuern?');
define('TEXT_PASSWORD_FORGOTTEN','&Auml;ndern Sie Ihr Passwort in drei leichten Schritten.');
define('TEXT_EMAIL_PASSWORD_FORGOTTEN','Best&auml;tigungs-eMail f&uuml;r Passwort&auml;nderung');
define('TEXT_EMAIL_PASSWORD_NEW_PASSWORD','Ihr neues Passwort');

define('ERROR_MAIL','Bitte &uuml;berpr&uuml;fen Sie Ihre eingegebenen Daten im Formular');
define('CATEGORIE_NOT_FOUND','Kategorie wurde nicht gefunden');

define('BOX_INFORMATION_GV', 'Gutschein FAQ');
define('BOX_HEADING_GIFT_VOUCHER', 'Gutschein Konto');
define('GV_FAQ', 'Gutscheine - FAQ');
define('ERROR_REEDEEMED_AMOUNT', 'Gl&uuml;ckwunsch, Sie haben eingel&ouml;st ');
define('ERROR_NO_REDEEM_CODE', 'Sie haben leider keinen Code eingegeben.');
define('ERROR_NO_INVALID_REDEEM_GV', 'Ung&uuml;ltiger Gutscheincode');
define('TABLE_HEADING_CREDIT', 'Guthaben');
define('ENTRY_AMOUNT_CHECK_ERROR', 'Sie verf&uuml;gen nicht &uuml;ber ein entsprechendes Guthaben.');


define('EMAIL_SUBJECT', 'Nachricht von ' . STORE_NAME);
define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');

define('EMAIL_GV_TEXT_HEADER', 'Herzlichen Gl&uuml;ckwunsch, Sie haben einen Gutschein &uuml;ber %s erhalten !');
define('EMAIL_GV_TEXT_SUBJECT', 'Ein Geschenk von %s');
define('EMAIL_GV_FROM', 'Dieser Gutschein wurde Ihnen &uuml;bermittelt von %s');
define('EMAIL_GV_MESSAGE', 'Mit der Nachricht ');
define('EMAIL_GV_SEND_TO', 'Hallo, %s');
define('EMAIL_GV_REDEEMED', 'Um diesen Gutschein einzul&ouml;sen, klicken Sie bitte auf den unteren Link. Bitte notieren Sie sich zur Sicherheit Ihren Gutscheincode :  %s, so k&ouml;nnen wir Ihnen im Problemfall schneller helfen.');
define('EMAIL_GV_LINK', 'Um den Gutschein einzul&ouml;sen klichen Sie bitte auf ');
define('EMAIL_GV_VISIT', ' oder besuchen Sie ');
define('EMAIL_GV_ENTER', ' und geben den Code am Ende Ihrer Bestellung ein. ');
define('EMAIL_GV_FIXED_FOOTER', 'Falls es mit dem obigen Link Probleme beim Einl&ouml;sen kommen sollte, ' . "\n" .
                                'k&ouml;nnen Sie den Betrag w&auml;hrend des Bestellvorganges verbuchen.' . "\n\n");
define('EMAIL_GV_SHOP_FOOTER', '');
define('MAIN_MESSAGE', 'Sie haben sich dazu entschieden, einen Gutschein im Wert von %s an %s versenden, dessen eMail-Adresse %s lautet.<br /><br />Folgender Text erscheint in Ihrer eMail:<br /><br />Hallo %s<br /><br />
                        Ihnen wurde ein Gutschein im Wert von %s durch %s geschickt.');

define('REDEEMED_AMOUNT','Ihr Gutschein wurde erfolgreich auf Ihr Konto verbucht. Gutscheinwert:');
define('REDEEMED_COUPON','Ihr Coupon wurde erfolgreich eingebucht und wird bei Ihrer n&auml;chsten Bestellung automatisch eingel&ouml;st.');

define('ERROR_INVALID_USES_USER_COUPON','Sie k&ouml;nnen den Kupon nur ');

define('ERROR_INVALID_USES_COUPON','Dieser Kupon k&ouml;nnen Kunden nur ');

define('TIMES',' mal einl&ouml;sen.');
define('ERROR_INVALID_STARTDATE_COUPON','Ihr Kupon ist noch nicht verf&uuml;gbar.');
define('ERROR_INVALID_FINISDATE_COUPON','Ihr Kupon ist bereits abgelaufen.');

define('PERSONAL_MESSAGE', '%s schreibt: ');

define('NAVBAR_GV_FAQ', 'Gutschein FAQ');
define('NAVBAR_GV_REDEEM', 'Gutschein einl&ouml;sen');
define('NAVBAR_GV_SEND', 'Gutschein versenden');

//Popup Window
define('TEXT_CLOSE_WINDOW', 'Fenster schliessen.');

// VAT ID
define('ENTRY_VAT_TEXT', 'Nur f&uuml;r Deutschland und EU!');
define('ENTRY_VAT_ERROR', 'Die Eingegebene UstID ist ung&uuml;ltig oder kann derzeit nicht &uuml;berpr&uuml;ft werden! Bitte geben Sie eine g&uuml;ltige ID ein oder lassen Sie das Feld leer.');

define('MSRP','UVP');
define('YOUR_PRICE','Ihr Preis ');
define('ONLY',' Nur ');
define('FROM','Ab ');
define('YOU_SAVE','Sie Sparen ');
define('INSTEAD','Statt ');
define('TXT_PER',' pro ');
?>