<?php
session_start();
include '../../private/conn.php';

$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$street = $_POST['street'];
$place = $_POST['place'];
$zipcode = $_POST['zipcode'];
$housenumber = $_POST['housenumber'];
$number = $_POST['number'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = 'customer';



$stmt = $conn->prepare("insert into user (firstname, middlename,lastname,street,place,zipcode,housenumber,number,dob,email,password, role)
                                                   values(:firstname, :middlename, :lastname,:street,:place,:zipcode,:housenumber,:number,:dob,:email,:password,:role)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':middlename', $middlename);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':street', $street);
$stmt->bindParam(':place', $place);
$stmt->bindParam(':zipcode', $zipcode);
$stmt->bindParam(':housenumber', $housenumber);
$stmt->bindParam(':number', $number);
$stmt->bindParam(':dob', $dob);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':role', $role);
$stmt->execute();


$_SESSION['userid'] = $conn->lastInsertId();
$_SESSION['role'] = $role;

header('location: ../index.php?page=homepage');






