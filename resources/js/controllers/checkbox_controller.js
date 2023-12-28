import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ["checkbox", "hiddenInput"]

    connect() {
        this.updateHiddenInput();
    }

    updateHiddenInput() {
        this.hiddenInputTarget.disabled = this.checkboxTarget.checked;
    }
}