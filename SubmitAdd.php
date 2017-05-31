<?php


session_start();
if(( $_SESSION["user"]!=$_POST["userId"] ) ){
	echo "<script>alert('未登录'); window.location.href='Login.php';</script>";
	header("location:Login.php");
}

require_once("mysqliconn.php");
$stmt = $dbConnection->prepare("INSERT INTO `Submit` (`problemId`, `userId`, `submitTime`) VALUES (?, ?, CURRENT_TIMESTAMP)");
$stmt->bind_param('ss', $_POST["problemId"], $_POST["userId"]);

if ($_FILES["submitCode"]["error"] > 0) {
  	echo "<script>alert('上传错误'); window.location.href='index1.php';</script>";
} else {
		if($stmt->execute()){
			$getId=$dbConnection->insert_id;
			if(!is_dir("dat/submissions/".$getId)){
				mkdir("dat/submissions/".$getId);
			}
			move_uploaded_file($_FILES["submitCode"]["tmp_name"], "dat/problems/".$getId."/src.cpp");
			shell_exec("/opt/OJ/judge/sendjudge.py ".$getId);
			echo "<script>alert('提交成功'); window.location.href='ShowStatus.php';</script>";
		}
		else{
			echo "<script>alert('提交失败: 数据库错误'); window.location.href='ProblemManage.php';</script>";
		}
    }
$stmt->close();
$dbConnection->close();


?>
