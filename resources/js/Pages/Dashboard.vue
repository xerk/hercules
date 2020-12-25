<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Dashboard") }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome :tutorials="tutorials" />
                </div>
            </div>
        </div>
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="text-gray-500 text-3xl">
                            {{ __("Change Log") }}
                        </div>
                        <ul class="block my-4 mx-auto" x-data="{selectChangeLog:null}" v-if="terms.name">
                            <li class="flex align-center flex-col" v-for="(changeLog, key) in changeLogs" :key="key">
                                <h4 @click="
                            selectChangeLog !== 0 ? (selectChangeLog = 0) : (selectChangeLog = null)
                        " class="cursor-pointer px-5 py-3 bg-white-300 text-grey-700 inline-block hover:opacity-75 shadow-md hover:-mb-3 rounded-t flex justify-between items-center">
                                    <span>{{ changeLog.name }}</span>
                                    <span>v{{ changeLog.version }}</span>
                                </h4>
                                <p v-show="selectChangeLog == 0" class="border py-4 px-2" v-html="changeLog.desc">

                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="text-gray-500 text-3xl">
                            {{ __("Download") }}
                        </div>
                        <div class="w-full my-8 overflow-hidden rounded-lg shadow-md">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">#</th>
                                            <th class="px-4 py-3">
                                                {{ __("License") }}
                                            </th>
                                            <th class="px-4 py-3">
                                                {{ __("Version") }}
                                            </th>
                                            <th class="px-4 py-3">
                                                {{ __("Created At") }}
                                            </th>
                                            <th class="px-4 py-3">
                                                {{ __("Download") }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        <template v-for="(lic, key) in license">
                                            <tr class="text-gray-700 dark:text-gray-400" :key="key"
                                                v-if="lic.status == 'active'">
                                                <td class="px-4 py-3">
                                                    <!-- {{ client.id }} -->
                                                    {{lic.id}}
                                                </td>
                                                <td class="px-4 py-3">
                                                    <!-- {{ client.name }} -->
                                                    {{lic.name}}
                                                </td>
                                                <td class="px-4 py-3 text-xs">
                                                    <span
                                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                        <!-- {{ client.file }} -->
                                                        {{lic.version}}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    {{ dateAgo(lic.created_at) }}
                                                </td>
                                                <td class="px-4 py-3 text-sm capitalize">
                                                    <a class="hover:underline text-indigo-500" :href="
                                                    route(
                                                        'license.download',
                                                        lic.id
                                                    )
                                                ">{{ __("Download") }}</a>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div
                                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
                            >
                                <span class="flex items-center col-span-3">
                                    Showing {{ clients.from }}-{{
                                        clients.to
                                    }}
                                    of
                                    {{ clients.total }}
                                </span>
                                <span class="col-span-2"></span>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="text-gray-500 text-3xl">
                            {{__('Terms and Conditions')}}
                        </div>
                        <ul class="block my-4 mx-auto" x-data="{selected:null}" v-if="terms.name">
                            <li class="flex align-center flex-col">
                                <h4 @click="
                            selected !== 0 ? (selected = 0) : (selected = null)
                        " class="cursor-pointer px-5 py-3 bg-white-300 text-grey-700 inline-block hover:opacity-75 shadow-md hover:-mb-3 rounded-t">
                                    {{ terms.name }}
                                </h4>
                                <p v-show="selected == 0" class="border py-4 px-2" v-html="terms.desc">

                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "./../Layouts/AppLayout";
    import Welcome from "./../Jetstream/Welcome";

    export default {
        props: ['license', 'terms', 'changeLogs', 'tutorials'],
        components: {
            AppLayout,
            Welcome
        },
        data() {
            return {
                selected: 0,
                selectChangeLog: 0
            }
        },
        methods: {
            dateAgo(time) {
                return moment(time).fromNow();
            },
            download(id) {
                this.$inertia.post(route("clients.download", id), {
                    preserveScroll: true
                });
            },
        }
    };

</script>
