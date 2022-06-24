<template>
    <BreezeGuestLayout>
        <Head title="Posts" />

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <Link class="mt-5 bg-violet-500 hover:bg-violet-600 focus:outline-none focus:ring focus:ring-violet-300 active:bg-violet-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white" :href="route('create')">
                    Create New
                </Link>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Title</th>
                                <th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Slug</th>
                                <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(post, p) in posts" :key="p">
                                <td><Link :href="route('show', {param: post.param})">{{ post.title }}</Link></td>
                                <td>{{ post.slug }}</td>
                                <td>{{ post.description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';

    name: 'Welcome'

    defineProps({
        posts: {
            type: Array,
            default: [],
        },
    });
</script>
