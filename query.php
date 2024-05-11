<?php

$other_question = "SELECT * FROM questions WHERE question_category = 'other'";
$mdd_question = "SELECT * FROM questions WHERE question_category = 'mdd'";
$apd_question = "SELECT * FROM questions WHERE question_category = 'apd'";
$dmdd_question = "SELECT * FROM questions WHERE question_category = 'dmdd'";
$odd_question = "SELECT * FROM questions WHERE question_category = 'odd'";
$gd_question = "SELECT * FROM questions WHERE question_category = 'gd'";
$ed_question = "SELECT * FROM questions WHERE question_category = 'ed'";
$dd_question = "SELECT * FROM questions WHERE question_category = 'dd'";
$bpd_question = "SELECT * FROM questions WHERE question_category = 'bpd'";
$sp_question = "SELECT * FROM questions WHERE question_category = 'sp'";
$pd_question = "SELECT * FROM questions WHERE question_category = 'pd'";

$other_result = mysqli_query($conn, $other_question) or die(mysqli_error($conn));
$mdd_result = mysqli_query($conn, $mdd_question) or die(mysqli_error($conn));
$apd_result = mysqli_query($conn, $apd_question) or die(mysqli_error($conn));
$dmdd_result = mysqli_query($conn, $dmdd_question) or die(mysqli_error($conn));
$odd_result = mysqli_query($conn, $odd_question) or die(mysqli_error($conn));
$gd_result = mysqli_query($conn, $gd_question) or die(mysqli_error($conn));
$ed_result = mysqli_query($conn, $ed_question) or die(mysqli_error($conn));
$dd_result = mysqli_query($conn, $dd_question) or die(mysqli_error($conn));
$bpd_result = mysqli_query($conn, $bpd_question) or die(mysqli_error($conn));
$sp_result = mysqli_query($conn, $sp_question) or die(mysqli_error($conn));
$pd_result = mysqli_query($conn, $pd_question) or die(mysqli_error($conn));

// Program begin


?>