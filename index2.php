<!DOCTYPE html>

<?php 


session_start();
if(! $_SESSION["admin"]){
	header("location:Login.php");
}





?>

<html lang="zh-cn">

<head>

<meta http-equiv="content-type" content="text/html;charset=utf-8">

<title>在线评测系统</title>


<link rel="stylesheet" href="sub/css/style.css" type="text/css" />


</head>

<body>
<div class="loginBox">

<h1 style="text-align: middle;"> 在线评测系统 </h1>

<div class="loginBoxCenter">

<p>
<a href="index2.php">首页</a>
<a href="Logout.php">注销</a>
</p>

<ul >
<li><a href="ProblemManage.php">题目管理</a></li>
<li><a href="PostManage.php">讨论管理</a></li>
</ul>

</div>

</div>
</body>

</html>