<?php
include '../private/conn.php';


$sql = "SELECT firstname
        FROM user
        WHERE role = 'worker'";
$stmt = $conn->prepare($sql);
$stmt->execute();


?>



<li class="table-header">
    <div class="col col-1">Name</div>
</li>



<?php if ($stmt->rowCount() > 0) { ?><?php

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


?>

<li class="table-header">
    <div class="col col-1" data-label="Job Id"><?= $row["firstname"] ?></div>
    <div class="col col-1" data-label="Job Id">
    </div>
</li>

<?php }}?>