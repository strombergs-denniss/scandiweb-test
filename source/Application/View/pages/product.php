<?php

use Core\View;

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Product</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
        <link rel="stylesheet" href="/dist/styles/main.css">
        <script src="/dist/scripts/main.js" defer></script>
        <script src="/dist/scripts/api.js" defer></script>
        <script src="/dist/scripts/pages/product.js" defer></script>
    </head>
    <body>
        <div class="root container">
            <header>
                <?= View::render("components/navigation", []) ?>
            </header>
            <main>
                <?= View::render("components/product-form", ["product" => View::output($product), "productTypes" => $productTypes]) ?>
                <div class="alert alert--fixed-bottom" id="product-alert"></div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>
