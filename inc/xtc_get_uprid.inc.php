<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_get_uprid.inc.php 193 2007-02-25 09:45:22Z matthias $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(general.php,v 1.225 2003/05/29); www.oscommerce.com 
   (c) 2003	 nextcommerce (xtc_get_uprid.inc.php,v 1.3 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   
// Return a product ID with attributes
/*
  function xtc_get_uprid($prid, $params) {
  if (is_numeric($prid)) {
    $uprid = $prid;

    if (is_array($params) && (sizeof($params) > 0)) {
      $attributes_check = true;
      $attributes_ids = '';

      reset($params);
      while (list($option, $value) = each($params)) {
        if (is_numeric($option) && is_numeric($value)) {
          $attributes_ids .= '{' . (int)$option . '}' . (int)$value;
        } else {
          $attributes_check = false;
          break;
        }
      }

      if ($attributes_check == true) {
        $uprid .= $attributes_ids;
      }
    }
  } else {
    $uprid = xtc_get_prid($prid);

    if (is_numeric($uprid)) {
      if (strpos($prid, '{') !== false) {
        $attributes_check = true;
        $attributes_ids = '';

        $attributes = explode('{', substr($prid, strpos($prid, '{')+1));

        for ($i=0, $n=sizeof($attributes); $i<$n; $i++) {
          $pair = explode('}', $attributes[$i]);

          if (is_numeric($pair[0]) && is_numeric($pair[1])) {
            $attributes_ids .= '{' . (int)$pair[0] . '}' . (int)$pair[1];
          } else {
            $attributes_check = false;
            break;
          }
        }

        if ($attributes_check == true) {
          $uprid .= $attributes_ids;
        }
      }
    } else {
      return false;
    }
  }

  return $uprid;
}
*/

  function xtc_get_uprid($prid, $params) {
    $uprid = $prid;
    if ( (is_array($params)) && (!strstr($prid, '{')) ) {
      while (list($option, $value) = each($params)) {
        //CLR 030714 Add processing around $value. This is needed for text attributes.
        $uprid = $uprid . '{' . $option . '}' . htmlspecialchars(stripslashes(trim($value)), ENT_QUOTES);
      }
    //CLR 030228 Add else stmt to process product ids passed in by other routines.
    } else {
      $uprid = htmlspecialchars(stripslashes($uprid), ENT_QUOTES);
    }



    if ( (is_array($params)) && (!strstr($prid, '{')) ) {
      while (list($option, $value) = each($params)) {
        $uprid = $uprid . '{' . $option . '}' . $value;
      }
    }


    return $uprid;
  }

 ?>