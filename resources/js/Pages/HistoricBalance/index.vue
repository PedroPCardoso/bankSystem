<template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <Link class="
                                            px-6
                                            py-2
                                            mb-2
                                            text-green-100
                                            bg-green-500
                                            rounded
                                        " @click="create()">
                            historics Create
                            </Link>
                        </div>
                        <table>
                            <thead class="font-bold bg-gray-300 border-b-2">
                                <td class="px-4 py-2">ID</td>
                                <td class="px-4 py-2">Description</td>
                                <td class="px-4 py-2">Title</td>
                                <td class="px-4 py-2">Action</td>
                            </thead>
                            <tbody>
                                <tr v-for="historic in historics.data" :key="historic.id">
                                    <td class="px-4 py-2">{{ historic.id }}</td>
                                    <td class="px-4 py-2">  {{ historic.Description }}</td>
                                    <td class="px-4 py-2">{{ historic.amount }}</td>
                                    <td class="px-4 py-2 font-extrabold">
                                        <Link class="text-green-700" :href="route('historics.edit', historic.id)">
                                        Edit
                                        </Link>
                                        <Link @click="destroy(historic.id)" class="text-red-700">Delete</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :links="historics.links" />
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import { inject, reactive } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
export default {
    components: {
        // BreezeAuthenticatedLayout,
        Head,
        // BreezeNavLink,
        Link,
    },
    props: {
        historics: Object,
    },
    setup() {
        const route = inject('$route');
    },
    methods:{
        go(id){
            Inertia.post(route('historics.edit'), id);
        },
        create() {
            Inertia.get(route('historics.create'));
        }
    }
}
</script>

<style>

</style>