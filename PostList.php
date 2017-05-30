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
<!-- <style type="text/css">
	label {
		font-size: 18px;
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
<?php
if (! $_SESSION["admin"]) {
    include('nav1.php');
} else {
    include('nav2.php');
}
?>
<div class="jumbotron">
<div class="container">
		<h2> 讨论板 </h2>

<div class="container" style="margin: 30px;">
	<form action="PostList.php" method="GET">
		<div class="row">
		<div class="col-md-1" style="text-align: right; vertical-align: middle;"><label>题号：</label></div>
		<div class="col-md-3"><input type="text" name="problemId" value="" class="form-control" /></div>
		<div class="col-md-1"><input type="submit" value="查询"/></div>
		<div class="col-md-7">
<?php
if($_GET['problemId'] && $_GET['problemId']!="") {
	printf('<a href="PostAdd.php?problemId=%s">发布新讨论</a>', $_GET['problemId'] );
}else{
	echo '<a href="PostAdd.php">发布新讨论</a>';
}
?>
		</div>
		</div>
	</form>
</div>

<div class="container" style="width: 90%;">
<table class="table table-striped">
<tr><th>编号</th><th>标题</th><th>作者</th></tr>
<?php
$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
//连接数据库
mysql_select_db('OJ',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式

$q="select * from `Post`";//设置查询指令

if($_GET['problemId'] && $_GET['problemId']!=""){
	$q= sprintf("select * from `Post` WHERE `problemId` = '%s'", $_GET['problemId']);
}



$result=mysql_query($q);//执行查询
while($row=mysql_fetch_assoc($result))//将result结果集中查询结果取出一条
{
	$format = '
	<tr>
	<td>%s</td>
	<td><a href="PostShow.php?postId=%s">%s</a></td>
	<td>%s</td>
	</tr>
	';

	printf($format, $row["postId"], $row["postId"],  $row["postTitle"],  $row["userId"] );
}
?>

</table>
</div>

</div>
</div>
<script type="text/javascript">
    $('#nav-discuss').addClass('active');
</script>
</body>

</html>
