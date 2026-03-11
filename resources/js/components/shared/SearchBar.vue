<template>
    <div class="p-4 flex gap-3">
        <input :value="modelValue" @input="handleInput" type="text" :placeholder="placeholder"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />

        <button v-if="modelValue && showClearButton" @click="handleClear"
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            Clear
        </button>
    </div>
</template>

<script>
export default {
    name: 'SearchBar',
    props: {
        modelValue: String,
        placeholder: String,
        showClearButton: { type: Boolean, default: true }
    },
    emits: ['update:modelValue', 'clear', 'search'],
    methods: {
        handleInput(event) {
            const val = event.target.value;
            console.log('[SearchBar] handleInput value:', val);

            // tells Vue to update the parent's searchQuery automatically
            this.$emit('update:modelValue', val);
            // Emit search event for parent to handle API
            this.$emit('search', val);
        },
        handleClear() {
            console.log('[SearchBar] handleClear clicked');
            this.$emit('update:modelValue', '');
            this.$emit('clear');
        }
    }
}
</script>
