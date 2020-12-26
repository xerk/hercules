<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Our Tutorials") }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4 font-semibold text-gray-500">{{__('Categories')}}</div>
                <div class="flex flex-wrap -mx-2">
                    <inertia-link :href="route('tutorials.show', category.slug)" class="relative w-full sm:w-1/2 md:w-1/3 lg:w-1/3 mb-4 px-2" v-for="category in categories" :key="category.id">
                        <div
                            class="bg-white shadow rounded-lg overflow-hidden h-32 transform transition duration-150 ease-in-out hover:scale-95 cursor-pointer"
                        >
                            <div class="p-5">
                                <p
                                    class="text-lg leading-tight text-navy-500 font-semibold"
                                >
                                    {{category.name}}
                                </p>
                                <div class="text-gray-600 text-sm truncate mt-1">
                                    {{category.desc}}
                                </div>
                            </div>
                            <div
                                class="flex text-gray-700 absolute bottom-0 w-full bg-gray-100"
                            >
                                <div class="flex-1 inline-flex items-center p-4">
                                    <p class="text-sm flex items-center">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-book mr-2"
                                        >
                                            <path
                                                d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"
                                            ></path>
                                            <path
                                                d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"
                                            ></path>
                                        </svg>
                                        <span class="text-gray-900 font-bold mr-1">{{category.tutorials_count}}</span> articles</p>
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
    props: ['categories']
};
</script>

<style></style>
