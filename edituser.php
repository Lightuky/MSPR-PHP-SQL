<?php
require_once 'includes/header.php';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$user = getUser($id);
?>
<section>
    <div class="container bg-dark">
        <div class="row">
            <div class="col-5"><img src="<?php echo getAvatar($user, 300); ?>" alt="photo" class="d-block w-100"></div>
            <div class="col-7">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="h1"><?php echo $user['first_name'] ?></div>
                        <div class="h5">Inscrit <?php echo getDateForHumans($user['created_at']); ?></div>
                        <form method="post" action="assets/updateuser.php?id=<?php echo $id ?>">
                            <div class="list-group-item bg-dark">
                                <span class="text-muted">Nom :</span>
                                <input type="text" name="last_name" id="last_name" value="<?php echo $user['last_name'] ?>" class="ml-3">
                            </div>
                            <div class="list-group-item bg-dark">
                                <span class="text-muted">Prénom :</span>
                                <input type="text" name="first_name" id="first_name" value="<?php echo $user['first_name'] ?>" class="ml-3">
                            </div>
                            <div class="list-group-item bg-dark">
                                <span class="text-muted">Adresse Email :</span>
                                <input type="text" name="email" id="email" value="<?php echo $user['email'] ?>" class="ml-3">
                            </div>
                            <div class="list-group-item bg-dark">
                                <span class="text-muted">N° de téléphone :</span>
                                <input type="text" name="phone_number" id="phone_number" value="<?php echo !$user['phone_number'] ? '' : $user['phone_number']; ?>" class="ml-3">
                            </div>
                            <div class="list-group-item bg-dark">
                                <span class="text-muted">Date de naissance :</span>
                                <input type="date" name="birthday" id="birthday" value="<?php echo !$user['birthday'] ? '' : $user['birthday']; ?>" class="ml-3">
                            </div>
                            <div class="list-group-item bg-dark">
                                <span class="text-muted">Genre :</span>
                                <select id="gender" name="gender" class="ml-3">
                                    <option value="1" <?php if ($user['gender'] === '1' ) echo 'selected'; ?>>Homme</option>
                                    <option value="2" <?php if ($user['gender'] === '2' ) echo 'selected'; ?>>Femme</option>
                                    <option value="3" <?php if ($user['gender'] === '3' ) echo 'selected'; ?>>Autre</option>
                                </select>
                            </div>
                            <?php if (isset($_SESSION['auth_id'])) {
                                if ($id == $_SESSION['auth_id']) { ?>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-success mr-2 mt-3">Sauvegarder</button>
                                    </div>
                                <?php }
                            } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>


