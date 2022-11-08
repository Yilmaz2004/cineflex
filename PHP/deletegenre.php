<?php
session_start();
include '../../private/conn.php';

$genreid = $_GET['genreid'];
try {
    $stmt = $conn->prepare("DELETE FROM genre WHERE genreid = :genreid");
    $stmt->bindParam(':genreid', $genreid);
    $stmt->execute();

}catch (Exception $e){
    $_SESSION['melding'] = 'Genre is linked to a movie ';
    header('location: ../index.php?page=genreoverview');

}

header('location: ../index.php?page=genre/genreoverview');
