<?php

use Core\View;

?>

<div class="modal" id="<?= View::output($addModalId); ?>">
    <div class="modal__dialog">
        <div class="modal__head">
            <h3 class="modal__title">Add</h3>
            <button class="button icon" data-deactivate="modal" type="button">close</button>
        </div>
        <div class="modal__body">
            <?= View::output($addForm); ?>
        </div>
        <div class="modal__foot">
            <button class="button button--outline modal__confirm-button --success" type="button">Add</button>
            <button class="button button--outline --info" data-deactivate="modal" type="button">Cancel</button>
        </div>
    </div>
</div>

<div class="modal" id="<?= View::output($removeModalId); ?>">
    <div class="modal__dialog">
        <div class="modal__head">
            <h3 class="modal__title">Remove</h3>
            <button class="button button--outline icon" data-deactivate="modal" type="button">close</button>
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

<template class="template">
    <?= View::output($nodeItemTemplate); ?>
</template>

<?= View::output($node); ?>
