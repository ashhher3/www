<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学生违纪详情查看</title>
</head>

<body>
<?php
include'conn.php';

if(isset($_POST['xq']) and $_POST['xq']=="详情"){
	$a=$_POST['id'];
	$arr=mysql_query("select * from type where id='$a'",$conn);//查询处分信息
	$crr=mysql_query("select * from body",$conn);//查询处分类型
	$result2=mysql_fetch_row(mysql_query("select * from date where number='$a'",$conn));	//$brr=//查询学生信息
	for($i=0;$result3[$i]=mysql_fetch_row($crr);$i++);//导入处分类型
	$b=$result2[2];
	$result4=mysql_fetch_array(mysql_query("select * from class where number='$b'",$conn));//查询班级信息
	$i=0;//检测是否有违纪记录
	?>
	<tr>
            <td height="25">&nbsp;姓名
              &nbsp;</td>
            <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学号
              &nbsp;</td>
            <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;班级
              &nbsp;</td>
              <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学部
              &nbsp;</td>
            <td height="25">&nbsp;事由
              &nbsp;</td>
            <td height="25">日期
              &nbsp;</td>
            <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;备注
            &nbsp;</td>
            <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是否消除
            &nbsp;</td>
            <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;消除理由
            <span class="STYLE3">&nbsp;</span></td>
          </tr></br></br>
	<?php
	while($result=mysql_fetch_array($arr)){
		$i=1;
?>
          <tr>
            <td height="25"><?php echo $result2[0];//输出姓名?>
              &nbsp;</td>
            <td height="25"><?php echo $result2[1];//输出学号?>
              &nbsp;</td>
            <td height="25"><?php echo (int)($a/100000000);echo "级"; echo $result4['class'];//输出班级?>
              &nbsp;</td>
              <td height="25"><?php echo $result4['club'];//输出班级?>
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
              			
            			<td height="25"><?php echo (int)($result2[3]/100); echo"区"; echo $result2[3]%100; echo "栋"; echo $result2[4]%1000;
            			}
            	}
            	if($result['yes']==2)
            	{ ?>
            &nbsp;</td>
            <td height="25">是 
            &nbsp;</td>
            <td height="25"> <?php echo $result['xq'];
             }
             else {?>
             &nbsp;</td>
            <td height="25">否 
            <?php } ?>
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
</body>
</html>
