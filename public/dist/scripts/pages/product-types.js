window.onload = (event) => {
    let system = new window.System();
    let productTypeManager = system.uniqueComponents["product-type-manager"];
    productTypeManager.loadAPI = () => API.findAllProductTypes();
    productTypeManager.addAPI = (productType) => API.createProductType(productType);
    productTypeManager.editAPI = (productType) => API.updateProductType(productType);
    productTypeManager.removeAPI = (productTypeIds) => API.deleteProductTypes(productTypeIds);
    productTypeManager.load();

    let attributeGroupManager = system.uniqueComponents["attribute-group-manager"];
    attributeGroupManager.loadAPI = () => API.findAllAttributeGroups();
    attributeGroupManager.addAPI = (attributeGroup) => API.createAttributeGroup(attributeGroup);
    attributeGroupManager.editAPI = (attributeGroup) => API.updateAttributeGroup(attributeGroup);
    attributeGroupManager.removeAPI = (attributeGroupIds) => API.deleteAttributeGroups(attributeGroupIds);
    attributeGroupManager.load();

    let attributeManager = system.uniqueComponents["attribute-manager"];
    attributeManager.loadAPI = () => API.findAllAttributes();
    attributeManager.addAPI = (attribute) => API.createAttribute(attribute);
    attributeManager.editAPI = (attribute) => API.updateAttribute(attribute);
    attributeManager.removeAPI = (attributeIds) => API.deleteAttributes(attributeIds);
    attributeManager.load();

    let addAttributeGroupButton = document.querySelector("#add-attribute-group-button");
    let attributeGroupSelect = document.querySelector(`[name="attribute-group"]`);
    let attributeGroupTemplate = system.uniqueComponents["attribute-group-template"];
    let attributeGroupList = system.uniqueComponents["attribute-group-list"];

    let addAttributeButton = document.querySelector("#add-attribute-button");
    let attributeSelect = document.querySelector(`[name="attribute"]`);
    let attributeTemplate = system.uniqueComponents["attribute-template"];
    let attributeList = system.uniqueComponents["attribute-list"];

    function loadPTAttributeGroups(productTypeId) {
        API.findAllProductTypeAttributeGroups(productTypeId).then((data) => {
            attributeGroupList.clear();
            for (let datum of data) {
                let node = attributeGroupList.pushNodeFromTemplate(attributeGroupTemplate);
                node.setData(datum);
            }
        });
    }

    function loadPTAttributes(attributeGroupId) {
        API.findAllAttributeGroupAttributes(attributeGroupId).then((data) => {
            attributeList.clear();
            for (let datum of data) {
                let node = attributeList.pushNodeFromTemplate(attributeTemplate);
                node.setData(datum);
            }
        });
    }

    function loadAttributeGroups() {
        API.findAllAttributeGroups().then((data) => {
            attributeGroupSelect.innerHTML = data.map((item) => `<option value="${item.id}">${item.code}</option>`).join("");
        });
    }

    function loadAttributes() {
        API.findAllAttributes().then((data) => {
            attributeSelect.innerHTML = data.map((item) => `<option value="${item.id}">${item.code}</option>`).join("");
        });
    }

    productTypeManager.addModal.onActivate2 = () => {
        loadPTAttributeGroups(productTypeManager.addModal.activator.properties.data.id);
    };

    attributeGroupManager.addModal.onActivate2 = (event) => {
        loadPTAttributes(attributeGroupManager.addModal.activator.properties.data.id);
    };

    attributeGroupManager.addModal.onConfirm2 = (event) => {
        loadAttributeGroups();
    };

    attributeManager.addModal.onConfirm2 = (event) => {
        loadAttributes();
    };

    loadAttributeGroups();
    loadAttributes();

    addAttributeGroupButton.onclick = (event) => {
        let selected = attributeGroupSelect.querySelector(":checked");
        let add = true;

        // to make them not repeat
        for (let node of attributeGroupList.properties.nodes) {
            if (node.properties.data.id == selected.value) {
                add = false;
                break;
            }
        }

        if (add) {
            let node = attributeGroupList.pushNodeFromTemplate(attributeGroupTemplate);
            node.setData({ id: selected.value, code: selected.innerHTML });
        }
    };

    addAttributeButton.onclick = (event) => {
        let add = true;
        let selected = attributeSelect.querySelector(":checked");

        // to make them not repeat
        for (let node of attributeList.properties.nodes) {
            if (node.properties.data.id == selected.value) {
                add = false;
                break;
            }
        }

        if (add) {
            let node = attributeList.pushNodeFromTemplate(attributeTemplate);
            node.setData({ id: selected.value, code: selected.innerHTML });
        }
    };
};
