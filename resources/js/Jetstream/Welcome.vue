<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <!-- <div>
				<jet-application-logo class="block h-12 w-auto" />
			</div> -->

            <div class="mt-8 text-2xl">
                Welcome to your Hercules application!
            </div>

            <div class="mt-6 text-gray-500">
                Hercules is a software for social marketing.
            </div>
            <div class="my-4">
                <div class="text-gray-700 text-2xl">Hercules WhatsApp Part 1</div>
                <iframe
                    width="856"
                    height="482"
                    src="https://www.youtube.com/embed/aREKhk_C820"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
            <div>
                <div class="text-gray-700 text-2xl">Hercules WhatsApp Part 2</div>
                <iframe
                    width="856"
                    height="482"
                    src="https://www.youtube.com/embed/D7wDewfFV4k"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>
</template>

<script>
import JetApplicationLogo from "./../Jetstream/ApplicationLogo";

export default {
    components: {
        JetApplicationLogo
    }
};
</script>
