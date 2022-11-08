<?php
include '../../private/conn.php';

session_start();

$viewpoint = $_POST['viewpoint'];




            $image = base64_encode(file_get_contents($_FILES['picture']['tmp_name']));

            $userid = $_SESSION['userid'];


            $title = $_POST['title'];
            $description = $_POST['description'];
            $length = $_POST['length'];
            $languageid = $_POST['languageid'];
            $dimensionid = $_POST['dimension'];


            //$status = 'notplanned';

            $stmt = $conn->prepare("INSERT INTO movies  (title,description,length,languageid,dimensionid,picture)
                        VALUES(:title, :description,:length,:languageid,:dimensionid,:picture)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':length', $length);
            $stmt->bindParam(':languageid', $languageid);
            $stmt->bindParam(':picture', $image);
            $stmt->bindParam(':languageid', $languageid);
            $stmt->bindParam(':dimensionid', $dimensionid);
            $stmt->execute();

            $moviesid = $conn->lastInsertId();

            $genreid = $_POST['genreid'];

            foreach ($genreid as $value) {

                $stmt4 = $conn->prepare("INSERT INTO moviesgenre  (moviesid ,genreid)
                        VALUES(:moviesid,:genreid)");
                $stmt4->bindParam(':moviesid', $moviesid);
                $stmt4->bindParam(':genreid', $value);


                $stmt4->execute();
            }



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




    header('location: ../index.php?page=viewfilms');

?>