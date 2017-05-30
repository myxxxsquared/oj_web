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

<title>在线评测系统</title>
</head>

<body>
<h1> 题目信息 </h1>

<form action="ProblemUpdate.php" method="post">

<?php

$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
mysql_select_db('OJ',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式


$format = '<input type="text" name="problemId" value="%s" readonly="true" /> <br />';
printf($format, $_GET['problemId']);


$q="select * from `Problem` where problemId=".$_GET['problemId'];
$result=mysql_query($q);

$row=mysql_fetch_array($result);


$format = '
题目标题：<input type="text" name="problemTitle" value = "%s"/><br />
时间限制：<input type="text" name="timeLimit" value = "%s"/><br />
内存限制：<input type="text" name="memLimit" value= "%s" /><br />
题目描述：<br />
<textarea name="problemTxt" style="width:800px;height:800px;" >
%s
</textarea><br />
标准输入: <input type="file" name="problemInput" /><br />
标准输出: <input type="file" name="problemOutput" /><br />
';

printf($format, $row["problemTitle"],$row["timeLimit"],$row["memLimit"], $row["problemTxt"]);
?>



<input type="submit" />
</form>

</body>

</html>