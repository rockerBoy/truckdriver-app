<script setup>
import { onMounted, ref } from 'vue';
import {vMaska} from "maska/vue";

defineProps({
    modelValue: String,
    placeholder: String,
});

defineEmits(['update:modelValue']);
const date = ref(null);

onMounted(() => {
    if (date.value.hasAttribute('autofocus')) {
        date.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>
<template>
    <input
        ref="date"
        v-maska
        data-maska="##.##.####"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder"
    >
</template>
