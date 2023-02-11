<?php
/** @var Product[] $data */

/** @var \App\Core\IAuthenticator $auth */

use App\Models\Product;

if($auth->isLogged()){
    $user = \App\Models\User::getOne($auth->getLoggedUserId()); ?>

    <?php if ($user->getRight() == 'all') { ?>
        <div class=" container pt-2">
            <a href="?c=brands&a=index"
               class="button btn btn-primary buttonCeenter">Správa značiek</a>
        </div>

        <div class=" container b-5">
            <a href="?c=products&a=create"
               class="button btn btn-success buttonCeenter">Pridaj bicykel</a>
        </div>
    <?php } ?>


    <?php
    foreach ($data as $product) {
        ?>
        <div class="container align-items-center kartaActive mb-5 mt-5">

            <div class="row d-flex align-items-center p-2 ">

                <div class="col-lg-8 text-center align-middle p-5">
                    <?php if($product->getPath() != null){?>
                        <img src="<?php echo $product->getPath() ?>" class="produkt-full" alt="cestny bicykel">
                    <?php } else {?>
                        <img src="public/images/noImage.jpg" class="produkt-full" alt="cestny bicykel">
                    <?php }?>
                </div>
                <div class="col-lg-4 text-center align-middle p-5">
                    <h1 class="fw-normal"><?php echo $product->getBrand() ?></h1>
                    <p><?php echo $product->getSubclass() ?></p>
                    <span class="cena p-2"><?php echo $product->getPrice() ?> € </span>
                    <span><a class="btn btn-secondary tlacitko" onclick="add(<?php echo $product->getId() ?>)"
                             id="kosButton<?php echo $product->getId() ?>">Pridať do košíka</a></span>
                </div>

            </div>
            <div class="row align mb-4 ">
                <p> <?php echo $product->getDescription() ?> </p>
            </div>
            <?php if ($user->getRight() == 'all'){ ?>
            <div class="row container riadokMargin">
                <div class="col">
                    <a href="?c=products&a=edit&id=<?php echo $product->getId() ?>"
                       class="button btn btn-warning buttonCeenter">Uprav</a>
                </div>
                <div class="col">
<!--                    <a href="?c=products&a=delete&id=--><?php //echo $product->getId() ?><!--"-->
<!--                       class="button btn btn-danger buttonCeenter">Vymaz</a>-->

                    <!-- Button trigger modal -->
                    <button type="button" class="button btn btn-danger buttonCeenter"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $product->getId() ?>" > Vymaz </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop<?php echo $product->getId() ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?php echo $product->getId()?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="staticBackdropLabel<?php echo $product->getId()?>">Naozaj chceš vymazať produkt</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="button btn btn-primary " data-bs-dismiss="modal">Zrusiť vymazanie</button>
                                    <a href="?c=products&a=delete&id=<?php echo $product->getId()?>" class="button btn btn-danger">Potvrdiť vymazanie</a>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <?php
    foreach ($data as $product) {
        ?>
        <div class="container align-items-center kartaActive mb-5 mt-5">

            <div class="row d-flex align-items-center p-2 ">

                <div class="col-lg-8 text-center align-middle p-5">
                    <?php if($product->getPath() != null){?>
                        <img src="<?php echo $product->getPath() ?>" class="produkt-full" alt="cestny bicykel">
                    <?php } else {?>
                        <img src="public/images/noImage.jpg" class="produkt-full" alt="cestny bicykel">
                    <?php }?>
                </div>
                <div class="col-lg-4 text-center align-middle p-5">
                    <h1 class="fw-normal"><?php echo $product->getBrand() ?></h1>
                    <p><?php echo $product->getSubclass() ?></p>
                    <span class="cena p-2"><?php echo $product->getPrice() ?> € </span>
                </div>

            </div>
            <div class="row align mb-4 ">
                <p> <?php echo $product->getDescription() ?> </p>
            </div>
        </div>
    <?php } ?>
<?php } ?>






