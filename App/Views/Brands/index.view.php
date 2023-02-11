<?php
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var Array $data */

?>
<div class="background">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body bg-color-blue">
                        <h3 class="card-title text-center">Nová značka bicykla</h3>
                        <div class="text-center text-danger mb-3">
                            <?= @$data['message'] ?>
                        </div>
                        <form class="form-signin" method="post" action="?c=brands&a=store">
                            <div class="form-label-group mb-3">
                                <input name="title" type="text" required class="form-control">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit" name="submit">Pridaj
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body bg-color-blue">
                        <h3 class="card-title text-center pt-3">Existujúce značky</h3>
                        <div class="text-center text-danger mb-1">
                            <?= @$data['messageInfo'] ?>
                        </div>
                        <div>
                            <ul class="list-group pt-5">
                                <?php foreach ($data['znacky'] as $current) { ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center brandFont ">
                                        - <?php echo $current->getName() ?>
                                        <div class="row">
                                            <a href="?c=brands&a=update&id=<?php echo $current->getId() ?>"
                                               class="button btn btn-warning buttonCeenter brandButton mb-0 mx-2">Uprav</a>
                                            <a href="?c=brands&a=delete&id=<?php echo $current->getId() ?>"
                                               class="button btn btn-danger buttonCeenter brandButton mb-0">Vymaz</a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
