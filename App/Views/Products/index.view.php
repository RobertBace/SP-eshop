<!doctype html>
<php lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SP-Eshop</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>
    <?php
    /** @var Product[] $data */

    use App\Models\Product;

    ?>

    <div class=" container pt-3 pb-5">
        <a href="?c=products&a=create"
           type="button" class="button btn btn-success">Pridaj bicykel</a>
    </div>

    <?php
    $poc = 0;
    foreach ($data

             as $product) {
        $poc++;
        ?>


        <div class="container align-items-center kartaActive mb-5 mt-5">

            <div class="row d-flex align-items-center p-2 ">

                <div class="col-lg-8 text-center align-middle p-5">
                    <img src="<?php echo $product->getPath() ?>" class="produkt-full" alt="cestny bicykel">
                </div>
                <div class="col-lg-4 text-center align-middle p-5">
                    <h1 class="fw-normal"><?php echo $product->getTitle() ?></h1>
                    <p><?php echo $product->getSubclass() ?></p>
                    <span class="cena p-2"><?php echo $product->getPrice() ?> € </span>
                    <span><a class="btn btn-secondary tlacitko" href="#"
                             id="kosButton<?php echo $poc ?>">Pridať do košíka</a></span>
                </div>

            </div>
            <div class="row align mb-4 ">
                <p> <?php echo $product->getDescription() ?> </p>
            </div>
            <div class="row container riadokMargin">
                <div class="col">
                    <a href="?c=products&a=edit&id=<?php echo $product->getId() ?>
                    type=" button" class="button btn btn-warning">Uprav</a>
                </div>
                <div class="col">
                    <a href="?c=products&a=delete&id=<?php echo $product->getId() ?>"
                       type="button" class="button btn btn-danger">Vymaz</a>
                </div>


            </div>

        </div>
    <?php } ?>
    </body>
</php>

