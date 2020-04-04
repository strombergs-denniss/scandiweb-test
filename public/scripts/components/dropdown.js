import Component from "../component.js";

class Dropdown extends Component {
    constructor(element) {
        super(element);
    }

    initialize() {
        this.menuItems = this.element.querySelectorAll(".dropdown__menu-item");

        for (let menuItem of this.menuItems) {
            let component = this.system.uniqueComponents[menuItem.dataset.activate];

            if (component) {
                menuItem.onclick = (event) => {
                    component.activator = this.parent;
                    component.setIsActive(true);
                };
            }
        }
    }

    static initializeAll(system) {
        document.addEventListener("click", (event) => {
            for (let dropdown of system.classifiedComponents["dropdown"]) {
                if (dropdown.element != event.target.parentElement) {
                    dropdown.setIsActive(false);
                }
            }

            if (event.target.parentElement) {
                if (event.target.parentElement.classList.contains("dropdown")) {
                    let component = system.components[event.target.parentElement.dataset.index];

                    if (component) {
                        component.switch();
                    }
                }
            }
        });
    }
}

export default Dropdown;
