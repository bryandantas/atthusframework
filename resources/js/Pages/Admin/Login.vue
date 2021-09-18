<template>
    <Head :title="title"/>
    <Notifications />
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                 alt="Workflow">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Acesse sua Conta
            </h2>

        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form @submit.prevent="login" class="space-y-6">
                    <InputText
                        label="Email"
                        v-model="form.email"
                        name="email"
                        :error="form.errors.email"
                        type="email" />

                    <InputText
                        label="Senha"
                        v-model="form.password"
                        name="password"
                        :error="form.errors.password"
                        type="password" />

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember_me" type="checkbox"
                                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                   v-model="form.remember">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Lembrar de mim
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Esqueceu sua Senha?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                                :disabled="form.processing"
                                class="disabled:cursor-pointer disabled:bg-indigo-400 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
                            <svg v-show="form.processing"
                                 class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Entrar
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>

<script>
import {Head, useForm} from "@inertiajs/inertia-vue3";
import {ExclamationCircleIcon} from '@heroicons/vue/solid';
import Notifications from "../../shared/components/notifications";
import InputText from "../../shared/components/form/InputText";

export default {
    name: "Admin/Login",
    props: {
        title: String,
    },
    components: {
        InputText,
        Notifications,
        Head,
        ExclamationCircleIcon
    },
    setup() {
        const form = useForm({
            email: null,
            password: null,
            remember: false,
        });

        return {form};
    },
    methods: {
        login(){
            this.form.post(route('admin.login_post'));
        }
    }
}
</script>
