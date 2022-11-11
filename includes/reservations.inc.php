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
    if ($stmt->rowCount() > 0) {


        $sql = "SELECT *
        FROM movies 
where moviesid = :moviesid";
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
        $stmt2 = $conn->prepare($sql);
        $stmt2->bindParam(':userid', $userid);
        $stmt2->execute();
        $row2 = $stmt2->fetchAll();

     ?>

            <td> <?php  foreach ($row2 as $value){ echo $value['seats']; }  ?></td>

        </tr>
        </tbody>

</table>






<?php  }?>