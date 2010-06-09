<?php

/* --------------------------------------------------------------
   $Id: taiwan.php 92 2007-01-17 10:48:53Z sun $   

   xt:Commerce - community made shopping
   http://www.xt:Commerce.com

   Copyright (c) 2003 xt:Commerce
   --------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (german.php,v 1.8 2003/08/13); www.nextcommerce.org
   
   Released under the GNU General Public License 
   --------------------------------------------------------------*/
// Global
define('_CHARSET','UTF-8');     
// Box names
define('BOX_LANGUAGE','語言選擇');
define('BOX_DB_CONNECTION','資料庫連結') ;
define('BOX_WEBSERVER_SETTINGS','伺服器設定');
define('BOX_DB_IMPORT','資料庫寫入');
define('BOX_WRITE_CONFIG','寫入前台資料');
define('BOX_ADMIN_CONFIG','寫入管理員資料');
define('BOX_USERS_CONFIG','使用者設定');

define('PULL_DOWN_DEFAULT','請選擇國家!');

// Error messages
 	// index.php
	define('SELECT_LANGUAGE_ERROR','選擇語言!');
	define('TEXT_TRADITIONAL_CHINESE','正體中文');
	define('TEXT_SIMPLIFIED_CHINESE','简体中文');	
	// install_step2,5.php
	define('TEXT_CONNECTION_ERROR','資料庫聯結--測試失敗');
	define('TEXT_CONNECTION_SUCCESS','資料庫聯結--測試完成');
	define('TEXT_DB_ERROR','錯誤訊息：');
	define('TEXT_DB_ERROR_1','<p>請按下面 <i>Back</i> 按鈕，重新檢查資料庫主機設定</p>');
	define('TEXT_DB_ERROR_2','<p>如果你不知道資料庫主機(Mysql server)的名稱、帳號或密碼？請詢問你的系統管理員或提供網頁主機的公司</p>');
	// install_step6.php
	define('ENTRY_FIRST_NAME_ERROR','姓字數不足');
	define('ENTRY_LAST_NAME_ERROR','名字數不足');
	define('ENTRY_EMAIL_ADDRESS_ERROR','電子郵件字數不足');
	define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR','電子郵件格式錯誤');
	define('ENTRY_STREET_ADDRESS_ERROR','地址字數不足');
	define('ENTRY_POST_CODE_ERROR','郵遞區號字數不足');
	define('ENTRY_CITY_ERROR','鄉鎮名稱字數不足');
	define('ENTRY_COUNTRY_ERROR','國家名稱字數不足');
	define('ENTRY_STATE_ERROR','請檢查縣市欄位');
	define('ENTRY_TELEPHONE_NUMBER_ERROR','電話號碼字數不足');
	define('ENTRY_PASSWORD_ERROR','密碼輸入錯誤');
	define('ENTRY_STORE_NAME_ERROR','商店名稱字數不足');
	define('ENTRY_COMPANY_NAME_ERROR','公司名稱字數不足');
	define('ENTRY_EMAIL_ADDRESS_FROM_ERROR','電子郵件字數不足');
	define('ENTRY_EMAIL_ADDRESS_FROM_CHECK_ERROR','電子郵件格式錯誤');
	define('SELECT_ZONE_SETUP_ERROR','地區選項錯誤');


define('TITLE_DATABASE_SETTINGS', '資料庫進階設定');
	
// index.php
define('TITLE_SELECT_LANGUAGE','選擇您使用的語言!');

