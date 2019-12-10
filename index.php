<?php
require_once 'includes/header.php';
use Carbon\Carbon;

?>

    <section>
        <div class="container bg-dark">
            <div class="row">
                <div class="col-3">
                    <div class="card card bg-dark text-white">
                        <div class="card-body">
                            <div class="h3">Accueil</div>
                            <div class="h3">Messages</div>
                            <div class="h3">Groupes</div>
                            <div class="h3">Evenements</div>
                        </div>
                    </div>
                </div>
                <div class="col-6" id="feed">
                    <div class="card bg-dark text-white">
                        <div class="card-header text-center">
                            Ajouter une publication
                        </div>
                        <div class="card-body mt-2">
                            <label for="content" class="text-muted">Contenu du post</label>
                            <input type="text-area" class="form-control mt-1" name="content" rows="3">
                            <button class="btn btn-outline-info mt-3">Envoyer</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-secondary text-white">
                        <input type="text" class="form-control" placeholder="Recherche">
                    </div>
                    <div class="card bg-secondary text-white mt-4">
                        <div class="card-header text-center h4">Posts populaires</div>
                        <div class="card-body text-center">
                            <div class="h5">test post 1</div>
                            <div class="h5">test post 2</div>
                            <div class="h5">test post 3</div>
                            <div class="h5">test post 4</div>
                            <div class="h5">test post 5</div>
                        </div>
                    </div>
                    <div class="card bg-secondary text-white mt-4">
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