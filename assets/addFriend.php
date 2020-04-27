<?php

require_once '../includes/helpers.php';

$pending = isset($_GET['s']) ? $_GET['s'] : null;
$user_id = isset($_GET['id']) ? $_GET['id'] : null;

session_start();

if ($pending === '0') {
    addFriend(1, $_SESSION['auth_id'], $user_id);
    $pathSuccess =  "/user.php?id=$user_id";
    header('Location: '. $pathSuccess);
}
elseif ($pending === '1') {
    acceptFriendRequest(2, $_SESSION['auth_id'], $user_id);
    $pathSuccess =  "/user.php?id=$user_id";
    header('Location: '. $pathSuccess);
}
elseif ($pending === '2') {
    deleteFriend(2, $_SESSION['auth_id'], $user_id);
    $pathSuccess =  "/user.php?id=$user_id";
    header('Location: '. $pathSuccess);
}
else {
    dd('3');
}
