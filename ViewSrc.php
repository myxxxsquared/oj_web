<?php

session_start();

require_once("mysqliconn.php");
$stmt = $dbConnection->prepare("select `userId` from `Submit` where `submitId` = ?");
$stmt->bind_param('d', $_GET["submitId"]);
$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc())
{
    $userId = $row['userId'];
}else{
    echo("<script>alert('No such problem.');</script>");
}

?>

<pre>
<?php
if ($_SESSION['admin'] || ($userId == $_SESSION['user'])) {
    echo(htmlspecialchars(file_get_contents('dat/submissions/' . $_GET["submitId"] . "/src.cpp")));
} else {
    echo("<script>alert('Access denied!');</script>");
}
$stmt->close();
$dbConnection->close();
?>
</pre>
