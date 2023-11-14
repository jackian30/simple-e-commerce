<template>
    <Head title="Forgot Password" />

    <Layout :isLoading="form.processing">
        <v-card-title>
            <v-toolbar-title>Forgot Password</v-toolbar-title>
        </v-card-title>
        <v-card-text>
            <div class="mb-4 text-sm text-gray-600">
                Forgot your password? No problem. Just let us know your email
                address and we will email you a password reset link that will
                allow you to choose a new one.
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
                    label="Email"
                    required
                    type="email"
                    @input="v$.email.$touch()"
                    @blur="v$.email.$touch()"
                ></CustomInput>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-btn
                rounded="pill"
                color="#5D5FEF"
                type="submit"
                width="100%"
                @click="submit"
                variant="elevated"
                :loading="form.processing"
            >Email Password Reset Link</v-btn>
        </v-card-actions>
    </Layout>
</template>

<script setup lang="ts">
import { computed, reactive } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";

import { Head, useForm } from '@inertiajs/vue3';

import CustomInput from "@/Components/Input/CustomTextField.vue";
import Layout from "@/Layouts/AuthLayout.vue";

import { generateErrors } from "@/utils/errorGenerator";

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const $externalResults = reactive({});

const rules = computed(() => ({
    email: {
        required,
        email,
    },
}));

const v$ = useVuelidate(rules, form, { $externalResults });

const submit = async () => {
    await v$.value.$touch();

    if (v$.value.$invalid) {
        return await false;
    }

    form.post(route('password.email'), {
        onError: async (err) => {
            await Object.keys(err).forEach((item) => {
                $externalResults[item] = err[item];
            });
        }
    });
};
</script>
