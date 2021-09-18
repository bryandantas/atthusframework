<template>
    <div :class="additionalClasses">
        <label class="block text-sm font-medium text-gray-700"
               :for="name">
            {{ label }}
            <span v-if="subLabel" class="text-sm text-gray-500"> ({{ subLabel }})</span>
            <span class="font-sm text-gray-500" v-if="required">*</span>
        </label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <input :id="name"
                   @input="onChanged"
                   :value="modelValue"
                   :type="type"
                   :required="required"
                   :class="{'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500': error}"
                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            <div v-show="error" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true"/>
            </div>
        </div>
        <span v-if="error" class="mt-2 text-sm text-red-600">
        {{ error }}
    </span>
    </div>
</template>

<script>
import {ExclamationCircleIcon} from '@heroicons/vue/solid';

export default {
    name: "InputText",
    components: {
        ExclamationCircleIcon,
    },
    props: {
        type: {
            type: String,
            default: 'text',
            required: false
        },
        name: String,
        error: String,
        label: String,
        modelValue: String,
        subLabel: String,
        required: {
            type: Boolean,
            default: false,
            required: false
        },
        additionalClasses: {
            type: String,
            required: false,
        }
    },
    emits: ['update:modelValue'],
    setup(props, { emit }){
        function onChanged(e) {
            emit('update:modelValue', e.currentTarget.value);
        }

        return {onChanged}
    }
}
</script>

<style scoped>

</style>
