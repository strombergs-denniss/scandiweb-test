let system = new window.System();

let productList = system.uniqueComponents["product-list"];
let removeProductModal = system.uniqueComponents["remove-product-modal"];
let alert = system.uniqueComponents["alert"];

for (let node of productList.properties.nodes) {
    node.dataFromValues();
}

removeProductModal.onConfirm = (event) => {
    API.deleteProducts(productList.getSelectedNodeIds())
        .then(API.handleErrors)
        .then((data) => {
            productList.removeSelectedNodes();
            alert.success("Products have been successfully removed!");
        })
        .catch((error) => {
            alert.error("Failed to remove products!");
        });

    removeProductModal.setIsActive(false);
};

removeProductModal.onActivate = (event) => {
    if (!removeProductModal.activator.element.classList.contains("node--grid")) {
        productList.deselectAllNodes();
        removeProductModal.activator.setIsActive(true);
    }
};
