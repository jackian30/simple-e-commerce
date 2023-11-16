<template>
  <Head :title="product.name" />

  <Layout>
    <v-container>
      <Link :href="route('product.archive')">
      <v-btn
        icon="mdi-arrow-left"
        variant="plain"
      />
      </Link>
      <v-row>
        <v-col cols="5">
          <v-carousel>
            <v-carousel-item
              v-for="(image, key) in product.product_image "
              :key="key"
              :src="image.url"
              cover
            ></v-carousel-item>
          </v-carousel>
        </v-col>
        <v-col cols="7">
          <v-card class="fill-height">
            <v-card-title>
              <h1>{{ product.name }}</h1>
            </v-card-title>

            <v-card-subtitle>
              ${{ product.price }}
            </v-card-subtitle>
            <v-card-text>
              <h2 class="mb-3">Details:</h2>
              <p>{{ product.details }}</p>
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
                variant="text"
                append-icon="mdi-cart-plus"
                @click="cart.addToCart(product)"
              >
                Add to cart
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-card>
          <v-card-title>
            Description
          </v-card-title>
          <v-card-text>
            <p>{{ product.description }}</p>

          </v-card-text>
        </v-card>
      </v-row>
    </v-container>
  </Layout>
</template>
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

import Layout from "@/Layouts/GuestLayout.vue";

import { useCart } from '@/stores/cart';

const props = defineProps(['product']);

const cart = useCart();
</script>