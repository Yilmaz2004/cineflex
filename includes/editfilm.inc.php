<?php
$moviesid = $_GET['moviesid'];

$sql = "SELECT tile, description, language, genre, viewpoint, picture FROM movies
        WHERE moviesid = :moviesid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':moviesid' ,$moviesid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC)
?>
<body>
<div class="container mt-3">
    <h2>Edit A Worker</h2>
    <form action="php/editfilm.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" value="<?=$row['title']?>" name="firstname">
        </div>
        <div class="mb-3 mt-3">
            <label>Email:</label>
            <input type="text" class="form-control" placeholder="Enter email" value="<?=$row['description']?>" name="email">
        </div>

        <div class="mb-3 mt-3">
            <label>password:</label>
            <input type="text" class="form-control" placeholder="Enter password" value="<?=$row['language']?>" name="password">
        </div>
        <div class="mb-3 mt-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" value="<?=$row['genre']?>" name="firstname">
        </div>
        <div class="mb-3 mt-3">
            <label>Email:</label>
            <input type="text" class="form-control" placeholder="Enter email" value="<?=$row['viewpoint']?>" name="email">
        </div>

        <div class="mb-3 mt-3">
            <label>password:</label>
            <input type="text" class="form-control" placeholder="Enter password" value="<?=$row['picture']?>" name="password">
        </div>
        <input type="hidden" name="userid"   value="<?=$moviesid?>">
        <button name="submit" type="submit" class="btn btn-success">Update</button>
    </form>
</div>
</body>