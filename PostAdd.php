<!DOCTYPE html>
<?php


session_start();
if(! $_SESSION["user"] && ! $_SESSION["admin"]){
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
    td {
        padding: 5px;
    }
    label {
        font-size: 18px;
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
<h2> 发布讨论 </h2>

<form action="PostInsert.php" method="post">
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
<table>
<tr>
    <td><label>标题：</label></td>
    <td><input type="text" name="postTitle" value = "" class="form-control"/></td>
</tr>
<tr>
<td><label>题号:</label></td>
<td>
<?php

$format = '
<input type="text" name="problemId" value="%s" class="form-control"/><br />
';
if($_GET['problemId']){
	printf($format, $_GET['problemId']);
}else{
	printf($format, "");
}
?>
</td>
<tr>
<td><label>作者:</label></td>
<td>
<?php
echo $_SESSION['user'];
?>
</td>
</tr>
</table>
</div>

<div class="container" style="margin-bottom: 30px">
<h4>正文：</h4>
<textarea name="postTxt" style="height:300px;" class="form-control">
</textarea>
</div>
<div style="text-align: right; padding-right: 30px;">
<input type="submit" class="btn-primary" />
</div>
</form>
</div>
</div>
<script type="text/javascript">
    $('#nav-discuss').addClass('active');
</script>
</body>

</html>
