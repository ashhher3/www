<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>导入</title>
<!--JS日历开始-->
<LINK 
href="dpdemo/main.css" type=text/css rel=stylesheet><LINK 
href="dpdemo/dp.css" type=text/css rel=stylesheet>
<SCRIPT src="dpdemo/jquery.js" type=text/javascript></SCRIPT>

<SCRIPT src="dpdemo/jquery.datepicker.js" type=text/javascript></SCRIPT>

<STYLE type=text/css>.picker {
	BACKGROUND: url(dpdemo/cal.gif) no-repeat; MARGIN-LEFT: -19px; WIDTH: 16px; CURSOR: pointer; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; HEIGHT: 16px; BORDER-BOTTOM-STYLE: none
}
</STYLE>
<SCRIPT type=text/javascript>
        $(document).ready(function() {           
            $("#datetime").datepicker({ picker: "<button>选择</button>", applyrule: rule });
            $("#endtime").datepicker({ picker: "<button>选择</button>", applyrule: rule });
            $("#temptime").datepicker({ picker: "<img class='picker' align='middle' src='dpdemo/s.gif' alt=''/>" });
            $("#hdobj").datepicker({ picker: "#handler", showtarget: $("#target"), onReturn: function(d) { alert(d.Format("yyyy年M月d日")); } });
            function rule(id) {
                if (id == 'datetime') {
                    var v = $("#endtime").val();
                    if (v == "") {
                        return null;
                    }
                    else {
                        var d = v.match(/^(\d{1,4})(-|\/|.)(\d{1,2})\2(\d{1,2})$/);
                        if (d != null) {
                            var nd = new Date(parseInt(d[1], 10), parseInt(d[3], 10) - 1, parseInt(d[4], 10));
                            return { enddate: nd };
                        }
                        else {
                            return null;
                        }
                    }
                }
                else {
                    var v = $("#datetime").val();
                    if (v == "") {
                        return null;
                    }
                    else {
                        var d = v.match(/^(\d{1,4})(-|\/|.)(\d{1,2})\2(\d{1,2})$/);
                        if (d != null) {
                            var nd = new Date(parseInt(d[1], 10), parseInt(d[3], 10) - 1, parseInt(d[4], 10));
                            return { startdate: nd };
                        }
                        else {
                            return null;
                        }
                    }

                }
            }
        });
    </SCRIPT>
    <!--JS日历结束-->
</head>

<body>
  <?php
include'conn.php';
?>
<form id="form1" name="form1" method="post" action="">
  <tr>
          <td width="73"><span class="STYLE1">请输入学号</span></td>
          <td width="436"><label>
            <input name="textfield" type="text" size="20" />
            </label>
          <td width="73"><span class="STYLE1">违纪事由</span></td>
          <select name="wj" id="wj">
          <?php //导入事由
          $crr=mysql_query("select * from body",$conn);
          for($i=0;$result3[$i]=mysql_fetch_row($crr);$i++);
          for($i=0;$result3[$i]!=null;$i++)
          	{ ?>
          <option value="<?php echo $result3[$i][0];?>"><?php echo $result3[$i][1];?></option>
          <?php
          	}
          	?>
        </select>
        <td width="73"><span class="STYLE1">日期</span></td>
        <INPUT name="temptime" id="temptime" >
        <td width="73"><span class="STYLE1">教室</span><input name="classroom" type="text" size="20" /></td>

        <td width="73"><span class="STYLE1">上课时间</span>
        <select name="time" id="time">
        <option value=""></option>
        <option value="早自习">早自习</option>
        <option value="一二节课">一二节课</option>
        <option value="三四节课">三四节课</option>
        <option value="五六节课">五六节课</option>
        <option value="七八节课">七八节课</option>
        <option value="九十节课">九十节课</option>
        <option value="晚自习">晚自习</option>
        </select>
            <input type="submit" name="Submit" value="确认" />
            &nbsp;</td></tr></br></br></form>
<form id="form2" name="form2" method="post" action=""> 
    <?php
    if(isset($_POST['Submit']) and $_POST['Submit']=="确认" and $_POST['wj']!=NULL and $_POST['temptime']!=null){
    if($_POST['wj']==3 or $_POST['wj']==4 )
    	{ if($_POST['classroom']==null or $_POST['time']==null)
			{ 
				echo "<script> alert('请填写教室号及上课时间！');history.back();</script>";
			}
		}
	$a=$_POST['textfield'];
	$wj=$_POST['wj'];
	$result=mysql_fetch_row(mysql_query("select * from date where number='$a'",$conn));	//$brr=//查询学生信息
	$b=$result[2];
	$result4=mysql_fetch_array(mysql_query("select * from class where number='$b'",$conn));//查询班级信息
	?>
	<tr>
            <td height="25">&nbsp;姓名：<?php echo $result[0]; ?>
              &nbsp;</td>
            <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学号：<?php echo $result[1]; ?>
              &nbsp;</td>
            <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;班级：<?php echo (int)($a/100000000);echo "级"; echo $result4['class'];//输出班级?>
              &nbsp;</td>
              <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学部：<?php echo $result4['club']; //学部?>
              &nbsp;</td>
            <td height="25">&nbsp;违纪事由:<?php $wj=$result3[$_POST['wj']][1]; echo $wj; //学部?>
              &nbsp;</td>
            <td height="25">日期:<?php $temptime=$_POST['temptime']; echo $temptime; //学部?>
              &nbsp;</td>
            <td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;备注:
            <?php
            if($_POST['wj']==3 or $_POST['wj']==4)
            	{ $classroom=$_POST['classroom'];
        		  $time=$_POST['time'];
        		  echo $classroom;
        		  echo "   ";
        		  echo $time;
        		}
        		else
        		{ if($_POST['wj']==5 or $_POST['wj']==6 or $_POST['wj']==7)
        			{ echo (int)($result[3]/100); echo"区"; echo $result[3]%100; echo "栋"; echo $result[4]%1000;
        			}
        			else
        				{echo "无";}
        		}
        		?>
            <span class="STYLE3">&nbsp;</span></td>
          </tr></br></br>
          <input type="submit" name="yes" value="确认提交" />
          </form>
<?php
if(isset($_POST['yes']) and $_POST['yes']=="确认提交" and $classroom!=null and $time!=null){
	if($_POST['wj']==3 or $_POST['wj']==4){
	$insert22=mysql_query("insert into type(id,bodyid,day,classroom,class,yes) values('$a','$wj','$temptime','$classroom','$time','0') ");
	echo "ccccccc";
}
echo "aaaaaa";}
?>
	
	
<?php
}
mysql_close($conn);
?>
  </body>
</html>