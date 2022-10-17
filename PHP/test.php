<?php

include '../../private/conn.php';

//$picture = $_POST['picture'];
//$_FILES['picture']['name'] = $picture;
$languageid = 4;

$image = base64_encode(file_get_contents($_FILES['picture']['tmp_name']));

$stmt = $conn->prepare("INSERT INTO movies  (picture,languageid )
                        VALUES(:picture,:languageid)");
$stmt->bindParam(':picture', $image);
$stmt->bindParam(':languageid', $languageid);
$stmt->execute();


