<?php
require_once '../../../config/conn.php';

session_start();

// zijn de velden passwoord en confirm-passwordt wel hetzelfde? V
// $_POST (hier zit all velden uit het form)
$naam = $_POST['name'];
$password = $_POST['password'];
$passwordconfirm = $_POST['confirm-password'];

if($password !== $passwordconfirm){
    die( 'wachtwoorden zijn niet hetzelfde');
} 

// wachtwoord hashen
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);



// in de database zetten.
$sql = "INSERT INTO users (naam, username, password) VALUES (:naam, :username, :password)";
$statement = $conn->prepare($sql);
$statement->execute([
    ':naam' => $_POST['name'],
    ':username' => $_POST['username'],
    ':password' => $hashedPassword

]);
header("Location: " . $base_url . "/index.php?msg=geregistreerd");