<?php

$sql = "SELECT m.moviesid, m.title,c.moviesid,c.date,c.endtime,c.room
FROM movies m 
left join calendar c on m.moviesid = c.moviesid   
WHERE status = 'planned'";
$stmt = $conn->prepare($sql);
$stmt->execute();

if (isset($_SESSION['notification'])) {
    echo '<p style = "color:red;">' . $_SESSION['notification'] . '</p>';
    unset($_SESSION['notification']);
}

?>

<div class="table-responsive">

    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'worker' ){?>
        <button type="button" class="btn btn-primary"  onclick="window.location.href='index.php?page=planfilm'">Plan a film</button>
    <?php }?>
    <table class="table">
        <thead>
        <div class='container'>
            <table class='table table-bordered' >
                <tr>
                    <th>Title</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>End time</th>
                    <th>Film details</th>
                </tr>
                </thead>
                <?php if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tbody>
                        <tr>
                            <td><?= $row["title"] ?></td>
                            <td><?= $row["room"] ?></td>
                            <td><?= $row["date"] ?> </td>
                            <td><?= $row["endtime"] ?> </td>
                            <td><button onclick="window.location.href='index.php?page=filmdetails&moviesid=<?=$row["moviesid"] ?>'">Film details</button> </td>
                        </tr>
                        </tbody>
                    <?php }
                } ?>
            </table>
        </div>
</div>





