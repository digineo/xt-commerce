<?php
/* --------------------------------------------------------------
   $Id$

   xt:Commerce - Shopsoftware
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce
   --------------------------------------------------------------

   Released under the GNU General Public License
   --------------------------------------------------------------*/

class newsletter_recipients {
	var $title, $options, $filename,$stats;

	function newsletter_recipients() {
		$this->title = 'Newsletter recipients';
		$this->options = true;
		$this->filename = 'newsletter_recipients.csv';
		$this->time_start = time();
		$this->counter = 0;
		$this->Version = '1.0';
		$this->seperator = CSV_SEPERATOR;
		if (CSV_SEPERATOR == '')
			$this->seperator = "\t";
		if (CSV_SEPERATOR == '\t')
			$this->seperator = "\t";

	}

	function start() {
		global $export;
		
		require (DIR_FS_CATALOG.DIR_WS_CLASSES.'class.newsletter.php');
		$newsletter = & new newsletter();
		if (isset ($_POST['filename']) && $_POST['filename'] != '')
			$this->filename = xtc_db_input($_POST['filename']);

		$query = "SELECT * FROM ".TABLE_NEWSLETTER_RECIPIENTS." WHERE mail_status=1";
		$query = xtc_db_query($query);
		$fp = fopen(DIR_FS_DOCUMENT_ROOT.'export/'.$this->filename, "w+");
		$heading = 'firstname'.CSV_SEPERATOR.'lastname'.CSV_SEPERATOR.'gender'.CSV_SEPERATOR.'email'.CSV_SEPERATOR.'status'.CSV_SEPERATOR.'removelink'.CSV_SEPERATOR.'added'."\n";
		fputs($fp, $heading);
		while ($data = xtc_db_fetch_array($query)) {
			$this->counter++;
			$content = $data['customers_firstname'].$this->seperator;
			$content .= $data['customers_lastname'].$this->seperator;
			$content .= $data['customers_gender'].$this->seperator;
			$content .= $data['customers_email_address'].$this->seperator;
			$content .= $data['customers_status'].$this->seperator;
			$content .= $newsletter->RemoveLinkAdmin($data['mail_key'], $data['customers_email_address']).$this->seperator;
			$content .= $data['date_added']."\n";
			fputs($fp, $content);
		}
		fclose($fp);
		$this->stats = array (array ('title' => 'Recipients exported', 'value' => $this->counter), array ('title' => 'Time', 'value' => $export->calcElapsedTime($this->time_start)));
	}

	function selection() {

		$form_data = array ();
		$form_data = array_merge($form_data, array (array ('title' => FILENAME, 'field' => xtc_draw_input_field('filename', $this->filename))));

		return $form_data;

	}
}
?>