<?php
session_start();

if(! $_SESSION["user"]  ){
	echo "<script>alert('未登录'); window.location.href='Login.php';</script>";
	header("location:Login.php");
}

require_once("mysqliconn.php");

$stmt = $dbConnection->prepare("INSERT INTO `OJ`.`Post` (`postTitle`, `postTxt`, `userId`, `problemId`) VALUES (?, ?, ?, ?)");
$stmt->bind_param('sssd', $_POST["postTitle"], $_POST["postTxt"],$_SESSION["user"], $_POST["problemId"]);

if($stmt->execute()) {
	echo "<script>alert('发布成功'); window.location.href='PostList.php?problemId=". $_POST["problemId"]. "';</script>";
} else {
	echo "<script>alert('发布失败'); window.location.href='PostList.php?problemId=". $_POST["problemId"]. "';</script>";
}

$stmt->close();
?>
