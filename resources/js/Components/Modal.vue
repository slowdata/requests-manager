<script setup>

</script>

<template>
    <div class="fixed inset-0 bg-gray-600 opacity-80 grid place-items-center">
        <div class="bg-white text-black w-4/5 max-w-2xl p-6 rounded-md opacity-100">
            <header>
                <div class="flex justify-between items-start">
                    <slot name="header" v-if="$slots.header">
                    </slot>
                    <button class="pr-3 font-bold text-3xl" @click="$emit('close')">&times;</button>
                </div>
            </header>
            <div>
                <slot name="default">
                </slot>
            </div>
            <footer>
                <slot name="footer">

                </slot>
            </footer>

        </div>
    </div>
</template>