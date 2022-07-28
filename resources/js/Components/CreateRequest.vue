<script setup>
import { ref, onMounted } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3';

import Modal from '@/Components/Modal.vue'

let showModal = ref(false)

let error = ref('')
let app = ref('')
let apps = ref([])

const form = useForm({
    pedido: '',
    app: '',
    description: ''
})

onMounted(async () => {
    try {
        const res = await fetch('/apps/short')
        if (!res.ok) error.value = "Erro ao obter aplicatioções!"
        else
            apps.value = await res.json()
    } catch (err) {
        console.log(err);
        error.value = err.message
    }
})


</script>

<template>
    <button class="mb-2 hover:text-red-500" @click="showModal = true">Novo
        pedido...
    </button>
    <Teleport to="body">
        <Modal v-if="showModal" @close="showModal = false">
            <template #header>
                <h2 class="font-bold text-lg mb-3">Criar pedido</h2>
            </template>
            <template #default>
                <div class="flex flex-col gap-2">
                    <input class="px-2 py-1 flex-1 border-red-400 border rounded"
                        placeholder="Titulo do novo pedido..." v-model="form.pedido">
                    <select v-model="form.app" class="px-2 py-1 border-red-400 rounded">
                        <option value="" disabled>Selectione uma aplicação</option>
                        <option v-for="application in apps" :key="application.id">{{ application }}
                        </option>
                    </select>
                    <textarea cols="30" rows="10" class="px-2 py-2 border-red-400 rounded"
                        v-model="form.description"></textarea>
                </div>
                <p>{{ error }}</p>
            </template>
        </Modal>
    </Teleport>

</template>