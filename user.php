<?php
require_once 'includes/header.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

$user = getUser($id);
?>
<section>
    <div class="container bg-dark">
        <div class="row">
            <div class="col-5"><img src="<?php echo getAvatar($user, 300); ?>" alt="" class="d-block w-100"></div>
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <div class="h1"><?php echo $user['first_name'] ?></div>
                        <div class="h5">Inscrit <?php echo getDateForHumans($user['created_at']); ?></div>
                        <div class="list-group">
                            <div class="list-group-item bg-dark"><span class="text-muted">Nom :</span> <?php echo $user['last_name'] ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">Prénom :</span> <?php echo $user['first_name'] ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">Adresse Email :</span> <?php echo $user['email'] ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">N° de téléphone :</span> <?php echo !$user['phone_number'] ? 'Non renseigné' : $user['phone_number']; ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">Date de naissance :</span> <?php echo !$user['birthday'] ? 'Non renseigné' : $user['birthday']; ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">Genre :</span> <?php echo $user['gender'] != 1 ? ($user['gender'] != 2 ? "Autre" : "Femme" ) : "Homme" ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>


