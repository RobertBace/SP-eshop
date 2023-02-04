<?php
$layout = 'auth';
/** @var Array $data */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/styl.css">
    <script src="public/js/script.js"></script>
</head>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Registracia</h5>
                    <div class="text-center text-danger mb-3">
                        <?= @$data['message'] ?>
                    </div>
                    <form class="form-signin" method="post" action="?c=auth&a=store">
                        <div class="form-label-group mb-3">
                            <input input type="email" name="email" class="form-control"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="E-mail"
                                   <?php if($data != null){?>value="<?php echo $data['email']?>" <?php }?>>
                        </div>

                        <div class="form-label-group mb-3">
                            <input name="username" type="text" class="form-control" placeholder="Username"
                                   maxlength="20"
                                   <?php if($data != null){?>value="<?php echo $data['username']?>" <?php }?> >
                        </div>

<!--                        ^: anchored to beginning of string-->
<!--                        \S*: any set of characters-->
<!--                        (?=\S{8,}): of at least length 8-->
<!--                        (?=\S*[a-z]): containing at least one lowercase letter-->
<!--                        (?=\S*[A-Z]): and at least one uppercase letter-->
<!--                        (?=\S*[\d]): and at least one number-->
<!--                        $: anchored to the end of the string-->

                        <div class="form-label-group mb-3">
                            <input name="password" type="password" class="form-control"
                                   placeholder="Password" required
                                   pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$">
                        </div>

                        <div class="form-label-group mb-3">
                            <input name="repassword" type="password" class="form-control"
                                   placeholder="Reenter Password" required
                                   pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" name="submit">Registrovať
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>