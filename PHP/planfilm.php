<?php
session_start();
include '../../private/conn.php';

$moviesid = $_POST['film'];
$date = $_POST['date'];
$starttime = $_POST['starttime'];
$endtimemovie = $_POST['endtime'];
$room = $_POST['room'];
$endtime = date('H:i', strtotime($endtimemovie. ' +10 minutes'));
$seatsbig= 90;
$seatssmall= 60;



$stmtcalendar = $conn->prepare("INSERT INTO calendar (moviesid, date,starttime,endtimemovie,endtime)
                    VALUES(:moviesid, :date,:starttime,:endtimemovie,:endtime)");
$stmtcalendar->bindParam(':moviesid', $moviesid);
$stmtcalendar->bindParam(':date', $date);
$stmtcalendar->bindParam(':starttime', $starttime);
$stmtcalendar->bindParam(':endtimemovie', $endtimemovie);
$stmtcalendar->bindParam(':endtime', $endtime);
$stmtcalendar->execute();



if($_POST['room'] == 'bigroom'){
    $stmtbig = $conn->prepare("INSERT INTO room (room,seats,moviesid)
                    VALUES(:room,:seats ,:moviesid)");
    $stmtbig->bindParam(':room', $room);
    $stmtbig->bindParam(':seats', $seatsbig);
    $stmtbig->bindParam(':moviesid', $moviesid);
    $stmtbig->execute();

}elseif ($_POST['room'] == 'smallroom'){
    $stmtsmall = $conn->prepare("INSERT INTO room (moviesid, room,seats)
                    VALUES(:moviesid,:room,:seats)");
    $stmtsmall->bindParam(':moviesid', $moviesid);
    $stmtsmall->bindParam(':room', $room);
    $stmtsmall->bindParam(':seats', $seatssmall);
    $stmtsmall->execute();
}

$stmtmovie = $conn->prepare("UPDATE movies SET status = 'planned' WHERE moviesid = :moviesid");
$stmtmovie->bindParam(':moviesid', $moviesid);
$stmtmovie->execute();


header('location: ../index.php?page=planning');

