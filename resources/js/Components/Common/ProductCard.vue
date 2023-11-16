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
      <v-row no-gutters>
        {{ product.name }}
        <v-spacer />
        <Link :href="route('product.index', product.slug)">
        <v-btn>
          View Details
        </v-btn>
        </Link>
      </v-row>

    </v-card-title>

    <v-card-subtitle>
      ${{ product.price }}
    </v-card-subtitle>
    <v-card-text>

    </v-card-text>

    <v-card-actions>

      <v-spacer />
      <Link
        :href="route('checkout.single.show', product.id)"
        class="mr-2"
      >

      <v-btn
        color="primary"
        variant="elevated"
        append-icon="mdi-cart-check"
      >
        Checkout
      </v-btn>
      </Link>

      <v-btn
        color="warning"
        variant="elevated"
        append-icon="mdi-cart-plus"
        @click="cart.addToCart(product)"
      >
        Add to cart
      </v-btn>

    </v-card-actions>
  </v-card>
</template>
<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

import { useCart } from '@/stores/cart';

const props = defineProps(['product']);

const cart = useCart();
</script>