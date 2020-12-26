<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Our Tutorials") }}
            </h2>
        </template>
        <div class="py-12" id="docs">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4 font-semibold text-gray-500">{{__('Our Tutorials')}}</div>
                <div class="flex flex-wrap -mx-2">
                    <div class="relative w-full mb-4 px-2">
                        <div class="bg-white shadow rounded-lg overflow-hidden h-auto">
                            <div class="p-5">
                                <p
                                    class="text-xs font-bold uppercase tracking-wider text-gray-100 bg-blue-500 w-auto flex-1 inline-flex rounded-lg shadow-md px-2 py-1 mb-2">
                                    {{ tutorial.category.name }}
                                </p>
                                <div class="relative overflow-hidden" style="padding-top: 36.25%" v-if="tutorial.url">
                                    <iframe class="absolute top-0 left-0  w-full h-full text-center" :src="tutorial.url"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                                <p class="md:w-5/6 w-full mx-auto my-4 text-2xl leading-tight text-navy-500 font-extrabold">
                                    {{ tutorial.name }}
                                </p>
                                <article class="w-full md:w-5/6 mx-auto px-5 sm:px-0 prose max-w-none" v-html="tutorial.desc">
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "./../../../Layouts/AppLayout";
    export default {
        components: {
            AppLayout
        },
        props: ["tutorial"]
    };

</script>

<style>
#docs article a {
    color: #1853db;
    text-decoration: underline;
} 
</style>