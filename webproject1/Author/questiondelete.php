<?php

$id = $_GET['id'];

require_once("config.php");
require_once("../Models/Question.php");

$question = new Question();
$question->Delete($id);

header('location: allquestions.php');
