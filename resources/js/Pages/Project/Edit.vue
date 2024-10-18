<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, nextTick } from 'vue';
import { Link, Head } from '@inertiajs/vue3';

// Acesse as props diretamente no setup usando defineProps
const props = defineProps({
    project: {
        type: Object,
        required: true,
    },
    status: {
        type: String,
        required: false,
    },
    id:{
        type: String,
        required: true,
    },
});
console.log(props.project.name)
const form = useForm({
    name: props.project.name || '',
    description: props.project.description || '',
});

const updateProject = () => {
    form.put(route('project.edit',props.id), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: async () => {
            await nextTick(); // Garantindo que o DOM está atualizado antes de tentar focar
            if (form.errors.description) {
                form.reset('description');
                document.getElementById('description').focus();
            }
            if (form.errors.name) {
                form.reset('name');
                document.getElementById('name').focus();
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
                {{ props.project.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <form @submit.prevent="updateProject" class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="name" value="Nome do projeto" />
                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autocomplete="name" />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="description" value="Descrição do projeto" />
                        <TextInput id="description" v-model="form.description" type="text" class="mt-1 block w-full" autocomplete="description" />
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
