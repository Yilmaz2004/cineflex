<?php

$sql = "SELECT * FROM movies
        WHERE status = 'notplanned'";
$stmt = $conn->prepare($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->execute();


?>


<body>
<div class="container mt-3">
    <h2>Add a film</h2>
    <form action="php/planfilm.php" method="POST" enctype="multipart/form-data">

            <select name="film">
                <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){?>
                <option value="<?php echo $row["moviesid"]; ?>"><br>
                    <?php echo $row["title"]; ?>
                </option><br>
            <?php } ?>

                <div class="mb-3 mt-3">
                    <label>date:</label>
                    <input type="date" class="form-control" placeholder="Date" name="date">
                </div>

                <div class="mb-3 mt-3">
                    <label>date:</label>
                    <input type="time" class="form-control" placeholder="Date" name="date">
                </div>

        <button name="submit" type="submit" class="btn btn-success">Add film</button>
    </form>
</div>
</body>
