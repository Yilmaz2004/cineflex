<?php
include "../private/conn.php";


$language = new language();
if (isset($_SESSION['melding'])) {
    echo '<p style = "color:red;">' . $_SESSION['melding'] . '</p>';
    unset($_SESSION['melding']);}

?>

<table class="table">
    <thead>
    <tr>
        <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=language/addlanguage'">
            Add Genre
        </button>
        <th scope="col">Genre</th>

        <th scope="col">Edit</th>
        <th scope="col">Delete</th>

    </tr>
    </thead>


    <tbody>


    <?php
    if ($language->get_languagedata($conn) != NULL){
    foreach($language->get_languagedata($conn) as $value){?>

        <tr>
            <td>
                <?= $value->language ?>
            </td>




            <td>
                <button class="btn btn-primary"
                        onclick="window.location.href='index.php?page=language/editlanguage&languageid=<?=  $value->languageid ?> '">Edit
                </button>
            </td>
            <td>
                <button class="btn btn-danger"
                        onclick=" if(confirm('Are you sure you want to delete this language?'))window.location.href='php/deletelanguage.php?languageid=<?=  $value->languageid ?> '">
                    Delete
                </button>
            </td>
        </tr>
    <?php }} ?>
    </tbody>

</table>




