<template>
  <v-card>
    <v-carousel>
      <v-carousel-item
        v-for="(image, key) in product.product_image "
        :key="key"
        :src="image.url"
        cover
      ></v-carousel-item>
    </v-carousel>

    <v-card-title>
      {{ product.name }}
    </v-card-title>

    <v-card-subtitle>
      ${{ product.price }}
    </v-card-subtitle>

    <v-card-actions>
      <v-btn>
        View Details
      </v-btn>
      <v-spacer />
      <v-btn
        color="warning"
        variant="text"
        append-icon="mdi-cart-plus"
        @click="cart.addToCart(product)"
      >
        Add to cart
      </v-btn>

    </v-card-actions>
  </v-card>
</template>
<script setup lang="ts">
import { useCart } from '@/stores/cart';

const props = defineProps(['product']);

const cart = useCart();


</script>