import axios from "axios";
import { defineStore } from "pinia";
import { usePage } from '@inertiajs/vue3';

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
        this.products[isExist].originalPrice = product.price;
        this.products[isExist].price = product.price * this.products[isExist].quantity;
      } else {
        let productToPush = JSON.parse(JSON.stringify(product));

        productToPush.quantity = 1;
        productToPush.originalPrice = product.price;
        productToPush.price = parseFloat(product.price)

        this.products.push(productToPush);
      }

      if (usePage().props.auth.user) {
        this.saveToCart();
      }
    },
    removeProduct (key: number) {
      this.products.splice(key, 1);

      if (usePage().props.auth.user) {
        this.saveToCart();
      }
    },
    changeQuantity (key: number) {
      this.products[key].price = this.products[key].originalPrice * this.products[key].quantity;

      if (usePage().props.auth.user) {
        this.saveToCart();
      }
    },
    saveToCart () {
      axios.post(route('cart.store'), { products: this.products }).then(res => {
        this.products = [];
        res.data.forEach(product => {
          this.products.push({
            id: product.product.id,
            name: product.product.name,
            quantity: product.quantity,
            price: product.product.price * product.quantity,
            originalPrice: product.product.price,
          });
        })
      });
    }
  },
  persist: {
    storage: localStorage,
  },
});
