<template>
<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Add new {{title}}</h1>
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
                    

                        <input type="file" v-if="type=='1'" ref="photo" accept="image/*" @change="uploadImage($event)" id="file-input">
                        <img v-if="url" :src="url" class="w-full mt-4 h-80" />
                        <div class="inline-block relative w-64">
                            <label for="title">Type</label>

                            <select :disabled="true" v-model="form.type" 
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="0">Payment</option>
                                <option value="1">Deposit</option>
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
    props:{
        type:Number,
    },
    setup() {
        const form = useForm({
            Description: null,
            amount: null,
            type: null,
            receipt:null
        });
        return { form };
    },
    data() {
        return {
            url: null,
        }
    },
    created(){
        this.form.type= this.type
        this.title = this.type=='1' ? "Deposit" : "Payment"
    },
    methods: {
        submit() {
            if (this.type == '1' && this.$refs.photo){
                this.form.receipt = this.$refs.photo.files[0];
            }
            console.log(this.$refs.photo);
            this.form.type =  this.type;
            this.form.post(route("historics.store"));
        },
        uploadImage(event) {
            const file = event.target.files[0];
            this.url = URL.createObjectURL(file);
        }
    },
};
</script>

<style>

</style>