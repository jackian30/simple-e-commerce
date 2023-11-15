<template>
  <Head title="Checkout" />

  <Layout>
    <v-container>
      <Link :href="route('product.archive')">
      <v-btn
        icon="mdi-arrow-left"
        variant="plain"
      />
      </Link>
      <v-row>
        <v-col>
          <v-card>
            <v-card-title>
              Your Orders:
            </v-card-title>
            <v-card-text>
              <v-list>
                <v-list-item>
                  <v-list-item-title>{{ product.name }}</v-list-item-title>
                  <v-list-item-subtitle>${{ product.price }}</v-list-item-subtitle>

                  <template #append>
                    <Counter v-model.number="quantity" />

                  </template>
                </v-list-item>
              </v-list>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col>
          <v-card>
            <v-card-title>
              Checkout
            </v-card-title>
            <v-card-text>
              <h1>Total Price:</h1>
              <p>${{ totalPrice }}</p>
            </v-card-text>
            <v-card-actions>
              <v-btn
                color="primary"
                variant="elevated"
                block
                v-if="$page.props.auth.user"
                @click="checkoutCart"
              >
                Checkout
              </v-btn>
              <Link
                :href="route('login')"
                v-else
                class="min-w-[100%]"
              >
              <v-btn
                color="warning"
                variant="elevated"
                block
              >
                Login to Checkout
              </v-btn>
              </Link>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </Layout>
</template>
<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

import Counter from "@/Components/Input/Counter.vue";
import Layout from "@/Layouts/GuestLayout.vue";

import { ref, watch, computed } from 'vue';
import axios from 'axios';

const props = defineProps(['product']);

const quantity = ref(1);

watch(() => quantity.value, (newVal) => {
  if (newVal <= 0) {
    quantity.value = 1
  }
})
const totalPrice = computed(() => {
  return quantity.value * props.product.price;
})

function checkoutCart () {
  axios.post(route('checkout.single', props.product.id), { quantity: quantity.value }).then((res) => {
    Swal.fire({
      title: 'Checkout successful!',
      icon: 'success',
    }).then(() =>
      router.visit(route('product.archive'))
    );
  })
}
</script>