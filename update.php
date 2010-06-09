<?php
/*
 * Update Script for xt:Commerce Database
 * xt:Commerce Version 3.0.4 SP1 -> 3.0.4 SP2
 * 
 * (c) 2006 xt:Commerce GbR, http://www.xt-commerce.com
 * 
 */
 

  include('includes/application_top.php');
 
 

switch ($_POST['action']) {
	
	case 'db_update':
	include('update/db_304sp1_304sp2.php');
	break;
	
	default:
	include('update/index.php');
	break;	
	
	
}


 
?>
