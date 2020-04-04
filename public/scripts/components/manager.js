import Component from "../component.js";

class Manager extends Component {
    constructor(element) {
        super(element);
    }

    initialize() {
        this.addModal = this.children[0];
        this.addForm = this.addModal.children[0];
        this.removeModal = this.children[1];
        this.nodeTemplate = this.children[2];
        this.node = this.children[3];
        this.alert = this.system.uniqueComponents["alert"];

        this.addModal.onActivate = (event) => {
            document.body.classList.add("overflow-hidden");
            if (this.addModal.activator.element.classList.contains("node--list")) {
                this.addModal.setTitle("Add");
                this.addModal.setConfirmButtonText("Add");
            } else {
                this.node.deselectAllNodes();
                this.addModal.activator.setIsActive(true);
                this.addForm.deserialize(this.addModal.activator.properties.data);
                this.addModal.setTitle("Edit");
                this.addModal.setConfirmButtonText("Save");
                this.addModal.confirmButton.classList.add("--warning");
                this.addModal.confirmButton.classList.remove("--success");
            }

            this.addModal.onActivate2();
        };

        this.removeModal.onActivate = (event) => {
            if (!this.removeModal.activator.element.classList.contains("node--list")) {
                this.node.deselectAllNodes();
                this.removeModal.activator.setIsActive(true);
            }

            this.removeModal.onActivate2();
        };

        this.addModal.onConfirm = (event) => {
            if (!this.addForm.validate()) {
                return null;
            }

            if (this.addModal.activator.element.classList.contains("node--list")) {
                this.addAPI(this.addForm.serialize())
                    .then((data) => {
                        let node = this.node.pushNodeFromTemplate(this.nodeTemplate);
                        node.setData(data);
                        this.alert.success("Item has been successfully added!");
                    })
                    .catch((error) => {
                        this.alert.error("Failed to add item!");
                    });
            } else {
                let ser = this.addForm.serialize();
                ser.id = this.addModal.activator.properties.data.id;
                this.editAPI(ser)
                    .then((data) => {
                        this.alert.success("Item has been successfully saved!");
                        this.addModal.activator.setData(data);
                    })
                    .catch((error) => {
                        this.alert.error("Failed to save item!");
                    });
            }
            this.addModal.onConfirm2();
            this.addModal.setIsActive(false);
        };

        this.removeModal.onConfirm = (event) => {
            this.removeAPI(this.node.getSelectedNodeIds())
                .then(API.handleErrors)
                .then((data) => {
                    this.alert.success("Items have been successfully removed!");
                    this.node.removeSelectedNodes();
                })
                .catch((error) => {
                    this.alert.error("Failed to remove items!");
                });

            this.removeModal.setIsActive(false);
        };
    }

    load() {
        this.loadAPI().then((data) => {
            for (let datum of data) {
                let node = this.node.pushNodeFromTemplate(this.nodeTemplate);
                node.setData(datum);
            }
        });
    }

    static initializeAll(system) {}
}

export default Manager;
