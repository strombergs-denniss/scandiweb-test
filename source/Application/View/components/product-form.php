<?php

use Core\View;

?>

<form class="form" id="add-product-form" data-product-id="<?= isset($product["id"]) ? $product["id"] : "0"; ?>"  novalidate>
    <div class="form__group">
        <label for="sku">SKU</label>
        <input class="form__control" name="sku" type="text" maxlength="255" value="<?= View::output($product["sku"]); ?>" required>
        <div class="form__feedback">Please provide valid product SKU.</div>
    </div>

    <div class="form__group">
        <label for="name">Name</label>
        <input class="form__control" name="name" type="text" maxlength="255" value="<?= View::output($product["name"]); ?>" required>
        <div class="form__feedback">Please provide valid product name.</div>
    </div>

    <div class="form__group">
        <label for="type">Type</label>
        <select class="form__control" name="type" required>
            <?php foreach ($productTypes as $productType) : ?>
                <option value="<?= $productType->getID() ?>" <?= View::output($product["type"]) == $productType->getId() ? "selected" : "" ?>><?= $productType->getName() ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form__group">
        <label for="price">Price</label>
        <input class="form__control" name="price" type="number" min="0.01" max="1000000" step="0.01" value="<?= View::output($product["price"]); ?>" required>
        <div class="form__feedback">Please provide valid product price (minimal: 0.01, maximal:1000000).</div>
    </div>
    
    <div class="form__group">
        <label for="name">Quantity</label>
        <input class="form__control" name="quantity" type="number" min="0" max="1000000" value="<?= View::output($product["quantity"]); ?>" required>
        <div class="form__feedback">Please provide valid product quantity (minimal: 0, maximal: 1000000).</div>
    </div>

    <fieldset name="attribute-groups"></fieldset>

    <button class="button button--outline <?= isset($product["id"]) ? "--warning" : "--success" ?>" type="submit"><?= isset($product["id"]) ? "Save" : "Add"; ?></button>
</form>
