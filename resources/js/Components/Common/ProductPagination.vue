<template>
  <v-row
    align="center"
    justify="center"
    no-gutters
    class="p-5"
  >
    <v-pagination
      v-model="page"
      :length="link.last_page"
      :total-visible="5"
      rounded="circle"
    ></v-pagination>
  </v-row>
</template>

<script setup lang="ts">
import { watch, ref } from 'vue';

const props = defineProps(['link']);

const emit = defineEmits(['changePage'])

const page = ref(props.link.current_page);

watch(() => page.value, (newVal) => {
  emit('changePage', newVal)
});
</script>
