<?php

session_start();
$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
    mysql_select_db('OJ',$link);//选择数据库
    mysql_query("set names utf8");//设置编码格式

$q=sprintf("select `userId` from `Submit` where `submitId` = '%s';", $_GET["submitId"]);

$result = mysql_query($q);
$userId = mysql_result($result, 0);

?>

<pre>
<?php
if ($_SESSION['admin'] || ($userId == $_SESSION['user'])) {
    echo(htmlspecialchars(file_get_contents('dat/submissions/' . $_GET["submitId"] . "/src.cpp")));
} else {
    echo("<script>alert('Access denied!');</script>");
}
?>
</pre>
