<?php
/* --------------------------------------------------------------
   $Id: class.export.php 241 2007-03-08 13:33:48Z mzanier $

   xt:Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2007 xt:Commerce

   Released under the GNU General Public License
   --------------------------------------------------------------*/

class export {

	function export() {
		
		$this->CAT=array();
     	$this->PARENT=array();
		$this->module_directory = DIR_WS_CLASSES.'export/';
		$file_extension = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '.'));
		$directory_array = array(array ('text'=>'-- Select --','id'=>'none'));
		if ($dir = @ dir($this->module_directory)) {
			while ($file = $dir->read()) {
				if (!is_dir($this->module_directory.$file)) {
					if (substr($file, strrpos($file, '.')) == $file_extension) {

						$class = substr($file, 0, strrpos($file, '.'));
						include ($this->module_directory.$file);
						$GLOBALS[$class] = &new $class;						
						$directory_array[] = array ('text' => $GLOBALS[$class]->title, 'id' => $class);

					}
				}
			}
			sort($directory_array);
			$dir->close();
		}
		$this->modules = $directory_array;
		
	}

	function dropDown() {
		return xtc_draw_pull_down_menu('select_export', $this->modules,$_GET['select_export'],'onChange="this.form.submit();"');

	}

	function start($class) {
		return $GLOBALS[$class]->start();
	}
	
	function getVersion($class) {
		return $GLOBALS[$class]->Version;
	}

	function sendFile($class) {
		$filename = $GLOBALS[$class]->filename;
		$fp = fopen(DIR_FS_DOCUMENT_ROOT.'export/'.$filename, "rb");
		$buffer = fread($fp, filesize(DIR_FS_DOCUMENT_ROOT.'export/'.$filename));
		fclose($fp);
		unlink(DIR_FS_DOCUMENT_ROOT.'export/'.$filename);
		header('Content-type: application/x-octet-stream');
		header('Content-disposition: attachment; filename='.$filename);
		echo $buffer;
		exit;

	}
	
	function showStats($class) {
		
		$stats = $GLOBALS[$class]->stats;
		$statistics = '<table width="100%"  border="0" cellpadding="4">';
		for ($i = 0, $n = sizeof($stats); $i < $n; $i ++) {

			$statistics .= '<tr>
						    <td width="150" nowrap class="messageStackSuccess">'.$stats[$i]['title'].'</td>
						    <td width="100%" class="messageStackSuccess">'.$stats[$i]['value'].'</td>
						  </tr>';

		}

		$statistics .= '</table>';
		return $statistics;
	}


	function selection($class) {

		$selection = $GLOBALS[$class]->selection();

		$select = '<hr noshade><table width="500"  border="0" cellpadding="4">';
		for ($i = 0, $n = sizeof($selection); $i < $n; $i ++) {

			$select .= '<tr>
						    <td width="100" class="main">'.$selection[$i]['title'].'</td>
						    <td width="400" class="main">'.$selection[$i]['field'].'</td>
						  </tr>';

		}

		$select .= '</table>';
		return $select;

	}
	
		/**
	*   Calculate Elapsed time from 2 given Timestamps
	*   @param int $time old timestamp
	*   @return String elapsed time
	*/
	function calcElapsedTime($time) {

		$diff = time() - $time;
		$daysDiff = 0;
		$hrsDiff = 0;
		$minsDiff = 0;
		$secsDiff = 0;

		$sec_in_a_day = 60 * 60 * 24;
		while ($diff >= $sec_in_a_day) {
			$daysDiff++;
			$diff -= $sec_in_a_day;
		}
		$sec_in_an_hour = 60 * 60;
		while ($diff >= $sec_in_an_hour) {
			$hrsDiff++;
			$diff -= $sec_in_an_hour;
		}
		$sec_in_a_min = 60;
		while ($diff >= $sec_in_a_min) {
			$minsDiff++;
			$diff -= $sec_in_a_min;
		}
		$secsDiff = $diff;

		return ('(' . $hrsDiff . 'h ' . $minsDiff . 'm ' . $secsDiff . 's)');

	}
	
	function getCurrencies() {
		
		// build Currency Select
		$curr = '';
		$currencies = xtc_db_query("SELECT code FROM " . TABLE_CURRENCIES);
		while ($currencies_data = xtc_db_fetch_array($currencies)) {
			$curr .= xtc_draw_radio_field('currencies', $currencies_data['code'], true) . $currencies_data['code'] . '<br>';
		}
		return $curr;
		
	}
	
	function getCampaigns() {
	
		$campaign_array = array (
			array (
				'id' => '',
				'text' => TEXT_NONE
			)
		);
		$campaign_query = xtc_db_query("select campaigns_name, campaigns_refID from " . TABLE_CAMPAIGNS . " order by campaigns_id");
		while ($campaign = xtc_db_fetch_array($campaign_query)) {
			$campaign_array[] = array (
				'id' => 'refID=' . $campaign['campaigns_refID'] . '&',
				'text' => $campaign['campaigns_name'],

				
			);
		}
		
		return $campaign_array;
	}
	
	function buildCAT($catID) {

		if (isset ($this->CAT[$catID])) {
			return $this->CAT[$catID];
		} else {
			$cat = array ();
			$tmpID = $catID;

			while ($this->getParent($catID) != 0 || $catID != 0) {
				$cat_select = xtc_db_query("SELECT categories_name FROM " . TABLE_CATEGORIES_DESCRIPTION . " WHERE categories_id='" . $catID . "' and language_id='" . $_SESSION['languages_id'] . "'");
				$cat_data = xtc_db_fetch_array($cat_select);
				$catID = $this->getParent($catID);
				$cat[] = $cat_data['categories_name'];

			}
			$catStr = '';
			for ($i = count($cat); $i > 0; $i--) {
				$catStr .= $cat[$i -1] . ' > ';
			}
			$this->CAT[$tmpID] = $catStr;
			return $this->CAT[$tmpID];
		}
	}

	function getParent($catID) {
		if (isset ($this->PARENT[$catID])) {
			return $this->PARENT[$catID];
		} else {
			$parent_query = xtc_db_query("SELECT parent_id FROM " . TABLE_CATEGORIES . " WHERE categories_id='" . $catID . "'");
			$parent_data = xtc_db_fetch_array($parent_query);
			$this->PARENT[$catID] = $parent_data['parent_id'];
			return $parent_data['parent_id'];
		}

	}
	
}
?>