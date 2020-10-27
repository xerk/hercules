<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Purchase
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <jet-form-section @submitted="redeemCode">
                    <template #title> Redeem Code </template>
                    <template #description>
                        Redeem code, or git card from Hercules
                    </template>
                    <div class="mt-2 text-2xl">Get In Action</div>

                    <div class="mt-2 text-xs text-gray-500">
                        You can find Facebook accounts by add (IDs) in this
                        Input
                    </div>

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <div>
                                <div v-if="errors.message" class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md"
                                    role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                                </svg></div>
                                        <div>
                                            <p class="font-bold">Ops, You have an error</p>
                                            <p class="text-sm">{{errors.message}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="form.recentlySuccessful && !errors.message" class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md"
                                    role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                                </svg></div>
                                        <div>
                                            <p class="font-bold">Congratulations</p>
                                            <p class="text-sm">Redeem code is successful.</p>
                                        </div>
                                    </div>
                                </div>

                                <jet-label class="mt-4" for="code" value="Redeem Card" />
                                <jet-input id="code" type="text" class="mt-1 block w-full" v-model="form.code"
                                    ref="code" autocomplete="off" />
                                <jet-input-error :message="form.error('code')" class="mt-2" />

                            </div>
                        </div>
                    </template>

                    <template #actions>
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </jet-action-message>

                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </jet-button>
                    </template>
                </jet-form-section>
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
        props: ["purchase", 'errors'],

        components: {
            AppLayout,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        data() {
            return {
                form: this.$inertia.form({
                    code: null,
                }, {
                    bag: "redeemCode",
                    resetOnSuccess: false,
                }),
            }
        },

        methods: {
            redeemCode(url = null) {
                this.form.post(route('purchase.redeem'), {
                    preserveScroll: true
                });
            },
        }
    }

</script>

<style>

</style>
