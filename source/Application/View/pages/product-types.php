<?php

use Core\View;

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Product types</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
        <link rel="stylesheet" href="/dist/styles/main.css">
        <script src="/dist/scripts/main.js" defer></script>
        <script src="/dist/scripts/api.js" defer></script>
        <script src="/dist/scripts/pages/product-types.js" defer></script>
    </head>
    <body>
        <div class="root container">
            <header>
                <?= View::render("components/navigation", []) ?>
            </header>
            <main>
                <?php { ?>
                    <?php $addForm = View::capture("components/product-type-form", []) ?>

                    <?php ob_start(); ?>
                    <li class="node node--list-item">
                        <div class="node__head">
                            <button class="checkbox">
                                <span class="icon">check</span>
                            </button>
                            <span class="node__data"></span>
                            <div class="dropdown">
                                <button class="button icon" type="button">more_vert</button>
                                <div class="dropdown__menu">
                                    <button class="dropdown__menu-item" data-activate="add-product-type-modal" type="button">View</button>
                                    <button class="dropdown__menu-item" data-activate="remove-product-type-modal" type="button">Remove</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php $nodeItemTemplate = ob_get_clean(); ?>

                    <?php $node = View::capture("components/list-node", ["title" => "Product types", "addButtonActivate" => "add-product-type-modal", "removeButtonActivate" => "remove-product-type-modal"]) ?>

                    <div class="manager" id="product-type-manager">
                        <?= View::render("components/manager", ["addModalId" => "add-product-type-modal", "addForm" => $addForm, "removeModalId" => "remove-product-type-modal","nodeItemTemplate" => $nodeItemTemplate, "node" => $node]) ?>
                    </div>
                <?php } ?>

                <?php { ?>
                    <?php $addForm = View::capture("components/attribute-group-form", []) ?>

                    <?php ob_start(); ?>
                    <li class="node node--list-item">
                        <div class="node__head">
                            <button class="checkbox">
                                <span class="icon">check</span>
                            </button>
                            <span class="node__data"></span>
                            <div class="dropdown">
                                <button class="button icon" type="button">more_vert</button>
                                <div class="dropdown__menu">
                                    <button class="dropdown__menu-item" data-activate="add-attribute-group-modal" type="button">View</button>
                                    <button class="dropdown__menu-item" data-activate="remove-attribute-group-modal" type="button">Remove</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php $nodeItemTemplate = ob_get_clean(); ?>

                    <?php $node = View::capture("components/list-node", ["title" => "Attribute groups", "addButtonActivate" => "add-attribute-group-modal", "removeButtonActivate" => "remove-attribute-group-modal"]) ?>

                    <div class="manager" id="attribute-group-manager">
                        <?= View::render("components/manager", ["addModalId" => "add-attribute-group-modal", "addForm" => $addForm, "removeModalId" => "remove-attribute-group-modal","nodeItemTemplate" => $nodeItemTemplate, "node" => $node]) ?>
                    </div>
                <?php } ?>

                <?php { ?>
                    <?php $addForm = View::capture("components/attribute-form", []) ?>

                    <?php ob_start(); ?>
                    <li class="node node--list-item">
                        <div class="node__head">
                            <button class="checkbox">
                                <span class="icon">check</span>
                            </button>
                            <span class="node__data"></span>
                            <div class="dropdown">
                                <button class="button icon" type="button">more_vert</button>
                                <div class="dropdown__menu">
                                    <button class="dropdown__menu-item" data-activate="add-attribute-modal" type="button">View</button>
                                    <button class="dropdown__menu-item" data-activate="remove-attribute-modal" type="button">Remove</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php $nodeItemTemplate = ob_get_clean(); ?>

                    <?php $node = View::capture("components/list-node", ["title" => "Attributes", "addButtonActivate" => "add-attribute-modal", "removeButtonActivate" => "remove-attribute-modal"]) ?>

                    <div class="manager" id="attribute-manager">
                        <?= View::render("components/manager", ["addModalId" => "add-attribute-modal", "addForm" => $addForm, "removeModalId" => "remove-attribute-modal","nodeItemTemplate" => $nodeItemTemplate, "node" => $node]) ?>
                    </div>
                <?php } ?>
                <div class="alert alert--fixed-bottom" id="alert"></div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>
