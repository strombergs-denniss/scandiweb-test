<?php

use Core\View;

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
        <link rel="stylesheet" href="/dist/styles/main.css">
        <script src="/dist/scripts/main.js" defer></script>
        <script src="/dist/scripts/api.js" defer></script>
        <script src="/dist/scripts/pages/products.js" defer></script>
    </head>
    <body>
        <div class="root container">
            <header>
                <?= View::render("components/navigation", []) ?>
            </header>
            <main>
                <div class="modal" id="remove-product-modal">
                    <div class="modal__dialog">
                        <div class="modal__head">
                            <h3 class="modal__title">Remove</h3>
                            <button class="button icon" data-deactivate="modal" type="button">close</button>
                        </div>
                        <div class="modal__body">
                            <p>Do you really want to remove selected list items?</p>
                        </div>
                        <div class="modal__foot">
                            <button class="button button--outline modal__confirm-button --danger" type="button">Yes</button>
                            <button class="button button--outline --info" data-deactivate="modal" type="button">No</button>
                        </div>
                    </div>
                </div>

                <figure class="node node--grid" id="product-list">
                    <div class="node__head">
                        <div class="dropdown dropdown--right">
                            <button class="button icon" type="button">more_vert</button>
                            <div class="dropdown__menu">
                                <button class="dropdown__menu-item" data-activate="remove-product-modal" type="button">Remove</button>
                            </div>
                        </div>
                        <h2 class="node__title">Products</h2>
                    </div>
                    <ul class="node__body">
                        <?php foreach ($products as $product) : ?>
                            <li class="node node--grid-item">
                                <div class="node__head">
                                    <button class="checkbox">
                                        <span class="icon">check</span>
                                    </button>
                                    <div class="node__data">
                                        <div class="hidden" data-key="id"><?= $product->getId(); ?></div>
                                        <div data-key="sku"><?= $product->getSKU(); ?></div>
                                        <div data-key="name"><?= $product->getName(); ?></div>
                                        <div data-key="type"><?= $product->getType(); ?></div>
                                        <div data-key="price"><?= $product->getPrice() . " $" ?></div>
                                        <div data-key="quantity"><?= $product->getQuantity() . " (quantity)"; ?></div>
                                        <?php $attributeGroups = json_decode($product->getAttributeGroups(), true); ?>
                                        <?php $attributeGroup = $attributeGroups[0]; ?>
                                        <div>
                                            <?= $attributeGroup["name"] . ":" ?>
                                            <?php if ($attributeGroup["display"] != "") : ?>
                                                <?php
                                                $arr = [];

                                                foreach ($attributeGroup["attributes"] as $attribute) {
                                                    array_push($arr, $attribute["value"]);
                                                }
                                                $matches = [];
                                                $keys = preg_match_all("({\d})", $attributeGroup["display"], $matches);
                                                $output = str_replace($matches[0], $arr, $attributeGroup["display"]);
                                                echo $output;
                                                ?>
                                            <?php else : ?>
                                                <div>
                                                    <?php foreach ($attributeGroup["attributes"] as $attribute) : ?>
                                                        <div style="padding-left: 1rem;"><?= $attribute["name"] . ": " . $attribute["value"] . " " . $attribute["metadata"] ?></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="button icon" type="button">more_vert</button>
                                        <div class="dropdown__menu">
                                            <a class="dropdown__menu-item" href="<?= "/product/" . $product->getId() ?>">View</a>
                                            <button class="dropdown__menu-item" data-activate="remove-product-modal">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </figure>
                <div class="alert alert--fixed-bottom" id="alert"></div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>
