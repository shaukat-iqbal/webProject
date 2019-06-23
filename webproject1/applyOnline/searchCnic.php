<?php
include_once("../Models/StudentClass.php");
include_once("../Models/AuthorClass.php");
if (isset($_POST['cnic'])) {
    if (isset($_POST['role'])) {
        $auth = new Author();
        $result = $auth->search($_POST['cnic']);
        if (!$result) {
            echo "not registered";
            return;
        }
        echo "already registered";
        return;
    }
    $std = new Student();
    $result = $std->search($_POST['cnic']);
    if (!$result) {
        echo "not registered";
        return;
    }
    echo "already registered";
} else {
    echo "cnic not aval";
}
