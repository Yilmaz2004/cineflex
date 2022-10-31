<?php
include '../private/conn.php';
include 'PHP/oop.php';


$moviesid = $_GET['moviesid'];

//$sql = "SELECT m.picture, m.title, m.description, m.length, l.language, l.languageid,d.dimensionid,d.dimension
//        FROM movies m
//        LEFT JOIN language l on l.languageid = m.languageid
//        LEFT JOIN dimension d on d.dimension = m.dimensionid
//
//where m.moviesid = :moviesid";
//
//$stmt = $conn->prepare($sql);
//$stmt->bindParam(':moviesid', $moviesid);
//$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT viewpointid
        FROM movieviewpoint 
where moviesid = :moviesid";
$stmt2 = $conn->prepare($sql);
$stmt2->bindParam(':moviesid', $moviesid);
$stmt2->execute();
$result = $stmt2->fetchAll();

$sql = "SELECT genreid
        FROM moviesgenre 
where moviesid = :moviesid";
$stmt3 = $conn->prepare($sql);
$stmt3->bindParam(':moviesid', $moviesid);
$stmt3->execute();
$result2 = $stmt3->fetchAll();
?>



<table class="table">
    <thead>
    <tr>
        <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=viewfilms'">
            Back
        </button>
        <th scope="col">Picture</th>
        <th scope="col">Titel</th>
        <th scope="col">Dimension</th>
        <th scope="col">Description</th>
        <th scope="col">Length</th>
        <th scope="col">Language</th>
        <th scope="col">Genres</th>



    </tr>
    </thead>
    <?php

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


        $movie = new movies($id = $_GET['moviesid']);

        ?>
            <tbody>
            <tr>
                <td><img src="data:image/png;base64,<?= $row['picture'] ?>" width="200px" height="200px"></td>
                <td><?= $movie->get_title() ?></td>
                <td><?= $movie->get_dimension() ?></td>
                <td><textarea class="form-control"  disabled aria-label="With textarea" > <?= $movie->get_description() ?></textarea></td>
                <td><?= $movie->get_length() ?> Hours</td>
                <td><?= $movie->get_language() ?></td>
                <td>
                <?php
                foreach ($result2 as $value){
                    $sql = "SELECT genre
                            FROM genre 
                            where genreid = :genreid";
                $stmt4 = $conn->prepare($sql);
                $stmt4->bindParam(':genreid', $value['genreid']);
                $stmt4->execute();
                    $row4 = $stmt4->fetch(PDO::FETCH_ASSOC)
                ?>
                    <?= $row4["genre"] ?> <?=  '<br/>'?>
                <?php }?>
            </td>

            </tr>
            </tbody>
        <?php } ?>
</table>
<?php
foreach ($result as $value) {
    $sql = "SELECT viewpoint
        FROM viewpoint 
where viewpointid = :viewpointid";
    $stmt3 = $conn->prepare($sql);
    $stmt3->bindParam(':viewpointid', $value['viewpointid']);
    $stmt3->execute();


while  ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {?>
    <img  class="picture" src="<?= $row3["viewpoint"] ?>" width="200px" height="200px">

<?php }}?>




