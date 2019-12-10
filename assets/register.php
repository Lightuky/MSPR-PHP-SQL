<?php

require_once '../includes/helpers.php';

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
    session_start();
    $_SESSION['fields'] = $fields;
    $pathError =  '/register.php?errored=true';
    header('Location: '. $pathError);
}
else {
    $id = setNewUser($data);

    $pathError =  '/index.php';
    header('Location: '. $pathError);

    session_start();
    $user = $id;
}