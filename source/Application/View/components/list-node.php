<?php

use Core\View;

?>

<figure class="node node--list">
    <figcaption class="node__head">
        <div class="dropdown dropdown--right">
            <button class="button icon" type="button">more_vert</button>
            <div class="dropdown__menu">
                <button class="dropdown__menu-item" data-activate="<?= View::output($addButtonActivate); ?>" type="button">Add</button>
                <button class="dropdown__menu-item" data-activate="<?= View::output($removeButtonActivate); ?>" type="button">Remove</button>
            </div>
        </div>
        <h2 class="node__title"><?= View::output($title); ?></h2>
    </figcaption>
    <ul class="node__body"></ul>
</figure>
