<?php
require_once("../Models/AuthorClass.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO: Write code below this line to insert record
    $author = new Author();
    if (!$author->Insert($_POST['name'], $_POST['cnic'], $_POST['email'], $_POST['password'], $_POST['subject_id'])) {
        echo "Cannot Add new Author record!";
        return;
    }
    header("Location: index.php");
}
