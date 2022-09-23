<?php
session_start();
include '../../private/conn.php';

$moviesid = $_POST['moviesid'];

$title = $_POST['title'];
$description = $_POST['description'];
$language = $_POST['language'];
$genre = $_POST['genre'];
$viewpoint = $_POST['viewpoint'];
$picture = $_POST['picture'];


$picture = "picture/" . basename($_FILES["picture"]["name"]);
$viewpoint = "viewpoint/" . basename($_FILES["viewpoint"]["name"]);


$target_dir = "../picture/";
$target_dir2 = "../viewpoint/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$target_file2 = $target_dir2 . basename($_FILES["viewpoint"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    echo $picture . '<br>';
    echo $viewpoint . '<br>';

    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    $check2 = getimagesize($_FILES["viewpoint"]["tmp_name"]);

    if ($check !== false || $check2 !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["picture"]["name"])) . " has been uploaded.";
            $stmt = $conn->prepare("UPDATE movies  SET title = :title, description = :description, language = :language, genre = :genre, viewpoint = :viewpoint, picture = :picture WHERE moviesid = :moviesid ");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':language', $language);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':viewpoint', $viewpoint);
            $stmt->bindParam(':picture', $picture);
            $stmt->bindParam(':moviesid', $moviesid);


            $stmt->execute();

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


header('location: ../index.php?page=viewfilms');
?><?php
