<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/env.php';

use Carbon\Carbon;

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

function getUsers($id) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("SELECT * FROM users WHERE id != $id LIMIT 5");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    $stmt = $dbh->prepare("SELECT users.id, users.first_name, users.last_name, posts.* FROM users LEFT JOIN posts ON users.id = posts.author_id WHERE posts.author_id != 'NULL' ORDER BY date_added DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPopularPublications() {
    $dbh = connectDB();
    $stmt = $dbh->prepare("SELECT users.id, users.first_name, users.last_name, posts.* FROM users LEFT JOIN posts ON users.id = posts.author_id WHERE posts.author_id != 'NULL' ORDER BY upvotes DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getComments($post) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("SELECT comments.*, users.id, users.first_name, users.last_name FROM comments LEFT JOIN users ON users.id = comments.author_id WHERE comments.post_id = $post");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addComment($data, $author, $post_id) {
    $dbh = connectDB();
    $stmt = $dbh->prepare( "INSERT INTO comments (author_id, post_id, content) VALUES (:author_id, :post_id, :content)");
    $stmt->bindValue(':author_id', $author);
    $stmt->bindValue(':post_id', $post_id);
    $stmt->bindValue(':content', $data['content']);
    $stmt->execute();
}

function addNewPost($data, $author) {
    $dbh = connectDB();
    $stmt = $dbh->prepare( "INSERT INTO posts (author_id, content) VALUES (:author_id, :content)");
    $stmt->bindValue(':author_id', $author);
    $stmt->bindValue(':content', $data['content']);
    $stmt->execute();
}

function getPost($id) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("SELECT users.id, users.first_name, users.last_name, posts.* FROM users LEFT JOIN posts ON users.id = posts.author_id WHERE posts.id = :id LIMIT 1");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getDateForHumans($date) {
    $c = new Carbon($date, 'Europe/Paris');
    return $c->diffForHumans();
}

function addLike($id) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("UPDATE posts SET upvotes = upvotes + 1 WHERE id = $id");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function checkFriend($auth_id, $user2) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("SELECT * FROM friends WHERE (user1_id = :user1_id AND user2_id = :user2_id) OR (user1_id = :user2_id AND user2_id = :user1_id)");
    $stmt->bindValue(':user1_id', $auth_id);
    $stmt->bindValue(':user2_id', $user2);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addFriend($pending, $auth_id, $user2_id) {
    $dbh = connectDB();
    $stmt = $dbh->prepare( "INSERT INTO friends (user1_id, user2_id, pending) VALUES (:user1_id, :user2_id, :pending)");
    $stmt->bindValue(':user1_id', $auth_id);
    $stmt->bindValue(':user2_id', $user2_id);
    $stmt->bindValue(':pending', $pending);
    $stmt->execute();
}

function acceptFriendRequest($pending, $auth_id, $user2_id) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("UPDATE friends SET pending = :pending WHERE user1_id = :user1_id AND user2_id = :user2_id");
    $stmt->bindValue(':pending', $pending);
    $stmt->bindValue(':user1_id', $user2_id);
    $stmt->bindValue(':user2_id', $auth_id);
    $stmt->execute();
}

function deleteFriend($pending, $auth_id, $user2_id) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("DELETE FROM friends WHERE (user1_id = :user1_id AND user2_id = :user2_id AND pending = :pending) OR (user1_id = :user2_id AND user2_id = :user1_id AND pending = :pending)");
    $stmt->bindValue(':pending', $pending);
    $stmt->bindValue(':user1_id', $auth_id);
    $stmt->bindValue(':user2_id', $user2_id);
    $stmt->execute();
}

function updateUser($data, $id) {
    $dbh = connectDB();
    $stmt = $dbh->prepare("UPDATE users SET last_name = :last_name, first_name = :first_name, email = :email, phone_number = :phone_number, birthday = :birthday, gender = :gender, updated_at = :updated_at WHERE id = $id");
    $stmt->bindValue(':last_name', $data['last_name']);
    $stmt->bindValue(':first_name', $data['first_name']);
    $stmt->bindValue(':email', $data['email']);
    $stmt->bindValue(':phone_number', $data['phone_number']);
    $stmt->bindValue(':birthday', $data['birthday']);
    $stmt->bindValue(':gender', $data['gender']);
    $stmt->bindValue(':updated_at', date("Y-m-d H:i:s", time()));
    $stmt->execute();
}