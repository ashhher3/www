<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen" href="css/bg.css" />
<title>查询</title>
</head>

<body>

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
	else{ 
	  with(document.LoginForm){ 
      action="studentcx.php"; 
      submit(); 
  	} 
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
	else{ 
	  with(document.LoginForm){ 
      action="classcx.php"; 
      submit(); 
  	} 
  	}
}
}

//-->
</script>


<form name="LoginForm" method="post" onSubmit="return InputCheck(this)">
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

</body>
</html>
