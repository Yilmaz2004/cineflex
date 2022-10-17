<?php
session_start();
include '../../private/conn.php';

$genreid = $_POST['genreid'];
$genre = $_POST['genre'];



$stmt = $conn->prepare("UPDATE genre  SET genre = :genre  WHERE   genreid = :genreid ");
$stmt->bindParam(':genre', $genre);
$stmt->bindParam(':genreid', $genreid);


$stmt->execute();
header('location: ../index.php?page=genre/genreoverview');
?>