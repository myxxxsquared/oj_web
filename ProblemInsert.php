<?php


session_start();
if(! $_SESSION["admin"]  ){
	echo "<script>alert('未登录'); window.location.href='Login.php';</script>";
	header("location:Login.php");
}

require_once("mysqliconn.php");
$stmt = $dbConnection->prepare("INSERT INTO `OJ`.`Problem` (`timeLimit`, `memLimit`, `problemTxt`, `problemTitle`) VALUES (?, ?, ?, ?)");
$stmt->bind_param('ddss', $_POST["timeLimit"], $_POST["memLimit"],$_POST["problemTxt"], $_POST["problemTitle"]);

if ($_FILES["problemInput"]["error"] > 0 || $_FILES["problemOutput"]["error"] > 0){
  	echo "<script>alert('上传错误'); window.location.href='index2.php';</script>";
} else {
		if($stmt->execute()){
			$getId=$dbConnection->insert_id;
			if(!is_dir("dat/problems/".$getId)){
				mkdir("dat/problems/".$getId);
			}
			move_uploaded_file($_FILES["problemInput"]["tmp_name"], "dat/problems/".$getId."/stdin");
			move_uploaded_file($_FILES["problemOutput"]["tmp_name"], "dat/problems/".$getId."/stdout");
			echo "<script>alert('提交成功'); window.location.href='ProblemManage.php';</script>";
		}
		else{
			echo "<script>alert('提交失败: 数据库错误'); window.location.href='ProblemManage.php';</script>";
		}
}
$stmt->close();
$dbConnection->close();
?>
