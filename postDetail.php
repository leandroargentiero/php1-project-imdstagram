<?php
    include_once ("includes/no-session.inc.php");
    include_once ("includes/nav.inc.php");
    include_once ("classes/postDetail.class.php");
    $visible = "";
    $_SESSION['imageID'] = $_GET['imageID'];

    if(isset($_GET['imageID'])){
        $post = new postDetail();
        $image = $post->getImage($_GET['imageID']);
        $avatar = $post->getAvatar($_GET['imageID']);
        $username = $post->getUsername($_GET['imageID']);
        $postTime = $post->getPostHour($_GET['imageID']);
        $likeCount = $post->getLikes($_GET['imageID']);
        $userID = $post->getUserID($_GET['imageID']);
        $description = $post->getDescription($_GET['imageID']);

        $likeCheck = $post->likeCheck($_GET['imageID']);
        if($likeCheck)
        {
            $source = "images/heart_filled.png";
            $class = "btnUnlike";
        }
        else
        {
            $source = "images/heart_blank.png";
            $class = "btnLike";
        }
    }

    if ($username['username'] == $_SESSION['username']){
        $visible = "visible";
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
</head>

<body>
    <div class="postDetail">
        <div class="innerLeft">
            <figure class="<?php echo $image['filter']; ?>">
                <img src="<?php echo $image['fileLocation']; ?>" alt="">
            </figure>
        </div>
        <div class="innerRight">
            <div class="innerRightContainer">
                <div class="innerRightHeader">

                    <a href="profile.php?userID=<?php echo $userID['imageUserID']; ?>"><img class="avatarPostDetail" src="<?php echo $avatar['avatar']; ?>" alt=""></a>
                    <a href="profile.php?userID=<?php echo $userID['imageUserID']; ?>"><p class="name"><?php echo $username['username']; ?></p></a>
                    </ul>
                </div>
                <div class="innerRightSecondHeader">
                    <p class="likes"><?php

                                       if($likeCount == 0) {
                                           echo "No likes yet";
                                       }
                                       elseif($likeCount == 1)
                                       {
                                           echo $likeCount." Like";
                                       }
                                       else
                                       {
                                           echo $likeCount." Likes";
                                       }
                                     ?>
                    </p>
                    <p class="timestamp"><?php echo $postTime ?></p>
                </div>
                <div class="commentFeed">
                    <ul class="commentFeed-holder">
                        <?php $comments = array("a", "b", "c", "d"); ?>
                            <?php foreach( $comments as $key => $comment): ?>
                            <li class="commentFeed-items" id="_1"><span class="comment-username">kennymng</span><span class="comment-text">je foto is lelijk.</span></li>
                            <?php endforeach; ?>

                    </ul>
                </div>
                <div class="innerRightFooter">
                    <form id="commentForm" class="innerRightFooterForm" action="" method="post">
                        <img id="heart" class="likeHeart <?php echo $class ?>" src="<?php echo $source ?>" alt="like"
                        value="<?php echo $_GET['imageID']; ?>">
                        <input id="commentField" type="text" name="commentField" placeholder="Add a comment...">
                        <input id="comment-btn-submit" type="submit" style="position: absolute; left: -9999px"/>
                    </form>
                    
                    <span class="glyphicon glyphicon-trash" id="<?php echo $visible; ?>" aria-hidden="true" title="Verwijder je foto"></span>
                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="userID" value="1">
    <input type="hidden" id="userName" value="kennymng">
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/scripts.js">


</script>
</html>