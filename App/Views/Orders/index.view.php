<?php
/** @var \App\Core\IAuthenticator $auth */
/** @var Array $data */
?>

<?php $user = \App\Models\User::getOne($auth->getLoggedUserId()) ?>

<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-9 col-lg-9 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h1 class="card-title text-center pb-1 pt-1"> <?= $user->getUsername() ?> </h1>
                    <h3 class="card-title text-center pb-5 pt-1">Moje objednavky: </h3>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Vytvorené</th>
                            <th scope="col">Cena sucet</th>
                            <th scope="col">Stav</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $order) {?>
                        <tr>
                            <td> <a href = "?c=orders&a=ordered&id=<?php echo $order->getId() ?> " > <?php echo $order->getId() ?> </a> </td>
                            <td> <?php echo $order->getDate() ?> </td>
                            <td> <?php echo $order->getPrice() ?> €</td>
                            <td> <?php echo $order->getStatus() ?> </td>
                        </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>