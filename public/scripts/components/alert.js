import Component from "../component.js";

class Alert extends Component {
    constructor(element) {
        super(element);
    }

    onActivate() {
        setTimeout(() => {
            this.setIsActive(false);
        }, 2000);
    }

    success(message) {
        this.element.innerHTML = message;
        this.element.classList.remove("--danger");
        this.element.classList.add("--success");
        this.setIsActive(true);
    }

    error(message) {
        this.element.innerHTML = message;
        this.element.classList.remove("--success");
        this.element.classList.add("--danger");
        this.setIsActive(true);
    }

    initialize() {}

    static initializeAll(system) {}
}

export default Alert;
