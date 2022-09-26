<?php
include '../private/conn.php';

$moviesid = $_GET['moviesid'];

$sql = "SELECT *
        FROM movies where moviesid = :moviesid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':moviesid', $moviesid);
$stmt->execute();

$sql = "SELECT viewpointid
        FROM movieviewpoint 
where moviesid = :moviesid";
$stmt2 = $conn->prepare($sql);
$stmt2->bindParam(':moviesid', $moviesid);
$stmt2->execute();
$result = $stmt2->fetchAll();



?>
<table class="table">
    <thead>
    <tr>
        <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=viewfilms'">
            Back
        </button>
        <th scope="col">Picture</th>
        <th scope="col">Titel</th>
        <th scope="col">Description</th>
        <th scope="col">Length</th>
        <th scope="col">Language</th>
        <th scope="col">Genre</th>



    </tr>
    </thead>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tbody>
            <tr>
                <td><img class="picture" src="<?= $row["picture"] ?>" width="200px" height="200px"></td>
                <td><?= $row["title"] ?></td>
                <td><?= $row["description"] ?></td>
                <td><?= $row["length"] ?> Minutes</td>
                <td><?= $row["language"] ?></td>
                <td><?= $row["genre"] ?></td>


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




