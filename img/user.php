<?php
require_once 'includes/header.php';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$user = getUser($id);
$friend = checkFriend($_SESSION['auth_id'], $id);
?>
<section>
    <div class="container bg-dark">
        <div class="row">
            <div class="col-5"><img src="https://www.gravatar.com/avatar/<?php echo md5($user['email']); ?>?s=600" alt="photo" class="d-block w-100"></div>
            <div class="col-7">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="h1"><?php echo $user['first_name'] ?></div>
                                <div class="h5">Inscrit <?php echo getDateForHumans($user['created_at']); ?></div>
                            </div>
                            <div class="col-6">
                                <?php if ($_SESSION['auth_id'] != $id): ?>
                                    <?php if (!$friend): ?>
                                        <a href="assets/addFriend.php?s=0&id=<?php echo $id ?>" class="btn btn-success">Ajouter en ami</a>
                                    <?php else: ?>
                                        <?php if ($friend['pending'] === '2'): ?>
                                            <div class="d-flex">
                                                <div class="btn bg-success text-white">Déja Amis</div>
                                                <div class="ml-4"><a href="assets/addFriend.php?s=2&id=<?php echo $id ?>" class="btn btn-danger">Supprimer l'ami</a></div>
                                            </div>
                                        <?php else: ?>
                                            <?php if ($friend['user1_id'] === $_SESSION['auth_id']): ?>
                                                <div class="btn bg-info text-white">Demande Envoyée</div>
                                            <?php elseif ($friend['user2_id'] === $_SESSION['auth_id']): ?>
                                                <a href="assets/addFriend.php?s=1&id=<?php echo $id ?>" class="btn btn-success">Accepter la demande</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item bg-dark"><span class="text-muted">Nom :</span> <?php echo $user['last_name'] ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">Prénom :</span> <?php echo $user['first_name'] ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">Adresse Email :</span> <?php echo $user['email'] ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">N° de téléphone :</span> <?php echo !$user['phone_number'] ? 'Non renseigné' : $user['phone_number']; ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">Date de naissance :</span> <?php echo !$user['birthday'] ? 'Non renseigné' : $user['birthday']; ?></div>
                            <div class="list-group-item bg-dark"><span class="text-muted">Genre :</span> <?php echo $user['gender'] != 1 ? ($user['gender'] != 2 ? "Autre" : "Femme") : "Homme" ?></div>
                        </div>
                        <?php if (isset($_SESSION['auth_id'])) {
                            if ($id == $_SESSION['auth_id']) { ?>
                                <div class="d-flex">
                                    <a href="edituser.php?id=<?php echo $id ?>" class="btn btn-secondary mr-2 mt-3">Editer mes infos</a>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>


