<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_cleanName.inc.php 1206 2005-08-30 00:30:52Z hhgag $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


 function xtc_cleanName($name) {
     urlencode($name);
     return str_replace('%2F','/',$name);
 }

?>
