<?php
include '../private/conn.php';
$moviesid = $_GET['moviesid'];
$roomname = $_GET['roomname'];

$sql = "SELECT * FROM room WHERE roomname = :roomname ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':roomname', $roomname);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<?php for($i=0;$i<$row['rows'];$i++){?>

<?php for($a=0;$a<$row['colum'];$a++){?>
    <div style="float:left">
        <form action="php/reserve.php" method="post">

        <div  class="row" >

            <div class="seat"></div>

        <input type="checkbox">




            <input type="hidden">
            <input type="hidden">

        </div>
    </div>

    </form>
<?php }}

?>

