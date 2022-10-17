<?php
session_start();
include '../../private/conn.php';

$genre = $_POST['genre'];



$sql = 'SELECT genre FROM genre where genre = :genre ';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':genre', $genre);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() == 0) {


    $stmt = $conn->prepare("INSERT INTO genre  (genre)
                        VALUES(:genre)");
    $stmt->bindParam(':genre', $genre);
    $stmt->execute();
    header('location: ../index.php?page=genre/genreoverview');
} else {

    $_SESSION['melding'] = 'This genre already exists.';
    header('location: ../index.php?page=genre/addgenre ');
}


?>
