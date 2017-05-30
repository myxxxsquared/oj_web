<!DOCTYPE html>
<?php
session_start();
if(! $_SESSION["admin"]){
	header("location:Login.php");
}
?>

<html lang="zh-cn">

<head>

<link rel="stylesheet" href="css/style2.css" type="text/css" />
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/common.css" type="text/css" />
<title>在线评测系统</title>
</head>

<body>
<?php include('nav2.php') ?>
<div class="jumbotron">
<div class="container">
<h2> 题目编辑 </h2>

<form action="ProblemUpdate.php" method="post">

<?php

$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
mysql_select_db('OJ',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式


$q="select * from `Problem` where problemId=".$_GET['problemId'];
$result=mysql_query($q);

$row=mysql_fetch_array($result);


$format = '
<table>
<tr>
<td><label>题目标题：</label></td><td><input type="text" name="problemTitle" value = "%s" class="form-control"/></td>
</tr>
<tr>
<td><label>时间限制：</label></td><td><input type="text" name="timeLimit" value = "%s" class="form-control"/></td>
</tr>
<tr>
<td><label>内存限制：</label></td><td><input type="text" name="memLimit" value= "%s" class="form-control"/></td>
</tr>
</table>
<label>题目描述：</label>
<textarea name="problemTxt" style="height:300px;" class="form-control">
%s
</textarea><br />
<label>标准输入: </label><input type="file" name="problemInput" /><br />
<label>标准输出: </label><input type="file" name="problemOutput" /><br />
';

printf($format, $row["problemTitle"],$row["timeLimit"],$row["memLimit"], $row["problemTxt"]);
?>



<input type="submit" class="btn-primary"/>
</form>
</div>
</div>
</body>

</html>
