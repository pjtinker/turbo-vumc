import { Controller } from '@hotwired/stimulus'

// Usage: data-controller="flash"
export default class extends Controller {
    remove() {
        this.element.remove()
    }

    /**
     * The animation events were not working for me, so I just used a timeout to remove the element.
     */
    connect() {
        setTimeout(() => {
            this.element.remove()
          }, "5000");
      }
}
