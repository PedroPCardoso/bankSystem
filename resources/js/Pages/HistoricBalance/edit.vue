<template>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form @submit.prevent="submit">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" v-model="form.title" class="
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
                    <div>
                        <label for="title">Description</label>
                        <textarea name="description" type="text" v-model="form.description" class="
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
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Head,
    },
    setup(props) {
        const form = useForm({
            description: props.HistoricBalance.Description,
            amount: props.HistoricBalance.amount,
        });

        return { form };
    },
    props: {
        HistoricBalance: Object,
    },
    methods: {
        submit() {
            this.form.put(route("historics.update", this.HistoricBalance.id));
        },
    },
};
</script>

<style>

</style>