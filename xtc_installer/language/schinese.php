<?php
/* --------------------------------------------------------------
   $Id: china.php 73 2007-01-07 16:01:33Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (english.php,v 1.8 2003/08/13); www.nextcommerce.org
   
   Released under the GNU General Public License 
   --------------------------------------------------------------*/
// Global
define('_CHARSET','UTF-8');     
// Box names
define('BOX_LANGUAGE','语言选择');
define('BOX_DB_CONNECTION','资料库连结') ;
define('BOX_WEBSERVER_SETTINGS','伺服器设定');
define('BOX_DB_IMPORT','资料库写入');
define('BOX_WRITE_CONFIG','写入前台资料');
define('BOX_ADMIN_CONFIG','写入管理员资料');
define('BOX_USERS_CONFIG','使用者设定');

define('PULL_DOWN_DEFAULT','请选择国家!');

// Error messages
 	// index.php
	define('SELECT_LANGUAGE_ERROR','选择语言!');
	define('TEXT_TRADITIONAL_CHINESE','正體中文');
	define('TEXT_SIMPLIFIED_CHINESE','简体中文');	
	// install_step2,5.php
	define('TEXT_CONNECTION_ERROR','资料库联结--测试失败');
	define('TEXT_CONNECTION_SUCCESS','资料库联结--测试完成');
	define('TEXT_DB_ERROR','错误信息：');
	define('TEXT_DB_ERROR_1','<p>请按下面 <i>Back</i> 按钮，重新检查资料库主机设置</p>');
	define('TEXT_DB_ERROR_2','<p>如果你不知道资料库主机(Mysql server)的名称、帐号或密码？请询问你的系统管理员或提供网页主机的公司</p>');
	// install_step6.php
	define('ENTRY_FIRST_NAME_ERROR','姓字数不足');
	define('ENTRY_LAST_NAME_ERROR','名字数不足');
	define('ENTRY_EMAIL_ADDRESS_ERROR','电子邮件字数不足');
	define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR','电子邮件格式错误');
	define('ENTRY_STREET_ADDRESS_ERROR','地址字数不足');
	define('ENTRY_POST_CODE_ERROR','邮政编码字数不足');
	define('ENTRY_CITY_ERROR','地区／城市名称字数不足');
	define('ENTRY_COUNTRY_ERROR','国家名称字数不足');
	define('ENTRY_STATE_ERROR','请检查省／直辖市栏位');
	define('ENTRY_TELEPHONE_NUMBER_ERROR','电话号码字数不足');
	define('ENTRY_PASSWORD_ERROR','密码输入错误');
	define('ENTRY_STORE_NAME_ERROR','商店名称字数不足');
	define('ENTRY_COMPANY_NAME_ERROR','公司名称字数不足');
	define('ENTRY_EMAIL_ADDRESS_FROM_ERROR','电子邮件字数不足');
	define('ENTRY_EMAIL_ADDRESS_FROM_CHECK_ERROR','电子邮件格式错误');
	define('SELECT_ZONE_SETUP_ERROR','地区选项错误');
	
	
define('TITLE_DATABASE_SETTINGS', '资料库进阶设定');
	
// index.php
define('TITLE_SELECT_LANGUAGE','选择您使用的语言!');

