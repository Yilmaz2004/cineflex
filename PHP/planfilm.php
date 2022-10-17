<?php
session_start();
include '../../private/conn.php';

$moviesid = $_POST['film'];
$date = $_POST['date'];
$room = $_POST['room'];
$seatsbig = 90;
$seatssmall = 60;
$reserved = false;


$sql = "SELECT length  FROM movies
        WHERE moviesid = :moviesid";
$stmtlength = $conn->prepare($sql);
$stmtlength->bindParam(':moviesid', $moviesid);
$stmtlength->execute();
$rowlength = $stmtlength->fetch(PDO::FETCH_ASSOC);

$new_time = date("Y-m-d H:i", strtotime($date . sprintf("+%d hours", $rowlength['length'])));
$endtime = date('Y-m-d H:i', strtotime($new_time . '+10 minutes'));


$sql = "SELECT *  FROM calendar";
$stmtdate = $conn->prepare($sql);
$stmtdate->execute();
$rowdate = $stmtdate->fetchall(PDO::FETCH_ASSOC);


foreach ($rowdate as $datevalue) {

    $date_db = new DateTime($datevalue['date']);
    $date_db_tmsp = $date_db->getTimestamp();

    $endtime_db = new DateTime($datevalue['endtime']);
    $endtime_db_tmsp = $endtime_db->getTimestamp();

    $date_post = new DateTime($date);
    $date_post_tmsp = $date_post->getTimestamp();


    if ($date_post_tmsp >= $date_db_tmsp && $date_post_tmsp <= $endtime_db_tmsp) {

        $reserved = true;
        break;
    }
}

if ($reserved) {

    $_SESSION['melding'] = 'Time is occupied';

} else {



    echo 'Tijd niet bezet';
    $stmtcalendar = $conn->prepare("INSERT INTO calendar (moviesid, date,endtime)
                    VALUES(:moviesid, :date,:endtime)");
    $stmtcalendar->bindParam(':moviesid', $moviesid);
    $stmtcalendar->bindParam(':date', $date);
    $stmtcalendar->bindParam(':endtime', $endtime);
    $stmtcalendar->execute();


    if ($_POST['room'] == 'bigroom') {

        $stmtbigroom = $conn->prepare("INSERT INTO room (room,seats,moviesid)
                    VALUES(:room,:seats ,:moviesid)");
        $stmtbigroom->bindParam(':room', $room);
        $stmtbigroom->bindParam(':seats', $seatsbig);
        $stmtbigroom->bindParam(':moviesid', $moviesid);
        $stmtbigroom->execute();

    } elseif ($_POST['room'] == 'smallroom') {

        $stmtsmallroom = $conn->prepare("INSERT INTO room (moviesid, room,seats)
                    VALUES(:moviesid,:room,:seats)");
        $stmtsmallroom->bindParam(':moviesid', $moviesid);
        $stmtsmallroom->bindParam(':room', $room);
        $stmtsmallroom->bindParam(':seats', $seatssmall);
        $stmtsmallroom->execute();
    }

    $stmtmovie = $conn->prepare("UPDATE movies SET status = 'planned' WHERE moviesid = :moviesid");
    $stmtmovie->bindParam(':moviesid', $moviesid);
    $stmtmovie->execute();
}


header('location: ../index.php?page=planning');

