<template>
    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-bold text-gray-900">Olá, <span class="font-medium">{{ user.name }}</span></h1>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-4">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="col-span-1 bg-white rounded-lg p-6"></div>
                    <div class="col-span-1 bg-white rounded-lg p-6"></div>
                    <div class="col-span-1 bg-white rounded-lg p-6"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from "../../shared/layouts/AdminLayout";
import {computed} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";
export default {
    name: "Admin/Home",
    layout: AdminLayout,
    setup() {
        const user = computed(() => usePage().props.value.authUser);

        return {user}
    }

}
</script>
