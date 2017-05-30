<!DOCTYPE html>
<?php


session_start();
if(! $_SESSION["user"] && !$_SESSION["admin"] ){
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
<title>在线评测系统</title>
<style type="text/css">
    td {
        padding: 6px;
    }
</style>
</head>

<body>
<div class="jumbotron">
<div class="container">
<h2> 题目信息 </h2>


<?php

$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
mysql_select_db('OJ',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式



$q1="select COUNT(*) as c from `Submit` where problemId=".$_GET['problemId'];
$result1=mysql_query($q1);
$row1=mysql_fetch_array($result1);

$num1 =  $row1['c'];

$q2=sprintf("select COUNT(*) as c from `Submit` where (problemId=%s and result='Accepted'" , $_GET['problemId']);
$result2 = mysql_query($q2);
$row2 = mysql_fetch_array($result2);

$num2 = $row2['c'];




$q="select * from `Problem` where problemId=".$_GET['problemId'];
$result=mysql_query($q);
$row=mysql_fetch_array($result);
$format = '
<h2>%s. %s</h2>
<table class="table-striped">
<tr>
    <td>提交人数: </td>
    <td>%s</td>
</tr>
<tr>
    <td>通过人数: </td>
    <td>%s</td>
<tr>
<tr>
    <td>时间限制：</td>
    <td>%s ms</td>
</tr>
<tr>
    <td>内存限制：</td>
    <td>%s MB</td>
</table>
题目描述：
<div class="well">
<p>%s</p>
</div>

';

printf($format,$row["problemId"], $row["problemTitle"], $num1, $num2,$row["timeLimit"],$row["memLimit"], $row["problemTxt"]);



$format = '
<form action="SubmitAdd.php" method="post" enctype="multipart/form-data">
<p>
提交代码：
<input type="hidden" name="problemId" value="%s"/>
<input type="hidden" name="userId" value="%s" />
<input type="file" name="submitCode" />
<input type="submit" />
</p>
</form>
';

if($_SESSION['user']){
	printf($format, $_GET['problemId'], $_SESSION['user']);
}

$format= '<p><a href="PostList.php?problemId=%s">讨论板</a></p>';
printf($format, $_GET['problemId']);

?>
</div>
</div>



</body>

</html>
