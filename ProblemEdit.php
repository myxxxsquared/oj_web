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
<input type="hidden" name="problemId" value="<?php echo($_GET['problemId']); ?>" />
<?php

require_once("mysqliconn.php");
$stmt = $dbConnection->prepare("select * from `Problem` where problemId = ?");
$stmt->bind_param('d', $_GET['problemId']);
$stmt->execute();
$result = $stmt->get_result();
$row=$result->fetch_assoc($result);

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
$stmt->close();
$dbConnection->close();
?>



<input type="submit" class="btn-primary"/>
</form>
</div>
</div>
</body>

</html>
