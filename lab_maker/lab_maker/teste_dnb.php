<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";
$database = "lab_maker_db";

$conn = new mysqli("localhost", "root", "", "lab_maker_db", 3306);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>