<?php
session_start();
include '../../private/conn.php';

$languageid = $_POST['languageid'];
$language = $_POST['language'];



$stmt = $conn->prepare("UPDATE language  SET language = :language  WHERE   languageid = :languageid ");
$stmt->bindParam(':language', $language);
$stmt->bindParam(':languageid', $languageid);


$stmt->execute();
header('location: ../index.php?page=language/languageoverview');
?>