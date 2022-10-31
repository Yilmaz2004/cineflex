<?php
session_start();
include '../../private/conn.php';

$moviesid = $_GET['moviesid'];

try{
    $stmt = $conn->prepare("DELETE FROM movies WHERE moviesid = :moviesid");
    $stmt->bindParam(':moviesid', $moviesid);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM moviesgenre WHERE moviesid = :moviesid");
    $stmt->bindParam(':moviesid', $moviesid);
    $stmt->execute();
    header('location: ../index.php?page=viewfilms');
}catch (Exception $e){
   $_SESSION['melding'] = 'Movie is already planned';
    header('location: ../index.php?page=viewfilms');

}



?>