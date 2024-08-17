<script setup>
import { onMounted, ref } from 'vue';
import {vMaska} from "maska/vue";

defineProps({
    modelValue: String,
    placeholder: String,
    allowedPattern: {
        type: Object,
        default: {}
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        v-maska="allowedPattern"
        :placeholder="placeholder"
    >
</template>
