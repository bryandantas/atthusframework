<template>
    <button @click="clickEvent" type="button" class="transition duration-150 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ title }}
    </button>
</template>

<script>
export default {
    name: "PrimaryButton",
    props: {
        title: String,
        method: Function,
    },
    methods: {
        clickEvent(){
            this.$emit('handleClick');
        },
    }
}
</script>
