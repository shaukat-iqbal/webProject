<?php
require_once("../Models/AuthorClass.php");
require_once("../Models/SubjectClass.php");
$author = new Author();
if ($_GET['action'] == "assign") {

    $subject_id = $_GET['subject_id'];
    $author_id = $_GET['author_id'];

    if ($author->assignSubject($subject_id, $author_id)) {
        echo "assigned";
        return;
    }
    echo "not assigned";
    return;
} else if ($_GET['action'] == "remove") {
    $subject_name = $_GET['subject_name'];
    $subject = new Subject();
    $subject_id = $subject->getSubjectByName($subject_name)->subject_id;
    $author_id = $_GET['author_id'];
    if ($author->deAssignSubject($subject_id, $author_id)) {
        echo "removed";
        return;
    }
    echo "failed";
}
