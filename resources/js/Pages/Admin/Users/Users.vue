<template>
    <div class="px-4 sm:px-6 md:px-8">
        <div class="max-w-7xl mx-auto flex justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Usuários</h1>
            <PrimaryButton title="Novo Usuário" @handleClick="userModal" />
        </div>
        <div class="flex flex-col mt-4">

            <Information v-if="!persons" description="Não existem usuários cadastrados!" />

            <div v-else class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Editar</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(person, personIdx) in persons" :key="person.email" :class="personIdx % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ person.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ person.email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <inertia-link :href="route('admin.users.user', {'id': person.id})" class="text-indigo-600 hover:text-indigo-900">Editar</inertia-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0"
                                     enter-to="opacity-100" leave="ease-out duration-200" leave-from="opacity-100"
                                     leave-to="opacity-0">
                        <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"/>
                    </TransitionChild>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <TransitionChild as="template" enter="ease-out duration-300"
                                     enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                     enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                                     leave-from="opacity-100 translate-y-0 sm:scale-100"
                                     leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <form @submit.prevent="createUser"
                              class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <InputText
                                label="Nome"
                                v-model="form.name"
                                name="name"
                                :error="form.errors.name"
                                type="text"
                                required
                            />

                            <InputText
                                label="Email"
                                v-model="form.email"
                                name="email"
                                :error="form.errors.email"
                                type="email"
                                required
                                additional-classes="mt-4"
                            />

                            <div class="mt-5 gap-2 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <button type="submit"
                                        :disabled="form.processing"
                                        class="disabled:cursor-pointer disabled:bg-indigo-400 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
                                    <svg v-show="form.processing"
                                         class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Criar Usuário
                                </button>
                                <button type="button"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                        @click="open = false">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

    </div>
</template>

<script>
import AdminLayout from "../../../shared/layouts/AdminLayout";
import Information from "../../../shared/components/Information";
import PrimaryButton from "../../../shared/components/buttons/PrimaryButton";
import {ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import InputText from "../../../shared/components/form/InputText";
import {Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
export default {
    name: "Admin/Users/Users",
    components: {
        InputText,
        PrimaryButton,
        Information,
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
    },
    layout: AdminLayout,
    props: {
        persons: Array
    },
    setup() {
        const open = ref(false);
        const form = useForm({
            name: null,
            email: null,
        });

        return {open, form}
    },
    methods: {
        userModal() {
            this.open = true;
        },
        createUser() {
            this.form.post(route('admin.users.create'));
        }
    },
    computed: {
        shouldHidePagination() {
            return !this.persons.prev_page_url && !this.persons.next_page_url;
        }
    }
}
</script>
