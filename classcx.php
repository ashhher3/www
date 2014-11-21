<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen" href="css/bg.css" />
<title>班级查询</title>
<script>
function HiddenTr(display)
{
var tempTable=document.getElementsByName("yy")
if(display=="1")
	for(i=0;tempTable.length;i++)
  	tempTable[i].style.display=""
else
	for(i=0;tempTable.length;i++)
  tempTable[i].style.display="none"
}

</script>

</head>

<body >
  <?php
include'conn.php';
  ?>

<?php
if(isset($_POST['Submit'])  and $_POST['classid']!=null){
	$classid=$_POST['classid'];
	$student_arr=mysql_query("select name,number,class,classid,yes,yesid from date where number like '%".$classid."%' order by number asc",$conn);//查询班级所有学生
	for($i=0;$student[$i]=mysql_fetch_array($student_arr);$i++);//导入所有学生信息
	?>
	<h2>班级查询结果</h2>
	<center><input type="button" onClick="HiddenTr(0)" value="隐藏无记录同学"/>&nbsp;<input type="button" onClick="HiddenTr(1)" value="显示所有"/></center>
	<table class="bordered">
    <thead>
	<tr>
            <th>姓名</th>
            <th>学号</th>
            <th>学部</th>
            <th>班级</th>
            <th>三大日常记录数</th>
            <th>其他违纪记录数</th>
            <th>查看个人详情</th>
    </tr>
    </thead>
    <?php
    for($i=0;$student[$i]!=NULL;$i++)
    	{?>
    <tr <?php if($student[$i]['yes']==0 and $student[$i]['yesid']==0) { ?> name="yy" <?php }?> >
            <td> <?php echo $student[$i]['name'];//输出姓名?> </td>
            <td> <?php echo $student[$i]['number'];//输出学号?> </td>
            <td> <?php echo $student[$i]['class'];//输出学部?> </td>
            <td> <?php echo $student[$i]['classid'];//输出班级?> </td>
            <td <?php if($student[$i]['yes']>0) { ?> id="tt" <?php }?> > <?php echo $student[$i]['yes'];//输出三大日常记录数?> </td>
            <td <?php if($student[$i]['yesid']>0) { ?> id="tt" <?php }?> > <?php echo $student[$i]['yesid'];//输出其他违纪记录数?> </td>
            <td> <form  method="post" action="studentcx.php">
            	<input type="hidden" name="classid" value="<?php echo $student[$i]['number']; //个人信息查询?>" />
            	 <input type="submit" name="Submit" value="查看详情" /> 
            	 </form></td>
    </tr>
    <?php
    	}
?>
</table>
<?php
}
	else
		{ echo "<script> window.location.href='cx2.php'</script>";}?>
    </table>

</body>
</html>
