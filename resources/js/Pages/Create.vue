<template>
    <BreezeGuestLayout>
        <Head title="Create Post" />

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="title" value="Title" />
                <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="description" value="Description" />
                <BreezeTextarea id="description" type="description" class="mt-1 block w-full" v-model="form.description" required autocomplete="description" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('home')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Go Back
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    submit
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>

<script setup>
    import BreezeButton from '@/Components/Button.vue';
    import BreezeGuestLayout from '@/Layouts/Guest.vue';
    import BreezeInput from '@/Components/Input.vue';
    import BreezeTextarea from '@/Components/Textarea.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import { Link, useForm } from '@inertiajs/inertia-vue3';
    import { ref } from '@vue/reactivity';

    name: 'Create'

    const loading = ref(false);
    const form = useForm({
        title: '',
        description: ''
    })

    const submit = () => {
        form.post(route('store'), {
            onFinish: () => form.reset('title', 'description'),
        });
    };
</script>
