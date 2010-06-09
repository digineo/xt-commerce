<?php


/* -----------------------------------------------------------------------------------------
   $Id: xtc_php_mail.inc.php 222 2007-03-05 10:39:57Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2003	 nextcommerce (xtc_php_mail.inc.php,v 1.17 2003/08/24); www.nextcommerce.org


   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
// include the mail classes
function xtc_php_mail($from_email_address, $from_email_name, $to_email_address, $to_name, $forwarding_to, $reply_address, $reply_address_name, $path_to_attachement, $path_to_more_attachements, $email_subject, $message_body_html, $message_body_plain, $language_code = '') {
	global $mail_error;

	$mail = new PHPMailer();
	$mail->PluginDir = DIR_FS_DOCUMENT_ROOT . 'includes/classes/';	
	
	  // language code change
	if (!$language_code || $language_code==''){
		$language_code = $_SESSION['language'];
	}
	if ($language_code == 'tchinese' || $language_code == 'schinese') {
		if ($language_code == 'tchinese') {
			$MailCharCode = "BIG5";
		}
		elseif ($language_code == 'schinese') {
			$MailCharCode = "GB2312";
		} else {
			$MailCharCode = "UTF-8";
		}	
		if (function_exists('iconv')) {
			$mail->CharSet = $MailCharCode;
			$from_email_name    = iconv("UTF-8", $MailCharCode."//TRANSLIT", $from_email_name);
			$to_name            = iconv("UTF-8", $MailCharCode."//TRANSLIT", $to_name);
			$forwarding_to      = iconv("UTF-8", $MailCharCode."//TRANSLIT", $forwarding_to);
			$reply_address_name = iconv("UTF-8", $MailCharCode."//TRANSLIT", $reply_address_name);
			$email_subject      = iconv("UTF-8", $MailCharCode."//TRANSLIT", $email_subject);
			$message_body_html  = iconv("UTF-8", $MailCharCode."//TRANSLIT", $message_body_html);
			$message_body_plain = iconv("UTF-8", $MailCharCode."//TRANSLIT", $message_body_plain);			
		} elseif (function_exists('mb_convert_encoding')) {
			$mail->CharSet = $MailCharCode;
			$from_email_name    = mb_convert_encoding($from_email_name,    $MailCharCode, "UTF-8");
			$to_name            = mb_convert_encoding($to_name,            $MailCharCode, "UTF-8");
			$forwarding_to      = mb_convert_encoding($forwarding_to,      $MailCharCode, "UTF-8");
			$reply_address_name = mb_convert_encoding($reply_address_name, $MailCharCode, "UTF-8");
			$email_subject      = mb_convert_encoding($email_subject,      $MailCharCode, "UTF-8");
			$message_body_html  = mb_convert_encoding($message_body_html,  $MailCharCode, "UTF-8");
			$message_body_plain = mb_convert_encoding($message_body_plain, $MailCharCode, "UTF-8");											
	    }

	}
	
	
		$lang_query = "SELECT code FROM " . TABLE_LANGUAGES . " WHERE directory = '" . $language_code . "'";
		$lang_query = xtc_db_query($lang_query);
		$lang_data = xtc_db_fetch_array($lang_query);
		$mail->SetLanguage = $lang_data['code'];
	
	
	if (EMAIL_TRANSPORT == 'smtp') {
		$mail->IsSMTP();
		$mail->SMTPKeepAlive = true; // set mailer to use SMTP
		$mail->SMTPAuth = SMTP_AUTH; // turn on SMTP authentication true/false
		$mail->Username = SMTP_USERNAME; // SMTP username
		$mail->Password = SMTP_PASSWORD; // SMTP password
		$mail->Host = SMTP_MAIN_SERVER . ';' . SMTP_Backup_Server; // specify main and backup server "smtp1.example.com;smtp2.example.com"
	}

	if (EMAIL_TRANSPORT == 'sendmail') { // set mailer to use SMTP
		$mail->IsSendmail();
		$mail->Sendmail = SENDMAIL_PATH;
	}
	if (EMAIL_TRANSPORT == 'mail') {
		$mail->IsMail();
	}

	if (EMAIL_USE_HTML == 'true') // set email format to HTML
		{
		$mail->IsHTML(true);
		$mail->Body = $message_body_html;
		// remove html tags
		$message_body_plain = str_replace('<br />', " \n", $message_body_plain);
		$message_body_plain = strip_tags($message_body_plain);
		$mail->AltBody = $message_body_plain;
	} else {
		$mail->IsHTML(false);
		//remove html tags
		$message_body_plain = str_replace('<br />', " \n", $message_body_plain);
		$message_body_plain = strip_tags($message_body_plain);
		$mail->Body = $message_body_plain;
	}

	$mail->From = $from_email_address;
	$mail->Sender = $from_email_address;
	$mail->FromName = $from_email_name;
	$mail->AddAddress($to_email_address, $to_name);
	if ($forwarding_to != '')
		$mail->AddBCC($forwarding_to);
	$mail->AddReplyTo($reply_address, $reply_address_name);

	$mail->WordWrap = 50; // set word wrap to 50 characters
	//$mail->AddAttachment($path_to_attachement);                     // add attachments
	//$mail->AddAttachment($path_to_more_attachements);               // optional name                                          

	$mail->Subject = $email_subject;

	if (!$mail->Send()) {
		echo "Message was not sent <p>";
		echo "Mailer Error: " . $mail->ErrorInfo;
		exit;
	}
}
?>