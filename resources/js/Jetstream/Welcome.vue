<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <!-- <div>
				<jet-application-logo class="block h-12 w-auto" />
			</div> -->

            <div class="my-8 text-2xl">
                {{ __("Welcome to your Hercules application!") }}
            </div>
            <div class="mt-6 text-gray-500">
                {{ __("Hercules is a software for social marketing.") }}
            </div>
            <ul class="block my-4 mx-auto" x-data="{selected:null}">
                <li class="flex align-center flex-col" v-for="tutorial in tutorials" :key="tutorial.id">
                    <h4
                        @click="
                            selected !== 0 ? (selected = 0) : (selected = null)
                        "
                        class="cursor-pointer px-5 py-3 bg-white-300 text-grey-700 inline-block hover:opacity-75 shadow-md hover:-mb-3 rounded-t"
                    >
                        {{ tutorial.name }}
                    </h4>
                    <div v-show="selected == 0" class="border py-4 px-2">
                       <div class="relative overflow-hidden" style="padding-top: 56.25%">
                            <iframe
                            class="absolute top-0 left-0 w-full h-full"
                            :src="tutorial.url"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                       </div>
                        <div class="mt-4 mx-4" v-html="tutorial.desc"></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import JetApplicationLogo from "./../Jetstream/ApplicationLogo";

export default {
    props: ['tutorials'],
    components: {
        JetApplicationLogo
    },
    data() {
        return {
            selected: 0
        };
    }
};
</script>
