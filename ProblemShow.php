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

<title>在线评测系统</title>
</head>

<body>
<h1> 题目信息 </h1>


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
<h1>%s. %s</h1>
提交人数: %s<br />
通过人数: %s<br />
时间限制：%s ms<br />
内存限制：%s MB<br />
题目描述：
<p>
%s
</p>

';

printf($format,$row["problemId"], $row["problemTitle"], $num1, $num2,$row["timeLimit"],$row["memLimit"], $row["problemTxt"]);



$format = '
<form action="SubmitAdd.php" method="post">
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




</body>

</html>
