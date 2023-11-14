import { defineStore } from "pinia";

export const useCart = defineStore("cart", {
  state: () => {
    return {
      products: [],
    };
  },
  actions: {
    addToCart (product) {
      let isExist = this.products.findIndex(item => item.id === product.id);

      if (isExist !== -1) {
        this.products[isExist].quantity += 1;
        this.products[isExist].price = product.price * this.products[isExist].quantity;
      } else {
        this.products.push({ ...product, quantity: 1 });
      }
    }
  },
  persist: {
    storage: localStorage,
  },
});
