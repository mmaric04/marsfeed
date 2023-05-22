<?php
require_once("DatabaseAccess.php");

function addComment($comment, $postId, $username){
    $result = new stdClass();
    $result->success = 1;
    $result->error = "";
    $result->id = -1;
    $result->id = getDbAccess()->executeInsertQuery("INSERT INTO Comments (comment, username, post_id)
        VALUES ('$comment', '$username', '$postId');");
    return $result; 
}