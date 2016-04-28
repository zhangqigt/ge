<?php
	header("Content-type: text/html; charset=utf-8"); 
	
	$id=$_GET['id'];	

	$host = "rdshqw1nuazicyieo55ju.mysql.rds.aliyuncs.com:3306"; //服务器名称
    $db_user = "re3u3x9iupi16m6c"; //用户名
    $db_password = "xutch123"; //密码
    $db = "re3u3x9iupi16m6c"; //所要连接的数据库
	
	$link_id = @ mysql_connect($host,$db_user,$db_password) or die("连接数据库失败".mysql_error());
	$db_selected = mysql_select_db($db,$link_id); 
	mysql_set_charset('utf8');
	
	$sql="delete from device where id=$id";
	mysql_query($sql,$link_id)or die("删除出错".mysql_error());;;
	
	Header("Location:device_manage.php?operation=delete"); 
?>