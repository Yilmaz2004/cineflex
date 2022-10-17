<?php
$moviesid = $_GET['moviesid'];

$sql = "SELECT m.title, m.description, m.languageid, m.picture, l.language
FROM movies m
LEFT JOIN language l ON m.languageid = l.languageid
        WHERE moviesid = :moviesid ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':moviesid', $moviesid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM language ";
$stmttest = $conn->prepare($sql);
$stmttest->execute();


$sql = "SELECT viewpointid, viewpoint FROM viewpoint where type = 'age'";
$stmt2 = $conn->prepare($sql);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

$movieviewpointids = array();

$sql = "SELECT movieviewpointid, viewpointid, moviesid FROM movieviewpoint where moviesid = :moviesid";
$stmt4 = $conn->prepare($sql);
$stmt4->bindParam(':moviesid', $moviesid);
$stmt4->execute();
while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
    array_push($movieviewpointids,$row4['viewpointid']);
}


$sql = "SELECT movieviewpointid, viewpointid, moviesid FROM movieviewpoint where moviesid = :moviesid";
$stmt5 = $conn->prepare($sql);
$stmt5->bindParam(':moviesid', $moviesid);
$stmt5->execute();
$row5 = $stmt5->fetch(PDO::FETCH_ASSOC);

$genreids = array();

$sql = "SELECT * FROM moviesgenre where moviesid = :moviesid";
$stmttest1 = $conn->prepare($sql);
$stmttest1->bindParam(':moviesid', $moviesid);
$stmttest1->execute();

while ($rowtest1 = $stmttest1->fetch(PDO::FETCH_ASSOC)) {
    array_push($genreids,$rowtest1['genreid']);
}
?>

<body>

<h2>Edit film</h2>
<form action="php/editfilm.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
        <label>Title:</label>
        <input type="text" class="form-control" placeholder="Enter Title" value="<?= $row['title'] ?>" name="title">
    </div>

    <div class="input-group">
        <span class="input-group-text">description</span>
        <textarea class="form-control" name="description" aria-label="With textarea" > <?= $row['description'] ?></textarea>
    </div>
    <div class="mb-3 mt-3">
        <label>Language:</label>
        <select class="form-control"  class="form-select" name="languageid">
            <option value="<?= $row["languageid"] ?>"><?= $row["language"] ?></option>
            <?php while ($rowtest = $stmttest->fetch(PDO::FETCH_ASSOC)) {
                if($rowtest["languageid"] != $row["languageid"]){ ?>
                    <option  value="<?= $rowtest["languageid"] ?>"><?= $rowtest["language"] ?></option>
                <?php } }  ?>
        </select>


    </div>
    <label>Genres:</label>
    <?php
    $sql = "SELECT * FROM genre";
    $stmt6 = $conn->prepare($sql);
    $stmt6->execute();


    while ($row6 = $stmt6->fetch(PDO::FETCH_ASSOC)) {?>

        <label>

            <input type="checkbox" name="genreid[]" value="<?= $row6["genreid"] ?>" <?php if(in_array($row6["genreid"], $genreids)){ ?> checked="checked" <?php } ?>><?= $row6["genre"]?>
            <span class="checkmark"></span>

        </label>

    <?php }?>

    <div class="mb-3 mt-3">
        <label>Picture:</label>
        <input type="file" class="form-control"  value="<?= $row['picture'] ?>" name="picture" >
    </div>
    <label >

        <input type="radio" name="viewpointage" value="<?= $row2["viewpointid"] ?>" <?php if($row2["viewpointid"] == $row5["viewpointid"]){ ?> checked="checked" <?php } ?>>

        <img  class="picture" src="<?= $row2["viewpoint"] ?>" width="150px" height="150px">
    </label>

    <?php while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {?>

        <label>
            <input type="radio" name="viewpointage" value="<?= $row2["viewpointid"] ?>" <?php if($row2["viewpointid"] == $row5["viewpointid"]){ ?> checked="checked" <?php } ?> >
            <span class="checkmark"></span>
            <img  class="picture" src="<?= $row2["viewpoint"] ?>" width="150px" height="150px">
        </label>

    <?php }?>
    <?php
    $sql = "SELECT * FROM viewpoint where type != 'age'";
    $stmt3 = $conn->prepare($sql);
    $stmt3->execute();
    while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
    {?>

        <label>
            <input type="checkbox" name="viewpointid[]" value="<?= $row3["viewpointid"] ?>" <?php if(in_array($row3["viewpointid"], $movieviewpointids)){ ?> checked="checked" <?php } ?>>



            <img  class="picture" src="<?= $row3["viewpoint"] ?>" width="150px" height="150px">
        </label>

    <?php }?>




    <input type="hidden" name="moviesid" value="<?= $moviesid ?>">
    <button name="submit" type="submit" class="btn btn-success">Save changes</button>
</form>

</body>