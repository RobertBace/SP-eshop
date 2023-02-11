<?php
$layout = 'auth';
/** @var Array $data */
?>

<div class="background">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body bg-color-blue transprency">
                        <h5 class="card-title text-center">Prihlásenie</h5>
                        <div class="text-center text-danger mb-3">
                            <?= @$data['message'] ?>
                        </div>
                        <form class="form-signin" method="post" action="?c=auth&a=login">
                            <div class="form-label-group mb-3">
                                <input type="email" name="email" id="email" class="form-control"
                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="E-mail">
                            </div>

                            <div class="form-label-group mb-3">
                                <input name="password" type="password" id="password" class="form-control"
                                       placeholder="Password" required>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit" name="submit">Prihlásiť
                                </button>
                            </div>
                        </form>

                        <div class="card-body text-center mt-3 pb-0">
                            <a href="?c=auth&a=registration">Vytvoriť nový učet!</a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>