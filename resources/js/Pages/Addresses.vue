<script setup>
import { Head } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    addresses: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <Head title="Addresses" />
    <div class="container mx-auto px-4 py-8 flex flex-col items-center">
        <h1 class="text-2xl font-bold text-blue-800 mb-8">Список адресов</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="hidden md:table-cell px-6 py-3 text-left text-sm font-semibold text-gray-700 w-1/5">Регион</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 w-1/4">Город</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Улица</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(address, index) in addresses.data"
                        :key="index"
                        class="transition-colors duration-200 hover:bg-gray-100"
                        :class="{ 'bg-gray-50': index % 2 }">
                        <td class="hidden md:table-cell px-6 py-4 text-sm text-gray-900">{{ address.region }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ address.city }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ address.street }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Pagination
            :current-page="addresses.current_page"
            :last-page="addresses.last_page"
            @page-changed="page => $inertia.get('/', { page })"
        />
    </div>
</template>
