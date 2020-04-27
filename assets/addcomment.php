<?php

require_once '../includes/helpers.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

session_start();

$data = [];
$fields = [];
$errored = false;

foreach ($_POST as $name => $value) {
    $errored = !$value ? true : $errored;
    $data[$name] = $value;
    $fields[$name]['old'] = $value;
    $fields[$name]['error'] = !$value ? 'Ce champ est obligatoire' : NULL;
}

if ($errored) {
    $_SESSION['fields'] = $fields;
    $pathError =  "/post.php?id=$id&errored=true";
    header('Location: '. $pathError);
}
else {
    addComment($data, $_SESSION['auth_id'], $id);

    $pathSuccess =  "/post.php?id=$id";
    header('Location: '. $pathSuccess);
}
