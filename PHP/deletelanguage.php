<?php
include '../../private/conn.php';

$languageid = $_GET['languageid'];

$stmt = $conn->prepare("DELETE FROM language WHERE languageid = :languageid");
$stmt->bindParam(':languageid', $languageid);
$stmt->execute();
header('location: ../index.php?page=language/languageoverview');
?>
