import Component from "../component.js";

class Form extends Component {
    constructor(element) {
        super(element);
    }

    initialize() {
        this.submitButton = this.element.querySelector(`[type="submit"]`);
        this.element.onsubmit = (event) => {
            event.preventDefault();
            this.onSubmit();
        };
    }

    serialize() {
        let controls = this.element.querySelectorAll(".form__control");
        let data = {};

        for (let control of controls) {
            let parent = control.parentNode.parentNode;

            if (parent.tagName == "FORM") {
                data[control.name] = control.value;
            } else if (parent.tagName == "FIELDSET") {
                if (parent.name in data) {
                    data[parent.name][control.name] = control.value;
                } else {
                    data[parent.name] = {};
                    data[parent.name][control.name] = control.value;
                }
            }
        }

        if (this.children[1]) {
            data[this.children[1].dataName] = this.children[1].serialize();
        }

        return data;
    }

    deserialize(data) {
        for (let key in data) {
            let control = this.element.querySelector(`[name=${key}]`);

            if (control) {
                control.value = data[key];
            }
        }
    }

    reset() {
        let controls = this.element.querySelectorAll(".form__control");

        for (let control of controls) {
            if (control.tagName != "SELECT") {
                control.value = "";
            } else {
                control.value = control.children[0].value;
            }
        }
    }

    validate() {
        let controls = this.element.querySelectorAll(".form__control");
        let isValid = true;

        for (let control of controls) {
            if (!control.validity.valid) {
                this.element.classList.add("form--validated");
                isValid = false;
                break;
            }
        }

        return isValid;
    }

    onSubmit() {}

    static initializeAll(system) {}
}

export default Form;
