<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Facebook") }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-rows-3 grid-flow-col gap-4">
                    <div class="row-span-3 relative">
                        <div class="bg-white shadow rounded-lg">
                            <div class="bg-gray-50 rounded-lg px-4 py-2 font-semibold">
                                Facebook Results
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="bg-white shadow rounded-lg">
                            <div class="bg-gray-50 rounded-lg px-4 py-2 font-semibold">
                                Facebook Search
                            </div>
                            <div class="p-6 flex flex-wrap">
                                <div>
                                    <jet-label class="mt-4" for="code" :value="__('Facebook ID')" />
                                    <jet-input id="code" type="text" class="mt-1 block w-full" v-model="form.code"
                                        ref="code" autocomplete="off" />
                                    <jet-input-error :message="form.error('code')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-span-2 col-span-2">
                        <div class="bg-white shadow rounded-lg">
                            <div class="bg-gray-50 rounded-lg px-4 py-2 font-semibold">
                                Facebook Search
                            </div>
                            <div class="p-6 flex flex-wrap">
                                <div>
                                    <jet-label class="mt-4" for="code" :value="__('Facebook ID')" />
                                    <jet-input id="code" type="text" class="mt-1 block w-full" v-model="form.code"
                                        ref="code" autocomplete="off" />
                                    <jet-input-error :message="form.error('code')" class="mt-2" />
                                </div>
                            </div>
                        </div>
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
        props: ["purchase", "errors"],

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
        },

        methods: {
            redeemCode(url = null) {
                this.form.post(route("purchase.redeem"), {
                    preserveScroll: true
                });
            }
        }
    };

</script>

<style></style>
