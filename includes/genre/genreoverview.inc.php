<?php
include "../private/conn.php";


    $genre = new genre();

if (isset($_SESSION['melding'])) {
    echo '<p style = "color:red;">' . $_SESSION['melding'] . '</p>';
    unset($_SESSION['melding']);}

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


                <?php
                if ($genre->get_genredata($conn) != NULL){
                    foreach($genre->get_genredata($conn) as $value){?>

                    <tr>
                        <td>
                            <?= $value->genre ?>
                        </td>




                <td>
                    <button class="btn btn-primary"
                            onclick="window.location.href='index.php?page=genre/editgenre&genreid=<?=  $value->genreid ?> '">Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger"
                            onclick=" if(confirm('Are you sure you want to delete this genre?'))window.location.href='php/deletegenre.php?genreid=<?=  $value->genreid ?> '">
                        Delete
                    </button>
                </td>
            </tr>
                    <?php }} ?>
            </tbody>

</table>




