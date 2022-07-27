<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

defineProps({
    reqs: Array
})
let showModal = ref(true)
</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Requests
            </h2>
        </template>


        <div v-if="!reqs.length" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>

        <div v-else v-for=" req in reqs" class="py-12" :key="req.id">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <button class="mb-1 pl-1">Novo pedido...</button>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ req.title }}
                    </div>
                </div>
            </div>
        </div>


        <div v-if="showModal" class="fixed inset-0 bg-gray-700 opacity-60 grid place-items-center">
            <div class="bg-white text-black w-3/4 max-w-lg p-6 rounded-md">Titulo e novo request
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
