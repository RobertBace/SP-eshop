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
                        <h3 class="card-title text-center">Zmena nazvu značky [<?php echo $data['brand']->getName() ?>]</h3>
                        <div class="text-center text-danger mb-3">
                            <?= @$data['message'] ?>
                        </div>
                        <form class="form-signin" method="post"
                              action="?c=brands&a=store&id=<?php echo $data['brand']->getId() ?>">
                            <div class="form-label-group mb-3">
                                <input name="title" type="text" required class="form-control"
                                       value="<?php echo $data['brand']->getName() ?>">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit" name="submit">Uprav
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>