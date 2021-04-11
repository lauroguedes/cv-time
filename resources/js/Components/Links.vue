<template>
  <div class="text-center">
    <h2 class="uppercase my-5 flex items-center justify-center">
      <i class="far fa-circle text-gray-400 text-xs mr-2"></i>
      <span class="text-gray-800 text-xl">{{ title }}</span>
      <i class="far fa-circle text-gray-400 text-xs ml-2"></i>
    </h2>
    <ul class="list-none mb-2">
      <li v-for="link in links" class="mb-3" :key="link.id">
        <a
          :href="link.url"
          class="underline text-gray-800 hover:text-gray-500"
          target="_blank"
          ><i
            :class="[
              link.name == 'website'
                ? 'fas fa-external-link-alt'
                : `fab fa-${link.name}`,
              'text-indigo-400',
            ]"
          ></i>
          {{ link.name.toUpperCase() }}</a
        >
        <a
          href="#"
          @click.prevent="edit(link)"
          class="ml-3 transition duration-100 ease-in-out text-indigo-200 hover:text-indigo-400"
        >
          <i class="fas fa-pencil-alt"></i>
        </a>
        <destroy-action
          title="Delete Link"
          :description="`Are you sure to delete '${link.name.toUpperCase()}'? Confirm below.`"
          action="link.destroy"
          :modelId="link.id"
        />
      </li>
    </ul>
    <no-result :obj="links" />
    <button
      type="button"
      @click="showDialog()"
      class="transition duration-100 ease-in-out bg-green-400 hover:bg-green-500 text-white py-1 px-3 rounded text-sm"
    >
      <i class="fas fa-plus"></i>
    </button>
    <jet-dialog-modal-form-section
      :show="showForm"
      @close="showForm = false"
      @submitted="store"
    >
      <template #title> Add Link </template>
      <template #form>
        <div class="col-span-6 md:col-span-3">
          <jet-label for="name" value="Link Name" />
          <select
            id="name"
            v-model="form.name"
            class="form-input rounded-md shadow-sm mt-1 w-full"
          >
            <option value="github">Github</option>
            <option value="twitter">Twitter</option>
            <option value="linkedin">Linkedin</option>
            <option value="instagram">Instagram</option>
            <option value="facebook">Facebook</option>
            <option value="youtube">Youtube</option>
            <option value="pinterest">Pinterest</option>
            <option value="medium">Medium</option>
            <option value="website">Website</option>
          </select>
          <jet-input-error :message="form.error('name')" class="mt-2" />
        </div>
        <div class="col-span-6 md:col-span-3">
          <jet-label for="url" value="Link" />
          <jet-input
            id="url"
            type="text"
            class="mt-1 block w-full"
            v-model="form.url"
            autocomplete="url"
          />
          <jet-input-error :message="form.error('url')" class="mt-2" />
        </div>
      </template>

      <template #actions>
        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
          Saved.
        </jet-action-message>

        <jet-secondary-button @click.native="showForm = false">
          Cancel
        </jet-secondary-button>

        <jet-button
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Save
        </jet-button>
      </template>
    </jet-dialog-modal-form-section>
  </div>
</template>

<script>
import JetDialogModalFormSection from "@/Jetstream/DialogModalFormSection";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import DestroyAction from "./DestroyAction";
import NoResult from "./NoResult";

export default {
  props: {
    links: Array,
    title: String,
  },
  components: {
    JetActionMessage,
    JetButton,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetDialogModalFormSection,
    DestroyAction,
    NoResult,
  },
  data() {
    return {
      showForm: false,
      update: false,
      modelToUpdate: null,
      form: this.$inertia.form(
        {
          _method: "POST",
          name: null,
          url: null,
        },
        {
          bag: "store",
          resetOnSuccess: true,
        }
      ),
    };
  },

  methods: {
    showDialog() {
      this.showForm = true;
      this.form.reset();
    },
    store() {
      if (this.update) {
        this.form.put(
          route("link.update", {
            link: this.modelToUpdate,
          }),
          {
            preserveScroll: true,
            onSuccess: (data) => {
              if (_.isEmpty(data.props.errors)) {
                this.modelToUpdate = null;
                this.update = false;
                this.waitLitle();
              }
            },
          }
        );
        return;
      }
      this.form.post(route("link.store"), {
        preserveScroll: true,
        onSuccess: (data) => {
          if (_.isEmpty(data.props.errors)) {
            this.waitLitle();
          }
        },
      });
    },
    edit(link) {
      this.update = true;
      this.modelToUpdate = link.id;
      this.showForm = true;
      this.form.name = link.name;
      this.form.url = link.url;
    },
    waitLitle(time = 500) {
      return setTimeout(() => {
        this.showForm = false;
      }, time);
    },
  },
};
</script>