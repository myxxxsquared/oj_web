
<?php
require_once("mysqliconn.php");

session_start();

if($_POST["select"]=="SignIn") {
	if($_POST["userclass"]=="admin") {
		$stmt = $dbConnection->prepare("select * from `Admin` where adminId = ? and password = ?");
		$stmt->bind_param('ss', $_POST["username"], $_POST["password"]);
		$stmt->execute();
		
		if(is_null($stmt->fetch())) {
			echo "<script>alert('管理员用户名或密码错误，登录失败，请重试'); window.location.href='Login.php';</script>";
		} else {
			$_SESSION["admin"]=$_POST["username"];
			header("location:index2.php");
		}
	} else if($_POST["userclass"]=="user") {
		$stmt = $dbConnection->prepare("select `password` from `User` where userId = ?");
		$stmt->bind_param('s', $_POST["username"]);
		$stmt->execute();
		$stmt->bind_result($password);

		if(is_null($stmt->fetch())) {
			if($password == $_POST["password"]) {
				$_SESSION["user"] = $_POST["username"];
				header("location:index1.php");
			} else {
				echo "<script>alert('密码错误，请重试'); window.location.href='Login.php';</script>";
			}
		} else {
			echo "<script>alert('没有此用户，请重试'); window.location.href='Login.php';</script>";
		}
	}
} else if($_POST["select"]=="SignUp") {
	$stmt = $dbConnection->prepare("select * from `Admin` where adminId = ? and password = ?");
	$stmt->bind_param('ss', $_POST["username"], $_POST["password"]);
	$stmt->execute();
	
	if($stmt->affected_rows != 0) {
		echo "<script>alert('注册成功，请登录'); window.location.href='Login.php';</script>";
	} else {
		echo "<script>alert('注册失败'); window.location.href='Login.php';</script>";
	}
}
?>
