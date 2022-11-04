<?php


$sql = "SELECT * FROM viewpoint where type = 'age'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<body>

<h2>Add a film</h2>
<form action="php/addfilm.php" method="POST" enctype="multipart/form-data">


    <div class="mb-3 mt-3">
        <label>Picture:</label>
        <input type="file" class="form-control" placeholder="Naam" name="picture">
    </div>


    <div class="mb-3 mt-3">
        <label>Title:</label>
        <input type="text" class="form-control" placeholder="Title" name="title">
    </div>


    <div class="mb-3 mt-3">
        <label>description:</label>
        <textarea class="form-control" aria-label="With textarea" placeholder="description" name="description"></textarea>
    </div>


    <div class="mb-3 mt-3">
        <label>Length:</label>
        <input type="time"  class="form-control" placeholder="Length" name="length">
    </div>


    <div class="mb-3 mt-3">
        <label>Dimension:</label>
        <select class="form-control"  class="form-select" name="dimension">
            <?php
            $sql = "SELECT * FROM dimension";
            $stmtdimension = $conn->prepare($sql);
            $stmtdimension->execute();


            while ($rowdimension = $stmtdimension->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?= $rowdimension["dimensionid"] ?>"><?= $rowdimension["dimension"] ?></option>
            <?php }  ?>
        </select>
    </div>


    <div class="mb-3 mt-3">
        <label>Language:</label>
    <select class="form-control"  class="form-select" name="languageid">
        <?php
        $sql = "SELECT * FROM language";
        $stmt2 = $conn->prepare($sql);
        $stmt2->execute();


        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?= $row2["languageid"] ?>"><?= $row2["language"] ?></option>
        <?php }  ?>
    </select>
    </div>


            <?php
            $sql = "SELECT * FROM genre";
            $stmt2 = $conn->prepare($sql);
            $stmt2->execute();


            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {?>

                <label>
                    <input type="checkbox" name="genreid[]" value="<?= $row2["genreid"] ?>"><?= $row2["genre"]?>
                    <span class="checkmark"></span>

                </label>

            <?php }?>

    <br>
    <label>
        <input type="radio" name="viewpointage" value="<?= $row["viewpoint"] ?>" >
        <span class="checkmark"></span>
        <img  class="picture" src="<?= $row["viewpoint"] ?>" width="150px" height="150px">
    </label>

    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>

        <label>
            <input type="radio" name="viewpointage" value="<?= $row["viewpoint"] ?>"  >
            <span class="checkmark"></span>
            <img  class="picture" src="<?= $row["viewpoint"] ?>" width="150px" height="150px">
        </label>

    <?php }

    $sql = "SELECT * FROM viewpoint where type != 'age'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {?>

        <label>
            <input type="checkbox" name="viewpoint[]" value="<?= $row2["viewpointid"] ?>">
            <span class="checkmark"></span>
            <img  class="picture" src="<?= $row2["viewpoint"] ?>" width="150px" height="150px">
        </label>

    <?php }?>



    <button name="submit" type="submit" class="btn btn-success">Add film</button>
</form>

</body>