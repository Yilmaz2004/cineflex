<?php
include '../private/conn.php';
$moviesid = $_GET['moviesid'];
$roomname = $_GET['roomname'];
$starttime = $_GET['starttime'];
$endtime = $_GET['endtime'];


$sql = "SELECT * FROM room WHERE roomname = :roomname ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':roomname', $roomname);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);


$sql = "SELECT seatrow FROM seatrow ";
$stmt2 = $conn->prepare($sql);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

//echo ++$str; // prints 'b'

//foreach(range('a','z') as $v){
//    echo "$v \n";
//}

if (isset($_SESSION['notification'])) {
    echo '<p style = "color:red;">' . $_SESSION['notification'] . '</p>';
    unset($_SESSION['notification']);
}
?>
<?php for($x=65,$i=0;$i<$row['rows'];$i++,++$x){      ?>
<div  class="letter" style="float: initial"> <?= chr($x); ?> </div>
<?php  for($y=1,$a=0;$a<$row['colum'];$a++,$y++){ $seatnumber= chr($x). $y ?>

    <div style="float:left">
        <form action="php/reserve.php" method="post">
        <div class="row">


            <div class="seat"  style="color: white"> <?= $seatnumber?> </div>

        <input type="checkbox" value="<?= $seatnumber ?>" name="seats[]">


            <input type="hidden" name="roomname" value="<?= $roomname?>  ">
            <input type="hidden" name="moviesid" value="<?=$moviesid?>">



            <input type="hidden" name="starttime" value="<?=$starttime?>">
            <input type="hidden" name="endtime" value="<?=$endtime?>">


        </div>
    </div>



<?php }  }

?>
<button name="submit" type="submit" class="btn btn-success">Reserve seats</button>

</form>
