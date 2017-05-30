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
<?php


$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
mysql_select_db('OJ',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式


$q="select * from `Post` where postId=".$_GET['postId'];
$result=mysql_query($q);
$row=mysql_fetch_array($result);
$format = '
<h1>%s. %s</h1>
题号: %s<br />
作者: %s<br />
正文：
<p>
%s
</p>

';

printf($format,$row["postId"], $row["postTitle"], $row["problemId"],$row["userId"], $row["postTxt"] );


?>
</body>

</html>