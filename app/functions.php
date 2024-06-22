<?php

$db = mysqli_connect('db', 'user', 'secret', 'rcs16-db');

function getArticles(){
    global $db;
    return mysqli_query($db,'SELECT * FROM `articles`');
}

function insertArticles(array $post){
    global $db;
    $title = $post['title'];
    $imageurl = $post['imageurl'];
    $body = $post['body'];
    mysqli_query($db, "INSERT INTO `articles` (`title`, `image_url`, `body`) VALUES ('" . $title . "', '" . $imageurl . "', '" . $body . "')");
}

function deleteArticle(int $id){
    global $db;
    mysqli_query($db, "DELETE FROM `articles` WHERE `id`= $id");
}

function editArticle(array $get){
    global $db;
    $article = array();
    $id = $get["edit"];
    $result = mysqli_query($db,"SELECT * FROM `articles`  WHERE `id`= $id");
    if (mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }
    return [];
}

function updateArticle(array $post){
    global $db;
    $id = $post["id"];
    $title = $post['title'];
    $image = $post['image_url'];
    $body = $post['contents'];
    mysqli_query($db, "UPDATE `articles` SET `title` = '$title', `image_url` = '$image', `body` = '$body' WHERE `id`= $id");
}

?>