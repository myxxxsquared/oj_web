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
<link rel="stylesheet" href="css/common.css" type="text/css" />
<title>在线评测系统</title>

<!-- <style type="text/css">
    td {
        padding: 6px;
        padding-left: 20px;
        padding-right: 20px;
    }
    .btn-primary {
        margin: 5px;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .jumbotron {
        margin-top: 30px;
    }
</style> -->
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


<?php

require_once("mysqliconn.php");
$stmt = $dbConnection->prepare("select COUNT(*) as c from `Submit` where problemId= ?");
$stmt->bind_param('d', $_GET['problemId']);
$stmt->execute();
$result = $stmt->get_result();
$row=$result->fetch_assoc($result);
$num1 =  $row['c'];
$stmt->close();

$stmt = $dbConnection->prepare("select COUNT(*) as c from `Submit` where problemId= ? and result='Accepted'");
$stmt->bind_param('d', $_GET['problemId']);
$stmt->execute();
$result = $stmt->get_result();
$row=$result->fetch_assoc($result);
$num2 = $row['c'];
$stmt->close();

$stmt = $dbConnection->prepare("select * from `Problem` where problemId = ?");
$stmt->bind_param('d', $_GET['problemId']);
$stmt->execute();
$result = $stmt->get_result();
$row=$result->fetch_assoc($result);

$format = '
<h2 align="center">%s. %s</h2>
<div align="center" id="href-div"><a href="PostList.php?problemId=%s">前往本题讨论板</a>&nbsp;&nbsp;</div>
<table class="table-striped">
<tr>
    <td>提交次数: </td>
    <td>%s</td>
</tr>
<tr>
    <td>通过次数: </td>
    <td>%s</td>
</tr>
<tr>
    <td>时间限制：</td>
    <td>%s s</td>
</tr>
<tr>
    <td>内存限制：</td>
    <td>%s MB</td>
</tr>
</table>
<h4>题目描述：</h4>
<div class="well">
<p>%s</p>
</div>

';

printf($format, $row["problemId"], $row["problemTitle"], $_GET['problemId'], $num1, $num2,$row["timeLimit"],$row["memLimit"], $row["problemTxt"]);


$format = '
<form action="SubmitAdd.php" method="post" enctype="multipart/form-data">
<h4>提交代码：</h4>
<input type="hidden" name="problemId" value="%s"/>
<input type="hidden" name="userId" value="%s" />
<input type="file" name="submitCode" />
<input type="submit" class="btn-primary" />
</form>
';

if($_SESSION['user']){
	printf($format, $_GET['problemId'], $_SESSION['user']);
}

?>
</div>
</div>

<?php
if ($_SESSION['admin']) {
    echo ('
<script>
    $(\'<a href="ProblemEdit.php?problemId=' . $row["problemId"]. '"">编辑</a>\').appendTo("#href-div");
</script>
          ');
}
?>


</body>

</html>
