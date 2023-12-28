import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ['image', 'imageInput'];
    static values = { type: String, editable: Boolean };

    /**
     * Updates the thumbnail image for the item type
     * 
     * @param {*} event 
     * @returns 
     */
    updateThumbnail(event) {
        event.preventDefault();
        const itemType = this.typeValue;
        const editable = this.editableValue;

        if (!editable) {
            return;
        }

        fetch(`/unsplash/get-random-image-thumbnail/${itemType}`)
            .then(response => response.json())
            .then(data => {
                if (data.avatar_url) {
                    this.imageTarget.src = data.avatar_url;
                    this.imageInputTarget.value = data.avatar_url;
                }
            })
            .catch(error => console.error('Error:', error));
    }
}