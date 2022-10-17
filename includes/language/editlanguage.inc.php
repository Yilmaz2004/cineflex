<?php
$languageid = $_GET['languageid'];

$sql = "SELECT * FROM language WHERE languageid = :languageid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':languageid', $languageid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC)
?>
<body>
<div class="container mt-3">
    <h2>Edit A language</h2>
    <form action="php/editlanguage.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>language</label>
            <input type="text" class="form-control" placeholder="Enter name" value="<?= $row['language'] ?>"
                   name="language">
        </div>
        <input type="hidden" name="languageid" value="<?= $languageid ?>">
        <button name="submit" type="submit" class="btn btn-success">Update</button>
    </form>
</div>
</body>