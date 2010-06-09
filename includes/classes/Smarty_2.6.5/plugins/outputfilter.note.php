<?php
/* -----------------------------------------------------------------------------------------
   $Id: outputfilter.note.php,v 1.1 2003/09/06 22:13:53 fanta2k Exp $

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

    $cop='<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0"><tr valign="bottom"><td class="copyright">Dieser Shop wurde mit xt:Commerce erstellt.<br>xt:Commerce ist als freie Software unter der GNU/GPL Lizenz erhältlich.<br>eCommerce Engine © 2004 <a href="http://www.xt-commerce.com" target="new">xt:Commerce</a></td></tr></table></body></html>';

    return $tpl_output.$cop;

}

?>