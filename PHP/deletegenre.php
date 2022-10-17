<?php
include '../../private/conn.php';

$genreid = $_GET['genreid'];

$stmt = $conn->prepare("DELETE FROM genre WHERE genreid = :genreid");
$stmt->bindParam(':genreid', $genreid);
$stmt->execute();
header('location: ../index.php?page=genre/genreoverview');
