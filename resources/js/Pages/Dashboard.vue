<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ref, onMounted } from 'vue'

import CreateRequest from '@/Components/CreateRequest.vue'

defineProps({
    reqs: Array,
    store_url: String
})

const description = (des) => {
    const words = des.split(" ").length
    if (words > 5) {
        return `${(des.split(" ").slice(0, 6).join(" ")).trim()}...`
    } else {
        return `${(des.split(" ").slice(0, 4).join(" ")).trim()}...`
    }
}

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
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <CreateRequest :store_url="store_url" />
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="py-6 px-4 bg-white border-b border-gray-200
                    ">
                        <header class="mb-4">
                            <h2 class="font-bold">{{ req.title }}</h2>
                        </header>
                        <section>
                            <p class="text-sm">{{ description(req.description) }}</p>
                        </section>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>
