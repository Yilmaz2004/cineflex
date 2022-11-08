
<body>

<h2>Plan film</h2>
<form action="php/planfilm.php" method="POST" enctype="multipart/form-data">

    <div class="mb-3 mt-3">
        <label>Title</label>
        <select name="film">
            <?php
            $sql = "SELECT moviesid,title FROM movies";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?= $row['moviesid'] ?>"><?= $row['title'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3 mt-3">
        <label>Date and time:</label>
        <input type="datetime-local" class="form-control" placeholder="Date" name="starttime">
    </div>

    <div class="mb-3 mt-3">
        <label>Room:</label><br>
        <input type="radio" id="html" name="room" value="bigroom">
        <label for="html">Big room</label><br>
        <input type="radio" id="css" name="room" value="smallroom">
        <label for="css">Small room</label><br>
    </div>

    <button name="submit" type="submit" class="btn btn-success">Add film</button>
</form>

</body>
