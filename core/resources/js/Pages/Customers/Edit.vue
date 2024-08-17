<template>
    <AppLayout title="Customer Edit Page">
        <section class="py-12 max-w-7xl mx-auto">
            <div class="mx-auto sm:px-6 lg:px-8">
                <h1 class="mb-8 text-3xl font-bold">2. Заповніть паспортні данні замовника</h1>
            </div>
            <form @submit.prevent="form.post(route('customers.update', form))" :disabled="form.processing"
                  class="bg-white rounded-md shadow overflow-hidden">
                <!-- UKR Fields start -->
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <div class="pb-8 pr-6 w-full max-w-3xl lg:w-1/2">
                        <InputLabel for="last_name" value="Прізвище"/>
                        <TextInput
                            id="last_name"
                            v-model="form.last_name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="last_name"
                            placeholder="Прізвище (Укр)"
                            :allowed-pattern="maskRules.cyrillicMask"
                        />
                        <InputError class="mt-2" :message="form.errors.last_name"/>
                    </div>

                    <div class="pb-8 pr-6 w-full max-w-3xl lg:w-1/2">
                        <InputLabel for="first_name" value="Ім'я"/>
                        <TextInput
                            id="first_name"
                            v-model="form.first_name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="last_name"
                            placeholder="Ім'я"
                            :allowed-pattern="maskRules.cyrillicMask"
                        />
                        <InputError class="mt-2" :message="form.errors.first_name"/>
                    </div>

                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <InputLabel for="patronymic" value="Побатькові"/>
                        <TextInput
                            id="patronymic"
                            v-model="form.patronymic"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="patronymic"
                            placeholder="Побатькові"
                            :allowed-pattern="maskRules.cyrillicMask"
                        />
                        <InputError class="mt-2" :message="form.errors.patronymic"/>
                    </div>
                </div>

                <!-- EN Fields start -->
                <div class="flex flex-wrap -mb-8 -mr-6 p-8 bg-gray-50">
                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <InputLabel for="first_name_en" value="First Name"/>
                        <TextInput
                            id="last_name"
                            v-model="form.first_name_en"
                            type="text"
                            class="mt-1 block w-full"
                            autofocus
                            autocomplete="first_name_en"
                            placeholder="First Name"
                            :allowed-pattern="maskRules.latinMask"
                        />
                        <InputError class="mt-2" :message="form.errors.first_name_en"/>
                    </div>

                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <InputLabel for="last_name_en" value="Last Name"/>
                        <TextInput
                            id="last_name_en"
                            v-model="form.last_name_en"
                            type="text"
                            class="mt-1 block w-full"
                            autofocus
                            autocomplete="last_name"
                            placeholder="Last Name"
                            :allowed-pattern="maskRules.latinMask"
                        />
                        <InputError class="mt-2" :message="form.errors.last_name_en"/>
                    </div>
                </div>

                <!-- Contacts -->
                <div class="flex flex-wrap -mb-8 -mr-6 p-8 bg-white">
                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <InputLabel for="email" value="Email"/>
                        <TextInput
                            id="last_name_en"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            autofocus
                            autocomplete="email"
                            placeholder="Email"
                        />
                        <InputError class="mt-2" :message="form.errors.last_name_en"/>
                    </div>

                    <div class="pr-6 w-full lg:w-1/2">
                        <InputLabel for="birth_date" value="Дата Народження"/>
                        <DateField
                            id="birth_date"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="birth_date"
                            placeholder="дд.мм.рррр"
                            v-model="form.birth_date"
                        />
                        <InputError class="mt-2" :message="form.errors.birth_date"/>
                    </div>

                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <InputLabel for="phone_number" value="Номер телефону"/>
                        <TextInput
                            id="phone_number"
                            v-model="form.phone_number"
                            type="text"
                            class="mt-1 block w-full"
                            autofocus
                            autocomplete="phone_number"
                            placeholder="+38 (0##) ###-##-##"
                        />
                        <InputError class="mt-2" :message="form.errors.phone_number"/>
                    </div>

                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <MultiCheckBox :options="messengerOptions"></MultiCheckBox>
                    </div>

                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <InputLabel for="phone_number_alt" value="Номер телефону"/>
                        <TextInput
                            id="last_name_en"
                            v-model="form.phone_number_alt"
                            type="text"
                            class="mt-1 block w-full"
                            autofocus
                            autocomplete="phone_number_alt"
                            placeholder="+38 (0##) ###-##-##"
                        />
                        <InputError class="mt-2" :message="form.errors.last_name_en"/>
                    </div>
                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <MultiCheckBox :options="messengerOptions"></MultiCheckBox>
                    </div>
                </div>

                <div class="flex items-right px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Оновити
                    </PrimaryButton>
                </div>
            </form>
        </section>
    </AppLayout>
</template>

<script setup>
import { reactive } from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DateField from "@/Components/DateField.vue";
import MultiCheckBox from "@/Components/MultiCheckBox.vue";

const props = defineProps({
    customer: {
        type: Object,
        required: true,
    }
})
const messengerOptions = [
    {
        name: 'Telegram',
        id: 'telegram',
    },
    {
        name: 'Viber',
        id: 'viber',
    },
    {
        name: 'WhatsApp',
        id: 'whatsapp',
    },
];
const maskRules = {
    cyrillicMask: reactive({
        mask: 'Zz',
        tokens: {
            Z: {
                pattern: /[а-яґєіїА-ЯҐЄІЇ]/,
                uppercase: true,
            },
            z: {
                pattern: /[а-яґєії]/,
                lowercase: true,
                repeated: true,
            },
        },
    }),
    latinMask: reactive({
        mask: 'Ll',
        tokens: {
            L: {
                pattern: /[a-zA-Z]/,
                uppercase: true,
            },
            l: {
                pattern: /[a-zA-Z]/,
                lowercase: true,
                repeated: true,
            },
        },
    }),
}
const form = useForm({
    uuid: props.customer.data.uuid,
    last_name: props.customer.data.last_name,
    last_name_en: props.customer.data.last_name_en,
    first_name: props.customer.data.first_name,
    first_name_en: props.customer.data.first_name_en,
    patronymic: props.customer.data.patronymic,
    birth_date: props.customer.data.birth_date,
    email: props.customer.data.email,
    phone_number: props.customer.data.phone_number,
    phone_number_alt: props.customer.data.phone_number_alt,
    phone_messengers: props.customer.data.phone_messengers,
    phone_alt_messengers: props.customer.data.phone_alt_messengers,
})
</script>
