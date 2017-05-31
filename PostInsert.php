<?php
session_start();

if(! $_SESSION["user"] && ! $_SESSION["admin"] ){
	echo "<script>alert('未登录'); window.location.href='Login.php';</script>";
}

require_once("mysqliconn.php");

if(! $_SESSION["user"]) {
	$prbluser = 'Administrator';
}
else
{
	$prbluser = $_SESSION["user"];
}

$stmt = $dbConnection->prepare("INSERT INTO `Post` (`postTitle`, `postTxt`, `userId`, `problemId`) VALUES (?, ?, ?, ?)");
$stmt->bind_param('sssd', $_POST["postTitle"], $_POST["postTxt"],$prbluser, $_POST["problemId"]);

if($stmt->execute()) {
	echo "<script>alert('发布成功'); window.location.href='PostList.php?problemId=". $_POST["problemId"]. "';</script>";
} else {
	echo "<script>alert('发布失败'); window.location.href='PostList.php?problemId=". $_POST["problemId"]. "';</script>";
}

$stmt->close();
$dbConnection->close();
?>
