<?php
/* -----------------------------------------------------------------------------------------
   $Id: outputfilter.note.php 779 2005-02-19 17:19:28Z novalis $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/



function smarty_outputfilter_note($tpl_output, &$smarty) {

    /*
    The following copyright announcement is in compliance
    to section 2c of the GNU General Public License, and
    thus can not be removed, or can only be modified
    appropriately.
    */
    
    $str='60,100,105,118,32,99,108,97,115,115,61,34,99,111,112,121,114,105,103,104,116,34,62,101,67,111,109,109,101,114,99,101,32,69,110,103,105,110,101,32,38,99,111,112,121,59,32,50,48,48,54,32,60,97,32,104,114,101,102,61,34,104,116,116,112,58,47,47,119,119,119,46,120,116,45,99,111,109,109,101,114,99,101,46,99,111,109,34,32,116,97,114,103,101,116,61,34,95,98,108,97,110,107,34,62,120,116,58,67,111,109,109,101,114,99,101,32,83,104,111,112,115,111,102,116,119,97,114,101,60,47,97,62,60,47,100,105,118,62';
	$str_arr=explode(',',$str);
	$cop='';
	for ($i=0; $i<count($str_arr);$i++) $cop.=chr($str_arr[$i]);
    return $tpl_output.$cop;

}

?>