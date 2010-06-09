  <?php
/* -----------------------------------------------------------------------------------------
   $Id: product_attributes.php,v 1.18 2004/06/11 18:21:38 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(product_info.php,v 1.94 2003/05/04); www.oscommerce.com 
   (c) 2003      nextcommerce (product_info.php,v 1.46 2003/08/25); www.nextcommerce.org

   Released under the GNU General Public License
   -----------------------------------------------------------------------------------------
   Third Party contribution:
   Customers Status v3.x  (c) 2002-2003 Copyright Elari elari@free.fr | www.unlockgsm.com/dload-osc/ | CVS : http://cvs.sourceforge.net/cgi-bin/viewcvs.cgi/elari/?sortby=date#dirlist
   New Attribute Manager v4b                            Autor: Mike G | mp3man@internetwork.net | http://downloads.ephing.com
   Cross-Sell (X-Sell) Admin 1                          Autor: Joshua Dechant (dreamscape)
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


$module_smarty=new Smarty;
$module_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');

    $products_attributes_query = xtc_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$_SESSION['languages_id'] . "'");
    $products_attributes = xtc_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
      $products_options_name_query = xtc_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$_SESSION['languages_id'] . "' order by popt.products_options_name");
      
        $row = 0;
  	$col = 0;
  	$products_options_data=array();
      while ($products_options_name = xtc_db_fetch_array($products_options_name_query)) {
        $selected = 0;
        $products_options_array = array();

	$products_options_data[$row]=array(
	   				'NAME'=>$products_options_name['products_options_name'],
	   				'ID' => $products_options_name['products_options_id'],
	   				'DATA' =>'');
        $products_options_query = xtc_db_query("select pov.products_options_values_id,
                                                 pov.products_options_values_name,
                                                 pa.attributes_model,
                                                 pa.options_values_price,
                                                 pa.price_prefix,
                                                 pa.attributes_stock,
                                                 pa.attributes_model
                                                 from " . TABLE_PRODUCTS_ATTRIBUTES . " pa,
                                                 " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov
                                                 where pa.products_id = '" . (int)$_GET['products_id'] . "'
                                                 and pa.options_id = '" . $products_options_name['products_options_id'] . "'
                                                 and pa.options_values_id = pov.products_options_values_id
                                                 and pov.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                                 order by pa.sortorder");
        $col = 0;
        while ($products_options = xtc_db_fetch_array($products_options_query)) {
          $price='';
           if ($_SESSION['customers_status']['customers_status_show_price'] == '0') {
                      $products_options_data[$row]['DATA'][$col]=array(
                                    'ID' => $products_options['products_options_values_id'],
                                    'TEXT' =>$products_options['products_options_values_name'],
                                    'MODEL' =>$products_options['attributes_model'],
                                    'PRICE' =>'',
                                    'FULL_PRICE'=>'',
                                    'PREFIX' =>$products_options['price_prefix']);
           } else {
          if ($products_options['options_values_price']!='0.00') {
          $price = $xtPrice->xtcFormat($products_options['options_values_price'],false,$product_info['products_tax_class_id']);
          }

          $products_price=$xtPrice->xtcGetPrice($product_info['products_id'],
                                        $format=false,
                                        1,
                                        $product_info['products_tax_class_id'],
                                        $product_info['products_price']);

          $products_options_data[$row]['DATA'][$col]=array(
            						'ID' => $products_options['products_options_values_id'],
            						'TEXT' =>$products_options['products_options_values_name'],
                                    'MODEL' =>$products_options['attributes_model'],
            						'PRICE' =>$xtPrice->xtcFormat($price,true),
                                    'FULL_PRICE'=>$xtPrice->xtcFormat($products_price+$price,true),
            						'PREFIX' =>$products_options['price_prefix']);
            						
            //if PRICE for option is 0 we don't need to display it
            if ($price == 0) { 
                unset($products_options_data[$row]['DATA'][$col]['PRICE']);
                unset($products_options_data[$row]['DATA'][$col]['PREFIX']);
            } 
                        						
          }
        $col++;
        }
      $row++;
      }

    }
  // template query
  $template_query=xtc_db_query("SELECT
                                options_template
                                FROM ".TABLE_PRODUCTS."
                                WHERE products_id='".(int)$_GET['products_id']."'");
  $template_data=xtc_db_fetch_array($template_query);
  if ($template_data['options_template']=='' or $template_data['options_template']=='default') {
          $files=array();
 if ($dir= opendir(DIR_FS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/module/product_options/')){
 while  (($file = readdir($dir)) !==false) {
        if (is_file( DIR_FS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/module/product_options/'.$file) and ($file !="index.html")){
        $files[]=array(
                        'id' => $file,
                        'text' => $file);
        }//if
        } // while
        closedir($dir);
 }
  $template_data['options_template']=$files[0]['id'];
  }

  $module_smarty->assign('language', $_SESSION['language']);
  $module_smarty->assign('options',$products_options_data);
  // set cache ID
  if (USE_CACHE=='false') {
  $module_smarty->caching = 0;
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/product_options/'.$template_data['options_template']);
  } else {
  $module_smarty->caching = 1;	
  $module_smarty->cache_lifetime=CACHE_LIFETIME;
  $module_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_GET['products_id'].$_SESSION['language'].$_SESSION['customers_status']['customers_status_name'];
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/product_options/'.$template_data['options_template'],$cache_id);
  }
  $info_smarty->assign('MODULE_product_options',$module);

 ?>