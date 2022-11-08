<?php
session_start();
include '../../private/conn.php';

$languageid= $_GET['languageid'];
try {
    $stmt = $conn->prepare("DELETE  FROM language WHERE languageid = :languageid");
    $stmt->bindParam(':languageid', $languageid);
    $stmt->execute();

}catch (Exception $e){
    $_SESSION['melding'] = 'language is linked to a movie ';
    header('location: ../index.php?page=language/languageoverview');

}

header('location: ../index.php?page=language/languageoverview');
