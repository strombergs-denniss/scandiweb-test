<form class="form" novalidate>
    <div class="form__group">
        <label for="code">Code</label>
        <input class="form__control" name="code" type="text" maxlength="255" required>
        <div class="form__feedback">Please provide valid attribute group code.</div>
    </div>

    <div class="form__group">
        <label for="name">Name</label>
        <input class="form__control" name="name" type="text" maxlength="255" required>
        <div class="form__feedback">Please provide valid attribute group name.</div>
    </div>

    <div class="form__group">
        <label for="description">Description</label>
        <input class="form__control" name="description" type="text" maxlength="255" required>
        <div class="form__feedback">Please provide valid attribute group description.</div>
    </div>

    <div class="form__group">
        <label for="display">Display</label>
        <input class="form__control" name="display" maxlength="255" type="text">
        <div class="form__feedback">Please provide valid attribute group display.</div>
    </div>

    <div class="form__group form__group--inline">
        <label for="attribute">Attribute</label>
        <select class="form__control" name="attribute"></select>
        <button class="button icon" id="add-attribute-button" type="button">add</button>
    </div>

    <template class="template" id="attribute-template">
        <li class="node node--list-item">
            <div class="node__head">
                <span class="node__data"></span>
                <button class="button icon delete-button">remove</button>
            </div>
        </li>
    </template>

    <figure class="node node--list" id="attribute-list" data-data-name="attributes">
        <figcaption class="node__head">
            <h4 class="node__title">Attributes</h4>
        </figcaption>
        <ul class="node__body"></ul>
    </figure>
</form>
