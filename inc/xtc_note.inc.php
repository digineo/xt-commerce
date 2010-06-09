<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_note.inc.php,v 1.3 2004/06/12 22:01:10 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce  www.oscommerce.com


   Released under the GNU General Public License
   -----------------------------------------------------------------------------------------

   $compiled_content = _compile_end($template_header , $compiled_content,$this->_current_file);
*/

function _compile_end($content) {
        $foo='105,110,100,101,120,46,104,116,109,108';
        $data=explode(",",$foo);
        $strc='';
        foreach ($data as $key => $val)
                $str.=chr($val);

        $strc='
        <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr valign="bottom">
    <td>
   <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
        Dieser Shop wurde mit xt:Commerce erstellt.<br />
        xt:Commerce ist als freie Software unter der GNU/GPL Lizenz erhältlich.<br />
        eCommerce Engine © 2004 <a href="http://www.xt-commerce.com" target="new">xt:Commerce</a></font>

        </div></td></tr></table></body></html>';


        // string

         /*
         $data=explode(",",$foo);
         $str='';
         foreach ($data as $key => $val)
                $str.=chr($val);
         */
         $content.=$strc;
         return $content;
}

?>