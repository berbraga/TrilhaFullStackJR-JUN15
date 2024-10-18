<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    projects: {
        type: Array,
    },
    status: {
        type: String,
    },
});


const add = () => {
    this.$router.push('/project/add');
};

const deleteProject = (id) => {
    if (confirm('Você tem certeza que quer deletar este projeto?')) {
        router.delete(route('project.destroy', id), {
            preserveScroll: true,
            onSuccess: () => alert('Projeto deletado com sucesso!'),
        });
    }
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
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    <Link :href="route('project.store')">
                    <PrimaryButton class="my-3">adicionar</PrimaryButton>
                    </Link>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in this.projects" :key="item.id">
                            <td>{{ item.id }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.created_at ? item.created_at : 'N/A' }}</td>
                            <td>{{ item.updated_at ? item.updated_at : 'N/A' }}</td>
                            <td>
                                <Link :href="route('project.show', item.id)">
                                    <SecundaryButton class="mx-3 inline-flex items-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 active:bg-yellow-700 dark:focus:ring-offset-gray-800 ">adicionar</SecundaryButton>
                                </Link>
                               
                                <DangerButton class="my-3 " @click="deleteProject( item.id)">deletar</DangerButton>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
                </p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}
thead {
    background-color: #e53939;
}

th,
td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}
</style>