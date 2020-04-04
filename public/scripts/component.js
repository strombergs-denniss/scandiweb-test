class Component {
    constructor(element) {
        this.class = element.classList[0];
        this.id = element.id;
        this.parent = null;
        this.children = [];
        this.element = element;
        this.isActive = false;
    }

    initialize() {}

    onActivate() {}

    onDeactivate() {}

    setIsActive(isActive) {
        this.isActive = isActive;

        if (this.isActive) {
            this.element.classList.add("active");
            this.onActivate();
        } else {
            this.element.classList.remove("active");
            this.onDeactivate();
        }
    }

    switch() {
        if (this.isActive) {
            this.setIsActive(false);
        } else {
            this.setIsActive(true);
        }
    }

    static initializeAll() {}
}

export default Component;
