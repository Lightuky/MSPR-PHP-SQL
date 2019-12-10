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

    return new PDO("mysql:host=$host;dbname=$dbname", "$username","$password");
}

function getUser($id) {
    $dbh = connectDB();
    $stmt = $dbh->query("SELECT * FROM users WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function getUsers() {
    $dbh = connectDB();
    $stmt = $dbh->query("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll();
}

function setNewUser($data) {

    $dbh = connectDB();
    $stmt = $dbh->prepare( "INSERT INTO users (first_name, last_name, email, gender, password) VALUES (:first_name, :last_name, :email, :gender, :password)");
    $stmt->bindValue(':first_name', $data['first_name']);
    $stmt->bindValue(':last_name', $data['last_name']);
    $stmt->bindValue(':email', $data['email']);
    $stmt->bindValue(':gender', $data['gender']);
    $stmt->bindValue(':password', $data['password']);
    $stmt->execute();

    return $dbh->lastInsertId();
}


function authUser($data) {
    $dbh = connectDB();
    $stmt = $dbh->query("UPDATE users SET is_logged = :is_logged, updated_at = :updated_at WHERE email = :email AND password = :password");
    $stmt->execute([
        ":updated_at" => date("Y-m-d H:i:s", strtotime('+1 hours')),
        "is_logged" => 1,
        "email" => $data['email'],
        "password" => $data['password'],
    ]);

    getAuth($data);
}

function getAuth($data) {
     dd($data);
}


function getUserPublications() {
    $dbh = connectDB();
    $dbh->query("SELECT * FROM posts");
    return $dbh->fetchAll();
}