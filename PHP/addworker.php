<?php
session_start();
include '../../private/conn.php';

$firstname = $_POST['firstname'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = 'worker';
$emailused= false;

$sql = 'SELECT userid FROM user where email = :email ';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() == 0) {


    $stmt = $conn->prepare("INSERT INTO user  (firstname, email,password,role)
                        VALUES(:firstname, :email,:password,:role)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->execute();
}else{
    $emailused=true;
    $_SESSION['melding'] = 'This email is not available.';
    header('location: ../index.php?page=addworker ');
}
    header('location: ../index.php?page=workersview ');

?>
