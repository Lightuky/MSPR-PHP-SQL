<?php
require_once 'vendor/autoload.php';
require_once 'includes/config.php';
require_once 'includes/helpers.php';
require_once 'includes/db.php';
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>NomReseau</title>
    <link rel="stylesheet" href="./public/css/app.css">
</head>
<body>
<div id="app">
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Accueil</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="messages.php">Messages</a></li>
                    <li class="nav-item"><a class="nav-link" href="groups.php">Groupes</a></li>
                    <li class="nav-item"><a class="nav-link" href="events.php">Evenements</a></li>
                </ul>
            </div>
            <?php
            if (empty($_SESSION['slug'])) {
                ?><a href="login.php" class="btn btn-primary">Connexion</a><?php
            }
            else {
                ?><a href="profile.php?id=<?php echo $_SESSION['slug'] ?>" class="btn btn-info">Mon Profil</a>
                <a href="disconnect.php" class="btn btn-danger ml-4 rounded-circle font-weight-bold" title="Déconnexion">X</a><?php
            }
            ?>
        </nav>
    </header>
    <main id="main" class="bg-dark">