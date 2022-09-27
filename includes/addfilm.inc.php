<?php


$sql = "SELECT * FROM viewpoint where type = 'age'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<body>
<div class="container mt-3">
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
            <input type="text" class="form-control" placeholder="Length" name="length">
        </div>


        <div class="mb-3 mt-3">
            <label>Language:</label>
            <input type="text" class="form-control" placeholder="Language" name="language">
        </div>


        <div class="mb-3 mt-3">
            <label>Genre:</label>
            <input type="text" class="form-control" placeholder="Genre" name="genre">
        </div>

        <label class="container">
            <input type="radio" name="viewpointage" value="<?= $row["viewpoint"] ?>" checked="checked" >
            <span class="checkmark"></span>
            <img  class="picture" src="<?= $row["viewpoint"] ?>" width="200px" height="200px">
        </label>

<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>

        <label class="container">
            <input type="radio" name="viewpointage" value="<?= $row["viewpoint"] ?>" checked="checked" >
            <span class="checkmark"></span>
            <img  class="picture" src="<?= $row["viewpoint"] ?>" width="200px" height="200px">
        </label>

<?php }

        $sql = "SELECT * FROM viewpoint where type != 'age'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {?>

            <label class="container" >
                <input type="checkbox" name="viewpoint[]" value="<?= $row2["viewpointid"] ?>">
                <span class="checkmark"></span>
                <img  class="picture" src="<?= $row2["viewpoint"] ?>" width="200px" height="200px">
            </label>

        <?php }?>



        <button name="submit" type="submit" class="btn btn-success">Add film</button>
    </form>
</div>
</body>
