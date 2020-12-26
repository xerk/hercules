<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Dashboard") }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="rounded-lg shadow bg-white dark:bg-gray-700 dark:text-gray-300 divide-y divide-gray-200 dark:divide-gray-800 relative z-10 mb-6"
                >
                    <header
                        class="px-4 py-3 bg-white dark:bg-gray-700 rounded-t-lg"
                    >
                        <h2 class="text-md font-medium">
                            <span class="mr-2">🚀</span> {{__('Finish up your account')}}
                            ({{ countDone() }}/3)
                        </h2>
                    </header>
                    <ul class="divide-y divide-gray-200">
                        <li class="flex items-center space-x-4 p-4">
                            <div
                                v-if="$page.user.point > 0"
                                class="w-8 h-8 rounded-full bg-green-400 border-2 border-white text-white text-md font-medium text-center flex justify-center items-center"
                            >
                                ✓
                            </div>
                            <div
                                v-else
                                class="w-8 h-8 border-2 border-white rounded-full self-center bg-primary-100 text-primary-600 text-md font-medium text-center flex justify-center items-center"
                            >
                                1
                            </div>
                            <!---->
                            <div class="flex-1">
                                <h3
                                    class="text-md font-medium flex items-center justify-between"
                                >
                                    {{__('Purchase Points')}}
                                </h3>
                                <!---->
                            </div>
                            <inertia-link
                                target="_self"
                                :href="route('purchase')"
                                class="inline-flex items-center justify-center text-sm font-medium border rounded-md transition-all ease-in-out duration-100 focus:outline-none focus:shadow-outline border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-600 text-gray-900 dark:text-gray-300 shadow-sm hover:bg-gray-50 focus:border-gray-400 focus:bg-white px-3 py-2 text-sm"
                                >{{__('Redeem points')}} +</inertia-link
                            >
                            <!---->
                        </li>
                        <li class="flex items-center space-x-4 p-4">
                            <div
                                v-if="export_counts > 0"
                                class="w-8 h-8 rounded-full bg-green-400 border-2 border-white text-white text-md font-medium text-center flex justify-center items-center"
                            >
                                ✓
                            </div>
                            <div
                                v-else
                                class="w-8 h-8 border-2 border-white rounded-full self-center bg-primary-100 text-primary-600 text-md font-medium text-center flex justify-center items-center"
                            >
                                2
                            </div>
                            <!---->
                            <div class="flex-1">
                                <h3 class="text-md font-medium">
                                    {{__('Create your first excel file')}}
                                    <span
                                        class="text-sm px-2 font-medium tracking-wide rounded-full bg-gray-100 text-gray-900 inline-flex items-center justify-center text-center"
                                    >
                                        {{__('Optional')}}
                                    </span>
                                </h3>
                                <!---->
                            </div>
                            <!---->
                            <inertia-link
                                target="_self"
                                :href="route('clients')"
                                class="inline-flex items-center justify-center text-sm font-medium border rounded-md transition-all ease-in-out duration-100 focus:outline-none focus:shadow-outline border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-600 text-gray-900 dark:text-gray-300 shadow-sm hover:bg-gray-50 focus:border-gray-400 focus:bg-white px-3 py-2 text-sm"
                                >{{__('Find Facebook Data')}}</inertia-link
                            >
                        </li>
                        <li class="flex items-center space-x-4 p-4">
                            <div
                                v-if="$page.user.membership"
                                class="w-8 h-8 rounded-full bg-green-400 border-2 border-white text-white text-md font-medium text-center flex justify-center items-center"
                            >
                                ✓
                            </div>
                            <!---->
                            <div
                                v-else
                                class="w-8 h-8 border-2 border-white rounded-full self-start bg-primary-100 text-primary-600 text-md font-medium text-center flex justify-center items-center"
                            >
                                3
                            </div>
                            <div class="flex-1">
                                <h3 class="text-md font-medium">
                                    {{__('Upgrade your plan')}}
                                    <!---->
                                </h3>
                                <p
                                    class="text-sm text-gray-500 dark:text-gray-400 max-w-2xl"
                                >
                                    {{__('Upgrade your plan to lift restrictions and enjoy the most out of managing your services.')}}
                                </p>
                            </div>
                            <a
                                target="_self"
                                href="/"
                                class="inline-flex items-center justify-center text-sm font-medium border rounded-md transition-all ease-in-out duration-100 focus:outline-none focus:shadow-outline border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-600 text-gray-900 dark:text-gray-300 shadow-sm hover:bg-gray-50 focus:border-gray-400 focus:bg-white px-3 py-2 text-sm"
                                >{{__('Upgrade plan')}}</a
                            >
                        </li>
                    </ul>
                    <div
                        class="absolute left-8 -ml-px border-l-2 border-dashed border-primary-100 inset-y-0"
                        style="z-index: -1;"
                    ></div>
                </div>
                <!-- ---  -->
                <div
                    class="rounded-lg shadow bg-white dark:bg-gray-700 dark:text-gray-300 divide-y divide-gray-200 dark:divide-gray-800 relative z-10 mb-6"
                >
                    <header
                        class="px-4 py-3 bg-white dark:bg-gray-700 rounded-t-lg"
                    >
                        <h2 class="text-md font-medium">
                            <span class="mr-2">🔥</span> {{ __("Change Log") }}
                        </h2>
                    </header>
                    <ul
                        class="divide-y divide-gray-200 rounded-b-lg overflow-hidden h-auto block mx-auto"
                        x-data="{selectChangeLog:null}"
                    >
                        <li
                            class="flex align-center flex-col"
                            v-for="(changeLog, key) in changeLogs"
                            :key="key"
                        >
                            <h4
                                @click="
                                    selectChangeLog !== 0
                                        ? (selectChangeLog = 0)
                                        : (selectChangeLog = null)
                                "
                                class="cursor-pointer px-5 py-3 bg-white-300 text-grey-700 inline-block hover:opacity-75 shadow-md hover:-mb-3 rounded-t flex justify-between items-center"
                            >
                                <span>{{ changeLog.name }}</span>
                                <span class="px-2 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">v{{ changeLog.version }}</span>
                            </h4>
                            <p
                                v-show="selectChangeLog == 0"
                                class="py-4 px-8 rounded-b-lg transform transition-all duration-150 ease-in-out h-full"
                                v-html="changeLog.desc"
                            ></p>
                        </li>
                    </ul>
                </div>

                <div
                    class="rounded-lg h-auto shadow bg-white dark:bg-gray-700 dark:text-gray-300 divide-y divide-gray-200 dark:divide-gray-800 relative z-10 mb-6"
                >
                    <header
                        class="px-4 py-3 bg-white dark:bg-gray-700 rounded-t-lg"
                    >
                        <h2 class="text-md font-medium">
                            <span class="mr-2">⬇️</span> {{ __("Download") }}
                        </h2>
                    </header>
                    <div class="divide-y divide-gray-200 w-full">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                                    >
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
                                <tbody
                                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                                >
                                    <template v-for="(lic, key) in license">
                                        <tr
                                            class="text-gray-700 dark:text-gray-400"
                                            :key="key"
                                            v-if="lic.status == 'active'"
                                        >
                                            <td class="px-4 py-3">
                                                {{ lic.id }}
                                            </td>
                                            <td class="px-4 py-3">
                                                {{ lic.name }}
                                            </td>
                                            <td class="px-4 py-3 text-xs">
                                                <span
                                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                                                >
                                                    {{ lic.version }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ dateAgo(lic.created_at) }}
                                            </td>
                                            <td
                                                class="px-4 py-3 text-sm capitalize"
                                            >
                                                <a
                                                    class="hover:underline text-indigo-500"
                                                    :href="
                                                        route(
                                                            'license.download',
                                                            lic.id
                                                        )
                                                    "
                                                    >{{ __("Download") }}</a
                                                >
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ---  -->
                <div
                    class="rounded-lg shadow bg-white dark:bg-gray-700 dark:text-gray-300 divide-y divide-gray-200 dark:divide-gray-800 relative z-10 mb-6"
                >
                    <header
                        class="px-4 py-3 bg-white dark:bg-gray-700 rounded-t-lg"
                    >
                        <h2 class="text-md font-medium">
                            <span class="mr-2">ℹ️</span> {{ __("Terms and Conditions") }}
                        </h2>
                    </header>
                    <ul
                        class="divide-y divide-gray-200 rounded-b-lg overflow-hidden h-auto block mx-auto"
                        x-data="{selected:null}"
                    >
                        <li class="flex align-center flex-col">
                            <h4
                                @click="
                                    selected !== 0
                                        ? (selected = 0)
                                        : (selected = null)
                                "
                                class="cursor-pointer px-5 py-3 bg-white-300 text-grey-700 inline-block hover:opacity-75 shadow-md hover:-mb-3 rounded-t"
                            >
                                {{ terms.name }}
                            </h4>
                            <p
                                v-show="selected == 0"
                                class="py-4 px-8 rounded-b-lg transform transition-all duration-150 ease-in-out h-full"
                                v-if="local == 'en'"
                                v-html="terms.desc.en"
                            ></p>
                            <p
                                v-show="selected == 0"
                                class="py-4 px-8 rounded-b-lg transform transition-all duration-150 ease-in-out h-full text-right"
                                v-else
                                v-html="terms.desc.ar"
                            ></p>
                        </li>
                    </ul>
                </div>
                <!-- <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                    <welcome :tutorials="tutorials" />
                </div> -->
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "./../Layouts/AppLayout";
import Welcome from "./../Jetstream/Welcome";

export default {
    props: ["license", "terms", "changeLogs", "tutorials", "export_counts"],
    components: {
        AppLayout,
        Welcome
    },
    data() {
        return {
            selected: 0,
            selectChangeLog: 0
        };
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
        countDone() {
            var count = 0;
            if (this.$page.user.point > 0) {
                count++;
            }

            if (this.$page.user.membership) {
                count++;
            }

            if (this.export_counts > 0) {
                count++;
            }

            return count;
        }
    },
    computed: {
        local() {
            return window.config.local;
        }
    }
};
</script>
