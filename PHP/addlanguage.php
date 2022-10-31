<?php
session_start();
include '../../private/conn.php';

$language = $_POST['language'];



$sql = 'SELECT language FROM language where language = :language ';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':language', $language);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() == 0) {


    $stmt = $conn->prepare("INSERT INTO language  (language)
                        VALUES(:language)");
    $stmt->bindParam(':language', $language);
    $stmt->execute();
    header('location: ../index.php?page=language/languageoverview');
} else {

    $_SESSION['notification'] = 'This language already exists.';
    header('location: ../index.php?page=language/addlanguage ');
}


?>
<?php
