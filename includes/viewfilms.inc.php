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
        <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=addfilm'">
            Add Film
        </button>
        <th scope="col">Picture</th>
        <th scope="col">Titel</th>
        <th scope="col">Description</th>
        <th scope="col">Length</th>
        <th scope="col">Language</th>
        <th scope="col">Genre</th>
        <th scope="col">Viewpoint</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>


    </tr>
    </thead>
    <?php if ($stmt->rowCount() > 0) {

        $sql = "SELECT *
        FROM movies";
        $stmt = $conn->prepare($sql);
        $stmt->execute();


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tbody>
            <tr>
                <td><img class="picture" src="<?= $row["picture"] ?>" width="200px" height="200px"></td>
                <td><?= $row["title"] ?></td>
                <td><?= $row["description"] ?></td>
                <td><?= $row["length"] ?> Minutes</td>
                <td><?= $row["language"] ?></td>
                <td><?= $row["genre"] ?></td>
                <td><img class="picture" src="<?= $row["viewpoint"] ?>" width="200px" height="200px"></td>
                <td>
                    <button class="btn btn-primary"
                            onclick="window.location.href='index.php?page=editfilm&moviesid=<?= $row["moviesid"] ?>'">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger"
                            onclick=" if(confirm('Are you sure you want to delete this film?'))window.location.href='php/deletefilm.php?moviesid=<?= $row["moviesid"] ?>'">
                        Delete
                    </button>
                </td>

            </tr>
            </tbody>
        <?php }
    } ?>
</table>




