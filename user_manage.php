<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理</title>
</head>

<body>
<script language="javascript">
	function Juge(theForm){
		if(theForm.student_number==""){
			alert("学号不能为空");
			theForm.name.focus();
			return false;
		}
		if(theForm.username==""){
			alert("姓名不能为空");
			theForm.name.focus();
			return false;
		}
		return true;
	}
</script>

 <a href="main.php">返回首页</a>
 <center>
 
 <h1>添加新用户</h1>
 <p>
 <table border=1>
	<form action="add_user.php" method="post" onsubmit="return Juge(this)">
		<tr> <td>学号</td> <td>姓名</td> <td>密码(为空时表示与学号相同)</td> <td>权限(1为管理员，不填为普通用户)</td> </tr>
		<tr> 
			<td><input name="student_number" type="text"></td> 
			<td><input name="username" type="text"></td> 
			<td><input name="password" type="text"></td> 
			<td><input name="privilege" type="text"></td>    </tr>
		<tr>
			<td colspan="4"><center><input type="submit" value="确定添加"></center></td>  </tr>
	</form>
 </table>
 
 <h1>修改用户信息</h1>
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
		
			$sql="select * from user";
			$result=@ mysql_query($sql,$link_id);
			$total_num=0;
			echo "当前用户列表：<br><br>";
			echo "<table border=1>";
			echo "<tr> <td>学号</td> <td>姓名</td> <td>密码</td> <td>权限</td> <td></td></tr>";
			while($row=mysql_fetch_array($result)){
				$total_num=$total_num+1;
				echo "<tr>";
				echo "<td>".$row['student_number']."</td>";
				echo "<td>".$row['username']."</td>";
				echo "<td>".$row['password']."</td>";
				echo "<td>".$row['privilege']."</td>";
				

				echo "<td>".'<a href=delete_user.php?id='.$row['id'].'>删除</a>'."</td>";
							
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

