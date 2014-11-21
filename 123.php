<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜索</title>
</head>

<body>
  <?php
include'conn.php';


?>
<form id="form1" name="form1" method="post" action="">
  <table id="wsano" width="800" height="70" border="0" cellpadding="0" cellspacing="0">
          <td width="73">        
          <select name="ano" id="ano">
        	<option value="1">学号查询</option>
        	<option value="2">姓名查询</option>
        </select></td>
          <td width="436"><label>
            <input name="textfield" type="text" size="20" />
          </label></td>
        <tr>

        </tr>
        <tr>
          <td colspan="2" align="center"><label>
            <input type="submit" name="Submit" value="搜索" />
          </label>
            <label>
            <input type="submit" name="Submit2" value="取消" />
            </label></td>
          </tr>

      </table></td>
      
  </table>
<?php
if(isset($_POST['Submit'])  and $_POST['textfield']!=null and $_POST['Submit']=="搜索" and $_POST['ano']==1){
	$a=$_POST['textfield'];
	$arr=mysql_query("select * from type where id='$a'",$conn);//查询处分信息
	$crr=mysql_query("select * from body",$conn);//查询处分类型
	$result2=mysql_fetch_row(mysql_query("select * from date where number='$a'",$conn));	//$brr=//查询学生信息
	for($i=0;$result3[$i]=mysql_fetch_row($crr);$i++);//导入处分类型
	$i=0;//检测是否有违纪记录
	while($result=mysql_fetch_array($arr)){
		$i=1;
?>
          <tr>
            <td height="25"><?php echo $result2[0];//输出姓名?>
              &nbsp;</td>
            <td height="25"><?php echo $result['id'];//输出学号?>
              &nbsp;</td>
            <td height="25"><?php echo $result2[4];//输出班级?>
              &nbsp;</td>
            <td height="25"><?php echo $result3[$result['bodyid']-1][1];//输出处分类型?>
              &nbsp;</td>
            <td height="25"><?php echo $result['day'];//输出日期?>
              &nbsp;</td>
              <?php
              //备注部分，当处分类型为旷课 显示查课的教室及哪几节课；当处分为宿管时，显示寝室号
              if($result3[$result['bodyid']-1][1]=="旷课" or $result3[$result['bodyid']-1][1]=="旷课代缴纸条")
              { ?>
              <td height="25"><?php echo $result['class'];echo "&nbsp;"; echo $result['classroom'];
              }
              else
              	{
              		if($result3[$result['bodyid']-1][1]=="晚归" or $result3[$result['bodyid']-1][1]=="大功率" or $result3[$result['bodyid']-1][1]=="卫生不合格")
              		{?>
              			&nbsp;</td>
            			<td height="25"><?php echo (int)($result2[2]/100); echo"区"; echo $result2[2]%100; echo "栋"; echo $result2[3]%1000;
            			}
            	}?>
              <span class="STYLE3">&nbsp;</span></td>
          </tr></br>
<?php
  }     //结束while循环
  if($i==0){echo "<script> alert('没有记录!')</script>";}//统计次数
  echo "共计";
  echo mysql_num_rows($arr);
  echo "条";
}
mysql_close($conn);
?>


</br>

</form>
</body>
</html>
