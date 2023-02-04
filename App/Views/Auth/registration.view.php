<?php
$layout = 'auth';
/** @var Array $data */
?>

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
                            <input type="email" name="email" class="form-control"
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