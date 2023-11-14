<template>
    <v-app class="auth-main">
        <v-overlay
            v-model="state.loading"
            persistent
            content-class="grid place-items-center w-full h-full"
        >
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
        <v-container class="auth-container">
            <v-card max-width="500" class="auth-card">
                <slot />
            </v-card>
        </v-container>
    </v-app>
</template>

<script setup>
import { reactive } from "@vue/reactivity";
import { onUnmounted } from "@vue/runtime-core";

const props = defineProps({
    isLoading: {
        type: Boolean,
        default: true,
    },
});

const state = reactive({
    loading: props.isLoading,
});

onUnmounted(() => {
    state.loading = false;
});
</script>

<style lang="scss" scoped>
.auth-main {
    background: #7879f1;
}
.auth-container {
    margin: auto;
    .v-card {
        margin: auto;
    }
}
.auth-card {
    border-radius: 9px;
}
</style>
