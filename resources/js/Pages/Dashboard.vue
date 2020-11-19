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
                    <welcome />
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
                        <ul>
                            <li>- v1.0.0.1</li>
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
                        <div
                            class="w-full my-8 overflow-hidden rounded-lg shadow-md"
                        >
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
                                        <tr
                                            class="text-gray-700 dark:text-gray-400"
                                        >
                                            <td class="px-4 py-3">
                                                <!-- {{ client.id }} -->
                                                1
                                            </td>
                                            <td class="px-4 py-3">
                                                <!-- {{ client.name }} -->
                                                Hercules v1.0.0
                                            </td>
                                            <td class="px-4 py-3 text-xs">
                                                <span
                                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                                                >
                                                    <!-- {{ client.file }} -->
                                                    v1.0.0
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                <!-- {{ dateAgo(client.created_at) }} -->
                                            </td>
                                            <td
                                                class="px-4 py-3 text-sm capitalize"
                                            >
                                                <a
                                                    class="hover:underline text-indigo-500"
                                                    href="#"
                                                    >{{ __("Download") }}</a
                                                >
                                            </td>
                                        </tr>
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
                        <ul>
                            <li>
                                Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Odio nobis ipsum voluptates ea
                                quas quae animi, soluta inventore sint sed
                                necessitatibus, ducimus aperiam ab nemo! Atque
                                sunt dolor est sequi!
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
    components: {
        AppLayout,
        Welcome
    }
};
</script>
