<?php
include_once("navigation.html");
require_once("../Models/AuthorClass.php");
$auth = new Author();
if (isset($_GET["cnic"]) && !empty($_GET["cnic"])) {
    if ($auth->Delete($_GET["cnic"])) {
        header("Location: index.php");
    }
    echo "Something went wrong! Record has not been deleted!";
} else {
    echo "Specify Author CNIC";
}
