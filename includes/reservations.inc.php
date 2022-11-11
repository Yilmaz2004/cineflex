<?php
include '../private/conn.php';

$userid = $_SESSION['userid'];
$sql = "SELECT *
        FROM userreserved 
where userid = :userid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userid', $userid);
$stmt->execute();
$row = $stmt->fetch();
//echo '<pre>'; print_r($row); echo '</pre>';
?>

<table class="table">
    <thead>
    <tr>

        <th scope="col">Picture</th>
        <th scope="col">Titel</th>
        <th scope="col">Seats</th>



    </tr>
    </thead>
    <?php



        $sql = "SELECT *
        FROM movies 
where moviesid = :moviesid ORDER BY moviesid";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bindParam(':moviesid', $row['moviesid']);
        $stmt2->execute();

        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {  ?>
            <tbody>
            <tr>
                <td><img src="data:image/png;base64,<?=$row2['picture'] ?>" width="200px" height="200px"></td>
                <td><?= $row2['title']; }?></td>




        <?php
        $sql = "SELECT *
        FROM userreserved 
where userid = :userid";
        $stmt3 = $conn->prepare($sql);
        $stmt3->bindParam(':userid', $userid);
        $stmt3->execute();
        $row3 = $stmt3->fetchAll();

     ?>


        </tr>
        </tbody>

</table>






