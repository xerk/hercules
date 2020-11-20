<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>{{ __("Profile Information") }}</template>

        <template #description>
            {{
                __(
                    "Update your account's profile information and email address."
                )
            }}
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div
                class="col-span-6 sm:col-span-4"
                v-if="$page.jetstream.managesProfilePhotos"
            >
                <!-- Profile Photo File Input -->
                <input
                    type="file"
                    class="hidden"
                    ref="photo"
                    @change="updatePhotoPreview"
                />

                <jet-label for="photo" :value="__('Photo')" />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="!photoPreview">
                    <img
                        :src="$page.user.profile_photo_url"
                        alt="Current Profile Photo"
                        class="rounded-full h-20 w-20 object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span
                        class="block rounded-full w-20 h-20"
                        :style="
                            'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                photoPreview +
                                '\');'
                        "
                    >
                    </span>
                </div>

                <jet-secondary-button
                    class="mt-2 mr-2"
                    type="button"
                    @click.native.prevent="selectNewPhoto"
                >
                    {{ __("Select A New Photo") }}
                </jet-secondary-button>

                <jet-secondary-button
                    type="button"
                    class="mt-2"
                    @click.native.prevent="deletePhoto"
                    v-if="$page.user.profile_photo_path"
                >
                    {{ __("Remove Photo") }}
                </jet-secondary-button>

                <jet-input-error :message="form.error('photo')" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" :value="__('Name')" />
                <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autocomplete="name"
                />
                <jet-input-error :message="form.error('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" :value="__('Email')" />
                <jet-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                />
                <jet-input-error :message="form.error('email')" class="mt-2" />
            </div>

            <!-- Locale -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="locale" :value="__('Locale')" />
                <select
                    v-model="form.locale"
                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                    id="locale"
                >
                    <option value="en">English</option>
                    <option value="ar">Arabic</option>
                </select>
                <jet-input-error :message="form.error('locale')" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
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
</template>

<script>
import JetButton from "./../../Jetstream/Button";
import JetFormSection from "./../../Jetstream/FormSection";
import JetInput from "./../../Jetstream/Input";
import JetInputError from "./../../Jetstream/InputError";
import JetLabel from "./../../Jetstream/Label";
import JetActionMessage from "./../../Jetstream/ActionMessage";
import JetSecondaryButton from "./../../Jetstream/SecondaryButton";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton
    },

    props: ["name", "email", "locale"],

    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: "PUT",
                    name: this.name,
                    email: this.email,
                    photo: null,
                    locale: this.locale
                },
                {
                    bag: "updateProfileInformation",
                    resetOnSuccess: false
                }
            ),

            photoPreview: null
        };
    },

    methods: {
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0];
            }

            this.form.post(route("user-profile-information.update"), {
                preserveScroll: true
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = e => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        deletePhoto() {
            this.$inertia
                .delete(route("current-user-photo.destroy"), {
                    preserveScroll: true
                })
                .then(() => {
                    this.photoPreview = null;
                });
        }
    }
};
</script>
