<?php
$genreid = $_GET['genreid'];


$sql = "SELECT * FROM genre WHERE genreid = :genreid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':genreid', $genreid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC)
?>
<body>
<div class="container mt-3">
    <h2>Edit Genre</h2>
    <form action="php/editgenre.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" value="<?= $row['genre'] ?>"
                   name="genre">
        </div>
        <input type="hidden" name="genreid" value="<?= $genreid ?>">
        <button name="submit" type="submit" class="btn btn-success">Update</button>
    </form>
</div>
</body>