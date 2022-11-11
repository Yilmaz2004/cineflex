<?php
session_start();
include '../../private/conn.php';

$userid = $_SESSION['userid'];
$moviesid = $_POST['moviesid'];
$roomname = $_POST['roomname'];
$seats = $_POST['seats'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];
$roomid = $_POST['roomid'];


if (isset($_POST['seats'])) {
    $count = count($seats);


    if ($count >= 6) {

        $_SESSION['notification'] = 'You have chosen 6 or more seats, please contacts us for your reservation';
        header('location: ../index.php?page=reserve&moviesid=' . $moviesid . '&roomname=' . $roomname);

    } else {

        foreach ($seats as $seatid) {

            $stmt2 = $conn->prepare("INSERT INTO userreserved  (userid,moviesid,room,seat)
                                VALUES(:userid,:moviesid,:room,:seat)");
            $stmt2->bindParam(':userid', $userid);
            $stmt2->bindParam(':moviesid', $moviesid);
            $stmt2->bindParam(':room', $roomname);
            $stmt2->bindParam(':seat', $seatid);
            $stmt2->execute();


        }


        echo $roomname;
        $stmt3 = $conn->prepare("UPDATE room SET seats = seats - :test  where roomid = :roomid");
        $stmt3->bindParam(':test', $count);
        $stmt3->bindParam(':roomid', $roomid);
        $stmt3->execute();






        $stmt3 = $conn->prepare("UPDATE calendar SET seatsleft = seatsleft - :count  where moviesid = :moviesid and starttime = :starttime and endtime = :endtime and roomid =:roomid");
        $stmt3->bindParam(':moviesid', $moviesid);
        $stmt3->bindParam(':starttime', $starttime);
        $stmt3->bindParam(':endtime', $endtime);
        $stmt3->bindParam(':count', $count);
        $stmt3->bindParam(':roomid', $roomid);
        $stmt3->execute();



    }

} else {
    $_SESSION['notification'] = 'Please select a seat.';
    header('location: ../index.php?page=reserve&moviesid=' . $moviesid . '&roomname=' . $roomname);


}

