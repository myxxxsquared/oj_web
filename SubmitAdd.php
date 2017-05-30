<?php


session_start();
if(! $_SESSION["admin"] && ( $_SESSION["user"]!=$_POST["userId"] ) ){
	echo "<script>alert('未登录'); window.location.href='Login.php';</script>";
	header("location:Login.php");
}


$q = sprintf("INSERT INTO `OJ`.`Submit` (`submitId`, `problemId`, `userId`, `submitTime`, `result`, `runTime`) VALUES ('', '%s', '%s', CURRENT_TIMESTAMP, '', '')", $_POST["problemId"], $_POST["userId"]);


if ($_FILES["submitCode"]["error"] > 0){
  	echo "<script>alert('上传错误'); window.location.href='index1.php';</script>";
}
else{


		$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
		mysql_select_db('OJ',$link);//选择数据库
		mysql_query("set names utf8");//设置编码格式

		$res = mysql_query($q);

		if($res){
			$getId=mysql_insert_id();
			if(!is_dir("dat/submissions/".$getId)){
				mkdir("dat/submissions/".$getId);
			}
			move_uploaded_file($_FILES["submitCode"]["tmp_name"], "dat/submissions/".$getId."/src.cpp");
			shell_exec("/opt/OJ/judge/sendjudge.py ".$getId);
			echo "<script>alert('提交成功'); window.location.href='ShowStatus.php';</script>";
		}
		else{
			echo "<script>alert('提交失败: 数据库错误'); window.location.href='index1.php';</script>";
		}

    }



?>
