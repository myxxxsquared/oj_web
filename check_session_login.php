<?php
if($_POST["select"]=="SignIn"){
	session_start();

	$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
	mysql_select_db('OJ',$link);//选择数据库
	mysql_query("set names utf8");//设置编码格式

	if($_POST["userclass"]=="admin"){

		$q=sprintf("select * from `Admin` where adminId = '%s' and password = '%s'", $_POST["username"], $_POST["password"]);
		$result=mysql_query($q);


		$num = mysql_num_rows($result);
		if($num)
		{
			$_SESSION["admin"]=$_POST["username"];
			header("location:index2.php");
			//echo "没有此管理员";

		}else{
			//header("location:Login.php");
			echo "<script>alert('没有此管理员'); window.location.href='Login.php';</script>";
			//echo $q;
		}

	}

	else if($_POST["userclass"]=="user"){
		$q=sprintf("select `password` from `User` where userId = '%s'", $_POST["username"]);
		$result=mysql_query($q);


		$num = mysql_num_rows($result);
		if($num != 0)
		{
			$password = mysql_result($result, 0);
			if ($_POST["password"] == $password) {
				$_SESSION["user"] = $_POST["username"];
				header("location:index1.php");
			} else {
				echo "<script>alert('密码错误'); window.location.href='Login.php';</script>";
			}
		} else {
			echo "<script>alert('没有此用户'); window.location.href='Login.php';</script>";
		}
	}
}else if($_POST["select"]=="SignUp"){

		$q=sprintf("INSERT INTO `OJ`.`User` (`userId`, `password`) VALUES ('%s', '%s')", $_POST["username"], $_POST["password"]);

		$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
		mysql_select_db('酒店客房管理系统',$link);//选择数据库
		mysql_query("set names utf8");//设置编码格式

		$res = mysql_query($q);

		if($res){
			echo "<script>alert('注册成功'); window.location.href='Login.php';</script>";
		}
		else{
			echo "<script>alert('注册失败'); window.location.href='Login.php';</script>";
		}


}
?>
