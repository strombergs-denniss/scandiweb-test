class API {
    static api = "http://localhost:8000/api";

    static handleErrors(response) {
        if (!response.ok) {
            throw Error(response.statusText);
        }

        return response;
    }

    // product api
    static async createProduct(product) {
        let response = await fetch(this.api + "/product", { method: "post", body: JSON.stringify(product) });
        return await response.json();
    }

    static async findAllProducts() {
        let response = await fetch(this.api + "/product");
        return await response.json();
    }

    static async updateProduct(product) {
        let response = await fetch(this.api + "/product", { method: "put", body: JSON.stringify(product) });
        return await response.json();
    }

    static async deleteProducts(products) {
        let response = await fetch(this.api + "/product", { method: "delete", body: JSON.stringify(products) });
        return await response;
    }

    static async findAllProductAttributeGroups(productId, productTypeId) {
        let response = await fetch(this.api + "/product/attribute-group/" + productId + "/" + productTypeId);
        return await response.json();
    }

    // product type api
    static async createProductType(productType) {
        let response = await fetch(this.api + "/product-type", { method: "post", body: JSON.stringify(productType) });
        return await response.json();
    }

    static async findAllProductTypes() {
        let response = await fetch(this.api + "/product-type");
        return await response.json();
    }

    static async updateProductType(productType) {
        let response = await fetch(this.api + "/product-type", { method: "put", body: JSON.stringify(productType) });
        return await response.json();
    }

    static async deleteProductTypes(productTypes) {
        let response = await fetch(this.api + "/product-type", { method: "delete", body: JSON.stringify(productTypes) });
        return await response;
    }

    static async findAllProductTypeAttributeGroups(productType) {
        let response = await fetch(this.api + "/product-type/" + productType + "/attribute-group");
        let data = await response.json();
        return data;
    }

    // attribute group api
    static async createAttributeGroup(attributeGroup) {
        let response = await fetch(this.api + "/attribute-group", { method: "post", body: JSON.stringify(attributeGroup) });
        return await response.json();
    }

    static async findAllAttributeGroups() {
        let response = await fetch(this.api + "/attribute-group");
        return await response.json();
    }

    static async updateAttributeGroup(attributeGroup) {
        let response = await fetch(this.api + "/attribute-group", { method: "put", body: JSON.stringify(attributeGroup) });
        return await response.json();
    }

    static async deleteAttributeGroups(attributeGroups) {
        let response = await fetch(this.api + "/attribute-group", { method: "delete", body: JSON.stringify(attributeGroups) });
        return await response;
    }

    // attribute api
    static async createAttribute(attribute) {
        let response = await fetch(this.api + "/attribute", { method: "post", body: JSON.stringify(attribute) });
        return await response.json();
    }

    static async findAllAttributes() {
        let response = await fetch(this.api + "/attribute");
        return await response.json();
    }

    static async updateAttribute(attribute) {
        let response = await fetch(this.api + "/attribute", { method: "put", body: JSON.stringify(attribute) });
        return await response.json();
    }

    static async deleteAttributes(attributes) {
        let response = await fetch(this.api + "/attribute", { method: "delete", body: JSON.stringify(attributes) });
        return await response;
    }

    static async findAllAttributeGroupAttributes(attributeGroupId) {
        let response = await fetch(this.api + "/attribute-group/" + attributeGroupId + "/attribute");
        return await response.json();
    }
}
