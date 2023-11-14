<template>
    <Head title="Register" />

    <Layout :isLoading="form.processing">
        <v-card-title>
            Register
        </v-card-title>
        <v-card-text>
            <v-form>
                <CustomInput
                    v-model="form.name"
                    :errorMessages="generateErrors(v$.name)"
                    label="Name"
                    required
                    outlined
                    @input="v$.name.$touch()"
                    @blur="v$.name.$touch()"
                    class="mt-[20px]"
                ></CustomInput>

                <CustomInput
                    v-model="form.email"
                    :errorMessages="generateErrors(v$.email)"
                    label="E-mail"
                    required
                    type="email"
                    @input="v$.email.$touch()"
                    @blur="v$.email.$touch()"
                    class="mt-[20px]"
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
                    label="Confirm password"
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
            <v-spacer />
            <Link :href="route('login')">
            <v-btn>
                Already registered?
            </v-btn>
            </Link>

            <v-btn
                @click="submit"
                color="#7D74FF"
                size="large"
                variant="elevated"
                rounded="pill"
                :loading="form.processing"
            >Register</v-btn>
        </v-card-actions>
    </Layout>
</template>
<script setup lang="ts">
import { computed, reactive } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email, sameAs } from "@vuelidate/validators";

import { Head, Link, useForm } from '@inertiajs/vue3';

import CustomInput from "@/Components/Input/CustomTextField.vue";
import Layout from "@/Layouts/AuthLayout.vue";

import { generateErrors } from "@/utils/errorGenerator";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const $externalResults = reactive({});

const rules = computed(() => ({
    name: {
        required,
    },
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

    form.post(route('register'), {
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