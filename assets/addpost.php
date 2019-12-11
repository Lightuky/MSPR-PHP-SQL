<?php

require_once '../includes/helpers.php';

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
    $pathError =  '/index.php?errored=true';
    header('Location: '. $pathError);
}
else {
    addNewPost($data, $_SESSION['auth_id']);

    $pathSuccess =  "/index.php";
    header('Location: '. $pathSuccess);
}
