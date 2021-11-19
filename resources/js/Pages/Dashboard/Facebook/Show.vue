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
                        <div class="bg-white shadow rounded-lg mb-4">
                            <div
                                class="bg-gray-50 rounded-lg px-4 py-2 font-semibold flex items-center justify-between"
                            >
                                <div>
                                    Display Not Dublicated Data
                                    <span v-if="clientCount > 0"
                                        >({{ clientCount }})</span
                                    >
                                </div>
                                <form
                                    @submit.prevent="getResult"
                                    v-if="clients.length"
                                >
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
                                    v-if="
                                        clients.length > 0 && !form.processing
                                    "
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
                                <div
                                    class="flex items-center justify-center flex-col"
                                    v-else-if="!form.processing"
                                >
                                    <no-data-svg />
                                    <div class="font-semibold mb-4">
                                        No Data
                                    </div>
                                </div>
                                <div
                                    class="font-semibold my-4 text-center"
                                    v-if="form.processing"
                                >
                                    Loading data...
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white shadow rounded-lg"
                            v-if="
                                clientCountWithOut > 0 &&
                                    clientCountWithOut != clientCount
                            "
                        >
                            <div
                                class="bg-gray-50 rounded-lg px-4 py-2 font-semibold flex items-center justify-between"
                            >
                                <div>
                                    Display All Data
                                    <span v-if="clientCountWithOut > 0"
                                        >({{ clientCountWithOut }})</span
                                    >
                                </div>
                                <form
                                    @submit.prevent="getResult"
                                    v-if="clientWithOut.length"
                                >
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
                                    v-if="
                                        clientWithOut.length > 0 &&
                                            !form.processing
                                    "
                                >
                                    <li
                                        class="pb-2 flex justify-between items-center"
                                        v-for="(client, key) in clientWithOut"
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
                                <div
                                    class="flex items-center justify-center flex-col"
                                    v-else-if="!form.processing"
                                >
                                    <no-data-svg />
                                    <div class="font-semibold mb-4">
                                        No Data
                                    </div>
                                </div>
                                <div
                                    class="font-semibold my-4 text-center"
                                    v-if="form.processing"
                                >
                                    Loading data...
                                </div>
                            </div>
                        </div>
                    </div>
                    <form
                        @submit.prevent="searchResult"
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
                                    <!-- Religion -->
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="religion"
                                            :value="__('Religion')"
                                        />
                                        <vue-tags-input
                                            v-model="form.religion"
                                            :tags="form.religions"
                                            @tags-changed="
                                                newTags =>
                                                    (form.religions = newTags)
                                            "
                                            placeholder="Add Reliation"
                                        />
                                        <jet-input-error
                                            :message="form.error('religion')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Birthdate -->
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="birthdate"
                                            value="Birthdate"
                                        />
                                        <div class="flex items-center">
                                            <div class="w-full mr-2">
                                                <select
                                                    v-model="form.birthdateFrom"
                                                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                                                    id="birthdateFrom"
                                                >
                                                    <option value="all"
                                                        >All</option
                                                    >
                                                    <option
                                                        :value="data"
                                                        v-for="(data,
                                                        key) in 80"
                                                        :key="key"
                                                    >
                                                        {{ data }}</option
                                                    >
                                                </select>
                                                <jet-input-error
                                                    :message="
                                                        form.error(
                                                            'birthdateFrom'
                                                        )
                                                    "
                                                    class="mt-2"
                                                />
                                            </div>
                                            <div class="w-full ml-2">
                                                <select
                                                    :disabled="
                                                        form.birthdateFrom ==
                                                            'all'
                                                    "
                                                    v-model="form.birthdateTo"
                                                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                                                    id="birthdateTo"
                                                >
                                                    <option value="all"
                                                        >All</option
                                                    >
                                                    <option
                                                        :value="birthdateTo"
                                                        v-for="(birthdateTo,
                                                        key) in 80"
                                                        :key="key"
                                                    >
                                                        {{
                                                            birthdateTo
                                                        }}</option
                                                    >
                                                </select>
                                                <jet-input-error
                                                    :message="
                                                        form.error(
                                                            'birthdateTo'
                                                        )
                                                    "
                                                    class="mt-2"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gender -->
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pb-2 px-2"
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
                                            :message="form.error('gender')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Relationship -->
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pb-2 px-2"
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
                                            :message="
                                                form.error('relationship')
                                            "
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Work -->
                                    <div class="w-full pb-2 px-2">
                                        <jet-label
                                            for="work"
                                            :value="__('Work')"
                                        />
                                        <vue-tags-input
                                            v-model="form.work"
                                            :tags="form.works"
                                            @tags-changed="workUpdate"
                                            :allow-edit-tags="true"
                                            :autocomplete-items="
                                                autocompleteItems
                                            "
                                            :add-only-from-autocomplete="true"
                                            placeholder="Add Work"
                                        >
                                            <div
                                                slot="autocomplete-item"
                                                slot-scope="props"
                                                @click="
                                                    props.performAdd(props.item)
                                                "
                                            >
                                                <div
                                                    class="flex items-center justify-between"
                                                >
                                                    <div>
                                                        {{ props.item.text }}
                                                    </div>
                                                    <div
                                                        class="font-semibold text-gray-700 px-1"
                                                    >
                                                        ({{ props.item.count }})
                                                    </div>
                                                </div>
                                            </div>
                                        </vue-tags-input>
                                        <jet-input-error
                                            :message="form.error('work')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Position -->
                                    <div class="w-full sm:w-full pb-2 px-2">
                                        <jet-label
                                            for="position"
                                            :value="__('Position')"
                                        />
                                        <vue-tags-input
                                            v-model="form.position"
                                            :tags="form.positions"
                                            @tags-changed="positionUpdate"
                                            :allow-edit-tags="true"
                                            :autocomplete-items="
                                                autocompleteItems
                                            "
                                            :add-only-from-autocomplete="true"
                                            placeholder="Add Position"
                                        >
                                            <div
                                                slot="autocomplete-item"
                                                slot-scope="props"
                                                @click="
                                                    props.performAdd(props.item)
                                                "
                                            >
                                                <div
                                                    class="flex items-center justify-between"
                                                >
                                                    <div>
                                                        {{ props.item.text }}
                                                    </div>
                                                    <div
                                                        class="font-semibold text-gray-700 px-1"
                                                    >
                                                        ({{ props.item.count }})
                                                    </div>
                                                </div>
                                            </div>
                                        </vue-tags-input>
                                        <jet-input-error
                                            :message="form.error('position')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Hometown -->
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="hometown"
                                            :value="__('Home Town')"
                                        />
                                        <vue-tags-input
                                            v-model="form.hometown"
                                            :tags="form.hometowns"
                                            @tags-changed="hometownUpdate"
                                            :autocomplete-items="
                                                autocompleteItems
                                            "
                                            :add-only-from-autocomplete="true"
                                            :allow-edit-tags="true"
                                            placeholder="Add Hometown"
                                        >
                                            <div
                                                slot="autocomplete-item"
                                                slot-scope="props"
                                                @click="
                                                    props.performAdd(props.item)
                                                "
                                            >
                                                <div
                                                    class="flex items-center justify-between"
                                                >
                                                    <div>
                                                        {{ props.item.text }}
                                                    </div>
                                                    <div
                                                        class="font-semibold text-gray-700 px-1"
                                                    >
                                                        ({{ props.item.count }})
                                                    </div>
                                                </div>
                                            </div>
                                        </vue-tags-input>
                                        <jet-input-error
                                            :message="form.error('hometown')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Location -->
                                    <div
                                        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pb-2 px-2"
                                    >
                                        <jet-label
                                            for="location"
                                            :value="__('Location')"
                                        />
                                        <vue-tags-input
                                            v-model="form.location"
                                            :tags="form.locations"
                                            @tags-changed="locationUpdate"
                                            :autocomplete-items="
                                                autocompleteItems
                                            "
                                            :add-only-from-autocomplete="true"
                                            :allow-edit-tags="true"
                                            placeholder="Add location"
                                        >
                                            <div
                                                slot="autocomplete-item"
                                                slot-scope="props"
                                                @click="
                                                    props.performAdd(props.item)
                                                "
                                            >
                                                <div
                                                    class="flex items-center justify-between"
                                                >
                                                    <div>
                                                        {{ props.item.text }}
                                                    </div>
                                                    <div
                                                        class="font-semibold text-gray-700 px-1"
                                                    >
                                                        ({{ props.item.count }})
                                                    </div>
                                                </div>
                                            </div>
                                        </vue-tags-input>
                                        <jet-input-error
                                            :message="form.error('location')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Education  -->
                                    <div class="w-full sm:w-full pb-2 px-2">
                                        <jet-label
                                            for="education"
                                            :value="__('Education')"
                                        />
                                        <vue-tags-input
                                            v-model="form.education"
                                            :tags="form.educations"
                                            @tags-changed="educationUpdate"
                                            :autocomplete-items="
                                                autocompleteItems
                                            "
                                            :add-only-from-autocomplete="true"
                                            :allow-edit-tags="true"
                                            placeholder="Add Education"
                                        >
                                            <div
                                                slot="autocomplete-item"
                                                slot-scope="props"
                                                @click="
                                                    props.performAdd(props.item)
                                                "
                                            >
                                                <div
                                                    class="flex items-center justify-between"
                                                >
                                                    <div>
                                                        {{ props.item.text }}
                                                    </div>
                                                    <div
                                                        class="font-semibold text-gray-700 px-1"
                                                    >
                                                        ({{ props.item.count }})
                                                    </div>
                                                </div>
                                            </div>
                                        </vue-tags-input>
                                        <jet-input-error
                                            :message="form.error('education')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Exist Email -->
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
                                            :message="form.error('existEmail')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Exist Mobile -->
                                    <!-- <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2">
                                        <div class="flex mt-4 items-center">
                                            <input id="exist-mobile" v-model="form.existMobile" type="checkbox"
                                                :value="false"
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded mr-2" />
                                            <jet-label for="exist-mobile" value="Exist Mobile Mandatory" class="bold" />
                                        </div>
                                        <jet-input-error :message="form.error('existMobile')" class="mt-2" />
                                    </div> -->

                                    <!-- Exist Username -->
                                    <!-- <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 pb-2 px-2">
                                        <div class="flex mt-4 items-center">
                                            <input :value="false" id="exist-username" v-model="form.existUsername"
                                                type="checkbox"
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded mr-2" />
                                            <jet-label for="exist-username" value="Exist Username Mandatory"
                                                class="bold" />
                                        </div>
                                        <jet-input-error :message="
                                                form.error('existUsername')
                                            " class="mt-2" />
                                    </div> -->
                                </div>

                                <!-- Submit Button -->
                                <div
                                    class="bg-gray-50 rounded-lg px-4 py-2 text-right"
                                >
                                    <jet-button
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

                <!-- Client Table  -->
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
                                    <th class="px-4 py-3">{{ __("Code") }}</th>
                                    <th class="px-4 py-3">{{ __("Count") }}</th>
                                    <th class="px-4 py-3">
                                        {{ __("Status") }}
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
                                    v-for="(result, key) in results.data"
                                    :key="key"
                                >
                                    <td class="px-4 py-3">
                                        {{ result.order }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ result.group }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ result.count }}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                                        >
                                            {{ result.status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm capitalize">
                                        <a
                                            class="hover:underline text-indigo-500"
                                            :href="
                                                route(
                                                    'clients.fb.download',
                                                    result.group
                                                )
                                            "
                                            >{{ __("Download") }}</a
                                        >
                                        <a
                                            class="hover:underline ml-2 text-indigo-500"
                                            :href="
                                                route(
                                                    'facebook.data',
                                                    result.group
                                                )
                                            "
                                            >{{ __("Show") }}</a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <span class="flex items-center col-span-3">
                            {{ __("Showing") }} {{ results.from }}-{{
                                results.to
                            }}
                            {{ __("of") }}
                            {{ results.total }}
                        </span>
                        <span class="col-span-2"></span>
                        <!-- Pagination -->
                        <span
                            class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end"
                        >
                            <nav aria-label="Table navigation">
                                <ul class="inline-flex items-center">
                                    <li
                                        v-for="(link, key) in results.links"
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
import JetActionMessage from "./../../../Jetstream/ActionMessage";
import JetButton from "./../../../Jetstream/Button";
import JetFormSection from "./../../../Jetstream/FormSection";
import JetInput from "./../../../Jetstream/Input";
import JetInputError from "./../../../Jetstream/InputError";
import JetLabel from "./../../../Jetstream/Label";
import NoDataSvg from "./components/NoDataSvg";
import VueTagsInput from "@johmun/vue-tags-input";

export default {
    props: [
        "clients",
        "errors",
        "results",
        "clientCount",
        "autocomplete",
        "clientWithOut",
        "clientCountWithOut"
    ],

    components: {
        AppLayout,
        NoDataSvg,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        VueTagsInput
    },

    data() {
        return {
            autocompleteItems: [],
            debounce: null,
            form: this.$inertia.form(
                {
                    country: "all",
                    count: 500,
                    religion: "",
                    religions: [],
                    birthdateTo: "all",
                    birthdateFrom: "all",
                    work: "",
                    works: [],
                    position: "",
                    positions: [],
                    education: "",
                    educations: [],
                    gender: "all",
                    hometown: "",
                    hometowns: [],
                    location: "",
                    locations: [],
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
                    name: "Saudi Arabia",
                    value: "saudi"
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
                    value: "lybia"
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

    watch: {
        "form.work": function(val) {
            console.log(val);
            this.initItems(val, "work");
        },
        "form.position": function(val) {
            this.initItems(val, "position");
        },
        "form.education": function(val) {
            this.initItems(val, "education");
        },
        "form.hometown": function(val) {
            this.initItems(val, "hometown");
        },
        "form.location": function(val) {
            this.initItems(val, "location");
        }
    },

    methods: {
        async searchResult(url = null) {
            if (this.form.count * 2 <= this.$page.user.point) {
                await this.form.post(route("facebook.find"), {
                    preserveScroll: true
                });
            } else {
                alert(this.__("You didn't have points enough"));
            }
        },
        async getResult(url = null) {
            if (this.form.count * 2 <= this.$page.user.point) {
                await this.form.post(route("facebook.store"), {
                    preserveScroll: true
                });
            } else {
                alert(this.__("You didn't have points enough"));
            }
        },
        workUpdate(newTags) {
            this.autocompleteItems = [];
            this.form.works = newTags;
        },
        positionUpdate(newTags) {
            this.autocompleteItems = [];
            this.form.positions = newTags;
        },
        locationUpdate(newTags) {
            this.autocompleteItems = [];
            this.form.locations = newTags;
        },
        hometownUpdate(newTags) {
            this.autocompleteItems = [];
            this.form.hometowns = newTags;
        },
        educationUpdate(newTags) {
            this.autocompleteItems = [];
            this.form.educations = newTags;
        },
        async initItems(q, table) {
            if (q.length < 2) return;

            clearTimeout(this.debounce);

            this.debounce = setTimeout(async () => {
                await this.$inertia.replace(
                    route("facebook.search", {
                        q: q,
                        table: table
                    }),
                    {
                        preserveScroll: true
                    }
                );
                if (this.autocomplete.length > 0) {
                    this.autocompleteItems = this.autocomplete.map(a => {
                        return {
                            text: a.name,
                            count: a.count
                        };
                    });
                }
            }, 600);
        }
    }
};
</script>
<style lang="css">
.vue-tags-input {
    @apply max-w-full !important;
}

.vue-tags-input .ti-input {
    appearance: none;
    background-color: #ffffff;
    border-color: #d2d6dc;
    border-width: 1 px;
    border-radius: 0.375 rem;
    padding-top: 0.5 rem;
    padding-right: 0.75 rem;
    padding-bottom: 0.5 rem;
    padding-left: 0.75 rem;
    font-size: 1rem;
    line-height: 1.5;
    @apply rounded-md shadow-sm mt-1 block w-full;
}
</style>
