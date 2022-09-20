<?php
session_start();
include '../../private/conn.php';

$userid = $_SESSION['userid'];

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


$stmt = $conn->prepare("UPDATE user  SET firstname = :firstname, middlename = :middlename,lastname = :lastname, street = :street, place = :place, zipcode = :zipcode,housenumber = :housenumber,number = :number, dob = :dob, email = :email WHERE   userid = :userid ");
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
$stmt->bindParam(':userid', $userid);


$stmt->execute();
header('location: ../index.php?page=profile&userid=' . $userid); ?>