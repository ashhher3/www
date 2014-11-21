<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>向数据库中添加数据</title>
</head>

<body>
<?php
include'conn.php';

if(isset($_POST['Submit'])  and $_POST['textfield']!=null and $_POST['Submit']=="提交"){
	$insert=mysql_query("insert into body(id,body) values('".$_POST['id']."','".$_POST['textfield']."')");
	if($insert){
	echo "<script> alert('增加成功!'); window.location.href='index.php'</script>";
	}else{
	echo "<script> alert('增加失败!'); window.location.href='index.php'</script>";
	}
}else{
	if(@$_POST['Submit2']=="取消"){
		echo "<script>window.location.href='index.php' </script>";
	}
	else{
	echo "<script> alert('请填写内容!'); window.location.href='index.php'</script>";
}
}
mysql_close($conn);
?>
</body>
</html>
