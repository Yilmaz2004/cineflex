<?php
include '../private/conn.php';
$genre = new genre();
?>
<table class="table">
    <thead>
    <tr>
        <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=genre/addgenre'">
            Add Genre
        </button>
        <th scope="col">Genre</th>

        <th scope="col">Edit</th>
        <th scope="col">Delete</th>

    </tr>
    </thead>


            <tbody>
            <tr><?php var_dump($genre); ?>
                <td><?=$genre->get_genre() ?></td>

                <td>
                    <button class="btn btn-primary"
                            onclick="window.location.href='index.php?page=genre/editgenre&genreid=<?= $row["genreid"] ?>'">Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger"
                            onclick=" if(confirm('Are you sure you want to delete this genre?'))window.location.href='php/deletegenre.php?genreid=<?= $row["genreid"] ?>'">
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>

</table>




