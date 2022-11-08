<?php
include '../private/conn.php';
$sql = "SELECT *
        FROM movies
        ";
$stmt = $conn->prepare($sql);
$stmt->execute();

if (isset($_SESSION['melding'])) {
echo '<p style = "color:red;">' . $_SESSION['melding'] . '</p>';
unset($_SESSION['melding']);}

?>
<?php
include '../private/conn.php';

$sql = "SELECT *
        FROM movies
        ";
$stmt = $conn->prepare($sql);
$stmt->execute();

if (isset($_SESSION['melding'])) {
    echo '<p style = "color:red;">' . $_SESSION['melding'] . '</p>';
    unset($_SESSION['melding']);}

?>

<table class="table">
    <thead>
    <tr>
        <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=addfilm'">
            Add Film
        </button>
        <th scope="col">Picture</th>
        <th scope="col">Titel</th>
        <th scope="col">View</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>


    </tr>
    </thead>
    <?php


    if ($stmt->rowCount() > 0) {

        $sql = "SELECT *
        FROM movies";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tbody>
            <tr>
                <td><img src="data:image/png;base64,<?=$row['picture'] ?>" width="200px" height="200px"></td>
                <td><?= $row['title'] ?></td>
                <td>
                    <button class="btn btn-info"
                            onclick="window.location.href='index.php?page=filmdetails&moviesid=<?= $row["moviesid"] ?>'">
                        Film Details
                    </button>
                </td>


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