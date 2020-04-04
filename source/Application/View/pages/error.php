<?php

use Core\View;

?>

<!doctype html>
<html lang="en">
    <head>
        <title>E-commerce</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
        <link rel="stylesheet" href="/dist/styles/main.css">
        <script src="/dist/scripts/main.js" defer></script>
        <script src="/dist/scripts/api.js" defer></script>
    </head>
    <body>
        <div class="root container">
            <header>
                <?= View::render("components/navigation", []) ?>
            </header>
            <main>
                <div class="error">
                    <h2 class="error__code"><?= $errorCode ?></h2>
                    <p class="error__details"><?= $errorDetails ?></p>
                </div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>
