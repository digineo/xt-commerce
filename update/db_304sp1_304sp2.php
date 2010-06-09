<?php
/*
 * Update Script for xt:Commerce Database
 * xt:Commerce Version 3.0.4 SP1 -> 3.0.4 SP2
 * 
 * (c) 2006 xt:Commerce GbR, http://www.xt-commerce.com
 * 
 */
 
 
   function xtc_UpdateQuery($query, $link = 'db_link') {
    global $$link;
	$val = true;
    $result = mysql_query($query, $$link) or $val = error();
    return $val;
  }
  
  function error() {
  	return false;
  }
 
 require('304sp2_queries.php');



 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>xt:Commerce Update</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="800" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="95" colspan="2" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="1"><img src="update/images/logo.gif"></td>
          <td background="update/images/bg_top.jpg">&nbsp;</td>
        </tr>
      </table>

    </td>
  </tr>
  <tr>
    <td width="180" valign="top" bgcolor="F3F3F3" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid; border-color: #6D6D6D;">
      <table width="180" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="17" background="update/images/bg_left_blocktitle.gif">
<div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><b><font color="FFAF00">xtc:</font><font color="#999999">Update</font></b></font></div></td>
        </tr>
        <tr>
          <td bgcolor="F3F3F3" ><br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10">&nbsp;</td>
                <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="update/images/icons/arrow02.gif" width="13" height="6">Start<br><img src="update/images/icons/arrow02.gif" width="13" height="6">Update</font></td>
              </tr>
            </table>
            <br /></td>
        </tr>
      </table>
    </td>
    <td align="right" valign="top" style="border-top: 1px solid; border-bottom: 1px solid; border-right: 1px solid; border-color: #6D6D6D;">
      <br />
      <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td><img src="update/images/title_index.gif" width="586" height="100" border="0"><br />

            <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br /><br />
            
            
            Database Update:<br>
        
   
            
            
             <table width="100%"  border="0" cellpadding="2" cellspacing="2" style="border: 1px solid; border-color: #4CC534;">
              
              <?php for ($i=1;$i<COUNT+1;$i++) { ?>
              
                  <tr>
                    <td width="95%"><?php echo constant(_Q.$i); $result=xtc_UpdateQuery(constant(Q.$i)); ?></td>
                    <td><?php if($result) { echo '<img src="update/images/ok.jpg">'; } else { echo '<img src="update/images/notok.jpg">'; } ?></td>
                  </tr>
                  
             <?php } ?>     
             </table>
            
            <br><br>DATABASE UDPATE FINISHED!<br><br>
          
            Please remove /update/ folder and update.php from your webspace<br><br>
            
            
            
            </font><br />
            <br /></td>
        </tr>
    


      </table>
      <p><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="images/break-el.gif" width="100%" height="1"></font></p>

</td>
  </tr>
</table>

<p align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">E-Commerce Engine Copyright © 2006 <a href="http://www.xt-commerce.com">xt:Commerce</a></font></p>
</body>
</html>