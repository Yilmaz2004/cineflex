<?php
session_start();
include '../../private/conn.php';

$title = $_POST['title'];
$description = $_POST['description'];
$length = $_POST['length'];
$language = $_POST['language'];
$genre = $_POST['genre'];
$viewpoint = $_POST['viewpoint'];
$picture = $_POST['picture'];



$stmt = $conn->prepare("UPDATE movies  SET title = :title, description = :description, length = :length, language = :language, genre = :genre, viewpoint = :viewpoint, picture = :picture WHERE   moviesid = :moviesid ");
$stmt->bindParam(':title', $title );
$stmt->bindParam(':description', $description );
$stmt->bindParam(':length', $length );
$stmt->bindParam(':language', $language);
$stmt->bindParam(':genre', $genre );
$stmt->bindParam(':viewpoint', $viewpoint );
$stmt->bindParam(':picture', $picture);

$stmt->execute();
header('location: ../index.php?page=viewfilms');
?><?php
