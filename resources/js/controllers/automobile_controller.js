import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ['driverSelect'];
    static values = { drivers: Array };

    connect() {
        // Update the select list when the page loads
        const checkbox = document.getElementById("automatic");
        this.updateSelectList({ target: { checked: checkbox.checked } });
    }

    /**
     * Update the driver select list based on the automatic checkbox.  This is the one ACTUAL hotwired
     * component in the app.
     * @param {*} event 
     */
    updateSelectList(event) {
        const isManual = !event.target.checked;
        const frame = document.getElementById("driver-select-frame");

        const url = `/drivers/get_driver_select?isManual=${isManual}&currentDriverId=${this.driverSelectTarget.value}`;

        // Use Turbo to update the frame
        Turbo.visit(url, { frame: frame.id });
    }

}