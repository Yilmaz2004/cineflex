<?php
session_start();
include '../../private/conn.php';

$firstname = $_POST['firstname'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = 'worker';


$stmt = $conn->prepare("INSERT INTO user  (firstname, email,password,role)
                        VALUES(:firstname, :email,:password,:role)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':role', $role);
$stmt->execute();

header('location: ../index.php?page= ');

?>
