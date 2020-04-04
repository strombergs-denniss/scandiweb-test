import Component from "../component.js";

class Modal extends Component {
    constructor(element) {
        super(element);
    }

    initialize() {
        this.title = this.element.querySelector(".modal__title");
        this.confirmButton = this.element.querySelector(".modal__confirm-button");
        this.confirmButton.onclick = (event) => {
            this.onConfirm();
        };
    }

    setConfirmButtonText(text) {
        this.confirmButton.innerHTML = text;
    }

    onActivate() {
        document.body.classList.add("overflow-hidden");
    }

    onDeactivate() {
        document.body.classList.remove("overflow-hidden");
    }

    onActivate2() {}

    onConfirm() {}

    onConfirm2() {}

    setTitle(title) {
        this.title.innerHTML = title;
    }

    static initializeAll(system) {
        document.addEventListener("mousedown", (event) => {
            if (("deactivate" in event.target.dataset && event.target.dataset.deactivate == "modal") || event.target.classList.contains("modal")) {
                for (let modal of system.classifiedComponents["modal"]) {
                    modal.setIsActive(false);
                }
            }
        });
    }
}

export default Modal;
