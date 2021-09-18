<template>
    <nav class="border-t border-gray-200 px-4 flex items-center justify-between sm:px-0">
        <div class="-mt-px w-0 flex-1 flex">
            <inertia-link
                v-if="data.prev_page_url"
                :href="data.prev_page_url"
                class="transition duration-150 border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                <ArrowNarrowLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                Anterior
            </inertia-link>
        </div>
        <div class="hidden md:-mt-px md:flex">
            <inertia-link
                v-for="link in cleanLinks"
                :key="link.label"
                :href="link.url"
                :class="{'border-indigo-500 text-indigo-600' : link.active}"
                class="transition duration-150 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">
                {{ link.label }}
            </inertia-link>
        </div>
        <div class="-mt-px w-0 flex-1 flex justify-end">
            <inertia-link
                v-if="data.next_page_url"
                :href="data.next_page_url"
                class="transition duration-150 border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                Próximo
                <ArrowNarrowRightIcon class="ml-3 h-5 w-5 text-gray-400" aria-hidden="true" />
            </inertia-link>
        </div>
    </nav>
</template>

<script>
import { ArrowNarrowLeftIcon, ArrowNarrowRightIcon } from '@heroicons/vue/solid';
import {InertiaLink} from '@inertiajs/inertia-vue3';

export default {
    name: "Pagination",
    components: {
        ArrowNarrowLeftIcon,
        ArrowNarrowRightIcon,
        InertiaLink
    },
    props: {
        data: Object,
    },
    computed: {
        cleanLinks() {
            const cleanLinks = [...this.data.links];
            cleanLinks.shift();
            cleanLinks.pop();
            return cleanLinks;
        }
    }
}
</script>
