<?php
include '../../private/conn.php';

session_start();

$viewpoint = $_POST['viewpoint'];
$status = 'notplanned';


$picture = "picture/" . basename($_FILES["picture"]["name"]);
//$viewpoint = "viewpoint/" . basename($_FILES["viewpoint"]["name"]);


$target_dir = "../picture/";
//$target_dir2 = "../viewpoint/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
//$target_file2 = $target_dir2 . basename($_FILES["viewpoint"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//$imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    echo $picture . '<br>';
    //echo $viewpoint . '<br>';


    //$check2 = getimagesize($_FILES["viewpoint"]["tmp_name"]);


    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["picture"]["name"])) . " has been uploaded.";


            $userid = $_SESSION['userid'];


            $title = $_POST['title'];
            $description = $_POST['description'];
            $length = $_POST['length'];
            $language = $_POST['language'];
            $genre = $_POST['genre'];

            $stmt = $conn->prepare("INSERT INTO movies  (title,description,length,language,genre,picture,status)
                        VALUES(:title, :description,:length,:language,:genre,:picture,:status)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':length', $length);
            $stmt->bindParam(':language', $language);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':picture', $picture);
            $stmt->bindParam(':status', $status);

            $stmt->execute();

            $moviesid = $conn->lastInsertId();


            echo '<pre>';
            print_r($_POST);
            echo '</pre>';


            $viewpointage = $_POST['viewpointage'];

            $sql = 'SELECT viewpointid FROM viewpoint where viewpoint = :viewpoint ';
            $stmt2 = $conn->prepare($sql);
            $stmt2->bindParam(':viewpoint', $viewpointage);
            $stmt2->execute();
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

            $stmt3 = $conn->prepare("INSERT INTO movieviewpoint(moviesid,viewpointid)
                        VALUES(:moviesid, :viewpointid)");
            $stmt3->bindParam(':moviesid', $moviesid);
            $stmt3->bindParam(':viewpointid', $row2['viewpointid']);
            $stmt3->execute();

            $viewpoint = $_POST['viewpoint'];

            foreach ($viewpoint as $value) {
                $stmt2 = $conn->prepare("INSERT INTO movieviewpoint(moviesid,viewpointid)
                        VALUES(:moviesid, :viewpointid)");
                $stmt2->bindParam(':moviesid', $moviesid);
                $stmt2->bindParam(':viewpointid', $value);
                $stmt2->execute();


            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

    }

    header('location: ../index.php?page=viewfilms');
}
?>