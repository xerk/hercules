<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <inertia-link :href="route('dashboard')">
                                <!-- <jet-application-mark
									class="block h-9 w-auto"
								/> -->
                                <svg
                                    fill="#315DA8"
                                    width="126"
                                    height="24"
                                    viewBox="0 0 126 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <g
                                        id="Group_7"
                                        data-name="Group 7"
                                        transform="translate(-473 -375)"
                                    >
                                        <g
                                            id="Group_5"
                                            data-name="Group 5"
                                            transform="translate(473 375)"
                                        >
                                            <g
                                                id="Group_1"
                                                data-name="Group 1"
                                                transform="translate(7.764 13.813)"
                                            >
                                                <path
                                                    id="Path_1"
                                                    data-name="Path 1"
                                                    d="M269.046,286.572h-7.038V278.05h2.709v5.583h1.533V276.35H255.812v-2.926c.2-.013.413-.037.622-.037q4.6,0,9.2,0a3.305,3.305,0,0,1,3.415,3.632C269.051,280.177,269.046,283.334,269.046,286.572Z"
                                                    transform="translate(-255.812 -273.385)"
                                                />
                                            </g>
                                            <g
                                                id="Group_2"
                                                data-name="Group 2"
                                                transform="translate(0 0.009)"
                                            >
                                                <path
                                                    id="Path_2"
                                                    data-name="Path 2"
                                                    d="M132.811,57.229V51.659h-1.527v7.3h10.448v2.911c-.229.013-.44.037-.65.037q-4.565,0-9.129,0c-2.125,0-3.453-1.4-3.46-3.656-.009-3.155,0-6.311,0-9.517h7.025v8.491Z"
                                                    transform="translate(-128.487 -48.738)"
                                                />
                                            </g>
                                            <g
                                                id="Group_3"
                                                data-name="Group 3"
                                                transform="translate(13.965 0)"
                                            >
                                                <path
                                                    id="Path_3"
                                                    data-name="Path 3"
                                                    d="M360.293,63.128a13.986,13.986,0,0,0-1.325-.9,11.414,11.414,0,0,0-1.381-.521V51.552h-1.57v10.19H353.3V48.6h6.992Z"
                                                    transform="translate(-353.301 -48.602)"
                                                />
                                            </g>
                                            <g
                                                id="Group_4"
                                                data-name="Group 4"
                                                transform="translate(0.041 12.584)"
                                            >
                                                <path
                                                    id="Path_4"
                                                    data-name="Path 4"
                                                    d="M129.126,254.056l2.708,1.435v10.052h1.57V255.329h2.717v13.14h-6.995Z"
                                                    transform="translate(-129.126 -254.056)"
                                                />
                                            </g>
                                        </g>
                                        <g
                                            id="Group_6"
                                            data-name="Group 6"
                                            transform="translate(490.478 379)"
                                        >
                                            <path
                                                id="Path_6"
                                                data-name="Path 6"
                                                d="M176.9,314.485h-8.944v4.69h9.866l-.48,3.273H164.034V303.984h13.261v3.273h-9.336v3.956H176.9Z"
                                                transform="translate(-152.512 -303.713)"
                                            />
                                            <path
                                                id="Path_7"
                                                data-name="Path 7"
                                                d="M190.784,315.058v7.39h-3.952V303.984h8.217c4.077,0,6.274,2.218,6.274,5.069a4.42,4.42,0,0,1-2.718,4.369c.926.337,2.323,1.289,2.323,4.594v.912a14.526,14.526,0,0,0,.269,3.52h-3.833a12.822,12.822,0,0,1-.391-4.146v-.269c0-2.019-.516-2.975-3.53-2.975Zm0-3.178h3.39c2.214,0,3.068-.831,3.068-2.376,0-1.5-.994-2.342-2.972-2.342h-3.486Z"
                                                transform="translate(-158.597 -303.713)"
                                            />
                                            <path
                                                id="Path_8"
                                                data-name="Path 8"
                                                d="M227.017,316.659c-.752,3.445-3.383,5.955-8.066,5.955-5.93,0-8.733-4.145-8.733-9.4,0-5.063,2.892-9.6,8.928-9.6,4.979,0,7.393,2.887,7.85,5.975h-4.043a3.659,3.659,0,0,0-3.936-2.843c-3.335,0-4.623,2.963-4.623,6.324,0,3.122,1.117,6.411,4.731,6.411a3.709,3.709,0,0,0,3.824-2.823Z"
                                                transform="translate(-164.961 -303.614)"
                                            />
                                            <path
                                                id="Path_9"
                                                data-name="Path 9"
                                                d="M241.386,303.984v11c0,3.544,1.845,4.594,3.863,4.594,2.314,0,3.767-1.242,3.767-4.594v-11h4.047V314.79c0,6.314-3.743,7.923-7.867,7.923-4.221,0-7.859-1.679-7.859-7.848V303.984Z"
                                                transform="translate(-172.268 -303.713)"
                                            />
                                            <path
                                                id="Path_10"
                                                data-name="Path 10"
                                                d="M264.621,303.984h4.044v15.191h9.316l-.462,3.273h-12.9Z"
                                                transform="translate(-179.617 -303.713)"
                                            />
                                            <path
                                                id="Path_11"
                                                data-name="Path 11"
                                                d="M298.992,314.485h-8.944v4.69h9.866l-.48,3.273H286.123V303.984h13.261v3.273h-9.336v3.956h8.944Z"
                                                transform="translate(-185.472 -303.713)"
                                            />
                                            <path
                                                id="Path_12"
                                                data-name="Path 12"
                                                d="M311.542,316.938c.427,1.855,1.774,2.668,3.938,2.668s3.083-.842,3.083-2.194c0-1.5-.9-2.156-4.1-2.89-5.09-1.18-6.348-3.009-6.348-5.5,0-3.219,2.438-5.406,6.865-5.406,4.965,0,6.943,2.636,7.212,5.338h-4.075c-.2-1.137-.832-2.371-3.243-2.371-1.641,0-2.632.67-2.632,1.981,0,1.284.794,1.8,3.816,2.5,5.44,1.266,6.632,3.264,6.632,5.869,0,3.373-2.583,5.686-7.527,5.686-4.747,0-7.247-2.308-7.7-5.676Z"
                                                transform="translate(-191.169 -303.614)"
                                            />
                                        </g>
                                    </g>
                                </svg>
                            </inertia-link>
                        </div>

                        <!-- Navigation Links -->
                        <div
                            class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                        >
                            <jet-nav-link
                                :href="route('dashboard')"
                                :active="$page.currentRouteName == 'dashboard'"
                            >
                                {{ __("Dashboard") }}
                            </jet-nav-link>

                            <jet-nav-link
                                :href="route('clients')"
                                :active="$page.currentRouteName == 'clients'"
                            >
                                {{ __("Data Area") }}
                            </jet-nav-link>
                            <jet-nav-link
                                :href="route('purchase')"
                                :active="$page.currentRouteName == 'purchase'"
                            >
                                {{ __("Purchase Points") }}
                            </jet-nav-link>
                            <jet-nav-link href="#" class="cursor-not-allowed"
                                >{{ __("Facebook")
                                }}<span
                                    class="text-xs bg-red-500 rounded-full mx-2 text-white px-2 shadow-md py-1"
                                    >{{ "Soon" }}</span
                                >
                            </jet-nav-link>
                            <jet-nav-link href="#" class="cursor-not-allowed">
                                {{ "SEO" }}
                                <span
                                    class="text-xs bg-red-500 rounded-full mx-2 text-white px-2 shadow-md py-1"
                                    >{{ "Soon" }}</span
                                >
                            </jet-nav-link>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div
                        class="hidden sm:flex cursor-pointer select-none sm:items-center sm:ml-6"
                    >
                        <div
                            class="bg-indigo-500 shadow-md px-2 py-1 rounded-full font-bold text-white flex items-center"
                        >
                            <span class="mr-1">{{ $page.user.point }}</span>
                            <span class="text-xs">{{ __("Points") }} +</span>
                        </div>
                        <div class="ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button
                                        v-if="
                                            $page.jetstream.managesProfilePhotos
                                        "
                                        class="flex items-center text-sm border-transparent rounded-full focus:outline-none transition duration-150 ease-in-out"
                                    >
                                        <div class="px-2 py-1 leading-tight">
                                            <div>{{ $page.user.name }}</div>
                                            <small class="uppercase">{{
                                                $page.user.membership
                                            }}</small>
                                        </div>
                                        <img
                                            class="h-8 w-8 rounded-full object-cover shadow-md"
                                            :src="$page.user.profile_photo_url"
                                            :alt="$page.user.name"
                                        />
                                    </button>

                                    <button
                                        v-else
                                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                                    >
                                        <div>{{ $page.user.name }}</div>

                                        <div class="ml-1">
                                            <svg
                                                class="fill-current h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </div>
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div
                                        class="block px-4 py-2 text-xs text-gray-400"
                                    >
                                        {{ __("Manage Account") }}
                                    </div>

                                    <jet-dropdown-link
                                        :href="route('profile.show')"
                                    >
                                        {{ __("Profile") }}
                                    </jet-dropdown-link>

                                    <jet-dropdown-link
                                        :href="route('api-tokens.index')"
                                        v-if="$page.jetstream.hasApiFeatures"
                                    >
                                        {{ __("API Tokens") }}
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Management -->
                                    <template
                                        v-if="$page.jetstream.hasTeamFeatures"
                                    >
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            {{ __("Manage Team") }}
                                        </div>

                                        <!-- Team Settings -->
                                        <jet-dropdown-link
                                            :href="
                                                route(
                                                    'teams.show',
                                                    $page.user.current_team
                                                )
                                            "
                                        >
                                            {{ __("Team Settings") }}
                                        </jet-dropdown-link>

                                        <jet-dropdown-link
                                            :href="route('teams.create')"
                                            v-if="
                                                $page.jetstream.canCreateTeams
                                            "
                                        >
                                            {{ __(" Create New Team") }}
                                        </jet-dropdown-link>

                                        <div
                                            class="border-t border-gray-100"
                                        ></div>

                                        <!-- Team Switcher -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            {{ __("Switch Teams") }}
                                        </div>

                                        <template
                                            v-for="team in $page.user.all_teams"
                                        >
                                            <form
                                                @submit.prevent="
                                                    switchToTeam(team)
                                                "
                                            >
                                                <jet-dropdown-link as="button">
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <svg
                                                            v-if="
                                                                team.id ==
                                                                    $page.user
                                                                        .current_team_id
                                                            "
                                                            class="mr-2 h-5 w-5 text-green-400"
                                                            fill="none"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                            ></path>
                                                        </svg>
                                                        <div>
                                                            {{ team.name }}
                                                        </div>
                                                    </div>
                                                </jet-dropdown-link>
                                            </form>
                                        </template>

                                        <div
                                            class="border-t border-gray-100"
                                        ></div>
                                    </template>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            {{ __("Logout") }}
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown = !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown
                }"
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link
                        :href="route('dashboard')"
                        :active="$page.currentRouteName == 'dashboard'"
                    >
                        {{ __("Dashboard") }}
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link
                        :href="route('clients')"
                        :active="$page.currentRouteName == 'clients'"
                    >
                        {{ __("Data Area") }}
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link
                        :href="route('purchase')"
                        :active="$page.currentRouteName == 'purchase'"
                    >
                        {{ __("Purchase Points") }}
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link href="#">
                        {{ __("Facebook") }}
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link href="#">
                        {{ __("SEO") }}
                    </jet-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div
                        class="bg-indigo-500 shadow-md px-2 py-2 rounded-full font-bold text-white flex items-center justify-center mb-4 mx-4"
                    >
                        <span class="mr-1">{{ $page.user.point }}</span>
                        <span class="text-xs">{{ __("Points") }} +</span>
                    </div>
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img
                                class="h-10 w-10 rounded-full"
                                :src="$page.user.profile_photo_url"
                                :alt="$page.user.name"
                            />
                        </div>

                        <div class="ml-3">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.user.email }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link
                            :href="route('profile.show')"
                            :active="$page.currentRouteName == 'profile.show'"
                        >
                            {{ __("Profile") }}
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link
                            :href="route('api-tokens.index')"
                            :active="
                                $page.currentRouteName == 'api-tokens.index'
                            "
                            v-if="$page.jetstream.hasApiFeatures"
                        >
                            {{ __("API Tokens") }}
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                {{ __("Logout") }}
                            </jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        <template v-if="$page.jetstream.hasTeamFeatures">
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __("Manage Team") }}
                            </div>

                            <!-- Team Settings -->
                            <jet-responsive-nav-link
                                :href="
                                    route('teams.show', $page.user.current_team)
                                "
                                :active="$page.currentRouteName == 'teams.show'"
                            >
                                {{ __("Team Settings") }}
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link
                                :href="route('teams.create')"
                                :active="
                                    $page.currentRouteName == 'teams.create'
                                "
                            >
                                {{ __("Create New Team") }}
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __("Switch Teams") }}
                            </div>

                            <template v-for="team in $page.user.all_teams">
                                <form
                                    @submit.prevent="switchToTeam(team)"
                                    :key="team.id"
                                >
                                    <jet-responsive-nav-link as="button">
                                        <div class="flex items-center">
                                            <svg
                                                v-if="
                                                    team.id ==
                                                        $page.user
                                                            .current_team_id
                                                "
                                                class="mr-2 h-5 w-5 text-green-400"
                                                fill="none"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                ></path>
                                            </svg>
                                            <div>{{ team.name }}</div>
                                        </div>
                                    </jet-responsive-nav-link>
                                </form>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple> </portal-target>
    </div>
</template>

<script>
import JetApplicationLogo from "./../Jetstream/ApplicationLogo";
import JetApplicationMark from "./../Jetstream/ApplicationMark";
import JetDropdown from "./../Jetstream/Dropdown";
import JetDropdownLink from "./../Jetstream/DropdownLink";
import JetNavLink from "./../Jetstream/NavLink";
import JetResponsiveNavLink from "./../Jetstream/ResponsiveNavLink";

export default {
    components: {
        JetApplicationLogo,
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink
    },

    data() {
        return {
            showingNavigationDropdown: false
        };
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id
                },
                {
                    preserveState: false
                }
            );
        },

        logout() {
            axios.post(route("logout").url()).then(response => {
                window.location = "/";
            });
        }
    },

    computed: {
        path() {
            return window.location.pathname;
        }
    }
};
</script>
