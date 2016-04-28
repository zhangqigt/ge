<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改</title>
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
<?php	
	$id=$_GET['id'];	

	$host = "rdshqw1nuazicyieo55ju.mysql.rds.aliyuncs.com:3306"; //服务器名称
    $db_user = "re3u3x9iupi16m6c"; //用户名
    $db_password = "xutch123"; //密码
    $db = "re3u3x9iupi16m6c"; //所要连接的数据库
	
	$link_id = @ mysql_connect($host,$db_user,$db_password) or die("连接数据库失败".mysql_error());
	$db_selected = mysql_select_db($db,$link_id); 
	mysql_set_charset('utf8');
	
	$sql="select * from device where id=$id";
	$result = @ mysql_query($sql,$link_id) or die("SQL语句出错");
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
?>
<a href="device_manage.php">返回设备管理界面</a>
<center>
<h1>修改</h1>
<p>
<table border=1>
	<form action="update_device_operate.php" method="post" onsubmit="return Juge(this)">
		<input type="hidden" name="id" value="<?php echo $id ?>">;
		<tr> <td>设备名称</td> <td>型号</td> <td>备注</td> <td>当前被谁占用</td> </tr>
		<tr> 
			<td><input name="name" type="text" value="<?php echo $row['name'] ?>"></td> 
			<td><input name="specif" type="text" value="<?php echo $row['specif'] ?>"></td> 
			<td><input name="remark" type="text" value="<?php echo $row['remark'] ?>"></td> 
			<td><input name="stat" type="text" value="<?php echo $row['stat'] ?>"></td>    </tr>
		<tr>
			<td colspan="4"><center><input type="submit" value="确定修改"></center></td>  </tr>
	</form> 
</table>
</center>


</body>
</html>
