<?php
session_start();
include_once ("database.inc.php");

$likeImageID = $_POST['nieuweLike'];
// likeSenderID
$likeSenderID = $_SESSION['userID'];

$getReceiverID = $conn->prepare("SELECT imageUserID
                                 FROM posts
                                 WHERE imageID = :imageID");
$getReceiverID->bindValue(":imageID", $likeImageID);
$getReceiverID->execute();
$result = $getReceiverID->fetch(PDO::FETCH_ASSOC);
// likeReceiverID
$likeReceiverID = $result['imageUserID'];

if(!empty($likeReceiverID)){
    $statement = $conn->prepare("INSERT INTO likes (likeImageID, likeSenderID, likeReceiverID)
                                VALUES (:likeImageID, :likeSenderID, :likeReceiverID)");
    $statement->bindValue(':likeImageID', $likeImageID);
    $statement->bindValue(':likeSenderID', $likeSenderID);
    $statement->bindValue(':likeReceiverID', $likeReceiverID);
    $statement->execute();
}



