<?php
include '../private/conn.php';
?>

<div class="topnav">
    <a class="nav-link active" href=index.php?page=homepage>Homepage</a>
    <a class="nav-link active" href=index.php?page=planning>Planning</a>
    <?php if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $sql = "SELECT firstname
        FROM user
        WHERE userid = $userid";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($_SESSION['role'] == 'admin') {
            $sql = "SELECT userid
            FROM user
            WHERE userid = $userid";
            $stmt2 = $conn->prepare($sql);
            $stmt2->execute();
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC); ?>
            <a class="nav-link active" href=index.php?page=workersview>Worker Overview</a>
            <a style="float:right;color: white">Welkom <?= $row['firstname'] ?></a>
            <a onclick="window.location.href='index.php?page=profile&userid=<?= $row2["userid"] ?>'"
               style=" float:right;color: white">Profile</a>
            <a href="php/logout.php" style="float:right">Log uit</a>
        <?php }
        if ($_SESSION['role'] == 'worker') {
            $sql = "SELECT userid
            FROM user
            WHERE userid = $userid";
            $stmt2 = $conn->prepare($sql);
            $stmt2->execute();
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC); ?>
            <a class="nav-link active" href=index.php?page=viewfilms>Film Overview</a>
            <a style="float:right;color: white">Welkom <?= $row['firstname'] ?></a>
            <a onclick="window.location.href='index.php?page=profile&userid=<?= $row2["userid"] ?>'"
               style=" float:right;color: white">Profile</a>
            <a href="php/logout.php" style="float:right">Log uit</a>
        <?php } elseif ($_SESSION['role'] == 'customer') {
            $sql = "SELECT userid
            FROM user
            WHERE userid = $userid";
            $stmt2 = $conn->prepare($sql);
            $stmt2->execute();
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC); ?>
            <a style="float:right;color: white">Welkom <?= $row['firstname'] ?></a>
            <a onclick="window.location.href='index.php?page=profile&userid=<?= $row2["userid"] ?>'"
               style=" float:right;color: white">Profile</a>
            <a href="php/logout.php" style="float:right">Log uit</a>
        <?php }
    } else { ?>
        <a href=index.php?page=login style="float:right">Log in</a>
    <?php } ?>
</div>