import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ["checkbox", "hiddenInput"]

    connect() {
        this.updateHiddenInput();
    }

    /**
     * Update the hidden input based on the checkbox.  I used this to ensure the
     * hidden input is disabled when the checkbox is checked, thus the value is not submitted with the form.
     */
    updateHiddenInput() {
        this.hiddenInputTarget.disabled = this.checkboxTarget.checked;
    }
}