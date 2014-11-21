<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>增加类型</title>
</head>

<body>
  <?php
include'conn.php';
$arr=mysql_query("select * from body",$conn);
$a=mysql_num_rows($arr);

?>
<form id="form1" name="form1" method="post" action="index_ok.php">
  <table id="wsano" width="800" height="70" border="0" cellpadding="0" cellspacing="0">
          <td width="73"><span class="STYLE1">增加类型</span></td>
          <td width="436"><label>
            <input name="textfield" type="text" size="20" />
          </label></td>
        <tr>

        </tr>
        <input type="hidden" name="id" value="<?php $b=$a+1;echo "$b"; ?>" />
        <tr>
          <td colspan="2" align="center"><label>
            <input type="submit" name="Submit" value="提交" />
          </label>
            <label>
            <input type="submit" name="Submit2" value="取消" />
            </label></td>
          </tr>

      </table></td>
      
  </table>
<?php
/*使用while语句循环mysql_fetch_array()函数返回的数组*/
while($result=mysql_fetch_array($arr)){
?>
          <tr>
            <td height="25"><?php echo $result['id'];?>
                <!--输出新闻标题-->
              &nbsp;</td>
            <td height="25"><?php echo $result['body'];?>
                <!--输出新闻内容-->
              <span class="STYLE3">&nbsp;</span></td>
          </tr></br>
<?php
  }     //结束while循环
?>
</br>

共计
<?php
echo $a;
mysql_close($conn);
?>
条
</form>
</body>
</html>
