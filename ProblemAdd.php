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

<form action="ProblemInsert.php" method="post">
题目标题：<input type="text" name="problemTitle" value = ""/><br />
时间限制：<input type="text" name="timeLimit" value = ""/><br />
内存限制：<input type="text" name="memLimit" value= "" /><br />
题目描述：<br />
<textarea name="problemTxt" style="width:800px;height:800px;" >

</textarea><br />
标准输入: <input type="file" name="problemInput" /><br />
标准输出: <input type="file" name="problemOutput" /><br />
<input type="submit" />
</form>

</body>

</html>