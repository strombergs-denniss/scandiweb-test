import Component from "../component.js";

class Node extends Component {
    constructor(element) {
        super(element);
    }

    initialize() {
        this.title = this.element.querySelector(".node__title");
        this.data = this.element.querySelector(".node__data");
        this.body = this.element.querySelector(".node__body");
        this.properties = {
            title: this.title ? this.title.innerHTML : "",
            nodes: [],
            isSelected: false,
            data: {},
        };
        this.dataName = this.element.dataset.dataName;

        for (let child of this.children) {
            if (child.class == "node") {
                this.properties.nodes.push(child);
            }
        }

        let deleteButton = this.element.querySelector(".delete-button");

        if (deleteButton) {
            deleteButton.onclick = (event) => {
                this.parent.properties.nodes.splice(this.parent.properties.nodes.indexOf(this), 1);
                this.system.deleteComponent(this);
            };
        }
    }

    onPush() {}

    serialize() {
        let data = {};

        for (let node of this.properties.nodes) {
            data[node.properties.data.id] = true;
        }

        return data;
    }

    dataFromValues() {
        let values = this.element.querySelectorAll("[data-key]");

        for (let value of values) {
            this.properties.data[value.dataset.key] = value.innerHTML;
        }
    }

    setData(data) {
        this.properties.data = data;
        this.data.innerHTML = data.code;
    }

    findSelectedNodes() {
        let selectedNodes = [];

        for (let node of this.properties.nodes) {
            if (node.isActive) {
                selectedNodes.push(node);
            }
        }

        return selectedNodes;
    }

    getSelectedNodeIds() {
        let ids = [];
        let nodes = this.findSelectedNodes();

        for (let node of nodes) {
            ids.push(node.properties.data.id);
        }

        return ids;
    }

    deselectAllNodes() {
        for (let node of this.properties.nodes) {
            node.setIsActive(false);
        }
    }

    onActivate() {
        this.isSelected = this.isActive;

        if (this.children[0]) {
            if (this.children[0].class == "checkbox") {
                this.children[0].setIsActive(this.isActive);
            }
        }
    }

    onDeactivate() {
        this.isSelected = this.isActive;

        if (this.children[0]) {
            if (this.children[0].class == "checkbox") {
                this.children[0].setIsActive(this.isActive);
            }
        }
    }

    setIsSelected(isSelected) {
        this.properties.isSelected = isSelected;
        this.activate();
    }

    setTitle(title) {
        this.properties.title = title;
        this.title.innerHTML = title;
    }

    pushNodeFromElement(element) {
        this.body.appendChild(element);
        let node = this.system.createComponent(element, this);
        this.system.findComponents(node.element, node);
        this.system.initializeComponents();
        this.properties.nodes.push(node);
        this.onPush();
        return node;
    }

    pushNodeFromTemplate(template) {
        let element = template.element.content.cloneNode(true).children[0];
        this.body.appendChild(element);
        let node = this.system.createComponent(element, this);
        this.system.findComponents(node.element, node);
        this.system.initializeComponents();
        this.properties.nodes.push(node);
        this.onPush();
        return node;
    }

    pushNodeFromComponent(node) {
        this.body.appendChild(node.element);
        this.properties.nodes.push(node);
        this.onPush();
        return node;
    }

    removeSelectedNodes() {
        let nodes = this.findSelectedNodes();

        for (let node of nodes) {
            this.properties.nodes.splice(this.properties.nodes.indexOf(node), 1);
            this.system.deleteComponent(node);
        }
    }

    clear() {
        let node = this.properties.nodes.pop();

        while (node) {
            this.system.deleteComponent(node);
            node = this.properties.nodes.pop();
        }
    }

    static initializeAll(system) {}
}

export default Node;
