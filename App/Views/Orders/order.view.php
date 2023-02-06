<?php
/** @var Array $data */
?>


<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-8 col-lg-8 mx-auto ">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h1 class="menuText mt-3 text-center">OBJEDNÁVKA ČÍSLO: <?php echo $data['id'] ?> </h1>
                    <h3 class="card-title text-center pb-5 mb-5">objednaný tovar: </h3>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">značka</th>
                            <th scope="col">pocet</th>
                            <th scope="col">cena</th>
                            <?php if ($data['status'] == "Prebieha") { ?>
                                <th class="text-end" scope="col">zmaz</th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['products'] as $product) { ?>
                            <tr>
                                <td>  <?php echo $product->getId() ?>  </td>
                                <td> <?php echo $product->getBrand() ?> </td>
                                <td> <?php echo $product->getCountOfProduct($product->getId(), $data['id']) ?> </td>
                                <td> <?php echo $product->getPrice() ?> €</td>
                                <?php if ($data['status'] == "Prebieha") { ?>
                                    <td class="productDelete"><a class="productDeleteX"
                                                                 href="?c=orders&a=delete&id=<?php echo $product->getId() ?>">X</a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <?php if ($data['status'] != "Vybavena") { ?>
                            <a href="?c=orders&a=update&id= <?php echo $data['id'] ?>"
                               class="btn btn-success buttonCeenter ">Potvrdiť a odoslať objednavku </a>
                        <?php } ?>
                        <a href="?c=orders&a=index"
                           class="btn btn-primary buttonCeenter mt-1">Späť na objednávky </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
