<form class="form" novalidate>
    <div class="form__group">
        <label for="code">Code</label>
        <input class="form__control" name="code" maxlength="255" type="text" required>
        <div class="form__feedback">Please provide valid product type code.</div>
    </div>

    <div class="form__group">
        <label for="name">Name</label>
        <input class="form__control" name="name" maxlength="255" type="text" required>
        <div class="form__feedback">Please provide valid product type name.</div>
    </div>

    <div class="form__group form__group--inline">
        <label for="attribute-group">Attribute group</label>
        <select class="form__control" name="attribute-group" required>
            <option value="">sfd</option>
        </select>
        <button class="button icon" id="add-attribute-group-button" type="button">add</button>
    </div>

    <template class="template" id="attribute-group-template">
        <li class="node node--list-item">
            <div class="node__head">
                <span class="node__data"></span>
                <button class="button icon delete-button">remove</button>
            </div>
        </li>
    </template>

    <figure class="node node--list" id="attribute-group-list" data-data-name="attributeGroups">
        <figcaption class="node__head">
            <h4 class="node__title">Attribute groups</h4>
        </figcaption>
        <ul class="node__body"></ul>
    </figure>
</form>
