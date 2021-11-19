<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Find Facebook User") }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <jet-form-section @submitted="searchByUser">
                    <template #title>
                        {{ __("Search By Username or FB ID") }}
                    </template>
                    <template #description>
                        {{
                            __(
                                "Here in hercules you can find any user you want in facebook by id or username, this will take 1 points for search to unlock will take 4 points"
                            )
                        }}
                    </template>
                    <div class="mt-2 text-2xl">Get In Action</div>

                    <div class="mt-2 text-xs text-gray-500">
                        {{
                            __(
                                "You can find Facebook accounts by add (IDs) in this Input"
                            )
                        }}
                    </div>

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <div>
                                <div
                                    v-if="errors.message"
                                    class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md"
                                    role="alert"
                                >
                                    <div class="flex">
                                        <div class="py-1">
                                            <svg
                                                class="fill-current h-6 w-6 text-red-500 mr-4"
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
                                                {{
                                                    __("Ops, You have an error")
                                                }}
                                            </p>
                                            <p class="text-sm">
                                                {{ errors.message }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    v-if="
                                        form.recentlySuccessful &&
                                            !errors.message
                                    "
                                    class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md"
                                    role="alert"
                                >
                                    <div class="flex">
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
                                                Successful Finder
                                            </p>
                                            <p class="text-sm">
                                                Now you can unlock profiles.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <jet-label
                                    class="mt-4"
                                    for="username"
                                    :value="__('Search By Username or FB ID')"
                                />
                                <jet-input
                                    id="username"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.username"
                                    ref="username"
                                    autocomplete="off"
                                />
                                <jet-input-error
                                    :message="form.error('username')"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                    </template>

                    <template #actions>
                        <jet-action-message
                            :on="form.recentlySuccessful"
                            class="mr-3"
                        >
                            {{ __("Saved.") }}
                        </jet-action-message>

                        <jet-button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            {{ __("Save") }}
                        </jet-button>
                    </template>
                </jet-form-section>

                <div
                    class="bg-white shadow overflow-hidden sm:rounded-lg mt-4"
                    v-for="(account, key) in search"
                    :key="key"
                >
                    <div class="flex items-center justify-between">
                        <div class="px-4 py-5 sm:px-6">
                            <h3
                                class="text-lg leading-6 font-medium text-gray-900"
                            >
                                {{ key + 1 }} - {{ account.name }} ({{
                                    account.nationality
                                }})
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Facebook ID: <b>{{ account.unique_id }}</b>
                            </p>
                        </div>
                        <div class="px-4 py-5 sm:px-6">
                            <div
                                v-if="!unlock.includes(account.id)"
                                @click="unlock.push(account.id)"
                                class="hover:underline cursor-pointer text-indigo-500"
                            >
                                Unlock (4 points)
                            </div>
                        </div>
                    </div>
                    <div
                        class="border-t border-gray-200 px-4 py-5 sm:px-6"
                        v-if="unlock.includes(account.id)"
                    >
                        <dl
                            class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2"
                        >
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                    Full name
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.name }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                    Phone
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.mobile }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.username">
                                <dt class="text-sm font-medium text-gray-500">
                                    Email address
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.username }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.email">
                                <dt class="text-sm font-medium text-gray-500">
                                    Email address
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.email }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.birthdate">
                                <dt class="text-sm font-medium text-gray-500">
                                    Birthdate
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.birthdate }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.gender">
                                <dt class="text-sm font-medium text-gray-500">
                                    Gender
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.gender }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.religion">
                                <dt class="text-sm font-medium text-gray-500">
                                    Religion
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.religion }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.work">
                                <dt class="text-sm font-medium text-gray-500">
                                    Work
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.work }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.position">
                                <dt class="text-sm font-medium text-gray-500">
                                    Position
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.position }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.hometown">
                                <dt class="text-sm font-medium text-gray-500">
                                    Hometown
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.hometown }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.location">
                                <dt class="text-sm font-medium text-gray-500">
                                    Location
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.location }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1" v-if="account.education">
                                <dt class="text-sm font-medium text-gray-500">
                                    Education
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.education }}
                                </dd>
                            </div>
                            <div
                                class="sm:col-span-1"
                                v-if="account.relationship"
                            >
                                <dt class="text-sm font-medium text-gray-500">
                                    Relationship
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.relationship }}
                                </dd>
                            </div>
                            <div
                                class="sm:col-span-1"
                                v-if="account.nationality"
                            >
                                <dt class="text-sm font-medium text-gray-500">
                                    Nationality
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ account.nationality }}
                                </dd>
                            </div>
                        </dl>
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
import { PaperClipIcon } from "@heroicons/vue/solid";

export default {
    props: ["search", "errors"],

    components: {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        PaperClipIcon,
        JetInput,
        JetInputError,
        JetLabel
    },

    data() {
        return {
            form: this.$inertia.form(
                {
                    username: null,
                    id: null
                },
                {
                    bag: "search",
                    resetOnSuccess: false
                }
            ),
            unlock: []
        };
    },

    methods: {
        searchByUser() {
            this.form.post(route("search.store"), {
                preserveScroll: true
            });
        }
    }
};
</script>

<style></style>
