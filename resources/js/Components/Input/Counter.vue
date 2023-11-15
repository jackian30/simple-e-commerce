<template>
    <v-input
        variant="solo"
        hide-details="auto"
        :error-messages="errorMessages"
        class="custom-counter"
    >
        <div class="counter-group">
            <v-btn
                class="counter-button -left"
                @click="states.count === 0 ? 0 : states.count--"
                icon="mdi-minus"
                variant="flat"
                size="small"
            >
            </v-btn>
            <div class="counter-text">
                <span>{{ states.count }}</span>
            </div>
            <v-btn
                class="counter-button -right"
                @click="states.count++"
                icon="mdi-plus"
                variant="flat"
                size="small"
            >
            </v-btn>
        </div>
    </v-input>
</template>

<script setup>
import { reactive, ref } from "@vue/reactivity";
import { onBeforeMount, watch } from "@vue/runtime-core";
import { onUpdated } from "vue";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
    modelValue: {},
    attrs: {
        type: Object,
        default: {},
    },
    errorMessages: {
        default: () => [],
    },
});

const states = reactive({
    count: props.modelValue,
});

onBeforeMount(() => {
    if (props.modelValue) {
        states.count = props.modelValue;
    } else {
        states.count = 0;
    }
});

watch(
    () => states.count,
    (val) => {
        if (val === 0) {
            states.count = 1
        } else {
            emit("update:modelValue", val);
        }
    }
);
</script>

<style lang="scss">
.custom-counter {
    .v-input__control {
        display: unset;

        .counter-group {
            display: flex;
            align-items: stretch;

            .v-btn {
                &.counter-button {
                    padding: 0;
                    display: flex;
                    min-width: unset;
                    border-radius: 4px;
                    align-items: center;
                    box-sizing: border-box;
                    justify-content: center;
                    background-color: #fff;
                    border: 2px solid #ebebff;

                    .v-icon {
                        font-size: 20px;
                        color: #7d74ff;
                    }

                    &.-left {
                        border-radius: 4px 0 0 4px;
                    }

                    &.-right {
                        border-radius: 0 4px 4px 0;
                    }
                }
            }

            .counter-text {
                display: flex;
                background-color: #fff;

                border: 2px solid #ebebff;
                border-left: none;
                border-right: none;

                width: 100%;
                max-width: 55px;
                min-width: 30px;

                span {
                    margin: auto;
                    font-size: 14px;
                    font-weight: 400;
                    color: #3d4551;
                }
            }
        }
    }
}
</style>