define('TEXT_WELCOME_INDEX','<b>歡迎使用 xt:Commerce</b><br /><br />xt:Commerce 是由一個開放原始碼社群(open source community)，目前仍然還在持續不斷研發與成長的「開放原始碼(open source)電子商務解決方案」。
<br />它擁有非常多功能，主要可以讓商店擁有人以用最少的人力及最低的成本來設立、營運以及維護您的線上商店。
<br /><br />xt:Commerce 結合了開放原始碼方案(open source solutions)，主要使用<font color=red>強大的 PHP 網頁語言</font>(web scripting language)、<font color=red>穩定的 Apache 網頁主機</font>(web server)以及<font color=red>快速的 MySQL 資料庫</font>(database server)來提供一個免費和開放的平台。
<br /><br />xt:Commerce 沒有太多限制或特別的需求，它目前可以安裝任何 PHP4 的網頁主機上，或是任何支援 PHP 和 MySQL 的環境，包括 Linux, Solaris, BSD, Microsoft Windows 等環境。
<br /><br /><b>※PS：</b><br />請注意下方的下面的目錄及檔案權限檢查，並請做適度修正。<br />以避免安裝後無法使用，尤其是<font color=red>GDlib GIF-Support</font>（影像函數）的支援...');
define('TEXT_WELCOME_STEP1','<b>資料庫與網站伺服器設定</b><br />〔請輸入資料庫與網站伺服器設定〕<br />');
define('TEXT_WELCOME_STEP2','<b>安裝必要資料於資料庫</b><br />〔XT-Commerce 安裝程式，會自動安裝基本設定資料到您的資料庫〕');
define('TEXT_WELCOME_STEP3','<b>寫入資料庫.</b><br />');
define('TEXT_WELCOME_STEP4','<b>xt:Commerce 設定檔</b><br /><b>如果configure檔是舊有或是移植自其他地方, xt:Commerce會覆蓋原來檔案資料');
define('TEXT_WELCOME_STEP5','<b>網站伺服器設定</b><br /><br />');
define('TEXT_WELCOME_STEP6','<font color="#0000CC" size="5"><b>商店基本資料設定</b></font><br />安裝程式會產生管理員帳號並且執行寫入資料庫動作。<font size="-1">（請注意相關資料最少字數限制）</font><br />並於安裝完成後請至後端管理區設定運送及稅率。');
define('TEXT_WELCOME_FINISHED','<b>xt:Commerce 安裝完成！</b>');

// install_step1.php

define('TITLE_CUSTOM_SETTINGS','網站基本設定');
define('TEXT_IMPORT_DB','寫入xt:Commerce資料');
define('TEXT_IMPORT_DB_LONG','執行xt:Commerce基本資料匯入資料庫的程序（預設要打勾）');
define('TEXT_AUTOMATIC','自動設定與寫入Configure.php檔案');
define('TEXT_AUTOMATIC_LONG','匯入資料庫與網站結構資訊寫入設定檔Configure.php（預設要打勾）');
define('TITLE_DATABASE_SETTINGS','資料庫設定');
define('TEXT_DATABASE_SERVER','資料庫伺服器');
define('TEXT_DATABASE_SERVER_LONG','資料庫的位址，一般的預設是 <b>localhost</b>');
define('TEXT_USERNAME','資料庫使用者名稱：');
define('TEXT_USERNAME_LONG','資料庫使用者名稱：連接資料庫主機的使用者名稱，例如使用者為 xtc_user 或 root.<br /><b>注意：</b> 在這裡安裝時，此使用者必須有新增(Create)及刪除(Drop)資料表的權限');
define('TEXT_PASSWORD','密碼：');
define('TEXT_PASSWORD_LONG','資料庫使用者密碼：資料庫使用者帳號的密碼，通常與使用者名稱為一組');
define('TEXT_DATABASE','資料庫名稱：');
define('TEXT_DATABASE_LONG','資料庫名稱：儲存資料的資料庫名稱，如 xtc_db...');
define('TITLE_WEBSERVER_SETTINGS','網站伺服器設定');
define('TEXT_WS_ROOT','網站伺服器實際路徑');
define('TEXT_WS_ROOT_LONG','網路商店在主機上的的絕對路徑，網路商店的所在的實際位置，<br />linux 如 <i>/home/myname/public_html/XTcommerce/</i><br />windows 如 <i>c:/appserv/www/XTcommerce</i>');
define('TEXT_WWW_ADDRESS','WWW 網址');

// install_step2.php

define('TEXT_PROCESS_1','請繼續執行安裝完成資料庫寫入設定.');
define('TEXT_PROCESS_2','<b>注意！</b>這個程序執行時不可中斷，否則可能導致資料庫損毀');

// install_step3.php

define('TEXT_TITLE_ERROR','注意！有下列錯誤存在：');
define('TEXT_TITLE_SUCCESS','資料寫入資料庫完成！（寫入成功）恭喜啦！...加油，就快要成功了...:)');

// install_step4.php
define('TITLE_WEBSERVER_CONFIGURATION','網站伺服器設定:');
define('TITLE_STEP4_ERROR','下列錯誤存在:');
define('TEXT_STEP4_ERROR','<b>configuration不存在,或檔案權限有誤.</b><br /><br />請執行下列動作: ');
define('TEXT_STEP4_ERROR_1','如果<i>chmod 706</i>依舊無法運作，請設成<i>chmod 777</i>.');
define('TEXT_STEP4_ERROR_2','如果您是在 Microsoft Windows 上執行安裝,請試著重新命名 configuration 檔案,如此會由程式新增一個新的 configuration 檔案.');
define('TEXT_VALUES','下列檔案會被修改或寫入：');
define('TITLE_CHECK_CONFIGURATION','檢查您的網站伺服器資訊');
define('TITLE_CHECK_DATABASE', '請檢查您的資料庫伺服器資訊');
define('TEXT_PERSIST', '啟用資料庫持續連結');
define('TEXT_PERSIST_LONG', '啟用保持連結<br /><br />注意：租用虛擬主機或共用主機建議關閉這個選項(不勾選)，以免影響連線效能');
define('TEXT_SESS_FILE','Sessions 寫入檔案');
define('TEXT_SESS_DB','Sessions 寫入資料庫');
define('TEXT_SESS_LONG','網站sessions資料儲存位置。（建議寫入資料庫）');

// install_step5.php

define('TEXT_WS_CONFIGURATION_SUCCESS','<strong>xt:Commerce</strong> 伺服器設定完成〔恭喜啦，就快好了〕。<br />請點擊繼續，設定管理員、商店及商品折扣相關資料');

// install_step6.php

define('TITLE_ADMIN_CONFIG','管理員設定');
define('TEXT_REQU_INFORMATION','* 必填項目');
define('TEXT_FIRSTNAME','姓：');
define('TEXT_LASTNAME','名：');
define('TEXT_EMAIL','電子郵件：');
define('TEXT_EMAIL_LONG','（接收訂單用的E-mail、登入帳號）');				
define('TEXT_STREET','地址：');
define('TEXT_POSTCODE','郵遞區號：');
define('TEXT_CITY','鄉鎮村區：');
define('TEXT_STATE','縣市：');
define('TEXT_COUNTRY','國家：');
define('TEXT_COUNTRY_LONG','使用在運送與稅率上');
define('TEXT_TEL','電話號碼：');
define('TEXT_PASSWORD','密碼：');
define('TEXT_PASSWORD_CONF','確認密碼：');
define('TITLE_SHOP_CONFIG','商店設定');
define('TEXT_STORE','商店名稱:');
define('TEXT_STORE_LONG','(我的商店名稱)');
define('TEXT_EMAIL_FROM','網站寄信人的E-mail');
define('TEXT_EMAIL_FROM_LONG','(這個電子郵件地址，在商店寄送郵件時會設為「寄件人」)');
define('TITLE_ZONE_CONFIG','地區設定');
define('TEXT_ZONE','歐盟地區');
define('TITLE_ZONE_CONFIG_NOTE','*說明：您的商店是否為歐盟地區');
define('TITLE_SHOP_CONFIG_NOTE','*說明：商店基本設定');
define('TITLE_ADMIN_CONFIG_NOTE','*說明：管理員資訊設定');
define('TEXT_ZONE_NO','否');
define('TEXT_ZONE_YES','是');
define('TEXT_COMPANY','商店擁有人');

define('TITLE_CHMOD', '設定檔案權限');
// install_fnished.php

define('TEXT_SHOP_CONFIG_SUCCESS','恭喜您！<strong>xt:Commerce</strong> 商店設定已經完成');
define('TEXT_TEAM','你可以到以下網址參考～<br /><a href="http://www.xt-commerce.com">xt:Commerce 德國總部</a>
<br /><a href="http://www.xt-commerce.tw">xt:Commerce 漢語站</a>');
   
?>