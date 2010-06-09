<?php
/* --------------------------------------------------------------
   $Id: customer_memo.php,v 1.3 2004/06/05 11:39:59 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce

   (c) programmed by Zanier Mario for neXTCommerce

   Released under the GNU General Public License 
   --------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (customer_memo.php,v 1.6 2003/08/18); www.nextcommerce.org
   
   --------------------------------------------------------------*/


?>
    <td valign="top" class="main"><?php echo ENTRY_MEMO; ?></td>
    <td class="main"><?php
  $memo_query = xtc_db_query("SELECT
                                  *
                              FROM
                                  " . TABLE_CUSTOMERS_MEMO . "
                              WHERE
                                  customers_id = '" . $_GET['cID'] . "'
                              ORDER BY
                                  memo_date DESC");
  while ($memo_values = xtc_db_fetch_array($memo_query)) {
    $poster_query = xtc_db_query("SELECT customers_firstname, customers_lastname FROM " . TABLE_CUSTOMERS . " WHERE customers_id = '" . $memo_values['poster_id'] . "'");
    $poster_values = xtc_db_fetch_array($poster_query);
?><table width="100%">
      <tr>
        <td class="main"><b><?php echo TEXT_DATE; ?></b>:<i><?php echo $memo_values['memo_date']; ?></i><b><?php echo TEXT_TITLE; ?></b>:<?php echo $memo_values['memo_title']; ?><b>  <?php echo TEXT_POSTER; ?></b>:<?php echo $poster_values['customers_lastname']; ?> <?php echo $poster_values['customers_firstname']; ?></td>
      </tr>
      <tr>
        <td width="142" class="main" style="border: 1px solid; border-color: #cccccc;"><?php echo $memo_values['memo_text']; ?></td>
      </tr>
      <tr>
        <td><a href="<?php echo xtc_href_link(FILENAME_CUSTOMERS, 'cID=' . $_GET['cID'] . '&action=edit&special=remove_memo&mID=' . $memo_values['memo_id']); ?>" onClick="return confirm('<?php echo DELETE_ENTRY; ?>')"><?php echo xtc_image_button('button_delete.gif', IMAGE_DELETE); ?></a></td>
      </tr>
    </table>
<?php
  }
?>
    <table width="100%">
      <tr>
        <td class="main" style="border-top: 1px solid; border-color: #cccccc;"><b><?php echo TEXT_TITLE ?></b>:<?php echo xtc_draw_input_field('memo_title'); ?><br><?php echo xtc_draw_textarea_field('memo_text', 'soft', '80', '5'); ?><br><?php echo xtc_image_submit('button_insert.gif', IMAGE_INSERT); ?></td>
      </tr>
    </table></td>