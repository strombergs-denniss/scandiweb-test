let system = new window.System();

let productForm = system.uniqueComponents["add-product-form"];
let productAlert = system.uniqueComponents["product-alert"];

function attributeTemplate(attribute) {
    return `
        <div class="form__group">
            <label for="attribute">${attribute.name} | ${attribute.code}</label>
            <input class="form__control" name="${attribute.id}" type="${attribute.type}" value="${attribute.value}" required></input>
            <div class="form__helper">${attribute.description}</div>
            <div class="form__feedback">Please provide valid attribute value.</div>
        </div>
    `;
}

function attributeGroupTemplate(attributeGroup) {
    return `
        <fieldset name="attributes">
            <legend><h4>${attributeGroup.name} | ${attributeGroup.code}</h4></legend>
            ${attributeGroup.attributes.map((attribute) => attributeTemplate(attribute)).join("")}
            <div class="form__helper">${attributeGroup.description}</div>
        </fieldset>
    `;
}

function productTypeTemplate(productType) {
    return `
        <legend><h3>${productType.name} | ${productType.code}</h3></legend>
        ${productType.attributeGroups.map((attributeGroup) => attributeGroupTemplate(attributeGroup)).join("")}
    `;
}

// load attribute groups and attributes into attribute group fieldset
function loadAttributeGroups(productId) {
    let typeFieldset = document.body.querySelector(`[name="attribute-groups"]`);
    let selectedOption = productForm.element.querySelector(`[name="type"]`).querySelector(":checked");

    API.findAllProductAttributeGroups(productId, selectedOption.value).then((data) => {
        typeFieldset.innerHTML = productTypeTemplate(data);
    });
}

productForm.element.querySelector(`[name="type"]`).onchange = (event) => {
    loadAttributeGroups(0);
};

window.onload = (event) => {
    loadAttributeGroups(productForm.element.dataset.productId);

    productForm.onSubmit = (event) => {
        if (!productForm.validate()) {
            return null;
        }

        if (productForm.element.dataset.productId == "0") {
            API.createProduct(productForm.serialize())
                .then((data) => {
                    productAlert.success("Product has been added!");
                })
                .catch((error) => {
                    productAlert.error("Failed to add product!");
                });
        } else {
            let serialization = productForm.serialize();
            serialization.id = productForm.element.dataset.productId;
            API.updateProduct(serialization)
                .then((data) => {
                    productAlert.success("Product has been saved!");
                })
                .catch((error) => {
                    productAlert.error("Failed to save product!");
                });
        }

        productAlert.setIsActive(true);
    };
};
