<script setup>

</script>

<template>
    <div class="fixed inset-0 bg-gray-600 opacity-80 grid place-items-center">
        <div class="bg-white text-black w-4/5 max-w-2xl p-6 rounded-md opacity-95">
            <header>
                <slot name="header" v-if="$slots.header">
                </slot>
            </header>
            <div>
                <slot name="default">
                </slot>
            </div>
            <footer>
                <slot name=footer>
                    <button class="mt-3 px-2 py-1 bg-red-500 border-red-400 text-white
                        rounded-xl" @click="$emit('close')">Close</button>
                </slot>
            </footer>

        </div>
    </div>
</template>