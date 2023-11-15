<template>
    <v-app id="inspire">
        <v-app-bar>
            <v-spacer></v-spacer>

            <Link :href="route('checkout.index')">
            <v-btn stacked>
                <v-badge
                    :content="cart.products.length"
                    color="error"
                >
                    <v-icon>mdi-cart</v-icon>
                </v-badge>
            </v-btn>
            </Link>

            <v-menu
                anchor="bottom start"
                origin="top end"
                transition="scale-transition"
                v-if="$page.props.auth.user"
            >
                <template v-slot:activator="{ props }">
                    <v-btn
                        variant="text"
                        v-bind="props"
                        stacked
                    >{{ $page.props.auth.user.name }}</v-btn>
                </template>

                <v-list>
                    <v-list-item @click="profile">
                        <v-list-item-title>Profile</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="logout">
                        <v-list-item-title>Log Out</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <Link
                :href="route('login')"
                v-else
            >
            <v-btn stacked>
                Login
            </v-btn>
            </Link>
        </v-app-bar>

        <v-main class="bg-grey-lighten-3">
            <slot />
        </v-main>
    </v-app>
</template>
  
<script setup>
import { router, Link } from '@inertiajs/vue3'

import { useCart } from '@/stores/cart'

const cart = useCart();

function profile () {
    router.visit(route("profile.edit"));
}

function logout () {
    router.post(route("logout"));
}
</script>
