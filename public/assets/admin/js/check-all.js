class CheckBoxManager {
    constructor({selector, selectorAll, buttonDeleteAllSelector, titleSelector, prefix}) {
        this.checkBoxList = $(selector);
        this.checkAll = $(selectorAll);
        this.buttonDeleteAll = $(buttonDeleteAllSelector);
        this.title = $(titleSelector)
        this.prefix = prefix ? prefix : 'mục';
        this.initialize();
    }

    initialize() {
        this.checkBoxList.change((event) => this.handleCheckBoxChange(event));
        this.checkAll.change((event) => this.handleCheckAllChange(event));
        this.handleShowButton();
    }

    handleCheckBoxChange(event) {
        const {checked} = event.target;
        const checkedList = this.checkBoxList.filter(':checked');
        if (checked && checkedList.length === this.checkBoxList.length) {
            this.checkAll.prop('checked', true);
        } else if (checkedList.length === 0) {
            this.checkAll.prop('checked', false);
        }
        this.handleShowButton();
    }

    handleCheckAllChange(event) {
        const {checked} = event.target;
        this.checkBoxList.prop('checked', checked);
        this.handleShowButton();
    }

    handleShowButton() {
        const checkedList = this.checkBoxList.filter(':checked');
        if (checkedList.length) {
            this.title.text(`Bạn đang chọn ${checkedList.length} ${this.prefix}`);
            this.buttonDeleteAll.attr("style", "display:flex");
        } else {
            this.buttonDeleteAll.hide();
        }
    }
}
