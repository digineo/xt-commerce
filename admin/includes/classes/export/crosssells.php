<?php
/* --------------------------------------------------------------
   $Id$

   xt:Commerce - Shopsoftware
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce
   --------------------------------------------------------------

   Released under the GNU General Public License
   --------------------------------------------------------------*/
 
  class crosssells {
 	var $title,$filename,$stats;
 			
 		
 		function crosssells() {
 			$this->title='Cross Sells';
 			$this->time_start = time();
 			$this->counter=0;
 			$this->failed=0;
 			$this->Version = '1.0';
 			$this->seperator = CSV_SEPERATOR;
 			if (CSV_SEPERATOR == '')
			$this->seperator = "\t";
			if (CSV_SEPERATOR == '\t')
			$this->seperator = "\t";	
			$this->filename = 'cross_sells.csv';
 			
 		}
 	
 		function start() {
 			global $export;
 		
		if (isset ($_POST['filename']) && $_POST['filename'] != '')
			$this->filename = xtc_db_input($_POST['filename']);
		
		$query ="SELECT
pMain.products_model AS modMain,
pSlave.products_model AS modSlave,
px.products_xsell_grp_name_id,
px.sort_order
FROM
".TABLE_PRODUCTS." pMain,
".TABLE_PRODUCTS." pSlave
Inner Join ".TABLE_PRODUCTS_XSELL." AS px ON pMain.products_id = px.products_id AND pSlave.products_id = px.xsell_id";
		
		$query = xtc_db_query($query);
		$fp = fopen(DIR_FS_DOCUMENT_ROOT.'export/'.$this->filename, "w+");
		$heading = 'model_main'.$this->seperator.'model_cross_sell'.$this->seperator.'group'.$this->seperator.'sort_order'."\n";
		fputs($fp, $heading);
		while ($data = xtc_db_fetch_array($query)) {
			if ($data->fields['modMain'] != '' && $data->fields['modSlave']!='') {
			$this->counter++;			
			$content = $data['modMain'].$this->seperator;
			$content .= $data['modSlave'].$this->seperator;
			$content .= $data['products_xsell_grp_name_id'].$this->seperator;
			$content .= $data['sort_order']."\n";
			fputs($fp, $content);
			} else {
				$this->failed++;
			}
		}
		fclose($fp);
		$this->stats = array (array ('title' => 'Cross Sells exported', 'value' => $this->counter),array ('title' => 'Failed export (no model)', 'value' => $this->failed), array ('title' => 'Time', 'value' => $export->calcElapsedTime($this->time_start)));
	}
 	
 		function selection () {
 			
 			$form_data = array();
 			$form_data = array_merge($form_data, array (array ('title' => FILENAME, 'field' => xtc_draw_input_field('filename', $this->filename))));
		
 			return $form_data;
 			
 			
 		}
 	
 }
?>