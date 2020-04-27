<?php
require_once 'includes/header.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

$post = getPost($id);
$comments = getComments($id);
?>
<section>
    <div class="container">
        <div class="card mt-4 text-center mx-auto w-75" id="post-window">
            <div class="card-header">
                <span class="h2">Auteur : <?php echo $post['first_name'] . " " . $post['last_name'] ?></span>
                <?php if (isset($_SESSION['auth_id'])) {
                    if ($post['author_id'] == $_SESSION['auth_id']) { ?>
                        <div class="d-flex float-right">
                            <a href="assets/editPost.php?id=<?php echo $id ?>" class="mr-2 mt-1" title="Editer"><img src="img/edit.png" alt="Editer" style="width: 30px;"></a>
                            <a href="assets/deletePost.php?id=<?php echo $id ?>" class="ml-2 mt-1" title="Supprimer"><img src="img/orange.png" alt="Supprimer" style="width: 30px;"></a>
                        </div>
                    <?php }
                } ?>
            </div>
            <div class="card-body mt-2">
                <div class="h5 text-muted"><?php echo $post['content'] ?></div>
                <div class="text-muted mt-4">Publié <?php echo getDateForHumans($post['date_added']); ?></div>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-around">
                    <div class="d-flex text-muted" title="Likes"><?php echo $post['upvotes'] ?><a href="assets/addLikePost.php?id=<?php echo $post['id'] ?>" class="text-muted ml-2"><img src="img/orange.png" alt="Likes" style="width: 30px;"></a></div>
                    <div class="d-flex text-muted" title="Commentaires"><?php echo count(getComments($post['id'])); ?><img src="img/chat.png" alt="Commentaires" style="width: 30px;" class="ml-2"></div>
                    <div class="d-flex text-muted" title="Partages"><?php echo $post['shares'] ?><img src="img/share.png" alt="Partages" style="width: 30px;" class="ml-2"></div>
                </div>
            </div>
        </div>
        <div class="card mt-4 mx-auto w-50">
            <div class="card">
                <div class="card-header text-center">
                    Ajouter un commentaire
                </div>
                <div class="card-body mt-2">
                    <form method="post" action="assets/addcomment.php?id=<?php echo $id ?>">
                        <div class="form-group">
                            <label for="content" class="text-muted">Contenu du commentaire</label>
                            <textarea class="form-control mt-1" name="content" rows="3"></textarea>
                        </div>
                        <?php if (isset($_SESSION['auth_id'])) { ?>
                            <button class="btn btn-outline-info mt-3 m-auto">Envoyer</button>
                        <?php } else { ?>
                            <a href="login.php" class="btn btn-outline-info mt-3 m-auto">Envoyer</a>
                        <?php } ?>
                    </form>
                </div>
            </div>
            <div class="card mt-4 mx-auto w-50">
                <div class="card-header text-center">
                    <span class="h4">Commentaires</span>
                    <?php if (isset($_SESSION['auth_id'])) {
                        if ($post['author_id'] == $_SESSION['auth_id']) { ?>
                            <div class="d-flex float-right">
                                <a href="assets/editComment.php?id=<?php echo $id ?>" class="mr-2 mt-1" title="Editer"><img src="img/edit.png" alt="Editer" style="width: 30px;"></a>
                                <a href="assets/deleteComment.php?id=<?php echo $id ?>" class="ml-2 mt-1" title="Supprimer"><img src="img/orange.png" alt="Supprimer" style="width: 30px;"></a>
                            </div>
                        <?php }
                    } ?>
                </div>
                <?php foreach ($comments as $comment){ ?>
                    <div class="card mb-3">
                        <div class="card-body text-center pb-1">
                            <div class="text-muted"><span class="text-muted">Publié par :</span> <?php echo $comment['first_name'] . " " . $comment['last_name'] ?></div>
                            <div class="text-muted"><span class="text-muted">Commentaire :</span> <?php echo $comment['content'] ?></div>
                        </div>
                        <div class="card-body d-flex justify-content-around pt-0 pb-1">
                            <div class="d-flex text-muted"><?php echo $comment['upvotes'] ?><a href="assets/addLikeComment.php?id=<?php echo $comment['id'] ?>" class="text-muted ml-2"><img src="img/orange.png" alt="Likes" style="width: 30px;"></a></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
</section>

<?php require_once 'includes/footer.php'; ?>


