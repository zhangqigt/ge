<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登陆</title>
</head>

<body>
<br></br>
<br></br>
<br></br>
<br></br>
<br></br>
 <center>
<form id="form1" name="form1" method="post" action="">
  <p>用户名：
    <label for="UserName"></label>
  <input type="text" name="UserName" id="UserName" />
  </p>
  <p>&nbsp密码：
    <label for="PassWord"></label>
    <input type="password" name="PassWord" id="PassWord" onblur="2"/>
  </p>
  <p>
    <input type="submit" name="Login" id="Login" value="登陆" />
  </p>
  </center>
</form>
<?php
	//echo "session_start";
	session_start();
	
    $host = "rdshqw1nuazicyieo55ju.mysql.rds.aliyuncs.com:3306"; //服务器名称
    $db_user = "re3u3x9iupi16m6c"; //用户名
    $db_password = "xutch123"; //密码
    $db = "re3u3x9iupi16m6c"; //所要连接的数据库
	
    $link_id = @ mysql_connect($host,$db_user,$db_password) or die("连接数据库失败:".mysql_error());
    $db_selected = mysql_select_db($db,$link_id);  
	mysql_set_charset('utf8');
    if(!$db_selected){
        die("未找到指定的数据库".mysql_error());
    }
 
    if(isset($_COOKIE['user'])){ 
    
        $sql = 'select * from user where username="'.$_COOKIE['user'].'"';
        $result = @ mysql_query($sql,$link_id) or die("SQL语句出错");
        $row = mysql_fetch_array($result,MYSQL_ASSOC);
        if(isset($row)){ //如果数据库中存在该用户
            Header("Location:main.php"); //合法COOKIE直接跳转到指定界面
        }else{
            $_COOKIE['user'] = ""; //非法COOKIE清空
            Header("Location:login.php"); //重新载入界面
        }
    
    }
	
    if(isset($_POST['Login'])){
   		
		//echo "Login";
        $user = $_POST['UserName'];
        $pwd = $_POST['PassWord'];
		
		if($user!=null&&$pwd!=null){
			
		
			$sql = 'select * from user where student_number="'.$user.'"';
			$result = @ mysql_query($sql,$link_id) or die("SQL语句出错");
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$cmp_pwd = $row['password'];
			if($cmp_pwd == $pwd){
			 //用从数据库取出的密码和提交的密码比较
		
				setcookie("user",$row['username'],time()+300); 
				//设置COOKIE             
				Header("Location:http:main.php"); 
				//跳转到指定页面
		
			}else{
				
				echo "<script type='text/javascript'>alert('请输入正确的用户名和密码');</script>";
				//Header("Location:login.php"); 
				//echo "重新载入页面";
			}
		
		}
		else
		{
			echo "<script type='text/javascript'>alert('用户名或者密码不能为空');</script>";
		}
	}
	
?>



</body>
</html>
