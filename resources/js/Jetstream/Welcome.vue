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
                <li class="flex align-center flex-col">
                    <h4
                        @click="
                            selected !== 0 ? (selected = 0) : (selected = null)
                        "
                        class="cursor-pointer px-5 py-3 bg-white-300 text-grey-700 inline-block hover:opacity-75 shadow-md hover:-mb-3 rounded-t"
                    >
                        {{ __("Hercules WhatsApp Part 1") }}
                    </h4>
                    <p v-show="selected == 0" class="border py-4 px-2">
                        <iframe
                            width="856"
                            height="482"
                            src="https://www.youtube.com/embed/aREKhk_C820"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </p>
                </li>
                <li class="flex align-center flex-col">
                    <h4
                        @click="
                            selected !== 1 ? (selected = 1) : (selected = null)
                        "
                        class="cursor-pointer px-5 py-3 bg-white-400 text-grey-700 inline-block hover:opacity-75 shadow-md hover:-mb-3"
                    >
                        {{ __("Hercules WhatsApp Part 2") }}
                    </h4>
                    <p v-show="selected == 1" class="border py-4 px-2">
                        <iframe
                            width="856"
                            height="482"
                            src="https://www.youtube.com/embed/D7wDewfFV4k"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </p>
                </li>
                <!-- <li class="flex align-center flex-col">
                    <h4
                        @click="
                            selected !== 2 ? (selected = 2) : (selected = null)
                        "
                        :class="{
                            'cursor-pointer px-5 py-3 bg-white-500 text-grey-700 inline-block hover:opacity-75 shadow-md hover:-mb-3': true,
                            'rounded-b': selected != 2
                        }"
                    >
                        Accordion item 3
                    </h4>
                    <p
                        v-show="selected == 2"
                        :class="{
                            'border py-4 px-2': true,
                            'rounded-b': selected == 2
                        }"
                    >
                        Pretty cool huh?
                    </p>
                </li> -->
            </ul>
        </div>
    </div>
</template>

<script>
import JetApplicationLogo from "./../Jetstream/ApplicationLogo";

export default {
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
