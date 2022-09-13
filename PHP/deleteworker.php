<?php
include '../../private/conn.php';

$userid = $_GET['userid'];

$stmt = $conn->prepare("DELETE FROM user WHERE userid = :id");
$stmt->bindParam(':id', $userid);
$stmt->execute();

header('location: ../index.php?page=workersview');
