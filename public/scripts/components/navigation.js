import Component from "../component.js";

class Navigation extends Component {
    constructor(element) {
        super(element);
    }

    initialize() {
        this.toggle = this.element.querySelector(".navigation__toggle");
        this.toggle.onclick = (event) => {
            this.switch();
        };
    }

    static initializeAll(system) {}
}

export default Navigation;
