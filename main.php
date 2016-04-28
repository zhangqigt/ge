<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>操作首页面</title>
</head>

<body>

<center>
	<?php
		session_start();
		$result;
		
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
	
		if(isset($_COOKIE['user'])){ 
		
		
			$sql = 'select * from user where username="'.$_COOKIE['user'].'"';
			$result = @ mysql_query($sql,$link_id) or die("SQL语句出错");
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			if(isset($row)){ //如果数据库中存在该用户
				//！！！！！！！！！！！！！！合法COOKIE 执行主操作
				
				
				if($row['privilege']==1){
					echo "<br><br>";
					echo '<a href=device_manage.php>设备管理</a>';
					echo "&nbsp&nbsp&nbsp&nbsp";
					echo '<a href=user_manage.php>用户管理</a>';
					echo "<br><br>";
				}
				$result=show_device($link_id);
				
			}else{
				$_COOKIE['user'] = ""; //非法COOKIE清空
			   Header("Location:index.php"); //重新载入界面
			}
		
		}
		else
		{
			Header("Location:index.php"); //重新载入界面
		}
		//!!!!!!!!!!!!!!!!!!!!借用设备的操作
		//============================================================================================================================
		
		if(isset($_GET['operation'])){
			if($_GET['operation']=='borrow')
				echo "<script type='text/javascript'>alert('借用成功，请爱惜设备，及时归还');</script>";
			if($_GET['operation']=='return')
				echo "<script type='text/javascript'>alert('操作成功');</script>";
		}
		
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
				
				//echo '<form id="form1" name="form1" method="post" action="">';
				//echo "<td>".'<input type="submit" name="borrow" id="'.$total_num.'" value="借用" />'."</td>";				
				//echo "</form>";
				if($row['stat']==NULL)
					echo "<td>".'<a href=borrow.php?user='.$_COOKIE['user'].'&id='.$row['id'].'>借用</a>'."</td>";
				else{
					if($row['stat']==$_COOKIE['user'])
						echo "<td>".'<a href=return.php?user='.$_COOKIE['user'].'&id='.$row['id'].'>归还</a>'."</td>";
					else
						echo  "<td>".'<a href=>不可用</a>'."</td>";
				}
					
				
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

