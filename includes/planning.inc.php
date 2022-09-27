
<?php
$monday = date( 'd-m-Y', strtotime( 'monday this week' ) );
$tuesday = date( 'd-m-Y', strtotime( 'tuesday this week' ) );
$wednesday = date( 'd-m-Y', strtotime( 'wednesday this week' ) );
$thursday = date( 'd-m-Y', strtotime( 'thursday this week' ) );
$friday = date( 'd-m-Y', strtotime( 'friday this week' ) );
$saturday = date( 'd-m-Y', strtotime( 'saturday this week' ) );

$sql = "SELECT * FROM movies
        WHERE status = 'planned'";
$stmt = $conn->prepare($sql);
$stmt->execute();


//echo '<pre>'; print_r($row['title']); echo '</pre>';

?>

<div class="container">
    <div class="timetable-img text-center">
    </div>
    <div class="table-responsive">
        <button type="button" class="btn btn-primary"  onclick="window.location.href='index.php?page=planfilm'">Plan a film</button>
        <button type="button" class="btn btn-info" style="float: right">Next week</button>


        <table class="table">
            <thead>
            <tr>
                <th scope="col">*</th>
                <th scope="col"><?= $monday ?>/</th>
                <th scope="col"><?= $tuesday ?>/</th>
                <th scope="col"><?= $wednesday ?>/</th>
                <th scope="col"><?= $thursday ?>/</th>
                <th scope="col"><?= $friday ?>/</th>
                <th scope="col"><?= $saturday ?></th>
            </tr>
            </thead>
            <?php if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tbody>
                    <tr>
                        <td><?= $row["title"] ?></td>

                        <td> </td>

                        <td> </td>
                    </tr>
                    </tbody>
                <?php }
            } ?>
        </table>
    </div>
</div>





