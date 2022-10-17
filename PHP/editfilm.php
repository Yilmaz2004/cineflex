<?php
session_start();
include '../../private/conn.php';

$moviesid = $_POST['moviesid'];



$title = $_POST['title'];
$description = $_POST['description'];
$languageid = $_POST['languageid'];



$sql = 'SELECT *  FROM movies where moviesid = :moviesid ';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':moviesid', $moviesid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);



if ($_FILES['picture']['tmp_name'] != null){
    $image = base64_encode(file_get_contents($_FILES['picture']['tmp_name']));
    $stmt = $conn->prepare("UPDATE movies  SET title = :title, description = :description, languageid = :languageid , picture = :picture WHERE moviesid = :moviesid ");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':languageid', $languageid);
    $stmt->bindParam(':picture', $image);
    $stmt->bindParam(':moviesid', $moviesid);
    $stmt->execute();

}
else{
    $stmt = $conn->prepare("UPDATE movies  SET title = :title, description = :description, languageid = :languageid, picture = :picture WHERE moviesid = :moviesid ");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':languageid', $languageid);
    $stmt->bindParam(':picture', $row['picture']);
    $stmt->bindParam(':moviesid', $moviesid);
    $stmt->execute();

}



            $viewpointage = $_POST['viewpointage'];

echo $viewpointage;

            $stmt3 = $conn->prepare("UPDATE movieviewpoint  SET viewpointid = :viewpointid WHERE moviesid = :moviesid AND viewpointid <= 7  ");
            $stmt3->bindParam(':viewpointid', $viewpointage);
            $stmt3->bindParam(':moviesid', $moviesid);
            $stmt3->execute();




            $stmt = $conn->prepare("DELETE FROM movieviewpoint WHERE moviesid =:moviesid AND viewpointid >= 8  ");
            $stmt->bindParam(':moviesid', $moviesid);
            $stmt->execute();


            $viewpoint = $_POST['viewpointid'];
//            echo '<pre>', print_r($_POST['viewpointid']), '</pre>';


            foreach ($viewpoint as $value) {
                $stmt4 = $conn->prepare("INSERT INTO movieviewpoint(moviesid,viewpointid)
                        VALUES(:moviesid, :viewpointid)");
                $stmt4->bindParam(':viewpointid', $value);
                $stmt4->bindParam(':moviesid', $moviesid);
                $stmt4->execute();

            }


            $stmt = $conn->prepare("DELETE FROM moviesgenre WHERE moviesid =:moviesid ");
            $stmt->bindParam(':moviesid', $moviesid);
            $stmt->execute();

            $genreid = $_POST['genreid'];

            echo '<pre>', print_r($_POST['genreid']), '</pre>';

            foreach ($genreid as $value1) {
                $stmt4 = $conn->prepare("INSERT INTO moviesgenre(moviesid,genreid)
                        VALUES(:moviesid, :genreid)");
                $stmt4->bindParam(':moviesid', $moviesid);
                $stmt4->bindParam(':genreid', $value1);

                $stmt4->execute();

            }




header('location: ../index.php?page=viewfilms');
?>
