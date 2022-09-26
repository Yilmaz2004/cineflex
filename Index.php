<?php
session_start();
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else{
    $page='homepage';
}
?>


<!doctype html>     
<html lang="en">
<head>
    <title>CineFlex</title>
    <meta charset="utf-8">




</head>
<body>
<?php include 'includes/navbar.inc.php'; ?>
<?php include 'includes/'.$page.'.inc.php'; ?>


</body>
</html>