<?php
require_once("posts.php");
require_once("comments.php");

function processRequest(){
   $action = getRequestParameter("action");
   switch ($action) {
      case 'addPost':
         processAddPost();
         break;
      case 'addComment':
         processAddComment();
         break;
      case 'togglePostHeart':
         processTogglePostHeart();
         break;
      case 'togglePostBookmark':
         processTogglePostBookmark();
         break;
      default:
         echo(json_encode(array(
         "success" => false,
         "reason" => "Unknown action: $action"
         )));
         break;
   }
}

processRequest();

function processAddPost(){
   $title = $_POST['title'];
   $description = $_POST['description'];
   $username = $_POST['username'];
   $picture = null;
   if(!empty($_FILES['picture']['tmp_name']) && is_uploaded_file($_FILES['picture']['tmp_name'])){
      $picture = $_FILES['picture'];
   }

   $result = new stdClass();
   $result->success = 0;
   $result->error = "";
   $result->id = -1;
   if (!empty($title) && !empty($username)) {
      $result=addPost($title, $description, $picture, $username);
   }
   else {
      $result->error = "Title and username must not be empty";
   }
   echo(json_encode(array(
      "id" => $result->id,
      "success" => $result->success,
      "error" => $result->error
   )));
}

function processAddComment(){
   $comment = $_POST['comment'];
   $postId = $_POST['postId'];
   $username = $_POST['username'];

   $result = new stdClass();
   $result->success = 0;
   $result->error = "";
   $result->id = -1;
   if (!empty($comment) && !empty($postId) && !empty($username)) {
      $result=addComment($comment, $postId, $username);
   }
   else {
      $result->error = "Comment, post id and username must not be empty";
   }
   echo(json_encode(array(
      "id" => $result->id,
      "success" => $result->success,
      "error" => $result->error
   )));
}


  function getRequestParameter($key){
     return isset($_REQUEST[$key]) ? $_REQUEST[$key] : "";
  }

function processTogglePostHeart(){
   $success = false;
   $reason = "";
   $result = null;
   $id = getRequestParameter("id");
   $heart = getRequestParameter("heart");

   if (is_numeric($id) && is_numeric($heart)) {
      $result = togglePostHeart($id, $heart);
      $success = true;
   } else {
      $success = false;
      $reason = "Needs id:number; heart:number";
   }
   echo(json_encode(array(
      "success" => $success,
      "reason" => $reason,
      "result" => $result
   )));
}

function processTogglePostBookmark(){
   $success = false;
   $reason = "";
   $result = null;
   $id = getRequestParameter("id");
   $bookmark = getRequestParameter("bookmark");

   if (is_numeric($id) && is_numeric($bookmark)) {
      $result = togglePostBookmark($id, $bookmark);
      $success = true;
   } else {
      $success = false;
      $reason = "Needs id:number; bookmark:number";
   }
   echo(json_encode(array(
      "success" => $success,
      "reason" => $reason,
      "result" => $result
   )));
}