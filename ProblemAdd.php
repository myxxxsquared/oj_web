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
<style type="text/css">
    label {
        font-size: 16px;
    }
    td {
        padding: 5px;
    }
    table {
        margin: 10px;
    }
</style>
</head>

<body>
<?php
if (! $_SESSION["admin"]) {
    include('nav1.php');
} else {
    include('nav2.php');
}
?>
<div class="jumbotron">
<div class="container">
<h2> 题目信息 </h2>

<form action="ProblemInsert.php" method="post" enctype="multipart/form-data">
<div class="container">
<table>
<tr>
<td><label>题目标题：</label></td><td><input type="text" name="problemTitle" value = "" class="form-control"/></td>
</tr>
<tr>
<td><label>时间限制 (s)：</label></td><td><input type="text" name="timeLimit" value = "" class="form-control"/></td>
</tr>
<tr>
<td><label>内存限制 (MB)：</label></td><td><input type="text" name="memLimit" value= "" class="form-control"/></td>
</tr>
</table>

<label>题目描述：</label>
<textarea name="problemTxt" style="height:300px;" class="form-control">

</textarea><br />
<label>标准输入: </label><input type="file" name="problemInput" /><br />
<label>标准输出: </label><input type="file" name="problemOutput" /><br />
<input type="submit" class="btn-primary"/>
</form>
</div>
</div>
</div>
<script type="text/javascript">
    $('#nav-new').addClass('active');
</script>
</body>

</html>
