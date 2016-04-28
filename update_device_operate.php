<?php
	header("Content-type: text/html; charset=utf-8"); 

	$name=htmlspecialchars($_POST['name']);
	$specif=htmlspecialchars($_POST['specif']);
	$remark=htmlspecialchars($_POST['remark']);
	$stat=htmlspecialchars($_POST['stat']);
	$id=$_POST['id'];
	
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
	
	$sql="update device set name='$name',specif='$specif',remark='$remark',stat='$stat' where id=$id";
	mysql_query($sql,$link_id) or die("插入出错".mysql_error());
	
	header("Location:device_manage.php?operation=update");
	
?>