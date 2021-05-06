<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Facebook") }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-right">
                    <jet-button>
                    {{ __("Back") }}
                </jet-button>
                </div>
                <div class="w-full my-8 overflow-hidden rounded-lg shadow-md">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">{{ __("Name") }}</th>
                                    <th class="px-4 py-3">
                                        {{ __("Mobile") }}
                                    </th>
                                    <th class="px-4 py-3">{{ __("Email") }}</th>
                                    <th class="px-4 py-3">
                                        {{ __("Username") }}
                                    </th>
                                    <th class="px-4 py-3">
                                        {{ __("Religion") }}
                                    </th>
                                    <th class="px-4 py-3">
                                        {{ __("Gender") }}
                                    </th>
                                    <th class="px-4 py-3">
                                        {{ __("Birthday") }}
                                    </th>
                                    <th class="px-4 py-3">{{ __("Work") }}</th>
                                    <th class="px-4 py-3">
                                        {{ __("Position") }}
                                    </th>
                                    <th class="px-4 py-3">
                                        {{ __("Hometown") }}
                                    </th>
                                    <th class="px-4 py-3">
                                        {{ __("Education") }}
                                    </th>
                                    <th class="px-4 py-3">
                                        {{ __("Nationality") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                <tr class="text-gray-700 dark:text-gray-400" v-for="(client, key) in result.data"
                                    :key="key">
                                    <td class="px-4 py-3">
                                        {{ client.id }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ client.name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.mobile }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.email }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.username }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.religion }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.gender }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.birthday }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.work }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.position }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.hometown }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.education }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ client.nationality }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                        <span class="flex items-center col-span-3">
                            {{__('Showing')}} {{ result.from }}-{{ result.to }} {{__('of')}}
                            {{ result.total }}
                        </span>
                        <span class="col-span-2"></span>
                        <!-- Pagination -->
                        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                            <nav aria-label="Table navigation">
                                <ul class="inline-flex items-center">
                                    <li v-for="(link, key) in result.links" :key="key">
                                        <div v-if="link.url === null"
                                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                            :class="{
                                                'text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600':
                                                    link.active
                                            }" v-html="link.label"></div>
                                        <inertia-link v-else
                                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                            :class="{
                                                'text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600':
                                                    link.active
                                            }" :href="link.url" v-html="link.label">
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
    import JetActionMessage from "./../../../Jetstream/ActionMessage";
    import JetButton from "./../../../Jetstream/Button";
    import JetFormSection from "./../../../Jetstream/FormSection";
    import JetInput from "./../../../Jetstream/Input";
    import JetInputError from "./../../../Jetstream/InputError";
    import JetLabel from "./../../../Jetstream/Label";

    export default {
        props: ["result"],

        components: {
            AppLayout,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel
        },

        data() {
            return {
                form: this.$inertia.form({
                    code: null
                }, {
                    bag: "redeemCode",
                    resetOnSuccess: false
                })
            };
        }
    };

</script>

<style></style>
