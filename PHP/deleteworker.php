<?php
include '../../private/conn.php';

$userid = $_GET['userid'];

$stmt = $conn->prepare("DELETE FROM user WHERE userid = :userid");
$stmt->bindParam(':userid', $userid);
$stmt->execute();
//header('location: ../index.php?page=workersview');
