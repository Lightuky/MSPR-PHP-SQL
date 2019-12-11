<?php
require_once 'includes/header.php';
use Carbon\Carbon;
$posts = getUserPublications();
?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-3 position-fixed" style="left: 8%;">
                    <div class="card-body">
                        <a href="index.php" class="h3 nav-link text-warning">Accueil</a>
                        <a href="messages.php" class="h3 nav-link text-warning">Messages</a>
                        <a href="groups.php" class="h3 nav-link text-warning">Groupes</a>
                        <a href="events.php" class="h3 nav-link text-warning">Evenements</a>
                    </div>
                </div>
                <div class="col-6" id="feed" style="overflow: hidden; margin-left: 22% !important;">
                    <div class="card">
                        <div class="card-header text-center">
                            Ajouter une publication
                        </div>
                        <div class="card-body mt-2">
                            <form method="post" action="assets/addpost.php">
                                <div class="form-group">
                                    <label for="content" class="text-light">Contenu du post</label>
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
                    <a href="post?id=<?php echo $post['id'] ?>" class="card mt-4">
                        <div class="card-body text-center">
                            <div><span class="text-muted">Publié par :</span> <?php echo $post['first_name'] . " " . $post['last_name'] ?></div>
                            <div><span class="text-muted">Contenu :</span> <?php echo $post['content'] ?></div>
                        </div>
                        <div class="card-body d-flex justify-content-around">
                            <div class="d-flex"><?php echo $post['upvotes'] ?><span class="text-muted ml-2"> Likes</span></div>
                            <div class="d-flex"><?php echo countComments($post['id']); ?><span class="text-muted ml-2"> Commentaires</span></div>
                            <div class="d-flex"><?php echo $post['shares'] ?><span class="text-muted ml-2"> Partages</span></div>
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
                            <div class="h5">test post 1</div>
                            <div class="h5">test post 2</div>
                            <div class="h5">test post 3</div>
                            <div class="h5">test post 4</div>
                            <div class="h5">test post 5</div>
                        </div>
                    </div>
                    <div class="card text-white mt-4">
                        <div class="card-header text-center h5">Utilisateurs suggérés</div>
                        <div class="card-body text-center">
                            <div class="h5">User 1</div>
                            <div class="h5">User 2</div>
                            <div class="h5">User 3</div>
                            <div class="h5">User 4</div>
                            <div class="h5">User 5</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>