<!DOCTYPE html>
<?php


session_start();
if(! $_SESSION["user"] && ! $_SESSION["admin"]) {
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
<?php


$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
mysql_select_db('OJ',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式


$q="select * from `Post` where postId=".$_GET['postId'];
$result=mysql_query($q);
$row=mysql_fetch_array($result);
$format = '
<h2>%s. %s</h2>
<table>
<tr><td>题号: </td><td>%s</td>
<tr><td>作者:</td><td>%s</td>
</table>
<div class="well"><p>
%s
</p></div>

';

printf($format,$row["postId"], $row["postTitle"], $row["problemId"],$row["userId"], $row["postTxt"] );


?>
</div>
</div>
<script type="text/javascript">
    $('#nav-discuss').addClass('active');
</script>
</body>

</html>
