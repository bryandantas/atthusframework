<template>
    <div aria-live="assertive" class="fixed z-50 inset-0 flex items-end px-4 pt-16 pb-6 pointer-events-none sm:items-start">
        <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
            <transition appear enter-active-class="transform ease-out duration-500 transition delay-300" enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" enter-to-class="translate-y-0 opacity-100 sm:translate-x-0" leave-active-class="transition ease-in duration-300" leave-from-class="opacity-100" leave-to-class="opacity-0">
                <div v-if="showToast && toast" class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <CheckCircleIcon v-if="toast.type === 'success'" class="h-6 w-6 text-green-400" aria-hidden="true" />
                                <XCircleIcon v-if="toast.type === 'error'" class="h-6 w-6 text-red-400" aria-hidden="true" />
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm text-gray-500">
                                    {{ toast.message }}
                                </p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <button @click="show = false" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close</span>
                                    <XIcon class="h-5 w-5" aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import {ref} from 'vue'
import { CheckCircleIcon, XCircleIcon } from '@heroicons/vue/outline'
import { XIcon } from '@heroicons/vue/solid'
export default {
    name: "Notifications",
    components: {
        CheckCircleIcon,
        XIcon,
        XCircleIcon
    },
    data() {
        return {
            show: ref(true)
        }
    },
    computed: {
        toast(){
            return this.$page.props.flash;
        },
        showToast(){
            return this.show;
        }
    },
    watch: {
        toast: {
            handler() {
                this.show = true;
                setTimeout(() => this.show = false, 3000);
            },
            deep: true
        }
    },
    mounted(){
        setTimeout(() => this.show = false, 3000);
    }
}
</script>
