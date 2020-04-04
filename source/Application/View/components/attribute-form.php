<form class="form" novalidate>
    <div class="form__group">
        <label for="code">Code</label>
        <input class="form__control" name="code" type="text" maxlength="255" required>
        <div class="form__feedback">Please provide valid attribute code.</div>
    </div>

    <div class="form__group">
        <label for="name">Name</label>
        <input class="form__control" name="name" type="text" maxlength="255" required>
        <div class="form__feedback">Please provide valid attribute name.</div>
    </div>

    <div class="form__group">
        <label for="description">Description</label>
        <input class="form__control" name="description" maxlength="255" type="text">
        <div class="form__feedback">Please provide valid attribute description.</div>
    </div>

    <div class="form__group">
        <label for="type">Type</label>
        <select class="form__control" name="type" required>
            <option value="text">text</option>
            <option value="number">number</option>
        </select>
    </div>

    <div class="form__group">
        <label for="metadata">Metadata</label>
        <input class="form__control" name="metadata" type="text" maxlength="255" required>
        <div class="form__feedback">Please provide valid attribute metadata.</div>
    </div>
</form>