define('TEXT_WELCOME_INDEX','<b>欢迎使用 xt:Commerce</b><br /><br />xt:Commerce 是由一个开放原始码社群(open source community)，目前仍然还在持续不断研发与成长的“开放原始码(open source)电子商务解决方案”。
<br />它拥有非常多功能，主要可以让商店拥有人以用最少的人力及最低的成本来设立、营运以及维护您的线上商店。
<br /><br />xt:Commerce 结合了开放原始码方案(open source solutions)，主要使用<font color=red>强大的 PHP 网页语言</font>(web scripting language)、<font color=red>稳定的 Apache 网页主机</font>(web server)以及<font color=red>快速的 MySQL 资料库</font>(database server)来提供一个免费和开放的平台。
<br /><br />xt:Commerce 没有太多限制或特别的需求，它目前可以安装任何 PHP4 的网页主机上，或是任何支援 PHP 和 MySQL 的环境，包括 Linux, Solaris, BSD, Microsoft Windows 等环境。
<br /><br /><b>※PS：</b><br />请注意下方的下面的目录及档案权限检查，并请做适度修正。<br />以避免安装后无法使用，尤其是<font color=red>GDlib GIF-Support</font>（影像函数）的支援...');
define('TEXT_WELCOME_STEP1','<b>资料库与网站伺服器设定</b><br />〔请输入资料库与网站伺服器设定〕<br />');
define('TEXT_WELCOME_STEP2','<b>安装必要资料于资料库</b><br />〔XT-Commerce 安装程式，会自动安装基本设定资料到您的资料库〕');
define('TEXT_WELCOME_STEP3','<b>写入资料库.</b><br />');
define('TEXT_WELCOME_STEP4','<b>xt:Commerce 设定档</b><br /><b>如果configure档是旧有或是移植自其他地方, xt:Commerce会覆盖原来档案资料');
define('TEXT_WELCOME_STEP5','<b>网站伺服器设定</b><br /><br />');
define('TEXT_WELCOME_STEP6','<font color="#0000CC" size="5"><b>商店基本资料设定</b></font><br />安装程式会产生管理员帐号并且执行写入资料库动作。<font size="-1">（请注意相关资料最少字数限制）</font><br />并于安装完成后请至后端管理区设定运送及税率。');
define('TEXT_WELCOME_FINISHED','<b>xt:Commerce 安装完成！</b>');

// install_step1.php

define('TITLE_CUSTOM_SETTINGS','网站基本设定');
define('TEXT_IMPORT_DB','写入xt:Commerce资料');
define('TEXT_IMPORT_DB_LONG','执行xt:Commerce基本资料汇入资料库的程序（预设要打勾）');
define('TEXT_AUTOMATIC','自动设定与写入Configure.php档案');
define('TEXT_AUTOMATIC_LONG','汇入资料库与网站结构资讯写入设定档Configure.php（预设要打勾）');
define('TITLE_DATABASE_SETTINGS','资料库设定');
define('TEXT_DATABASE_SERVER','资料库伺服器');
define('TEXT_DATABASE_SERVER_LONG','资料库的位址，一般的预设是 <b>localhost</b>');
define('TEXT_USERNAME','资料库使用者名称：');
define('TEXT_USERNAME_LONG','资料库使用者名称：连接资料库主机的使用者名称，例如使用者为 xtc_user 或 root.<br /><b>注意：</b> 在这里安装时，此使用者必须有新增(Create)及删除(Drop)资料表的权限');
define('TEXT_PASSWORD','密码：');
define('TEXT_PASSWORD_LONG','资料库使用者密码：资料库使用者帐号的密码，通常与使用者名称为一组');
define('TEXT_DATABASE','资料库名称：');
define('TEXT_DATABASE_LONG','资料库名称：储存资料的资料库名称，如 xtc_db...');
define('TITLE_WEBSERVER_SETTINGS','网站伺服器设定');
define('TEXT_WS_ROOT','网站伺服器实际路径');
define('TEXT_WS_ROOT_LONG','网路商店在主机上的的绝对路径，网路商店的所在的实际位置，<br />linux 如 <i>/home/myname/public_html/XTcommerce/</i><br />windows 如 <i>c:/appserv/www/XTcommerce</i>');
define('TEXT_WWW_ADDRESS','WWW 网址');

// install_step2.php

define('TEXT_PROCESS_1','请继续执行安装完成资料库写入设定.');
define('TEXT_PROCESS_2','<b>注意！</b>这个程序执行时不可中断，否则可能导致资料库损毁');

// install_step3.php

define('TEXT_TITLE_ERROR','注意！有下列错误存在：');
define('TEXT_TITLE_SUCCESS','资料写入资料库完成！（写入成功）恭喜啦！...加油，就快要成功了...:)');

// install_step4.php
define('TITLE_WEBSERVER_CONFIGURATION','网站伺服器设定:');
define('TITLE_STEP4_ERROR','下列错误存在:');
define('TEXT_STEP4_ERROR','<b>configuration不存在,或档案权限有误.</b><br /><br />请执行下列动作: ');
define('TEXT_STEP4_ERROR_1','如果<i>chmod 706</i>依旧无法运作，请设成<i>chmod 777</i>.');
define('TEXT_STEP4_ERROR_2','如果您是在 Microsoft Windows 上执行安装,请试着重新命名 configuration 档案,如此会由程式新增一个新的 configuration 档案.');
define('TEXT_VALUES','下列档案会被修改或写入：');
define('TITLE_CHECK_CONFIGURATION','检查您的网站伺服器资讯');
define('TITLE_CHECK_DATABASE', '请检查您的资料库伺服器资讯');
define('TEXT_PERSIST', '启用资料库持续连结');
define('TEXT_PERSIST_LONG', '启用保持连结<br /><br />注意：租用虚拟主机或共用主机建议关闭这个选项(不勾选)，以免影响连线效能');
define('TEXT_SESS_FILE','Sessions 写入档案');
define('TEXT_SESS_DB','Sessions 写入资料库');
define('TEXT_SESS_LONG','网站sessions资料储存位置。（建议写入资料库）');

// install_step5.php

define('TEXT_WS_CONFIGURATION_SUCCESS','<strong>xt:Commerce</strong> 伺服器设定完成〔恭喜啦，就快好了〕。<br />请点击继续，设定管理员、商店及商品折扣相关资料');

// install_step6.php

define('TITLE_ADMIN_CONFIG','管理员设置');
define('TEXT_REQU_INFORMATION','* 必填项目');
define('TEXT_FIRSTNAME','姓：');
define('TEXT_LASTNAME','名：');
define('TEXT_EMAIL','电子邮件：');
define('TEXT_EMAIL_LONG','（接收订单用的E-mail、登入帐号）');				
define('TEXT_STREET','地址：');
define('TEXT_POSTCODE','邮政编码：');
define('TEXT_CITY','地区／城市：');
define('TEXT_STATE','省／直辖市：');
define('TEXT_COUNTRY','国家：');
define('TEXT_COUNTRY_LONG','使用在运送与税率上');
define('TEXT_TEL','电话号码：');
define('TEXT_PASSWORD','密码：');
define('TEXT_PASSWORD_CONF','确认密码：');
define('TITLE_SHOP_CONFIG','商店设置');
define('TEXT_STORE','商店名称:');
define('TEXT_STORE_LONG','(我的商店名称)');
define('TEXT_EMAIL_FROM','网站寄信人的E-mail');
define('TEXT_EMAIL_FROM_LONG','(这个电子邮件地址，在商店寄送邮件时会设为「寄件人」)');
define('TITLE_ZONE_CONFIG','地区设置');
define('TEXT_ZONE','欧盟地区');
define('TITLE_ZONE_CONFIG_NOTE','*说明：您的商店是否为欧盟地区');
define('TITLE_SHOP_CONFIG_NOTE','*说明：商店基本设置');
define('TITLE_ADMIN_CONFIG_NOTE','*说明：管理员信息设置');
define('TEXT_ZONE_NO','否');
define('TEXT_ZONE_YES','是');
define('TEXT_COMPANY','商店拥有人');

define('TITLE_CHMOD', '设定档案权限');
// install_fnished.php

define('TEXT_SHOP_CONFIG_SUCCESS','恭喜您！<strong>xt:Commerce</strong> 商店设定已经完成');
define('TEXT_TEAM','你可以到以下网址参考～<br /><a href="http://www.xt-commerce.com">xt:Commerce 德国总部</a>
<br /><a href="http://www.xt-commerce.tw">xt:Commerce 汉语站</a>');   

?>