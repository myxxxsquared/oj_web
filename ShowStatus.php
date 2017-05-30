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
<h2> 状态列表 </h2>
<p>
欢迎你，<?php echo $_SESSION["user"]; ?>
</p>

<div class="container" style="margin-top: 20px;">
<table class="table table-striped">
<tr><th>提交号</th><th>题目号</th><th>用户</th><th>提交时间</th><th>结果</th><th>运行时间 (ms)</th><th>内存用量 (Byte)</th></tr>
<?php
$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
//连接数据库
mysql_select_db('OJ',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式

$q="select * from Submit order by submitId desc";//设置查询指令
$result=mysql_query($q);//执行查询
$myiiiii = 0;

while($row=mysql_fetch_assoc($result))//将result结果集中查询结果取出一条
{
    $myiiiii = $myiiiii + 1;
    if($myiiiii > 30)
    {
        break;
    }
	$format = '<tr>
	<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>
	</tr>';

	printf($format, $row["submitId"], $row["problemId"], $row["userId"], $row["submitTime"], $row["result"], $row["runTime"], $row["memUsed"]);
}
?>

</table>
</div>
</div>
</div>
<script type="text/javascript">
    $('#nav-status').addClass('active');
</script>
</body>

</html>
