<script setup>
import { ref, onMounted, onUpdated } from 'vue'
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import Editor from '@toast-ui/editor'
import '@toast-ui/editor/dist/toastui-editor.css'

import Modal from '@/Components/Modal.vue'

const props = defineProps({
    store_url: String
})


let showModal = ref(false)

let error = ref('')
let apps = ref([])

const form = useForm({
    title: '',
    app: '',
    description: '',
    requested_by: ''
})

const editorHtml = ref(null)
let editor = null


onMounted(async () => {
    try {
        const res = await fetch('/apps/short')
        if (!res.ok) error.value = "Erro ao obter lista de aplicatioções!"
        else
            apps.value = await res.json()
    } catch (err) {
        console.log(err);
        error.value = err.message
    }
})

onUpdated(() => {
    if (editorHtml.value) {
        editor = new Editor({
            el: editorHtml.value,
            height: '400px',
            initialEditType: 'markdown',
            placeholder: 'Write something cool!',
        })
        editor.setMarkdown(form.description)
    }
})

const createRequest = () => {
    console.log(editor.getMarkdown())
    form.post(props.store_url)
}

const getMarkdown = (e) => {
    console.log(editor.getMarkdown())
    form.description = editor.getMarkdown()
}

function closeModal() {
    console.log("Oi!!");
    form.description = editor.getMarkdown()
    showModal.value = false
}

</script>

<template>
    <button class="mb-2 hover:text-red-500" @click="showModal = true">Novo
        pedido...
    </button>
    <Teleport to="body">
        <Modal v-if="showModal" @close="closeModal">
            <template #header>
                <h2 class="font-bold text-lg mb-3">Criar pedido</h2>
            </template>
            <template #default>
                <form @submit.prevent="createRequest">
                    <div class="flex flex-col gap-2">
                        <input class="px-2 py-1 flex-1 border-red-400 border rounded"
                            placeholder="Titulo do novo pedido..." v-model="form.title">
                        <select v-model="form.app" class="px-2 py-1 border-red-400 rounded">
                            <option value="" disabled>Selectione uma aplicação</option>
                            <option v-for="application in apps" :key="application.id">{{ application
                            }}
                            </option>
                        </select>
                        <!-- <textarea cols="30" rows="10" class="px-2 py-2 border-red-400 rounded"
                            v-model="form.description"></textarea> -->
                        <div>
                            <label for="editor">Descrição:</label>
                            <div id="editor" ref="editorHtml" @keydown="getMarkdown"></div>
                        </div>
                        <label for="editor">Pedido por:</label>
                        <input class="px-2 py-1 flex-1 border-red-400 border rounded"
                            v-model="form.requested_by" placeholder="Maria João">
                    </div>


                    <p v-if="error">{{ error }}</p>
                    <button class="mt-3 px-2 py-1 bg-red-500
                        border-red-400 text-white rounded-xl">Ok</button>
                </form>
            </template>
        </Modal>
    </Teleport>

</template>