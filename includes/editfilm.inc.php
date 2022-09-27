<?php
$moviesid = $_GET['moviesid'];

$sql = "SELECT title, description, language, genre, picture FROM movies
        WHERE moviesid = :moviesid ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':moviesid', $moviesid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT viewpointid
        FROM movieviewpoint 
where moviesid = :moviesid";
$stmttest = $conn->prepare($sql);
$stmttest->bindParam(':moviesid', $moviesid);
$stmttest->execute();
$result = $stmttest->fetchAll();
?>
<body>
<div class="container mt-3">
    <h2>Edit film</h2>
    <form action="php/editfilm.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Title:</label>
            <input type="text" class="form-control" placeholder="Enter name" value="<?= $row['title'] ?>" name="title">
        </div>
        <div class="input-group">
            <span class="input-group-text">description</span>
            <textarea class="form-control" aria-label="With textarea"></textarea>
        </div>

        <div class="mb-3 mt-3">
            <label>Language:</label>
            <input type="text" class="form-control" placeholder="Enter password" value="<?= $row['language'] ?>"
                   name="language">
        </div>
        <div class="mb-3 mt-3">
            <label>Genre:</label>
            <input type="text" class="form-control" placeholder="Enter name" value="<?= $row['genre'] ?>" name="genre">
        </div>

        <div class="mb-3 mt-3">
            <label>Picture:</label>
            <input type="file" class="form-control" placeholder="Enter password" value="<?= $row['picture'] ?>"
                   name="picture">
        </div>

        <?php

        $sql = "SELECT viewpointid
        FROM movieviewpoint 
        where moviesid = :moviesid";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bindParam(':moviesid', $moviesid);
        $stmt2->execute();
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            ?>

            <label class="container">
                <input type="radio" name="viewpointage" value="<?= $row2["viewpoint"] ?>" >
                <span class="checkmark"></span>
                <img  class="picture" src="<?= $row2["viewpoint"] ?>" width="200px" height="200px">
            </label>

        <?php }

//        $sql = "SELECT viewpointid FROM movieviewpoint where moviesid = :moviesid";
//        $stmt3 = $conn->prepare($sql);
//        $stmt3->bindParam(':moviesid', $moviesid);
//        $stmt3->execute();
//        $result = $stmt3->fetchAll();
//
//
//foreach ($result as $value) {
//    $sql = "SELECT viewpoint FROM viewpoint where viewpointid = :viewpointid and type != 'age'";
//    $stmt4 = $conn->prepare($sql);
//    $stmt4->bindParam(':viewpointid', $value['viewpointid']);
//    $stmt4->execute();
//
//        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {?>
<!---->
<!--            <label class="container" >-->
<!--                <input type="checkbox" name="viewpoint[]" value="--><?//= $row4["viewpoint"] ?><!--">-->
<!--                <span class="checkmark"></span>-->
<!--                <img  class="picture" src="--><?//= $row4["viewpoint"] ?><!--" width="200px" height="200px">-->
<!--            </label>-->
<!---->
<!--        --><?php //}}?>


        <input type="hidden" name="moviesid" value="<?= $moviesid ?>">
        <button name="submit" type="submit" class="btn btn-success">Save changes</button>
    </form>
</div>
</body>