<?php
$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<?php $user = \App\Models\User::getOne($auth->getLoggedUserId()) ?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h3 class="card-title text-center pb-3 pt-1">Úprava profilu: <?= $user->getUsername() ?></h3>
                    <div class="text-center text-danger mb-3">
                        <?= @$data['message'] ?>
                    </div>
                    <label class="form-label">Username:</label>
                    <form class="form-signin" method="post" action="?c=auth&a=storeEdit">
                        <div class="form-label-group mb-3">
                            <input name="username" type="text" class="form-control" placeholder="Username"
                                   maxlength="20"
                                   value="<?php echo $user->getUsername()?>"  >
                        </div>

                        <!--                        ^: anchored to beginning of string-->
                        <!--                        \S*: any set of characters-->
                        <!--                        (?=\S{8,}): of at least length 8-->
                        <!--                        (?=\S*[a-z]): containing at least one lowercase letter-->
                        <!--                        (?=\S*[A-Z]): and at least one uppercase letter-->
                        <!--                        (?=\S*[\d]): and at least one number-->
                        <!--                        $: anchored to the end of the string-->
                        <label class="form-label">New password (optional):</label>
                        <div class="form-label-group mb-3">
                            <input name="password" type="password" class="form-control"
                                   placeholder=" New Password"
                                   pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$">
                        </div>

                        <div class="form-label-group mb-3">
                            <input name="repassword" type="password" class="form-control"
                                   placeholder="Reenter New Password"
                                   pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$">
                        </div>
                        <label class="form-label text-danger">Old password* :</label>
                        <div class="form-label-group mb-3">
                            <input name="oldPassword" type="password" class="form-control"
                                   placeholder="Enter Old Password" required
                                   pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$">
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