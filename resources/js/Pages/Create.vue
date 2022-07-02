<template>
    <BreezeGuestLayout>
        <Head title="Create Post" />

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="url" value="Url" />
                <BreezeInput
                    id="url"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.url"
                    autofocus autocomplete="url"
                    :error="errors.url"
                />
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

    name: 'Create'

    const props = defineProps({
        errors: Object,
        flash: Object
    });

    const form = useForm({
        url: '',
    })

    const submit = () => {
        form.post(route('store'), {
            onSuccess: (response) => {
                if(props.flash.type === "success"){
                    toast.success(props.flash.message)
                } else {
                    toast.error(props.flash.message)
                }

                form.reset('url')
            },
            onError: () => toast.error("User Create Failed")
        });
    };
</script>
