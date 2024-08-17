<script setup>
import Table from "@/Components/Table.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    customers: {
        type: Object,
    }
})
</script>
<template>
    <AppLayout title="Index">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🚚TRU}{DR1V3R🚛
            </h2>
        </template>
        <section class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="mb-8 text-3xl font-bold">Список замовників:</h1>
                <Table :rows="props.customers" />
            </div>
        </section>
    </AppLayout>
</template>
