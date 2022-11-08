<?php
session_start();
include '../../private/conn.php';

$moviesid = $_POST['film'];
$starttime = $_POST['starttime'];
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

$new_time = date("Y-m-d H:i", strtotime($starttime . sprintf("+%d hours", $rowlength['length'])));
$endtime = date('Y-m-d H:i', strtotime($new_time . '+10 minutes'));


$sql = "SELECT *  FROM calendar";
$stmtdate = $conn->prepare($sql);
$stmtdate->execute();
$rowcalendar = $stmtdate->fetchall(PDO::FETCH_ASSOC);


foreach ($rowcalendar as $datevalue) {

    $date_db = new DateTime($datevalue['starttime']);
    $date_db_tmsp = $date_db->getTimestamp();

    $endtime_db = new DateTime($datevalue['endtime']);
    $endtime_db_tmsp = $endtime_db->getTimestamp();

    $date_post = new DateTime($starttime);
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

        $stmtcalendar = $conn->prepare("INSERT INTO calendar (moviesid, starttime,endtime,room)
                    VALUES(:moviesid, :starttime,:endtime,:room)");
        $stmtcalendar->bindParam(':moviesid', $moviesid);
        $stmtcalendar->bindParam(':starttime', $starttime);
        $stmtcalendar->bindParam(':endtime', $endtime);
        $stmtcalendar->bindParam(':room', $room);
        $stmtcalendar->execute();

        $stmtbigroom = $conn->prepare("INSERT INTO room (seats,moviesid,starttime,endtime,room)
                    VALUES(:seats ,:moviesid,:starttime,:endtime,:room)");
        $stmtbigroom->bindParam(':seats', $seatsbig);
        $stmtbigroom->bindParam(':moviesid', $moviesid);
        $stmtbigroom->bindParam(':starttime', $starttime);
        $stmtbigroom->bindParam(':endtime', $endtime);
        $stmtbigroom->bindParam(':room', $room);
        $stmtbigroom->execute();

    } elseif ($_POST['room'] == 'smallroom') {

        $stmtcalendar = $conn->prepare("INSERT INTO calendar (moviesid, starttime,endtime,room)
                    VALUES(:moviesid, :starttime,:endtime, :room)");
        $stmtcalendar->bindParam(':moviesid', $moviesid);
        $stmtcalendar->bindParam(':starttime', $starttime);
        $stmtcalendar->bindParam(':endtime', $endtime);
        $stmtcalendar->bindParam(':room', $room  );
        $stmtcalendar->execute();

        $stmtsmallroom = $conn->prepare("INSERT INTO room (moviesid,seats,starttime,endtime,room)
                    VALUES(:moviesid,:seats,:starttime,:endtime,:room)");
        $stmtsmallroom->bindParam(':moviesid', $moviesid);
        $stmtsmallroom->bindParam(':seats', $seatssmall);
        $stmtsmallroom->bindParam(':starttime', $starttime);
        $stmtsmallroom->bindParam(':endtime', $endtime);
        $stmtsmallroom->bindParam(':room', $room);
        $stmtsmallroom->execute();
    }

}


header('location: ../index.php?page=planning');

