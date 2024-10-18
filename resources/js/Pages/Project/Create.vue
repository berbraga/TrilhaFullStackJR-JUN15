<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';

import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';

const passwordInput = ref(null);
const name = ref(null);

const form = useForm({
    name: '',
    description: '',

});

const updatePassword = () => {
    form.post(route('project.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.description) {
                form.reset('description');
                passwordInput.value.focus();
            }
            if (form.errors.name) {
                form.reset('name');
                name.value.focus();
            }
        },
    });
};
</script>

<template>

    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">

            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

                <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="name" value="Nome do projeto " />

                        <TextInput id="name" ref="name" v-model="form.name" type="text" class="mt-1 block w-full"
                            autocomplete="name" />

                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="password" value="Descricao do projeto" />

                        <TextInput id="description" ref="passwordInput" v-model="form.description" type="text"
                            class="mt-1 block w-full" autocomplete="description" />

                        <InputError :message="form.errors.description" class="mt-2" />
                    </div>



                    <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                        <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">
                                salvar
                            </p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>