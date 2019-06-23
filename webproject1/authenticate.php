<?php

$connection = mysqli_connect("localhost", "root", "", "testing");

if (mysqli_connect_error()) {
    console . log("db connection error");
    die(mysqli_connect_error());
}
if (isset($_POST['cnic']) && isset($_POST['password']) && isset($_POST['role'])) {
    $cnic = $_POST['cnic'];
    $pass = md5($_POST['password']);
    $role =  $_POST['role'];
    if ($role == "Admin") {
        if ($cnic == "admin" && $pass == md5("admin")) {
            $_SESSION['username'] = $cnic;
            $_SESSION['role'] = $role;
            header("Location: ./Admin/index.php");
        } else {

            echo "0";
            return;
        }
    } else {
        $tableName = strtolower($role) . "s";
        $sql = "select * from $tableName where cnic='$cnic' and password='$pass'";
        $result = mysqli_query($connection, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $user;
            $_SESSION['role'] = $role;
            header("Location: $role/index.php");
        } else {
            echo "0";
            return;
        }
    }
} else {
    echo "not set";
}
