<?php


session_start();
if(! $_SESSION["admin"]  ){
	echo "<script>alert('未登录'); window.location.href='Login.php';</script>";
	header("location:Login.php");
}


$q = sprintf("INSERT INTO `OJ`.`Problem` (`problemId`, `timeLimit`, `memLimit`, `problemTxt`, `problemTitle`) VALUES ('', '%s', '%s', '%s', '%s')", $_POST["timeLimit"], $_POST["memLimit"],$_POST["problemTxt"], $_POST["problemTitle"]);




if ($_FILES["problemInput"]["error"] > 0 || $_FILES["problemOutput"]["error"] > 0){
  	echo "<script>alert('上传错误'); window.location.href='index2.php';</script>";
}
else{
		$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
		mysql_select_db('OJ',$link);//选择数据库
		mysql_query("set names utf8");//设置编码格式

		$res = mysql_query($q);

		if($res){
			$getId=mysql_insert_id();
			if(!is_dir("dat/problems/".$getId)){
				mkdir("dat/problems/".$getId);
			}
			move_uploaded_file($_FILES["problemInput"]["tmp_name"], "dat/problems/".$getId."/stdin"); 
			move_uploaded_file($_FILES["problemOutput"]["tmp_name"], "dat/problems/".$getId."/stdout"); 
			echo "<script>alert('提交成功'); window.location.href='index1.php';</script>";

		}
		else{
			echo "<script>alert('提交失败: 数据库错误'); window.location.href='index1.php';</script>";
		}

    }



?>