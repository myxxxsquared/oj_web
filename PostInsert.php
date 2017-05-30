<?php


session_start();
if(! $_SESSION["user"]  ){
	echo "<script>alert('未登录'); window.location.href='Login.php';</script>";
	header("location:Login.php");
}


$q = sprintf("INSERT INTO `OJ`.`Post` (`postId`, `postTitle`, `postTxt`, `userId`, `problemId`) VALUES ('', '%s', '%s', '%s', '%s')", $_POST["postTitle"], $_POST["postTxt"],$_SESSION["user"], $_POST["problemId"]);




		$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
		mysql_select_db('OJ',$link);//选择数据库
		mysql_query("set names utf8");//设置编码格式

		$res = mysql_query($q);

		if($res){
			echo "<script>alert('发布成功'); window.location.href='PostList.php?problemId=". $_POST["problemId"]. "';</script>";

		}
		else{
			echo "<script>alert('发布失败'); window.location.href='PostList.php?problemId=". $_POST["problemId"]. "';</script>";
		}





?>
