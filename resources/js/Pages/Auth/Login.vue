<template>
    <Head title="Log in" />
    <Layout :isLoading="form.processing">
        <v-card-text>
            <div class="grid place-items-center mb-[20px]">

            </div>
            <div
                v-if="status"
                class="mb-4 font-medium text-sm text-green-600"
            >
                {{ status }}
            </div>
            <v-form @submit.prevent="submit">
                <CustomInput
                    v-model="form.email"
                    :errorMessages="generateErrors(v$.email)"
                    label="E-mail"
                    required
                    type="email"
                    @input="v$.email.$touch()"
                    @blur="v$.email.$touch()"
                ></CustomInput>

                <CustomInput
                    v-model="form.password"
                    :errorMessages="generateErrors(v$.password)"
                    label="Password"
                    required
                    type="password"
                    outlined
                    @input="v$.password.$touch()"
                    @blur="v$.password.$touch()"
                    class="mt-[20px]"
                ></CustomInput>

                <v-checkbox
                    v-model="form.remember"
                    label="Remember me"
                    dense
                ></v-checkbox>
                <div class="grid grid-cols-2 gap-4">
                    <v-btn
                        rounded="pill"
                        color="primary"
                        style="color: white"
                        type="submit"
                        :loading="form.processing"
                    >
                        Sign In
                    </v-btn>
                    <Link :href="route('register')">
                    <v-btn
                        rounded="pill"
                        color="primary"
                        variant="outlined"
                        min-width="100%"
                    >Register
                    </v-btn>
                    </Link>
                </div>

                <Link
                    :href="route('password.request')"
                    class="grid place-items-center mt-[20px] text-[10px] not-italic font-normal leading-[7px text-[#5D5FEF]"
                >
                Forgot your password?
                </Link>
            </v-form>
        </v-card-text>
    </Layout>
</template>

<script setup lang="ts">
import { computed, reactive } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";

import { Head, Link, useForm } from '@inertiajs/vue3';

import { useCart } from '@/stores/cart';

const cart = useCart();

import CustomInput from "@/Components/Input/CustomTextField.vue";
import Layout from "@/Layouts/AuthLayout.vue";

import { generateErrors } from "@/utils/errorGenerator";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const $externalResults = reactive({});

const rules = computed(() => ({
    email: {
        required,
        email,
    },
    password: {
        required,
    },
}));

const v$ = useVuelidate(rules, form, { $externalResults });

const submit = async () => {
    await v$.value.$touch();

    if (v$.value.$invalid) {
        return await false;
    }

    form.post(route('login'), {
        onFinish: async () => {
            await cart.getExistingCart();
            form.reset('password');
        },
        onError: async (err) => {
            await Object.keys(err).forEach((item) => {
                $externalResults[item] = err[item];
            });
        }
    });
};
</script>
