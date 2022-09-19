<?php
include '../private/conn.php';
$userid = $_SESSION['userid'];
$sql = "SELECT firstname
        FROM user
        WHERE userid = $userid";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC)
?>

<div class="topnav">
    <a class="nav-link active" href=index.php?page=homepage>Homepage</a>
    <a class="nav-link active" href=index.php?page=>Planning</a>
    <?php if (isset($_SESSION['userid'])){?>



        <?php if($_SESSION['role'] == 'admin') {?>
            <a class="nav-link active" href=index.php?page=workersview>Worker Overview</a>

            <a href="php/logout.php" style="float:right">Log uit</a>
        <?php }
        if ($_SESSION['role'] == 'worker') {?>
            <a class="nav-link active" href=index.php?page=viewfilms>Film Overview</a>
            <a href="php/logout.php" style="float:right">Log uit</a>
        <?php }
        elseif ($_SESSION['role'] == 'customer') {?>
            <a href="index.php?page=profile" style="float:right">Welkom <?=$row['firstname']?></a>
            <a href="php/logout.php" style="float:right">Log uit</a>
        <?php }}
    else {?>

        <a  href=index.php?page=login style="float:right">Log in</a>
    <?php }?>

</div>


