<?php
require_once('../Models/AuthorClass.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO: Write code to Update records based on posted back fields
    $auth = new Author();
    if ($auth->Update($_POST['name'], $_POST['cnic'], $_POST['email'], $_POST['password'])) {
        echo "success";
        header("Location: index.php");
    }
}
