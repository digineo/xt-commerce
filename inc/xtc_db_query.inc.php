<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_db_query.inc.php 255 2007-03-09 08:27:34Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(database.php,v 1.19 2003/03/22); www.oscommerce.com
   (c) 2003	 nextcommerce (xtc_db_query.inc.php,v 1.4 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/
   
  // include needed functions
  include_once(DIR_FS_INC . 'xtc_db_error.inc.php');
  
  function xtc_db_query($query, $link = 'db_link') {
    global $$link;

	$start = microtime();
    //echo $query.'<br>';

    if (STORE_DB_TRANSACTIONS == 'true') {
      error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }
//    $queryStartTime = array_sum(explode(" ",microtime()));
    $result = mysql_query($query, $$link) or xtc_db_error($query, mysql_errno(), mysql_error());
//	$queryEndTime = array_sum(explode(" ",microtime())); 
//	$processTime = $queryEndTime - $queryStartTime;
//	echo 'time: '.$processTime.' Query: '.$query.'<br>';


    if (STORE_DB_TRANSACTIONS == 'true') {
       $result_error = mysql_error();
       error_log('RESULT ' . $result . ' ' . $result_error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }
    
    $time_start = explode(' ', $start);
	$time_end = explode(' ', microtime());
	$parse_time = number_format(($time_end[1] + $time_end[0] - ($time_start[1] + $time_start[0])), 3);
//	
//	echo '<div class="parseTime">QUERY NORMAL:'.$query.'<div>';
//	
//	echo '<div class="parseTime">Parse Time: ' . $parse_time . 's</div>';

    return $result;
  }
 ?>