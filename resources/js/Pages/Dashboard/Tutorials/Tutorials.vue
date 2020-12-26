<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Tutorials") }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4 font-semibold text-gray-500">Tutorials</div>
                <div class="flex flex-wrap -mx-2">
                    <inertia-link
                        class="relative w-full sm:w-1/2 md:w-1/3 lg:w-1/3 mb-4 px-2"
                        :href="route('tutorials.show.tutorial', [tutorial.category.slug, tutorial.slug])"
                        v-for="tutorial in tutorials"
                        :key="tutorial.id"
                    >
                        <div
                            class="bg-white shadow rounded-lg overflow-hidden h-auto transform transition duration-150 ease-in-out hover:scale-95"
                        >
                            <div class="p-5">
                                <p
                                    class="text-xs font-bold uppercase tracking-wider text-gray-100 bg-blue-500 w-auto flex-1 inline-flex rounded-lg shadow-md px-2 py-1 mb-2"
                                >
                                    {{ tutorial.category.name }}
                                </p>
                                <div
                                    class="relative overflow-hidden"
                                    v-if="tutorial.image"
                                >
                                    <img
                                        class="rounded-lg h-48 object-cover w-full"
                                        :src="`/storage/${tutorial.image}`"
                                        :alt="tutorial.name"
                                    />
                                </div>
                                <p
                                    class="text-lg leading-tight text-navy-500 font-semibold mt-2"
                                >
                                    {{ tutorial.name }}
                                </p>
                                <div
                                    class="text-gray-600 text-sm truncate mt-1"
                                >
                                    {{ tutorial.short_desc }}
                                </div>
                            </div>
                        </div>
                    </inertia-link>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "./../../../Layouts/AppLayout";
export default {
    components: { AppLayout },
    props: ["tutorials"]
};
</script>

<style></style>
