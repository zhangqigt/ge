<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设备管理</title>
</head>

<body>
<script type="text/javascript">
	function Juge(theForm){
		if(theForm.name.value==""){
			alert("设备名称不能为空");
			theForm.name.focus();
			return false;
		}
		return true;
	}
</script>

 <a href="main.php">返回首页</a>
 <center>
 
 <h1>添加设备或仪器</h1>
 <p>
 <table border=1>
	<form action="add_device.php" method="post" onsubmit="return Juge(this)">
		<tr> <td>设备名称</td> <td>型号(可空)</td> <td>备注(可空)</td> <td>当前被谁占用(可空)</td> </tr>
		<tr> 
			<td><input name="name" type="text"></td> 
			<td><input name="specif" type="text"></td> 
			<td><input name="remark" type="text"></td> 
			<td><input name="stat" type="text"></td>    </tr>
		<tr>
			<td colspan="4"><center><input type="submit" value="确定添加"></center></td>  </tr>
	</form>
 </table>
 
 <h1>修改设备或仪器</h1>
 <?php
	$host = "rdshqw1nuazicyieo55ju.mysql.rds.aliyuncs.com:3306"; //服务器名称
    $db_user = "re3u3x9iupi16m6c"; //用户名
    $db_password = "xutch123"; //密码
    $db = "re3u3x9iupi16m6c"; //所要连接的数据库
	
	$link_id = @ mysql_connect($host,$db_user,$db_password) or die("连接数据库失败".mysql_error());
	$db_selected = mysql_select_db($db,$link_id); 
	mysql_set_charset('utf8');
	if(!$db_selected){
        die("未找到指定的数据库".mysql_error());
    }
	
	$result=show_device($link_id);
	
	
	function show_device($link_id){ 
		
			$sql="select * from device";
			$result=@ mysql_query($sql,$link_id);
			$total_num=0;
			echo "当前仪器设备列表：<br><br>";
			echo "<table border=1>";
			echo "<tr> <td>名称</td> <td>型号</td> <td>当前使用者</td> <td>备注</td> <td></td></tr>";
			while($row=mysql_fetch_array($result)){
				$total_num=$total_num+1;
				echo "<tr>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['specif']."</td>";
				echo "<td>".$row['stat']."</td>";
				echo "<td>".$row['remark']."</td>";
				

				echo "<td>".'<a href=delete_device.php?id='.$row['id'].'>删除</a>'."</td>";
				echo "<td>".'<a href=update_device.php?id='.$row['id'].'>修改</a>'."</td>";
							
				echo "</tr>";
			}
			echo "</table>";	
			echo "<br>共有".$total_num."条记录";
			
			return $result;
		}
 ?>
 
 
</center>

</body>
</html>

