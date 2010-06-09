<?php

/* -----------------------------------------------------------------------------------------
   $Id: xtc_product_link.inc.php 70 2007-01-07 14:19:12Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2005 XT-Commerce

 
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

function xtc_product_link($pID, $name='') {

	$pName = xtc_cleanName($name);
	$link = 'info=p'.$pID.'_'.$pName.'.html';
	return $link;
}
?>