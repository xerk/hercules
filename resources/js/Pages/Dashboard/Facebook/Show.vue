<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Facebook") }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap">
                    <div
                        class="relative w-full sm:w-1/2 md:w-1/3 lg:w-1/3 px-2"
                    >
                        <div class="bg-white shadow rounded-lg mb-6">
                            <div
                                class="bg-gray-50 rounded-lg px-4 py-2 font-semibold"
                            >
                                Facebook Results
                            </div>
                            <div class="p-6">
                                <ul>
                                    <li
                                        class="pb-2 flex justify-between items-center"
                                    >
                                        <div class="text-gray-400">Country</div>
                                        <div class="font-semibold capitalize">
                                            {{ form.country }}
                                        </div>
                                    </li>
                                    <li
                                        class="pb-2 flex justify-between items-center"
                                    >
                                        <div class="text-gray-400">
                                            Facebook Count
                                        </div>
                                        <div class="font-semibold">
                                            {{ form.count }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="bg-white shadow rounded-lg">
                            <div
                                class="bg-gray-50 rounded-lg px-4 py-2 font-semibold flex items-center justify-between"
                            >
                                <div>Display Data</div>
                                <form @submit.prevent="getResult">
                                    <jet-button
                                        :class="{
                                            'opacity-25': form.processing
                                        }"
                                        :disabled="form.processing"
                                    >
                                        {{ __("Save") }}
                                    </jet-button>
                                </form>
                            </div>
                            <div class="p-2">
                                <ul
                                    class="px-4 overflow-scroll max-h-96 my-2"
                                    v-if="clients.length > 0 && !form.processing"
                                >
                                    <li
                                        class="pb-2 flex justify-between items-center"
                                        v-for="(client, key) in clients"
                                        :key="key"
                                    >
                                        <div class="text-gray-400 capitalize">
                                            {{ client.name }}
                                        </div>
                                        <div class="font-semibold capitalize">
                                            {{ client.gender }}
                                        </div>
                                    </li>
                                </ul>
                                <div class="flex items-center justify-center flex-col" v-else-if="!form.processing">
                                    <no-data-svg />
                                    <div class="font-semibold mb-4">No Data</div>
                                </div>
                                <div class="font-semibold my-4 text-center" v-if="form.processing">Loading data...</div>
                            </div>
                        </div>
                    </div>
                    <form
                        @submit.prevent
                        class="w-full sm:w-1/2 md:w-2/3 lg:w-2/3 px-2"
                    >
                        <div class="bg-white shadow rounded-lg mb-6">
                            <div>
                                <div
                                    class="bg-gray-50 rounded-lg px-4 py-2 font-semibold"
                                >
                                    Getting Started
                                </div>
                            </div>
                            <div class="p-6 flex flex-wrap items-end">
                                <div class="w-full sm:w-1/2 px-2">
                                    <jet-label for="country" value="Country" />
                                    <select
                                        v-model="form.country"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        id="country"
                                    >
                                        <option value="all">All</option>
                                        <option
                                            :value="country.value"
                                            v-for="(country, key) in countries"
                                            :key="key"
                                        >
                                            {{ country.name }}</option
                                        >
                                    </select>
                                    <jet-input-error
                                        :message="form.error('country')"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="w-full sm:w-1/2 px-2">
                                    <jet-label
                                        for="count"
                                        :value="__('Facebook Count')"
                                    />
                                    <jet-input
                                        id="count"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.count"
                                        ref="count"
                                        autocomplete="off"
                                    />
                                    <jet-input-error
                                        :message="form.error('count')"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="bg-white shadow rounded-lg">
                                <div
                                    class="bg-gray-50 rounded-lg px-4 py-2 font-semibold"
                                >
                                    Facebook Search
                                </div>
                                <div class="p-6 flex flex-wrap items-end">
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="religion"
                                            :value="__('Religion')"
                                        />
                                        <jet-input
                                            id="religion"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.religion"
                                            ref="religion"
                                            autocomplete="off"
                                        />
                                        <jet-input-error
                                            :message="form.error('religion')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="birthdate"
                                            value="Birthdate"
                                        />
                                        <select
                                            v-model="form.birthdate"
                                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                                            id="birthdate"
                                        >
                                            <option value="all">All</option>
                                            <option
                                                :value="[
                                                    birthdate.start,
                                                    birthdate.end
                                                ]"
                                                v-for="(birthdate,
                                                key) in birthdates"
                                                :key="key"
                                            >
                                                {{ birthdate.name }}</option
                                            >
                                        </select>
                                        <jet-input-error
                                            :message="form.error('birthdate')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="gender"
                                            value="Gender"
                                        />
                                        <select
                                            v-model="form.gender"
                                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                                            id="gender"
                                        >
                                            <option value="all">All</option>
                                            <option
                                                :value="gender.value"
                                                v-for="(gender, key) in genders"
                                                :key="key"
                                            >
                                                {{ gender.name }}</option
                                            >
                                        </select>
                                        <jet-input-error
                                            :message="form.error('birthdate')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="work"
                                            :value="__('Work')"
                                        />
                                        <jet-input
                                            id="work"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.work"
                                            ref="work"
                                            autocomplete="off"
                                        />
                                        <jet-input-error
                                            :message="form.error('work')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="position"
                                            :value="__('Position')"
                                        />
                                        <jet-input
                                            id="position"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.position"
                                            ref="position"
                                            autocomplete="off"
                                        />
                                        <jet-input-error
                                            :message="form.error('position')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="hometown"
                                            :value="__('Home Town')"
                                        />
                                        <jet-input
                                            id="hometown"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.hometown"
                                            ref="hometown"
                                            autocomplete="off"
                                        />
                                        <jet-input-error
                                            :message="form.error('hometown')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="location"
                                            :value="__('Location')"
                                        />
                                        <jet-input
                                            id="location"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.location"
                                            ref="location"
                                            autocomplete="off"
                                        />
                                        <jet-input-error
                                            :message="form.error('location')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="education"
                                            :value="__('Education')"
                                        />
                                        <jet-input
                                            id="education"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.education"
                                            ref="education"
                                            autocomplete="off"
                                        />
                                        <jet-input-error
                                            :message="form.error('education')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="relationship"
                                            value="Relationship"
                                        />
                                        <select
                                            v-model="form.relationship"
                                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                                            id="relationship"
                                        >
                                            <option value="all">All</option>
                                            <option
                                                :value="relationship.value"
                                                v-for="(relationship,
                                                key) in relationships"
                                                :key="key"
                                            >
                                                {{ relationship.name }}</option
                                            >
                                        </select>
                                        <jet-input-error
                                            :message="form.error('birthdate')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <div class="flex mt-4 items-center">
                                            <input
                                                id="exist-email"
                                                v-model="form.existEmail"
                                                type="checkbox"
                                                :value="false"
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded mr-2"
                                            />
                                            <jet-label
                                                for="exist-email"
                                                value="Exist Email Mandatory"
                                                class="bold"
                                            />
                                        </div>
                                        <jet-input-error
                                            :message="form.error('birthdate')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <div class="flex mt-4 items-center">
                                            <input
                                                id="exist-mobile"
                                                v-model="form.existMobile"
                                                type="checkbox"
                                                :value="false"
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded mr-2"
                                            />
                                            <jet-label
                                                for="exist-mobile"
                                                value="Exist Mobile Mandatory"
                                                class="bold"
                                            />
                                        </div>
                                        <jet-input-error
                                            :message="form.error('birthdate')"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2"
                                    >
                                        <div class="flex mt-4 items-center">
                                            <input
                                                :value="false"
                                                id="exist-username"
                                                v-model="form.existUsername"
                                                type="checkbox"
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded mr-2"
                                            />
                                            <jet-label
                                                for="exist-username"
                                                value="Exist Username Mandatory"
                                                class="bold"
                                            />
                                        </div>
                                        <jet-input-error
                                            :message="form.error('birthdate')"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="bg-gray-50 rounded-lg px-4 py-2 text-right"
                                >
                                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                    :class="{
                                        'opacity-25': form.processing
                                    }"
                                    :disabled="form.processing"
                                    @click.native="getResult"
                                >
                                    {{ __("Save Without Display") }}
                                </button>
                                <jet-button
                                    @click.native="searchResult"
                                    :class="{
                                        'opacity-25': form.processing
                                    }"
                                    :disabled="form.processing"
                                >
                                    {{ __("Save") }}
                                </jet-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div
                    class="w-full my-8 overflow-hidden rounded-lg shadow-md"
                    v-if="clients"
                >
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                                >
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">{{ __("Count") }}</th>
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
                                    v-for="(result, key) in results"
                                    :key="key"
                                >
                                    <td class="px-4 py-3">
                                        {{ key }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ result.length }}
                                    </td>
                                    <td class="px-4 py-3 text-sm capitalize">
                                        <a
                                            class="hover:underline text-indigo-500"
                                            :href="
                                                route(
                                                    'clients.fb.download',
                                                    key
                                                )
                                            "
                                            >{{ __("Download") }}</a
                                        >
                                        <a
                                            class="hover:underline ml-2 text-indigo-500"
                                            :href="route('facebook.data', key)"
                                            >{{ __("Show") }}</a
                                        >
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
import NoDataSvg from "./components/NoDataSvg";

