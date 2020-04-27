<?php
require_once 'includes/header.php';
use Carbon\Carbon;
?>
    <section>
        <div class="container">
            <h1>Mes amis</h1>
            <div class="row text-center">
                <div class="col-3"><div class="card-header"><img src="img/friends.png" class="icon float-left" alt="">Tous mes amis</div></div>
                <div class="col-3"><div class="card-header"><img src="img/online.png" class="icon float-left" alt="">Mes amis en ligne</div></div>
                <div class="col-3"><div class="card-header"><img src="img/new-friend.png" class="icon float-left" alt="">Ajouts récents</div></div>
                <div class="col-3"><div class="card-header"><img src="img/birthday.png" class="icon float-left" alt="">Anniversaire(s)</div></div>
            </div>
        </div>
    </section>
<?php require_once 'includes/footer.php'; ?>