<?php
include '../private/conn.php';


$sql = "SELECT firstname,lastname
        FROM user
        WHERE role = 'worker'";
$stmt = $conn->prepare($sql);
$stmt->execute();


if ($stmt->rowCount() > 0) {

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>



    <table class="table">
        <thead>
        <tr>

            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Add</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>

        </tr>
        </thead>
        <tbody>
        <tr>

            <td><?= $row["firstname"] ?></td>
            <td><?= $row["lastname"] ?></td>
            <td>x</td>
            <td>x</td>
            <td><button type="button" class="btn btn-danger" onclick=" if(confirm('Weet u zeker dat u deze betaling wilt verwijderen?'))window.location.href='php/deleteworker.php?workerid=<?= $row["workerid"] ?>'"Danger</button></td>

        </tr>


        </tr>
        </tbody>
    </table>



<?php

    }}
?>



