<?php
session_start();
include_once ("database.inc.php");

// likeImageID
$likeImageID = $_SESSION['imageID'];
// likeSenderID
$likeSenderID = $_SESSION['userID'];

$deleteLike = $conn->prepare("DELETE FROM likes
                              WHERE likeImageID = $likeImageID AND likeSenderID = $likeSenderID");
$deleteLike->execute();