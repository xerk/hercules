<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Facebook") }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full my-8 overflow-hidden rounded-lg shadow-md">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                                >
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
                            <tbody
                                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                            >
                                <tr
                                    class="text-gray-700 dark:text-gray-400"
                                    v-for="(client, key) in result"
                                    :key="key"
                                >
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
            form: this.$inertia.form(
                {
                    code: null
                },
                {
                    bag: "redeemCode",
                    resetOnSuccess: false
                }
            )
        };
    }
};
</script>

<style></style>
