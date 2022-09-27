<?php

$sql = "SELECT m.moviesid, m.title,m.genre,c.moviesid,c.date,c.starttime,c.endtime,c.endtimemovie,r.room 
FROM movies m 
left join calendar c on m.moviesid = c.moviesid   
left join room r on m.moviesid = r.moviesid        

         
        WHERE status = 'planned'";
$stmt = $conn->prepare($sql);
$stmt->execute();

?>

    <div class="table-responsive">

<?php if( $_SESSION['userid'] == 'admin' ||  $_SESSION['userid'] == 'worker'  ){?>
        <button type="button" class="btn btn-primary"  onclick="window.location.href='index.php?page=planfilm'">Plan a film</button>
        <?php }?>

        <table class="table">
            <thead>
            <div class='container'>
                <table class='table table-bordered' >
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Room</th>
                <th>Date</th>
                <th>Start time</th>
                <th>End time</th>
            </tr>
            </thead>
            <?php if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tbody>
                    <tr>
                        <td><?= $row["title"] ?></td>
                        <td><?= $row["genre"] ?> </td>
                        <td><?= $row["room"] ?></td>
                        <td><?= $row["date"] ?> </td>
                        <td><?= $row["starttime"] ?> </td>
                        <td><?= $row["endtimemovie"] ?> </td>
                    </tr>
                    </tbody>
                <?php }
            } ?>
        </table>
    </div>
</div>





