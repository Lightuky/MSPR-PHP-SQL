<?php

require_once 'includes/header.php';
use Carbon\Carbon;

?>
    <section class="text-white">
        <div class="container text-dark">
            <h1>Mes discussions</h1>
            <div class="row">
                <div class="col-4">
                    <div class="card-header text-dark">
                        Mes contacts
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Lucie KERVICHE</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Yann LE BOUDEC</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Mathilde CHANTAL</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Antoine MOURAT</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Antoine SEGUIN</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Iris SOULABAIL</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Juliette BARRÉ</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Armand LIBAUD</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Pierre LOGRE</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Tiffen BONNET</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Chloé ROCHARD</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Dylan THIBOUST</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Romain SENGER</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Arthur FLAMBARD</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Enzo BAUDIN GERMON</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Vincent PLANQUET</div>
                            <div class="list-group-item-flush list-group-item-action my-1"><img src="img/account.png" class="mr-4">Alex SEVESQUE</div>
                        </div>
                    </div>
                </div>
                <div class="col-8 text-center" id="message-block">
                    <div class="card-header text-dark">
                        Messages
                    </div>
                    <div class="card-body">
                        <div class="row mb-3" id="message-read">
                            Nouvelles notifications
                        </div>
                        <div class="row d-flex justify-content-between" id="message-send">
                            <div>Envoyer un message</div>
                            <div class="my-auto mr-3"><button name="send" type="submit" class="btn btn-outline-info">Envoyer !</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once 'includes/footer.php'; ?>