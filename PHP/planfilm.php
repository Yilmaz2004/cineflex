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
$rowcalendar = $stmtdate->fetchall(PDO::FETCH_ASSOC);


foreach ($rowcalendar as $datevalue) {

    $date_db = new DateTime($datevalue['date']);
    $date_db_tmsp = $date_db->getTimestamp();

    $endtime_db = new DateTime($datevalue['endtime']);
    $endtime_db_tmsp = $endtime_db->getTimestamp();

    $date_post = new DateTime($date);
    $date_post_tmsp = $date_post->getTimestamp();


    $endtime_post = new DateTime($endtime);
    $endtime_post_tmsp = $endtime_post->getTimestamp();

    if (($date_post_tmsp >= $date_db_tmsp && $date_post_tmsp <= $endtime_db_tmsp) || ($endtime_post_tmsp >= $date_db_tmsp && $endtime_post_tmsp <= $endtime_db_tmsp)) {


        if ($_POST['room'] == $datevalue['room']) {

            $reserved = true;
            break;
        }


    }
}

if ($reserved) {

    $_SESSION['notification'] = 'Time/Room is occupied';

} else {

    if ($_POST['room'] == 'bigroom') {

        $stmtcalendar = $conn->prepare("INSERT INTO calendar (moviesid, date,endtime,room)
                    VALUES(:moviesid, :date,:endtime,:room)");
        $stmtcalendar->bindParam(':moviesid', $moviesid);
        $stmtcalendar->bindParam(':date', $date);
        $stmtcalendar->bindParam(':endtime', $endtime);
        $stmtcalendar->bindParam(':room', $room);
        $stmtcalendar->execute();

        $stmtbigroom = $conn->prepare("INSERT INTO room (seats,moviesid)
                    VALUES(:seats ,:moviesid)");
        $stmtbigroom->bindParam(':seats', $seatsbig);
        $stmtbigroom->bindParam(':moviesid', $moviesid);
        $stmtbigroom->execute();

    } elseif ($_POST['room'] == 'smallroom') {

        $stmtcalendar = $conn->prepare("INSERT INTO calendar (moviesid, date,endtime,room)
                    VALUES(:moviesid, :date,:endtime, :room)");
        $stmtcalendar->bindParam(':moviesid', $moviesid);
        $stmtcalendar->bindParam(':date', $date);
        $stmtcalendar->bindParam(':endtime', $endtime);
        $stmtcalendar->bindParam(':room', $room);
        $stmtcalendar->execute();

        $stmtsmallroom = $conn->prepare("INSERT INTO room (moviesid,seats)
                    VALUES(:moviesid,:seats)");
        $stmtsmallroom->bindParam(':moviesid', $moviesid);
        $stmtsmallroom->bindParam(':seats', $seatssmall);
        $stmtsmallroom->execute();
    }

    $stmtmovie = $conn->prepare("UPDATE movies SET status = 'planned' WHERE moviesid = :moviesid");
    $stmtmovie->bindParam(':moviesid', $moviesid);
    $stmtmovie->execute();
}


header('location: ../index.php?page=planning');

