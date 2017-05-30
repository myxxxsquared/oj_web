<!DOCTYPE html>
<?php 


session_start();
if(! $_SESSION["user"]){
	header("location:Login.php");
}

?>
<html lang="zh-cn">

<head>

<link rel="stylesheet" href="css/style2.css" type="text/css" />
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<title>在线评测系统</title>
</head>

<body>
<h1> 发布讨论 </h1>

<form action="PostInsert.php" method="post">
标题：<input type="text" name="postTitle" value = ""/><br />
题号:
<?php

$format = '
<input type="text" name="problemId" value="%s" /><br />
';
if($_GET['problemId']){
	printf($format, $_GET['problemId']);
}else{
	printf($format, "");
}

?>
作者: 
<?php
echo $_SESSION['user'];
?>
<br />

正文：<br />
<textarea name="postTxt" style="width:800px;height:800px;" >

</textarea><br />
<input type="submit" />
</form>

</body>

</html>