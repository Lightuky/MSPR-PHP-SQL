<?php
require_once 'includes/header.php';
use Carbon\Carbon;
$posts = getUserPublications();
$popular_posts = getPopularPublications();
if (isset($_SESSION['auth_id'])) {
    $users = getUsers($_SESSION['auth_id']);
} else {
    $users = getUsers(0);
}

?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-3 position-fixed" style="left: 8%;">
                    <div class="card-body">
                        <a href="index.php" class="h3 nav-link text-warning">Fil d'actualité</a>
                        <a href="messages.php" class="h3 nav-link text-warning">Messages</a>
                        <a href="groups.php" class="h3 nav-link text-warning">Amis</a>
                    </div>
                </div>
                <div class="col-6" id="feed" style="overflow: hidden; margin-left: 22% !important;">
                    <h1>Fil d'actualité</h1>
                    <div class="card" style="border-bottom: 1px solid lightgray">
                        <div class="card-header text-center">
                            Ajouter une publication
                        </div>
                        <div class="card-body mt-2">
                            <form method="post" action="assets/addpost.php">
                                <div class="form-group">
                                    <label for="content">Contenu du post</label>
                                    <textarea class="form-control mt-1" name="content" rows="3"></textarea>
                                </div>
                                <?php if (isset($_SESSION['auth_id'])) { ?>
                                    <button class="btn btn-outline-info mt-3">Envoyer</button>
                                <?php } else { ?>
                                    <a href="login.php" class="btn btn-outline-info mt-3">Envoyer</a>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                    <?php foreach ($posts as $post){ ?>
                        <a href="post?id=<?php echo $post['id'] ?>" class="card mt-4" style="border: 1px solid lightgray;" id="postitem">
                            <div class="card-body text-center">
                                <div class="font-weight-bold mb-2"><?php echo $post['content'] ?></div>
                                <div><span class="text-muted">Publié par :</span> <?php echo $post['first_name'] . " " . $post['last_name'] ?></div>
                            </div>
                            <div class="card-body d-flex justify-content-around">
                                <div class="d-flex"><?php echo $post['upvotes'] ?><img src="img/orange.png" alt="Likes" style="width: 25px; height: 25px" class="ml-2"></div>
                                <div class="d-flex"><?php echo count(getComments($post['id'])); ?><img src="img/chat.png" alt="Commentaires" style="width: 25px; height: 25px" class="ml-2"></div>
                                <div class="d-flex"><?php echo $post['shares'] ?><img src="img/share.png" alt="Partages" style="width: 25px; height: 25px" class="ml-2"></div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <div style="right: 0;" class="col-3 position-absolute mr-5">
                    <div class="card">
                        <input type="text" class="form-control" placeholder="Recherche">
                    </div>
                    <div class="card mt-4">
                        <div class="card-header text-center h4">Posts populaires</div>
                        <div class="card-body text-center">
                            <?php foreach ($popular_posts as $popular_post) { ?>
                                <div class="h5"><a href="post?id=<?php echo $popular_post['id'] ?>" class="nav-link text-warning p-0"><?php echo $popular_post['content'] ?></a></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header text-center h5">Utilisateurs suggérés</div>
                        <div class="card-body text-center">
                            <?php foreach ($users as $user) { ?>
                                <div class="h5"><a href="user.php?id=<?php echo $user['id'] ?>" class="nav-link text-warning p-0"><?php echo $user['first_name'] . " " . $user['last_name'] ?></a></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>