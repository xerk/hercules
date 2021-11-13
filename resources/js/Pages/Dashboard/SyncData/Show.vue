<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Sync Data") }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="bg-gray-50 rounded-lg px-4 py-2 font-semibold">
                        Sync Data Now 🔥
                    </div>
                    <div class="p-6">
                        <div class="text-center font-semibold capitalize">
                            <div
                                v-if="message"
                                class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md"
                                role="alert"
                            >
                                <div class="flex items-center">
                                    <div class="py-1">
                                        <svg
                                            class="fill-current h-6 w-6 text-green-500 mr-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold">
                                            {{ message }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form @submit.prevent="syncData" class="mt-4">
                                <jet-button
                                    :class="{
                                        'opacity-25': form.processing
                                    }"
                                >
                                    {{ __("Launch!") }}
                                </jet-button>
                            </form>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full my-8 overflow-hidden rounded-lg shadow-md"
                    v-if="jobs"
                >
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                                >
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">{{ __("User") }}</th>
                                    <th class="px-4 py-3">{{ __("Name") }}</th>
                                    <th class="px-4 py-3">
                                        {{ __("Status") }}
                                    </th>
                                    <th class="px-4 py-3">
                                        {{ __("Exception") }}
                                    </th>
                                    <th class="px-4 py-3">
                                        {{ __("Created At") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                            >
                                <tr
                                    class="text-gray-700 dark:text-gray-400"
                                    v-for="(job, key) in jobs.data"
                                    :key="key"
                                >
                                    <td class="px-4 py-3">
                                        {{ job.id }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ job.user_id }}
                                    </td>
                                    <td
                                        class="px-4 py-3"
                                        v-html="job.name"
                                    ></td>
                                    <td class="px-4 py-3 text-xs">
                                        <span
                                            class="px-2 capitalize py-1 font-semibold leading-tight rounded-full"
                                            :class="
                                                job.status == 'processing'
                                                    ? 'text-yellow-700  bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100'
                                                    : 'text-green-700  bg-green-100 dark:bg-green-700 dark:text-green-100'
                                            "
                                        >
                                            {{
                                                (job.status == "processing" &&
                                                    __("Processing")) ||
                                                    __("Completed")
                                            }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ job.exception }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ dateAgo(job.created_at) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <span class="flex items-center col-span-3">
                            {{ __("Showing") }} {{ jobs.from }}-{{ jobs.to }}
                            {{ __("of") }}
                            {{ jobs.total }}
                        </span>
                        <span class="col-span-2"></span>
                        <!-- Pagination -->
                        <span
                            class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end"
                        >
                            <nav aria-label="Table navigation">
                                <ul class="inline-flex items-center">
                                    <li
                                        v-for="(link, key) in jobs.links"
                                        :key="key"
                                    >
                                        <div
                                            v-if="link.url === null"
                                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                            :class="{
                                                'text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600':
                                                    link.active
                                            }"
                                            v-html="link.label"
                                        ></div>
                                        <inertia-link
                                            v-else
                                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                            :class="{
                                                'text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600':
                                                    link.active
                                            }"
                                            :href="link.url"
                                            v-html="link.label"
                                        >
                                        </inertia-link>
                                    </li>
                                </ul>
                            </nav>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "./../../../Layouts/AppLayout";
import JetButton from "./../../../Jetstream/Button";

export default {
    props: ["jobs", "message"],

    components: {
        AppLayout,
        JetButton
    },

    data() {
        return {
            form: this.$inertia.form({
                bag: "redeemCode",
                resetOnSuccess: false
            })
        };
    },

    methods: {
        syncData(url = null) {
            this.form.post(route("sync.store"), {
                preserveScroll: true
            });
        },
        dateAgo(time) {
            return moment(time).fromNow();
        }
    }
};
</script>

<style></style>
