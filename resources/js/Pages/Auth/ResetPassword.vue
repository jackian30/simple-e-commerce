
<template>
    <Head title="Reset Password" />

    <Layout :isLoading="form.processing">
        <v-card-title>
            Reset Password
        </v-card-title>
        <v-card-text>

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

                <CustomInput
                    v-model="form.password_confirmation"
                    :errorMessages="generateErrors(v$.password_confirmation)"
                    label="Confirm Password"
                    required
                    type="password"
                    outlined
                    @input="v$.password_confirmation.$touch()"
                    @blur="v$.password_confirmation.$touch()"
                    class="mt-[20px]"
                ></CustomInput>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                color="primary"
                @click="submit"
                variant="elevated"
            >Reeset Password</v-btn>
        </v-card-actions>
    </Layout>
</template>
<script setup lang="ts">
import { computed, reactive } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email, sameAs } from "@vuelidate/validators";

import { Head, useForm } from '@inertiajs/vue3';

import CustomInput from "@/Components/Input/CustomTextField.vue";
import Layout from "@/Layouts/AuthLayout.vue";

import { generateErrors } from "@/utils/errorGenerator";

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
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
    password_confirmation: {
        required,
        sameAs: sameAs(form.password),
    },
}));

const v$ = useVuelidate(rules, form, { $externalResults });

const submit = async () => {
    await v$.value.$touch();

    if (v$.value.$invalid) {
        return await false;
    }

    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
        onError: async (err) => {
            await Object.keys(err).forEach((item) => {
                $externalResults[item] = err[item];
            });
        }
    });
};
</script>