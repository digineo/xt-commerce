<?php

/*------------------------------------------------------------------------------
   $Id: newsletter.php,v 1.0 

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce www.oscommerce.com 
   (c) 2003	 nextcommerce www.nextcommerce.org
   
   XTC-NEWSLETTER_RECIPIENTS RC1 - Contribution for XT-Commerce http://www.xt-commerce.com
   by Matthias Hinsche http://www.gamesempire.de
   
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

require ('includes/application_top.php');

// create smarty elements
$smarty = new Smarty;

// include boxes
require (DIR_FS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/source/boxes.php');

// include needed functions
require_once (DIR_FS_INC.'xtc_render_vvcode.inc.php');
require_once (DIR_FS_INC.'xtc_random_charcode.inc.php');


require_once (DIR_WS_CLASSES.'class.newsletter.php');

$newsletter = new newsletter;

if (isset ($_GET['action'])) {

	switch ($_GET['action']) {

		case 'process' :
			$newsletter->AddUser($_POST['check'], $_POST['vvcode'], $_POST['email']);
			$info_message = $newsletter->message;

			break;

		case 'activate' :
			$newsletter->ActivateAddress($_GET['key'], $_GET['email']);
			$info_message = $newsletter->message;
			break;

		case 'remove' :
			$newsletter->RemoveFromList($_GET['key'], $_GET['email']);
			$info_message = $newsletter->message;

			break;

	}

}

$breadcrumb->add(NAVBAR_TITLE_NEWSLETTER, xtc_href_link(FILENAME_NEWSLETTER, '', 'NONSSL'));

require (DIR_WS_INCLUDES.'header.php');
if (isset ($_SESSION['customer_id'])) {
			$customers_first_name = $_SESSION['customer_first_name'];
			$customers_last_name = $_SESSION['customer_last_name'];
			$email_address = $_SESSION['customer_email_address'];
		}


$smarty->assign('VVIMG', '<img src="'.xtc_href_link(FILENAME_DISPLAY_VVCODES).'" alt="Captcha" />');
$smarty->assign('text_newsletter', TEXT_NEWSLETTER);
$smarty->assign('info_message', $info_message);
$smarty->assign('FORM_ACTION', xtc_draw_form('sign', xtc_href_link(FILENAME_NEWSLETTER, 'action=process', 'NONSSL')));
$smarty->assign('INPUT_EMAIL', xtc_draw_input_field('email',($error ? xtc_db_input($_POST['email']) : $email_address), 'size="30"'));
$smarty->assign('INPUT_FIRSTNAME', xtc_draw_input_field('firstname', ($error ? xtc_db_input($_POST['firstname']) : $customers_first_name), 'size="30"'));
$smarty->assign('INPUT_LASTNAME', xtc_draw_input_field('lastname', ($error ? xtc_db_input($_POST['lastname']) : $customers_last_name), 'size="30"'));
$smarty->assign('INPUT_CODE', xtc_draw_input_field('vvcode', '', 'size="6" maxlength="6"', 'text', false));
$smarty->assign('CHECK_INP', xtc_draw_radio_field('check', 'inp'));
$smarty->assign('CHECK_DEL', xtc_draw_radio_field('check', 'del'));
$smarty->assign('BUTTON_SEND', xtc_image_submit('button_send.gif', IMAGE_BUTTON_LOGIN));
$smarty->assign('FORM_END', '</form>');

$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$main_content = $smarty->fetch(CURRENT_TEMPLATE.'/module/newsletter.html');
$smarty->assign('main_content', $main_content);

$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
if (!defined(RM))
	$smarty->load_filter('output', 'note');
$smarty->display(CURRENT_TEMPLATE.'/index.html');
include ('includes/application_bottom.php');
?>