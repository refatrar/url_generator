<script setup>
import { onMounted, computed, ref } from 'vue';

const props = defineProps([
    'modelValue',
    "error",
    "class",
    "type",
    "id",
    "type",
    "placeholder",
    "autocomplete",
]);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
const Classes = computed(() => {
  return props.error != null ? "border-red-300" : "border-gray-300";
});
</script>

<template>
    <input
        class="focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        :class="Classes"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        :id="id"
        :type="type"
        autofocus
        :placeholder="placeholder"
        :autocomplete="autocomplete"
    />
    <span v-show="error" class="text-red">{{ error }}</span>
</template>

<style>
    input {
        width: 100%;
    }
    .text-red {
        color: red;
    }
</style>
