<?php
include '../private/conn.php';


$sql = "SELECT * FROM language";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
<table class="table">
    <thead>
    <tr>
        <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=language/addlanguage'">
            Add language
        </button>
        <th scope="col">language</th>

        <th scope="col">Edit</th>
        <th scope="col">Delete</th>

    </tr>
    </thead>
    <?php if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tbody>
            <tr>
                <td><?= $row["language"] ?></td>

                <td>
                    <button class="btn btn-primary"
                            onclick="window.location.href='index.php?page=language/editlanguage&languageid=<?= $row["languageid"] ?>'">Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger"
                            onclick=" if(confirm('Are you sure you want to delete this genre?'))window.location.href='php/deletelanguage.php?languageid=<?= $row["languageid"] ?>'">
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        <?php }
    } ?>
</table>




