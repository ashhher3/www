<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen" href="css/bg.css" />
<title>查询</title>
</head>

<body>
  <?php
include'conn.php';
  ?>

<script language=JavaScript>
<!--

function InputCheck(LoginForm)
{
   if (LoginForm.query.value==1)
  {
  	if(LoginForm.classid.value.length!=10)
  	{
    alert("请输入10位有效学号！");
    LoginForm.classid.focus();
    return (false);
	}
  }
  else
  	{
  	if(LoginForm.classid.value.length!=8)
  	{
    alert("请输入8位有效班级代码！");
    LoginForm.classid.focus();
    return (false);
	}
  	}
}

//-->
</script>


<form name="LoginForm" method="post" action="" onSubmit="return InputCheck(this)">
  <table  width="800" height="70" border="0" cellpadding="0" cellspacing="0">
          <td width="73">        
          <select name="query">
        	<option value="1">学号查询</option>
        	<option value="2">班级查询</option>
        </select></td>
          <td width="436"><label>
            <input name="classid" type="text" size="20" />
          </label></td>
        <tr>

        </tr>
        <tr>
          <td colspan="2" align="center">
          <label>
            <input type="submit" name="Submit" value="查询" />
          </label>
            </td>
          </tr>

      </table></td>
      
  </table>
  </form>
<?php
if(isset($_POST['Submit'])  and $_POST['classid']!=null and $_POST['query']==1){
	$classid=$_POST['classid'];
	$classid_arr=mysql_query("select * from type where id='$classid' order by day asc",$conn);//查询处分信息
	$student=mysql_fetch_row(mysql_query("select * from date where number='$classid'",$conn));	//$brr=//查询学生信息
	for($num=0;$result[$num]=mysql_fetch_array($classid_arr);$num++);//导入所有记录
	$i=0;//检测是否有违纪记录
	?>
	<h2>三大日常查询结果</h2>
    <?php
    $jid=0;
    for($j=0;$j<$num;$j++)
    {
    	if($result[$j]['bodyid']=="旷课" or $result[$j]['bodyid']=="晚归" or $result[$j]['bodyid']=="早签")
    		{ 
    			$jid++;
    			if($jid==1)
    				{ 
    					?>
    <table class="bordered">
    <thead>
	<tr>
            <th>姓名</th>
            <th>学号</th>
            <th>学部</th>
            <th>班级</th>
            <th>事由</th>
            <th>日期</th>
            <th>备注</th>
            <th>是否消除</th>
            <th>消除理由</th>
    </tr>
    </thead>

    		<?php 
    				}
    		?>
    <tr>
            <td> <?php echo $student[0];//输出姓名?> </td>
            <td> <?php echo $student[1];//输出学号?> </td>
            <td> <?php echo $student[2];//输出学部?> </td>
            <td> <?php echo $student[4];//输出班级?> </td>
            <td> <?php echo $result[$j]['bodyid'];//输出事由?> </td>
            <td> <?php echo $result[$j]['day'];//输出日期?> </td>
            <td>
              <?php
              //备注部分，当处分类型为旷课 显示查课的教室及哪几节课；当处分为宿管时，显示寝室号
              if($result[$j]['bodyid']=="旷课")
              { 
                echo $result[$j]['classname'];echo "【"; echo $result[$j]['classroom']; echo "】";
              }
              else
              	{
              		if($result[$j]['bodyid']=="晚归")
              		 echo $student[5];
            	} ?>
            </td>
            	<?php
            	if($result[$j]['yes']==2)
            	{
            	?>
            <td> <?php echo "是"; ?> </td>
            <td> <?php echo $result[$j]['xq'];?></td>
            <?php } 
             	else { 
             		?>
            <td>否 </td>
            <td> </td>
            <?php } ?>
    </tr>
    	<?php
    	}
	}
	if($jid==0)
	{
    ?>
    <p> 没有记录哦~~~ 请继续保持 O(∩_∩)O！！</p>
    <?php
	}
	else { ?>
	<p>共计 <?php  echo $jid; echo "条"; ?> </p> <?php } ?>

</table>

<h2> 其他违纪查询结果 </h2>
<?php
	$iid=0;
    for($j=0;$j<$num;$j++)
    {
    	if($result[$j]['bodyid']!="旷课" and $result[$j]['bodyid']!="晚归" and $result[$j]['bodyid']!="早签")
    		{ 
    			$iid++;
    			if($iid==1)
    				{ 
    					?>
    <table class="bordered">
    <thead>
	<tr>
            <th>姓名</th>
            <th>学号</th>
            <th>学部</th>
            <th>班级</th>
            <th>事由</th>
            <th>日期</th>
            <th>备注</th>
            <th>是否消除</th>
            <th>消除理由</th>
    </tr>
    </thead>

    		<?php 
    				}
    		?>
    <tr>
            <td> <?php echo $student[0];//输出姓名?> </td>
            <td> <?php echo $student[1];//输出学号?> </td>
            <td> <?php echo $student[2];//输出学部?> </td>
            <td> <?php echo $student[4];//输出班级?> </td>
            <td> <?php echo $result[$j]['bodyid'];//输出事由?> </td>
            <td> <?php echo $result[$j]['day'];//输出日期?> </td>
            <td> <?php echo $result[$j]['classroom'] ?> </td>
            	<?php
            	if($result[$j]['yes']==2)
            	{
            	?>
            <td> <?php echo "是"; ?> </td>
            <td> <?php echo $result[$j]['xq'];?></td>
            <?php } 
             	else { 
             		?>
            <td>否 </td>
            <td> </td>
            <?php } ?>
    </tr>
    	<?php
    	}
	}
	if($iid==0)
	{
    ?>
    <p> 没有记录哦~~~ 请继续保持 O(∩_∩)O！！</p>
    <?php
	}
	else { ?>
	<p>共计 <?php  echo $iid; echo "条"; ?> </p> <?php }}?>
    </table>

</body>
</html>
