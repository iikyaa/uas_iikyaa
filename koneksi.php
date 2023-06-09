<?php
$host = "sql300.infinityfree.com";
$user = "if0_34388971";
$passwd = "C7fpaG9K0LzxLh";
$name = "if0_34388971_iikya";

$conn = mysqli_connect($host, $user, $passwd, $name);

if (!$conn) {
    die("Koneksi gagal terhubung : " . mysqli_connect_errno() . "-" . mysqli_connect_error());
}