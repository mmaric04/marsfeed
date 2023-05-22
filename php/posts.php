<?php
require_once("DatabaseAccess.php");


function getPostsFromDb()
{
    $dbAccess = getDbAccess();
    return $dbAccess->executeQuery("SELECT * FROM Posts ORDER BY date_time DESC");
}

function getPostHeartsFromDb($post_id)
{
    $dbAccess = getDbAccess();
    $result = $dbAccess->executeQuery("SELECT total_hearts FROM Posts WHERE id = $post_id");
    return $result[0][0];
}

function getPostBookmarksFromDb($post_id)
{
    $dbAccess = getDbAccess();
    $result = $dbAccess->executeQuery("SELECT total_bookmarks FROM Posts WHERE id = $post_id");
    return $result[0][0];
}

function getCommentsFromDb($post_id)
{
    $dbAccess = getDbAccess();
    return $dbAccess->executeQuery("SELECT * FROM Comments WHERE post_id = $post_id");
}

function generateCommentsHtml($post_id){
    $html = "";

    $comments = getCommentsFromDb($post_id);

    foreach($comments as $comment){
        $id = $comment[0];
        $username = $comment[1];
        $comment = $comment[2];
        $post_id= $comment[3];

        $html .=    "<div class='posted-comment'>
                        <div class='commenter'>
                            <img src='images/avatar.png' class='second_picture'>
                            <h5>
                                <a href='#'>$username</a>
                            </h5>
                        </div>
                        <div class='typed-comment'>
                            <p>$comment</p>
                        </div>
                    </div>";
    }
    return $html;
}


function generatePostsHtml(){
    $html = "";

    $posts = getPostsFromDb();

    foreach($posts as $post){
        $id = $post[0];
        $username = $post[1];
        $picture_path = $post[2];
        $is_hearted = $post[3];
        $total_hearts = $post[4];
        $is_bookmarked = $post[5];
        $total_bookmarks = $post[6];
        $description = $post[7];
        $title = $post[8];
        $date_time = $post[9];
        $heart_class = $is_hearted == '1' ? "fa-solid" : "fa-regular";
        $bookmark_class = $is_bookmarked == '1' ? "fa-solid" : "fa-regular";
        $comments = generateCommentsHtml($id);

        $html .= "<div class='article'>
                    <h2>$title</h2>
                    <h5>$username | $date_time</h5>
                    <p>$description</p>
                    <div class='img_main'><img src='$picture_path'>
                        <div class='heart-bookmark' data-post-id='$id'>
                            <div class='heart-wrapper'>
                                <button><i class='fa fa-heart $heart_class'></i></button>
                                <span class='total-hearts'>$total_hearts</span>
                            </div>
                            <div class='bookmark-wrapper'>
                                <button><i class='fa fa-bookmark $bookmark_class'></i></button>
                                <span class='total-bookmarks'>$total_bookmarks</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class='all-posted-comments' " . (empty($comments) ? "style='display:none;'":"") ."'>"
                    .
                        $comments
                    .
                    "</div>
                    <!--dio sa komentarom-->
                    <div class='comment'>
                        <div class='commenter'>
                            <img src='images/avatar.png' class='second_picture'>
                            <h5>
                                <a href='#'>Laura James</a>
                            </h5>
                        </div>
                        <div class='comment-box-post-button' data-post-id='$id'>
                            <input type='text' class='comment-box' placeholder='Enter comment'>
                            <button class='post-button'>Post</button>
                        </div>
                    </div>
                    <br>
                    </div>";
    }

    return $html;
}

function addPost($title, $description, $picture, $username){
    $date_time = date('Y-m-d H:i:s');
    $result = new stdClass();
    $result->success = 1;
    $result->error = "";
    $result->id = -1;
    if($picture != null){
        $result = uploadPicture($picture);
    }
    if($result->success){
        $picture_path = $picture == null ? "" : 'images/' . $picture["name"];
        $result->id = getDbAccess()->executeInsertQuery("INSERT INTO Posts (title, description, picture_path, username, date_time)
        VALUES ('$title', '$description', '$picture_path', '$username', '$date_time');");
    }
    return $result; 
}

function uploadPicture($picture){
    $target_dir = "/var/www/html/MaricM/MarsFeed/images/";
    $target_file = $target_dir . basename($picture["name"]);
    $uploadOk = 1;
    $error = "";
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($picture["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $error = "File is not an image.";
        $uploadOk = 0;
    }
    
    if (file_exists($target_file)) {
        $error = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    if ($picture["size"] > 5000000) {
        $error = "Sorry, your file is too large. (Larger than 5MB)";
        $uploadOk = 0;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if($uploadOk == 1) {
        if (move_uploaded_file($picture["tmp_name"], $target_file)) {
            $uploadOk = 1;
        } else {
            $error = "Sorry, there was an error uploading your file.";
            $uploadOk = 0;
        }
    }
    $return = new stdClass();
    $return->error = $error;
    $return->success = $uploadOk;
    $return->id = -1;
    return $return;
}

function togglePostHeart($id, $is_hearted){
    $total_hearts = getPostHeartsFromDb($id);
    $is_hearted == 1 ? $total_hearts++ : $total_hearts--;
    getDbAccess()->executeSetQuery("UPDATE Posts SET is_hearted='$is_hearted', total_hearts='$total_hearts' WHERE id='$id';");
    return $total_hearts;
}

function togglePostBookmark($id, $is_bookmarked){
    $total_bookmarks = getPostBookmarksFromDb($id);
    $is_bookmarked == 1 ? $total_bookmarks++ : $total_bookmarks--;
    getDbAccess()->executeSetQuery("UPDATE Posts SET is_bookmarked='$is_bookmarked', total_bookmarks='$total_bookmarks' WHERE id='$id';");
    return $total_bookmarks;
}

   