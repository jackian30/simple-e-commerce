<template>
  <Head title="Home" />
  <Layout>
    <v-container>
      <v-form @submit.prevent>
        <v-text-field
          variant="outlined"
          label="Search"
          v-model="search"
          append-icon="mdi-magnify"
          @click:append="navigateTo(1)"
          @click:clear="navigateTo(1)"
          @keydown.enter="navigateTo(1)"
          clearable
        ></v-text-field>
      </v-form>
      <v-container class="grid md:grid-cols-3 grid-cols-1 gap-10">
        <ProductCard
          v-for="product in products.data"
          :key="product.id"
          :product="product"
        ></ProductCard>
      </v-container>
      <Pagination
        :link="products"
        @changePage="navigateTo"
      />
    </v-container>
  </Layout>
</template>
<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';

import Layout from "@/Layouts/GuestLayout.vue";

import Pagination from '@/Components/Common/ProductPagination.vue'
import ProductCard from '@/Components/Common/ProductCard.vue'
import { ref } from 'vue';

import { useCart } from '@/stores/cart'

const props = defineProps(['products', 'search']);

const search = ref(props.search);

const cart = useCart();

function navigateTo (page: number) {
  let link = `${props.products.path}?page=${page}`;

  if (search.value) {
    link = `${link}&search=${search.value}`
  }

  router.visit(link);
}
</script>