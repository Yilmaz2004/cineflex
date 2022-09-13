<?php
include '../private/conn.php';

?>

<div class="topnav">
    <a class="nav-link active" href=index.php?page=>Planning</a>
    <?php if (isset($_SESSION['userid'])){?>
        <a href="php/logout.php" style="float:right">Log uit</a>
    <?php }else {?>
        <a  href=index.php?page=login style="float:right">Log in</a>
    <?php }?>

</div>



