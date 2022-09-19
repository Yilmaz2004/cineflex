<?php
$userid = $_GET['userid'];

$sql = "SELECT userid, firstname,middlename,lastname,place,street,housenumber,zipcode,number,dob, email, password FROM user
        WHERE userid = :userid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userid' ,$userid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC)
?>


<body xmlns="http://www.w3.org/1999/html">
<div class="container mt-3">
    <h2>Profile information</h2>
    <div class="mb-3 mt-3">
        <form action="php/editprofile.php" method="POST" enctype="multipart/form-data">

        <label>Name:</label>
        <input type="text" class="form-control" placeholder="Enter name"value="<?=$row['firstname']?>"  name="firstname" >
    </div>
    <div class="mb-3 mt-3">
        <label>Middle name:</label>
        <input type="text" class="form-control" placeholder="Enter middle name"value="<?=$row['middlename']?>" name="middlename" >
    </div>

    <div class="mb-3 mt-3">
        <label>Last name:</label>
        <input type="text" class="form-control" name="lastname" placeholder="Enter last name"value="<?=$row['lastname']?>" >
    </div>

    <div class="mb-3 mt-3">
        <label>Place:</label>
        <input type="text" class="form-control" placeholder="Enter place" name="place"value="<?=$row['place']?>" >
    </div>

    <div class="mb-3 mt-3">
        <label>Street:</label>
        <input type="text" class="form-control" placeholder="Enter street" name="street"value="<?=$row['street']?>" >
    </div>


    <div class="mb-3 mt-3">
        <label>Housenumber:</label>
        <input type="text" class="form-control" placeholder="Enter housenumber" name="housenumber"value="<?=$row['housenumber']?>" >
    </div>

    <div class="mb-3 mt-3">
        <label>Zipcode:</label>
        <input type="text" class="form-control" placeholder="Enter zipcode" name="zipcode"value="<?=$row['zipcode']?>" >
    </div>


    <div class="mb-3 mt-3">
        <label>Phone number:</label>
        <input type="text" class="form-control" placeholder="Enter phone number" name="number"value="<?=$row['number']?>" >
    </div>


    <div class="mb-3 mt-3">
        <label>Date of birth:</label>
        <input type="date" class="form-control" placeholder="Enter date of birth" name="dob"value="<?=$row['dob']?>" >
    </div>

    <div class="mb-3 mt-3">
        <label>Email:</label>
        <input type="text" class="form-control" placeholder="Enter email" name="email"value="<?=$row['email']?>" >
    </div>


    <button name="submit" type="submit"  class="btn btn-success">Save changes</button>
</form>

</div>
</body>
