<template>
    <div class="px-4 sm:px-6 md:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-900">Editar Usuário</h1>
        </div>
        <div class="mt-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Informações Pessoais</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Atualize aqui as informações pessoais do usuário
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="updateInfo">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <InputText
                                        label="Nome"
                                        v-model="infoForm.name"
                                        name="name"
                                        :error="infoForm.errors.name"
                                        type="text"
                                        required
                                        additional-classes="col-span-6 sm:col-span-3"
                                    />

                                    <InputText
                                        label="Email"
                                        v-model="infoForm.email"
                                        name="email"
                                        :error="infoForm.errors.email"
                                        type="email"
                                        required
                                        additional-classes="col-span-6 sm:col-span-3"
                                    />
                                </div>
                                <div class="mt-5 gap-2 sm:mt-4 sm:flex sm:flex-row-reverse justify-between">
                                    <button type="submit"
                                            :disabled="infoForm.processing"
                                            class="w-full sm:w-auto disabled:cursor-pointer disabled:bg-indigo-400 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
                                        <svg v-show="infoForm.processing"
                                             class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Salvar
                                    </button>
                                    <button v-if="user.id !== authUser.id" @click="confirmDeleteModal = true" type="button"
                                            class="transition duration-150 inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-red-600 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-sm">
                                        Excluir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div v-if="user.id === authUser.id" class="mt-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Senha</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Atualize aqui a sua senha
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="updatePassword">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <InputText
                                        label="Senha atual"
                                        v-model="passwordForm.password"
                                        name="password"
                                        :error="passwordForm.errors.password"
                                        type="password"
                                        required
                                        additional-classes="col-span-6"
                                    />

                                    <InputText
                                        label="Nova senha"
                                        v-model="passwordForm.newPassword"
                                        name="newPassword"
                                        :error="passwordForm.errors.newPassword"
                                        type="password"
                                        required
                                        additional-classes="col-span-6 sm:col-span-3 mt-2"
                                    />

                                    <InputText
                                        label="Confirme a nova senha"
                                        v-model="passwordForm.confirmPassword"
                                        name="confirmPassword"
                                        :error="passwordForm.errors.confirmPassword"
                                        type="password"
                                        required
                                        additional-classes="col-span-6 sm:col-span-3 mt-2"
                                    />
                                </div>
                                <div class="mt-5 gap-2 sm:mt-4 sm:flex sm:flex-row-reverse justify-between">
                                    <button type="submit"
                                            :disabled="passwordForm.processing"
                                            class="w-full sm:w-auto disabled:cursor-pointer disabled:bg-indigo-400 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
                                        <svg v-show="passwordForm.processing"
                                             class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Salvar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <TransitionRoot as="template" :show="confirmDeleteModal">
            <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="confirmDeleteModal = false">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                        <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                    </TransitionChild>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <ExclamationIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                                        Excluir Usuário
                                    </DialogTitle>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Você tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <button
                                    type="button"
                                    class="sm:ml-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm"
                                    @click="excludeUser">
                                    Excluir
                                </button>
                                <button
                                    type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                    @click="confirmDeleteModal = false" ref="cancelButtonRef">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

    </div>
</template>

<script>
import AdminLayout from "../../../shared/layouts/AdminLayout";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import InputText from "../../../shared/components/form/InputText";
import {computed, ref} from "vue";
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationIcon } from '@heroicons/vue/outline'
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "Admin/Users/User",
    components: {
        InputText,
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        ExclamationIcon,
    },
    layout: AdminLayout,
    props: {
        user: Object
    },
    setup() {
        const authUser = computed(() => usePage().props.value.authUser);

        return {authUser}
    },
    data() {
        const confirmDeleteModal = ref(false);
        const infoForm = useForm({
            name: this.user.name,
            email: this.user.email,
        });
        const passwordForm = useForm({
            password: null,
            newPassword: null,
            confirmPassword: null
        });

        return {
            confirmDeleteModal,
            infoForm,
            passwordForm,
        }
    },
    methods: {
        updateInfo() {
            this.infoForm.patch(route('admin.users.user.update_info', {id: this.user.id}));
        },
        updatePassword() {
            this.passwordForm.patch(route('admin.users.user.update_password', {id: this.user.id}), {
                onSuccess: () => this.passwordForm.reset(),
            });
        },
        excludeUser() {
            Inertia.delete(route('admin.users.user.delete', {id: this.user.id}))
        },
    }
}
</script>
