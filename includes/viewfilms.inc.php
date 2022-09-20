<?php
include '../private/conn.php';


$sql = "SELECT *
        FROM movies
        ";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
<table class="table">
    <thead>
    <tr>
        <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=addfilm'">Add Film</button>
        <th scope="col">Picture</th>
        <th scope="col">Titel</th>
        <th scope="col">description</th>
        <th scope="col">length</th>
        <th scope="col">language</th>
        <th scope="col">genre</th>
        <th scope="col">viewpoint</th>

    </tr>
    </thead>
    <?php if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tbody>
            <tr>
                <td><img  class="picture" src="<?= $row["picture"]?>" ></td>
                <td><?= $row["titel"] ?></td>
                <td><?= $row["description"] ?></td>
                <td><?= $row["length"] ?></td>
                <td><?= $row["language"] ?></td>
                <td><?= $row["genre"] ?></td>
                <td><img  class="picture" src="<?= $row["viewpoint"]?>" ></td>
<!--                <td><button type="button" class="btn btn-danger" onclick=" if(confirm('Are you sure you want to delete this worker?'))window.location.href='php/deleteworker.php?userid=--><?//= $row["userid"] ?>//'"Delete</button></td>
         </tr>
            </tbody>
        <?php }} ?>
</table>




