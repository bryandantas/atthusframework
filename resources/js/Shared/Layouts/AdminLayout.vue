<template>
    <Head :title="title"/>
    <Notifications />
    <div class="h-screen flex overflow-hidden bg-gray-100">
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" class="fixed inset-0 flex z-40 md:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                                 enter-from="opacity-0" enter-to="opacity-100"
                                 leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                                 leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75"/>
                </TransitionChild>
                <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                                 enter-from="-translate-x-full" enter-to="translate-x-0"
                                 leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                                 leave-to="-translate-x-full">
                    <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">
                        <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0"
                                         enter-to="opacity-100" leave="ease-in-out duration-300"
                                         leave-from="opacity-100" leave-to="opacity-0">
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button type="button"
                                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                        @click="sidebarOpen = false">
                                    <span class="sr-only">Close sidebar</span>
                                    <XIcon class="h-6 w-6 text-white" aria-hidden="true"/>
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex-shrink-0 flex items-center px-4">
                            <img class="h-8 w-auto"
                                 src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg"
                                 alt="Workflow"/>
                        </div>
                        <div class="mt-5 flex-1 h-0 overflow-y-auto">
                            <nav class="px-2 space-y-1">
                                <inertia-link v-for="item in navigation" :key="item.name" :href="item.href" @click="sidebarOpen = false"
                                              :class="[isUrl(item.current) ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']">
                                    <component :is="item.icon"
                                               :class="[isUrl(item.current) ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-4 flex-shrink-0 h-6 w-6']"
                                               aria-hidden="true"/>
                                    {{ item.name }}
                                </inertia-link>
                            </nav>
                        </div>
                    </div>
                </TransitionChild>
                <div class="flex-shrink-0 w-14" aria-hidden="true">
                </div>
            </Dialog>
        </TransitionRoot>

        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <img class="h-8 w-auto"
                             src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg"
                             alt="Workflow"/>
                    </div>
                    <div class="mt-5 flex-grow flex flex-col">
                        <nav class="flex-1 px-2 bg-white space-y-1">
                            <inertia-link v-for="item in navigation" :key="item.name" :href="item.href"
                                          :class="[isUrl(item.current) ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex items-center px-2 py-2 text-sm font-medium rounded-md transition ease-in-out duration-150']">
                                <component :is="item.icon"
                                           :class="[isUrl(item.current) ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 flex-shrink-0 h-6 w-6']"
                                           aria-hidden="true"/>
                                {{ item.name }}
                            </inertia-link>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button type="button"
                        class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
                        @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <MenuAlt2Icon class="h-6 w-6" aria-hidden="true"/>
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        <form class="w-full flex md:ml-0" action="#" method="GET">
                            <label for="search-field" class="sr-only">Search</label>
                            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                    <SearchIcon class="h-5 w-5" aria-hidden="true"/>
                                </div>
                                <input id="search-field"
                                       class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm"
                                       placeholder="Search" type="search" name="search"/>
                            </div>
                        </form>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <Menu as="div" class="ml-3 relative">
                            <div>
                                <MenuButton
                                    class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Open user menu</span>
                                    <span class="h-8 w-8 rounded-full overflow-hidden bg-gray-100">
                                      <svg class="h-full w-full text-gray-300" fill="currentColor"
                                           viewBox="0 0 24 24">
                                        <path
                                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                                      </svg>
                                    </span>
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition ease-out duration-100"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95">
                                <MenuItems
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                                        <inertia-link :href="item.href"
                                                      :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                                            {{ item.name }}
                                        </inertia-link>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <transition name="fade" mode="out-in">
                        <slot/>
                    </transition>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import {ref, computed} from 'vue';
import {Head, usePage} from '@inertiajs/inertia-vue3';
import {
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {
    UsersIcon,
    HomeIcon,
    MenuAlt2Icon,
    XIcon,
} from '@heroicons/vue/outline'
import {SearchIcon} from '@heroicons/vue/solid'
import Notifications from "../components/notifications";

const navigation = [
    {name: 'Início', href: route('admin.home'), icon: HomeIcon, current: 'admin.home'},
    {name: 'Usuários', href: route('admin.users'), icon: UsersIcon, current: 'admin.users'},
]
const userNavigation = [
    {name: 'Ver Perfil', href: route('admin.profile')},
    {name: 'Sair', href: route('admin.logout')},
]

export default {
    name: "AdminLayout",
    props: {
        title: String,
    },
    components: {
        Notifications,
        Dialog,
        DialogOverlay,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot,
        MenuAlt2Icon,
        SearchIcon,
        XIcon,
        Head,
    },
    setup() {
        const sidebarOpen = ref(false)
        const user = computed(() => usePage().props.value.authUser);

        return {
            navigation,
            userNavigation,
            sidebarOpen,
            user,
        }
    },
    methods: {
        isUrl(route) {
            return this.route().current(route + '*');
        },
    },
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.15s ease-in;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
