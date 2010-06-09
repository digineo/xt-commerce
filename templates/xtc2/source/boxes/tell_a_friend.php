<?php
/* -----------------------------------------------------------------------------------------
   $Id: tell_a_friend.php,v 1.1 2004/04/26 20:26:42 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(tell_a_friend.php,v 1.15 2003/02/10); www.oscommerce.com 
   (c) 2003	 nextcommerce (tell_a_friend.php,v 1.9 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
$box_smarty = new smarty;
$box_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/'); 
$box_content='';
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_draw_form.inc.php');
  require_once(DIR_FS_INC . 'xtc_draw_input_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_image_submit.inc.php');
  require_once(DIR_FS_INC . 'xtc_draw_hidden_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_hide_session_id.inc.php');



$box_content=xtc_draw_form('tell_a_friend', xtc_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false), 'get').xtc_draw_input_field('send_to', '', 'size="10"') . '&nbsp;' . xtc_image_submit('button_tell_a_friend.gif', BOX_HEADING_TELL_A_FRIEND) . xtc_draw_hidden_field('products_id', $_GET['products_id']) . xtc_hide_session_id() . '<br>' . BOX_TELL_A_FRIEND_TEXT.'</form>';



    $box_smarty->assign('BOX_CONTENT', $box_content);
	$box_smarty->assign('language', $_SESSION['language']);
       	  // set cache ID
  if (USE_CACHE=='false') {
  $box_smarty->caching = 0;
  $box_tell_a_friend= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_tell_friend.html');
  } else {
  $box_smarty->caching = 1;	
  $box_smarty->cache_lifetime=CACHE_LIFETIME;
  $box_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_SESSION['language'].$_GET['products_id'];
  $box_tell_a_friend= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_tell_friend.html',$cache_id);
  }

    $smarty->assign('box_TELL_FRIEND',$box_tell_a_friend);
    
    ?>