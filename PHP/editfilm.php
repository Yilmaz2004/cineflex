<?php
session_start();
include '../../private/conn.php';

$moviesid = $_POST['moviesid'];

$title = $_POST['title'];
$description = $_POST['description'];
$language = $_POST['language'];
$genre = $_POST['genre'];



$picture = "picture/" . basename($_FILES["picture"]["name"]);



$target_dir = "../picture/";

$target_file = $target_dir . basename($_FILES["picture"]["name"]);


$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    echo $picture . '<br>';


    $check = getimagesize($_FILES["picture"]["tmp_name"]);


    if ($check !== false ) {
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


            $stmt = $conn->prepare("UPDATE movies  SET title = :title, description = :description, language = :language, genre = :genre, picture = :picture WHERE moviesid = :moviesid ");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':language', $language);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':picture', $picture);
            $stmt->bindParam(':moviesid', $moviesid);
            $stmt->execute();

            $viewpointage = $_POST['viewpointage'];

echo $viewpointage;

            $stmt3 = $conn->prepare("UPDATE movieviewpoint  SET viewpointid = :viewpointid WHERE moviesid = :moviesid AND viewpointid <= 7  ");
            $stmt3->bindParam(':viewpointid', $viewpointage);
            $stmt3->bindParam(':moviesid', $moviesid);
            $stmt3->execute();




            $stmt = $conn->prepare("DELETE FROM movieviewpoint WHERE moviesid =:moviesid AND viewpointid >= 8  ");
            $stmt->bindParam(':moviesid', $moviesid);
            $stmt->execute();
            header('location: ../index.php?page=viewfilms');

            $viewpoint = $_POST['viewpointid'];
            echo '<pre>', print_r($_POST['viewpointid']), '</pre>';


            foreach ($viewpoint as $value) {
                $stmt4 = $conn->prepare("INSERT INTO movieviewpoint(moviesid,viewpointid)
                        VALUES(:moviesid, :viewpointid)");
                $stmt4->bindParam(':viewpointid', $value);
                $stmt4->bindParam(':moviesid', $moviesid);
                $stmt4->execute();

            }


        }
        else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


//header('location: ../index.php?page=viewfilms');
?><?php
