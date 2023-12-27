import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ['driverSelect'];
    static values = { drivers: Array };

    connect() {
      }

    updateSelectList(event) {
        const isManual = !event.target.checked;
        const frame = document.getElementById("driver-select-frame");

        const url = `/drivers/get_driver_select?isManual=${isManual}&selectedDriverId=${this.driverSelectTarget.value}`;

        // Use Turbo to update the frame
        Turbo.visit(url, { frame: frame.id });
    }
}