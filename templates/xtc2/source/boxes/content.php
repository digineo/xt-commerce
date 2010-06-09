<?php
/* -----------------------------------------------------------------------------------------
   $Id: content.php,v 1.1 2004/04/26 20:26:42 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(information.php,v 1.6 2003/02/10); www.oscommerce.com 
   (c) 2003	 nextcommerce (content.php,v 1.2 2003/08/21); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
$box_smarty = new smarty;
$box_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/'); 
$content_string='';

  if (GROUP_CHECK=='true') {
   $group_check="and group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
  }

$content_query="SELECT
 					content_id,
 					categories_id,
 					parent_id,
 					content_title,
 					content_group
 					FROM ".TABLE_CONTENT_MANAGER."
 					WHERE languages_id='".(int)$_SESSION['languages_id']."'
 					and file_flag=1 ".$group_check." and content_status=1 order by sort_order";

 $content_query = xtDBquery($content_query);

 while ($content_data=xtc_db_fetch_array(&$content_query,true)) {
 	
 $content_string .= '<img src="templates/'.CURRENT_TEMPLATE.'/img/icon_arrow.jpg"> <a href="' . xtc_href_link(FILENAME_CONTENT,'coID='.$content_data['content_group']) . '">' . $content_data['content_title'] . '</a><br>';
}
if ($content_string!='') {




    $box_smarty->assign('BOX_CONTENT', $content_string);
	$box_smarty->assign('language', $_SESSION['language']);
   	  // set cache ID
  if (USE_CACHE=='false') {
  $box_smarty->caching = 0;
  $box_content= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_content.html');
  } else {
  $box_smarty->caching = 1;
  $box_smarty->cache_lifetime=CACHE_LIFETIME;
  $box_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_SESSION['language'];
  $box_content= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_content.html',$cache_id);
  }
    
    $smarty->assign('box_CONTENT',$box_content);



}
?>