<?php
	header("Content-type: text/html; charset=utf-8"); 

	$username=htmlspecialchars($_POST['username']);
	$student_number=htmlspecialchars($_POST['student_number']);
	$password=htmlspecialchars($_POST['password']);
	$privilege=htmlspecialchars($_POST['privilege']);
	if($privilege=="1")
		$privilege=1;
	else
		$privilege=0;
	
	if($password==""){
		$password=$student_number;
	}

	
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
	
	$sql="insert into user(student_number,username,password,privilege) values('$student_number','$username','$password',$privilege)";
	mysql_query($sql,$link_id) or die("插入出错".mysql_error());
	
	header("Location:user_manage.php?operation=add");
	
?>