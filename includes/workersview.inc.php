<?php
include '../private/conn.php';


$sql = "SELECT firstname,email,userid
        FROM user
        WHERE role = 'worker'";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
<table class="table">
    <thead>
    <tr>

        <th scope="col">First name</th>
        <th scope="col">Email</th>
        <th scope="col">Add</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>

    </tr>
    </thead>
    <?php if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tbody>
            <tr>
                <td><?= $row["firstname"] ?></td>
                <td><?= $row["email"] ?></td>
                <td>x</td>
                <td>x</td>
                <td><button type="button" class="btn btn-danger" onclick=" if(confirm('Are you sure you want to delete this worker?'))window.location.href='php/deleteworker.php?userid=<?= $row["userid"] ?>'"Delete</button></td>
            </tr>
            </tbody>
        <?php }} ?>
</table>




