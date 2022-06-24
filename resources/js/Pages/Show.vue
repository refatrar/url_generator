<template>
    <BreezeGuestLayout>
        <Head title="Create Post" />

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <Link class="mt-5 bg-violet-500 hover:bg-violet-600 focus:outline-none focus:ring focus:ring-violet-300 active:bg-violet-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white" :href="route('home')">
                    Go Back
                </Link>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6">
                    <h1><strong>Title:</strong> {{ post.title }}</h1>
                    <h3><strong>Slug:</strong> {{ post.slug }}</h3>
                    <h5><strong>Description:</strong></h5>
                    <p>{{ post.description }}</p>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';

    name: 'Show'

    defineProps({
        post: {
            type: Object,
            default: null,
        },
    });
</script>
