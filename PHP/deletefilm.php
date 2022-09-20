<?php

include '../../private/conn.php';

$moviesid = $_GET['moviesid'];


$stmt = $conn->prepare("DELETE FROM movies WHERE moviesid = :moviesid");
$stmt->bindParam(':moviesid', $moviesid);
$stmt->execute();
header('location: ../index.php?page=viewfilms');
?>