export default {
    props: ["clients", "errors", "results"],

    components: {
        AppLayout,
        NoDataSvg,
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
                    country: "all",
                    count: 500,
                    religion: "",
                    birthdate: "all",
                    work: "",
                    position: "",
                    education: "",
                    gender: "all",
                    hometown: "",
                    location: "",
                    relationship: "all",
                    existEmail: false,
                    existMobile: false,
                    existUsername: false
                },
                {
                    bag: "redeemCode",
                    resetOnSuccess: false
                }
            ),
            relationships: [
                {
                    name: "Single",
                    value: "single"
                },
                {
                    name: "In a relationship",
                    value: "In a relationship"
                },
                {
                    name: "Engaged",
                    value: "Engaged"
                },
                {
                    name: "Married",
                    value: "Married"
                },
                {
                    name: "In a civil partnership",
                    value: "In a civil partnership"
                },
                {
                    name: "In a domestic partnership",
                    value: "In a domestic partnership"
                },
                {
                    name: "In an open relationship",
                    value: "In an open relationship"
                },
                {
                    name: "It's complicated",
                    value: "It's complicated"
                },
                {
                    name: "Separated",
                    value: "Separated"
                },
                {
                    name: "Divorced",
                    value: "Divorced"
                },
                {
                    name: "Widowed",
                    value: "Widowed"
                }
            ],
            genders: [
                {
                    name: "Male",
                    value: "male"
                },
                {
                    name: "Female",
                    value: "female"
                },
                {
                    name: "Other",
                    value: "other"
                }
            ],
            countries: [
                {
                    name: "Egypt",
                    value: "egypt"
                },
                {
                    name: "Turkey",
                    value: "turkey"
                },
                {
                    name: "SaudiArabia",
                    value: "saudiArabia"
                },
                {
                    name: "Emirates",
                    value: "emirates"
                },
                {
                    name: "Qatar",
                    value: "qatar"
                },
                {
                    name: "Kuwait",
                    value: "kuwait"
                },
                {
                    name: "Bahrain",
                    value: "bahrain"
                },
                {
                    name: "Oman",
                    value: "oman"
                },
                {
                    name: "Syria",
                    value: "syria"
                },
                {
                    name: "Jordan",
                    value: "jordan"
                },
                {
                    name: "Palestine",
                    value: "palestine"
                },
                {
                    name: "Iraq",
                    value: "iraq"
                },
                {
                    name: "Yemen",
                    value: "yemen"
                },
                {
                    name: "Lebanon",
                    value: "lebanon"
                },
                {
                    name: "Algeria",
                    value: "algeria"
                },
                {
                    name: "Tunisia",
                    value: "tunisia"
                },
                {
                    name: "Libya",
                    value: "libya"
                },
                {
                    name: "Morocco",
                    value: "morocco"
                },
                {
                    name: "Sudan",
                    value: "sudan"
                }
            ],
            birthdates: [
                {
                    name: "Between 13 to 15",
                    start: "13",
                    end: "15"
                },
                {
                    name: "Between 16 to 22",
                    start: "16",
                    end: "22"
                },
                {
                    name: "Between 23 to 28",
                    start: "23",
                    end: "28"
                },
                {
                    name: "Between 29 to 34",
                    start: "29",
                    end: "34"
                },
                {
                    name: "Between 35 to 40",
                    start: "35",
                    end: "40"
                },
                {
                    name: "Between 41 to 46",
                    start: "41",
                    end: "46"
                },
                {
                    name: "Between 47 to 52",
                    start: "47",
                    end: "52"
                },
                {
                    name: "Between 53+",
                    start: "53",
                    end: "100"
                }
            ]
        };
    },

    methods: {
        searchResult(url = null) {
            this.form.post(route("facebook.find"), {
                preserveScroll: true
            });
        },
        getResult(url = null) {
            this.form.post(route("facebook.store"), {
                preserveScroll: true
            });
        }
    }
};
</script>

<style></style>
