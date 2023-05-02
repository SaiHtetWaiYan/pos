import { defineStore } from 'pinia';

export const useCartStore = defineStore({
    id: 'cart',
    state: () => ({
        products: [],
    }),
    actions: {
        addItem(product){

            const existingProduct = this.products.find(p => p.id === product.id);
            if (existingProduct) {
                // If the product already exists, increment the quantity
                    if(existingProduct.quantity < existingProduct.stock ){
                        existingProduct.quantity += product.quantity;
                    }

            } else {
                // If the product does not exist, add it to the cart
                this.products.push(product);
            }
        },
        removeItem(index) {
            this.products.splice(index, 1);
        },
        removeAllItem(){
            this.products = []

        },

    },
    persist: true,
});
