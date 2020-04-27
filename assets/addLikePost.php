<?php

require_once '../includes/helpers.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

addLike($id);

$pathSuccess =  "/post.php?id=$id";
header('Location: '. $pathSuccess);
