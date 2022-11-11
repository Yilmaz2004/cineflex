<?php
session_start();
include '../../private/conn.php';

$moviesid = $_GET['moviesid'];
$starttime = $_GET['starttime'];
$endtime = $_GET['endtime'];
$room = $_GET['room'];

$sql = "SELECT moviesid  FROM userreserved
        WHERE moviesid = :moviesid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':moviesid', $moviesid);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);



if($stmt->rowCount() == 0){


    $stmtcalendar = $conn->prepare("DELETE FROM calendar WHERE moviesid = :moviesid and starttime = :starttime and endtime = :endtime and roomid = :roomid");
    $stmtcalendar->bindParam(':moviesid', $moviesid);
    $stmtcalendar->bindParam(':starttime', $starttime);
    $stmtcalendar->bindParam(':endtime', $endtime);
    $stmtcalendar->bindParam(':roomid', $room);
    $stmtcalendar->execute();


//    $stmtroom = $conn->prepare("DELETE FROM room WHERE moviesid = :moviesid and starttime = :starttime and endtime = :endtime and room = :room");
//    $stmtroom->bindParam(':moviesid', $moviesid);
//    $stmtroom->bindParam(':starttime', $starttime);
//    $stmtroom->bindParam(':endtime', $endtime);
//    $stmtroom->bindParam(':room', $room);
//    $stmtroom->execute();


    header('location: ../index.php?page=planning');
}else{
    $_SESSION['melding'] = 'This movie has been reserved by customers';
    header('location: ../index.php?page=planning');

}
