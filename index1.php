<!DOCTYPE html>

<?php

session_start();
if(! $_SESSION["user"]){
	header("location:Login.php");
}

?>

<html lang="zh-cn">

<head>

<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/common.css" type="text/css" />
<!-- <style type="text/css">
    td, th {
        padding: 2px;
        text-align: center;
    }
    caption {
        text-align: center;
        font-size: 20px;
    }
</style> -->

<title>在线评测系统</title>

<script type="text/javascript">
function del(){
	if(confirm("确定删除？")){
		return true;
	}
	return false;
}
</script>

</head>

<body>
<?php include('nav1.php') ?>
<div class="jumbotron">
<div class="container">
<h2>
欢迎你，<?php echo $_SESSION["user"]; ?>
</h2>
<div class="container" style="width: 70%;">
<table class="table table-striped" align="center">
<caption>题目列表</caption>
<tr><th>题目编号</th><th>题目名称</th></tr>
<?php
require_once("mysqliconn.php");
$q="SELECT * FROM `Problem`";
$result = $dbConnection->query($q);

$format = '
<tr>
	<td>%s</td>
    <td><a href="ProblemShow.php?problemId=%s">%s</a></td>
</tr>';

while($row=$result->fetch_assoc()) {
	printf($format, $row["problemId"], $row["problemId"], $row["problemTitle"]);
}
$result->close();
$dbConnection->close();
?>

</table>
</div>
</div>
</div>
<script type="text/javascript">
    $('#nav-mainpage').addClass('active');
</script>
</body>

</html>
