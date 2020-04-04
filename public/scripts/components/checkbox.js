import Component from "../component.js";

class Checkbox extends Component {
    constructor(element) {
        super(element);
    }

    initialize() {
        this.element.onclick = (event) => {
            this.switch();
            if (this.parent) {
                this.parent.setIsActive(this.isActive);
            }
        };
    }

    static initializeAll(system) {}
}

export default Checkbox;
