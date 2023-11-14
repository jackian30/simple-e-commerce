<template>
  <v-text-field
    ref="input"
    :model-value="modelValue"
    :type="type"
    :label="label"
    :placeholder="placeholder"
    :error-messages="errorMessages"
    :suffix="suffix"
    :disabled="disabled"
    :maxlength="maxlength"
    :required="required"
    @input="$emit('update:modelValue', $event.target.value)"
    :variant="variant"
    :bg-color="bgColor"
    @keypress="setMaxLength($event) & isNumber($event)"
    @paste="setMaxLength($event) & isNumber($event)"
    hide-details="auto"
    class="custom-input"
  />
</template>

<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
  label: {},
  value: {},
  modelValue: {},
  placeholder: {},
  disabled: {
    type: Boolean,
    default: false,
  },
  type: {
    type: String,
    default: "text",
  },
  maxlength: {
    type: Number,
    default: 255,
  },
  onlyNumbers: {
    type: Boolean,
    default: false,
  },
  isFloat: {
    type: Boolean,
    default: false,
  },
  suffix: {
    type: String,
    default: null,
  },
  errorMessages: {
    default: () => [],
  },
  required: {
    type: Boolean,
    default: false,
  },
  variant: {
    type: String,
    default: "solo",
  },
  bgColor: {
    type: String,
    default: "rgba(165, 166, 246, 0.1)",
  },
});

defineEmits(["update:modelValue"]);
defineExpose({ focus: () => input.value.focus() });

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

const input = ref(null);

function setMaxLength (evt) {
  if (props.modelValue.length >= props.maxlength) {
    evt.preventDefault();
  }
}

function isNumber (evt) {
  if (props.type == "number" || props.onlyNumbers) {
    evt = evt ? evt : window.event;
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (
      charCode > 31 &&
      (charCode < 48 || charCode > 57) &&
      (charCode !== 46 || charCode !== 45 || charCode !== 43)
    ) {
      evt.preventDefault();
    } else {
      return true;
    }
  }

  if (props.isFloat) {
    evt = evt ? evt : window.event;
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (
      charCode > 31 &&
      (charCode < 48 || charCode > 57) &&
      (charCode !== 45 || charCode !== 43) &&
      charCode !== 46
    ) {
      evt.preventDefault();
    } else {
      return true;
    }
  }
}
</script>
<style lang="scss">
.custom-input {
  &.v-text-field {
    .v-input__control {
      border-radius: 4px;
      box-sizing: border-box;
      border: 2px solid #ebebff;

      &:focus-within {
        border: 2px solid #7d74ff;
        outline: 0;
        transition: 0.3s ease;
      }

      .v-field {
        box-shadow: none;

        .v-field__field {
          .v-field__input {
            font-size: 14px;
            color: #3d4551;
          }
        }
      }
    }
  }
}
</style>