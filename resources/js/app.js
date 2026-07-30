import 'bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('requisitionForm', (initialItems = []) => ({
    items: initialItems.length ? initialItems : [{ product_id: '', quantity: 1, remarks: '' }],
    addItem() {
        this.items.push({ product_id: '', quantity: 1, remarks: '' });
    },
    removeItem(index) {
        if (this.items.length > 1) {
            this.items.splice(index, 1);
        }
    },
}));

Alpine.start();
