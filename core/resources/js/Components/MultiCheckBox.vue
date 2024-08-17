<script setup>
import Checkbox from "@/Components/Checkbox.vue";

defineProps({
    option: Array,
    options: {
        type: Array,
        required: true,
        validator: (value) => {
            const hasNameKey = value.every((option) =>
                Object.keys(option).includes('name')
            );
            const hasIdKey = value.every((option) =>
                Object.keys(option).includes('id')
            );

            return hasNameKey && hasIdKey;
        },
    },
    modelValue: {
        type: Array,
        default: []
    },
})
</script>
<template>
    <div class="flex">
        <Checkbox
            v-for="option in options"
            :key="option"
            :label="option.name"
            :checked="modelValue.includes(option.id)"
            v-bind="modelValue"
        ></Checkbox>
    </div>
</template>
