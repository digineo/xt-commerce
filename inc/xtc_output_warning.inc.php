<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_output_warning.inc.php 302 2007-03-30 08:25:49Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(general.php,v 1.225 2003/05/29); www.oscommerce.com 
   (c) 2003	 nextcommerce (xtc_output_warning.inc.php,v 1.3 2003/08/13); www.nextcommerce.org
   
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   
  function xtc_output_warning($warning) {
    new errorBox(array(array('text' => '<p class="errormessage">' . xtc_image(DIR_WS_ICONS . 'output_warning.gif', ICON_WARNING) . '  ' . $warning . '</p>')));
  }

 ?>