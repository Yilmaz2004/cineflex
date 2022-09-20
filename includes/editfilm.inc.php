<?php
$moviesid = $_GET['moviesid'];

$sql = "SELECT title, description, language, genre, viewpoint, picture FROM movies
        WHERE moviesid = :moviesid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':moviesid', $moviesid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC)
?>
<body>
<div class="container mt-3">
    <h2>Edit A Worker</h2>
    <form action="php/editfilm.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" value="<?= $row['title'] ?>" name="title">
        </div>
        <div class="mb-3 mt-3">
            <label>Email:</label>
            <input type="text" class="form-control" placeholder="Enter email" value="<?= $row['description'] ?>"
                   name="description">
        </div>

        <div class="mb-3 mt-3">
            <label>password:</label>
            <input type="text" class="form-control" placeholder="Enter password" value="<?= $row['language'] ?>"
                   name="language">
        </div>
        <div class="mb-3 mt-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" value="<?= $row['genre'] ?>" name="genre">
        </div>
        <div class="mb-3 mt-3">
            <label>Email:</label>
            <input type="file" class="form-control" placeholder="Enter email" value="<?= $row['viewpoint'] ?>"
                   name="viewpoint">
        </div>

        <div class="mb-3 mt-3">
            <label>password:</label>
            <input type="file" class="form-control" placeholder="Enter password" value="<?= $row['picture'] ?>"
                   name="picture">
        </div>
        <input type="hidden" name="moviesid" value="<?= $moviesid ?>">
        <button name="submit" type="submit" class="btn btn-success">Update</button>
    </form>
</div>
</body>