<template>
<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form @submit.prevent="submit">
                     
                        <div class="mt-4">
                            <label for="title">Description</label>
                            <textarea name="description" type="text" v-model="form.Description" class="
                                            w-full
                                            px-4
                                            py-2
                                            mt-2
                                            border
                                            rounded-md
                                            focus:outline-none
                                            focus:ring-1
                                            focus:ring-blue-600
                                        ">
                                    </textarea>
                        </div>
                        <div>
                            <label for="title">amount</label>
                            <input type="number" step="0.01" v-model="form.amount" class="
                                                                    w-full
                                                                    px-4
                                                                    py-2
                                                                    mt-2
                                                                    border
                                                                    rounded-md
                                                                    focus:outline-none
                                                                    focus:ring-1
                                                                    focus:ring-blue-600
                                                                " />
                        </div>
                        <div class="inline-block relative w-64">
                            <label for="title">Type</label>

                            <select v-model="form.type" 
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="1">Payment</option>
                                <option value="2">Deposit</option>
                            </select>

                        </div>
                        <!-- submit -->
                        <div class="flex items-center mt-4">
                            <button class="
                                            px-6
                                            py-2
                                            text-white
                                            bg-gray-900
                                            rounded
                                        ">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Head,
    },
    setup() {
        const form = useForm({
            Description: null,
            amount: null,
            type: null,
        });

        return { form };
    },
    methods: {
        submit() {
            this.form.post(route("historics.store"));
        },
    },
};
</script>

<style>

</style>