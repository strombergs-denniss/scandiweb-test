import Alert from "./components/alert.js";
import Checkbox from "./components/checkbox.js";
import Component from "./component.js";
import Dropdown from "./components/dropdown.js";
import Form from "./components/form.js";
import Manager from "./components/manager.js";
import Modal from "./components/modal.js";
import Navigation from "./components/navigation.js";
import Node from "./components/node.js";
import Template from "./components/template.js";

class System {
    constructor() {
        this.componentClasses = {
            alert: Alert,
            checkbox: Checkbox,
            dropdown: Dropdown,
            form: Form,
            manager: Manager,
            modal: Modal,
            navigation: Navigation,
            node: Node,
            root: Component,
            template: Template,
        };
        this.uninitializedComponents = [];
        this.components = [];
        this.classifiedComponents = {};
        this.uniqueComponents = {};
        this.rootElement = document.querySelector(".root");
        this.rootComponent = this.createComponent(this.rootElement, null);

        for (let key in this.componentClasses) {
            this.classifiedComponents[key] = [];
        }

        this.findComponents(this.rootElement, this.rootComponent);
        this.initializeComponents();
        this.initializeAll(this);
        console.log(this);
    }

    initializeAll() {
        for (let key in this.componentClasses) {
            this.componentClasses[key].initializeAll(this);
        }
    }

    createComponent(element, parentComponent) {
        let componentClass = this.componentClasses[element.classList[0]];

        if (!componentClass) {
            return null;
        }

        let component = new componentClass(element);
        component.system = this;
        this.uninitializedComponents.push(component);

        // assign children and parent
        if (parentComponent) {
            component.parent = parentComponent;
            parentComponent.children.push(component);
        }

        return component;
    }

    // initialize uninitialized components
    initializeComponents() {
        for (let component of this.uninitializedComponents) {
            this.classifiedComponents[component.class].push(component);

            component.element.dataset.index = this.components.push(component) - 1;

            if (component.id) {
                this.uniqueComponents[component.id] = component;
            }
        }

        for (let component of this.uninitializedComponents) {
            component.initialize();
        }

        this.uninitializedComponents = [];
    }

    deleteComponent(component) {
        let child = component.children.pop();
        while (child) {
            this.deleteComponent(child);
            child = component.children.pop();
        }

        // remove first component from parent component children
        if (component.parent.children.indexOf(component) > -1) {
            component.parent.children.splice(component.parent.children.indexOf(component), 1);
        }

        component.element.parentNode.removeChild(component.element);

        // remove from components array
        if (this.components.indexOf(component) > -1) {
            this.components[this.components.indexOf(component)] = null;
        }

        // remove from unique components array
        if (this.uniqueComponents[component.id]) {
            delete this.uniqueComponents[component.id];
        }

        // remove from classified components array
        if (this.classifiedComponents[component.class].indexOf(component) > -1) {
            this.classifiedComponents[component.class].splice(this.classifiedComponents[component.class].indexOf(component), 1);
        }
    }

    // find child components
    findComponents(parentElement, parentComponent) {
        let childElements = parentElement.children;

        for (let childElement of childElements) {
            let component = parentComponent;

            if (childElement.classList[0] in this.componentClasses) {
                component = this.createComponent(childElement, parentComponent);
            }

            this.findComponents(childElement, component);
        }
    }
}

window.System = System;
