<?php
session_start();
include '../../private/conn.php';

$firstname = $_POST['firstname'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = 'worker';


$sql = 'SELECT userid, email FROM user where email = :email ';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() == 0) {


    $stmt = $conn->prepare("INSERT INTO user  (firstname, email,password,role)
                        VALUES(:firstname, :email,:password,:role)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->execute();
    header('location: ../index.php?page=workersview ');
} else {

    $_SESSION['notification'] = 'This email is not available.';
    header('location: ../index.php?page=addworker ');
}


?>
