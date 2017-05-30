<!DOCTYPE html>

<?php
session_start();
header("location:ProblemManage.php");
?>

<html lang="zh-cn">

<head>

<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<title>在线评测系统</title>


<link rel="stylesheet" href="sub/css/style.css" type="text/css" />


</head>

<body>
<div class="jumbotron">
<div class="container">
<div class="loginBox">

<h2 style="text-align: middle;"> 在线评测系统 </h2>

<a href="index2.php">首页</a>
<a href="Logout.php">注销</a>

<div style="margin: 20px;">
<ul >
<li><a href="ProblemManage.php">题目管理</a></li>
<li><a href="PostManage.php">讨论管理</a></li>
</ul>
</div>

</div>
</div>
</div>
</body>

</html>
