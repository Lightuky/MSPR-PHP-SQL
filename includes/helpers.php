<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/env.php';

function dd($var) {
    var_dump($var);
    die();
}

function connectDB() {
    global $database;

    $host = $database['host'];
    $dbname = $database['dbname'];
    $username = $database['username'];
    $password = $database['password'];

    return new PDO("mysql:host=$host;dbname=$dbname", "$username","$password", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}

function getUser($id) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function setNewUser($data) {

    $dbh = connectDB();
    $stmt = $dbh->prepare( "INSERT INTO users (first_name, last_name, email, gender, password) VALUES (:first_name, :last_name, :email, :gender, :password)");
    $stmt->bindValue(':first_name', $data['first_name']);
    $stmt->bindValue(':last_name', $data['last_name']);
    $stmt->bindValue(':email', $data['email']);
    $stmt->bindValue(':gender', $data['gender']);
    $stmt->bindValue(':password', sha1($data['password']));
    $stmt->execute();

    return $dbh->lastInsertId();
}

function authUser($data) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1");
    $stmt->bindValue(':email', $data['email']);
    $stmt->bindValue(':password', sha1($data['password']));
    $stmt->execute();
    return $stmt->fetch();
}

function authOut() {
    session_destroy();
}

function getUserPublications() {
    $dbh = connectDB();
    $stmt = $dbh->prepare("SELECT users.id, users.first_name, users.last_name, posts.* FROM users LEFT JOIN posts ON users.id = posts.author_id WHERE posts.author_id != 'NULL'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countComments($post) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("SELECT * FROM comments WHERE comments.post_id = $post");
    $stmt->execute();
    return count($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function addNewPost($data, $author) {
        $dbh = connectDB();
        $stmt = $dbh->prepare( "INSERT INTO posts (author_id, content) VALUES (:author_id, :content)");
        $stmt->bindValue(':author_id', $author);
        $stmt->bindValue(':content', $data['content']);
        $stmt->execute();
}

function getDateForHumans($date) {
    return \Carbon\Carbon::make($date)->diffForHumans();
}

function getAvatar($user, $size = 300) {
    return "https://www.gravatar.com/avatar/". md5($user['email']) . "?s=$size";
}