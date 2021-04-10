<template>
  <jet-form-section @submitted="updateUserDetails">
    <template #title> Profile Details </template>

    <template #description> Update your details`s user. </template>

    <template #form>
      <div class="col-span-6 md:col-span-2">
        <jet-label for="city_uf" value="City/UF" />
        <jet-input
          id="city_uf"
          type="text"
          class="mt-1 block w-full"
          v-model="form.city_uf"
          autocomplete="city_uf"
        />
        <jet-input-error :message="form.error('city_uf')" class="mt-2" />
      </div>

      <div class="col-span-6 md:col-span-2">
        <jet-label for="phone" value="Phone" />
        <jet-input
          id="phone"
          type="text"
          class="mt-1 block w-full"
          v-model="form.phone"
        />
        <jet-input-error :message="form.error('phone')" class="mt-2" />
      </div>

      <div class="col-span-6 md:col-span-2">
        <jet-label for="date_birth" value="Date Birth" />
        <date-picker
          v-model="form.date_birth"
          format="DD/MM/YYYY"
          input-class="form-input rounded-md shadow-sm mt-1 w-full"
        ></date-picker>
        <jet-input-error :message="form.error('date_birth')" class="mt-2" />
      </div>

      <div class="col-span-6">
        <jet-label for="hobbies" value="Hobbies" />
        <textarea
          v-model="form.hobbies"
          rows="5"
          class="form-input rounded-md shadow-sm mt-1 w-full"
        ></textarea>
        <jet-input-error :message="form.error('hobbies')" class="mt-2" />
      </div>

      <div class="col-span-6">
        <jet-label for="about_me" value="About me" />
        <textarea
          v-model="form.about_me"
          rows="5"
          class="form-input rounded-md shadow-sm mt-1 w-full"
        ></textarea>
        <jet-input-error :message="form.error('about_me')" class="mt-2" />
      </div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful" class="mr-3">
        Saved.
      </jet-action-message>

      <jet-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Save
      </jet-button>
    </template>
  </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    DatePicker,
  },

  props: ["user"],

  data() {
    return {
      form: this.$inertia.form(
        {
          _method: "PUT",
          city_uf: this.user.profile.city_uf,
          phone: this.user.profile.phone,
          date_birth: this.$moment(this.user.profile.date_birth).toDate(),
          hobbies: this.user.profile.hobbies,
          about_me: this.user.profile.about_me,
        },
        {
          bag: "updateUserDetails",
          resetOnSuccess: false,
        }
      ),
    };
  },

  methods: {
    updateUserDetails() {
      this.form.post(
        route("profile.update", {
          profile: this.user.profile,
        }),
        {
          preserveScroll: true,
        }
      );
    },
  },
};
</script>