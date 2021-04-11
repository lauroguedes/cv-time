<template>
  <div class="text-center">
    <h2 class="uppercase mb-5 mt-8 flex items-center justify-center">
      <i class="far fa-circle text-gray-400 text-xs mr-2"></i>
      <span class="text-gray-800 text-xl">{{ title }}</span>
      <i class="far fa-circle text-gray-400 text-xs ml-2"></i>
    </h2>
    <ul class="list-none mb-2">
      <li
        v-for="skill in skills"
        class="mb-3"
        :key="skill.id"
        :title="`${getPercentage(skill.level)}%`"
      >
        <div>
          <span>{{ skill.name.toUpperCase() }}</span>
          <a
            href="#"
            @click.prevent="edit(skill)"
            class="ml-3 transition duration-100 ease-in-out text-indigo-200 hover:text-indigo-400"
          >
            <i class="fas fa-pencil-alt"></i>
          </a>
          <destroy-action
            title="Delete Link"
            :description="`Are you sure to delete '${skill.name.toUpperCase()}'? Confirm below.`"
            action="skill.destroy"
            :modelId="skill.id"
          />
        </div>
        <div class="relative pt-1">
          <div
            class="overflow-hidden h-1 mb-4 text-xs flex rounded bg-orange-100"
          >
            <div
              :style="`width: ${getPercentage(skill.level)}%`"
              class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-orange-400"
            ></div>
          </div>
        </div>
      </li>
    </ul>
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
      <template #title> Add Skill </template>
      <template #form>
        <div class="col-span-6 md:col-span-3">
          <jet-label for="name" value="Skill" />
          <jet-input
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            autocomplete="name"
          />
          <jet-input-error :message="form.error('name')" class="mt-2" />
        </div>
        <div class="col-span-6 md:col-span-3">
          <jet-label for="level" value="Level" />
          <select
            id="level"
            v-model="form.level"
            class="form-input rounded-md shadow-sm mt-1 w-full"
          >
            <option value="1">1 (Básico)</option>
            <option value="2">2 (Básico)</option>
            <option value="3">3 (Básico)</option>
            <option value="4">4 (Intermediário)</option>
            <option value="5">5 (Intermediário)</option>
            <option value="6">6 (Intermediário)</option>
            <option value="7">7 (Avançado)</option>
            <option value="8">8 (Avançado)</option>
            <option value="9">9 (Avançado)</option>
            <option value="10">10 (Especialista)</option>
          </select>
          <jet-input-error :message="form.error('level')" class="mt-2" />
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

export default {
  props: {
    skills: Array,
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
          level: null,
        },
        {
          bag: "store",
          resetOnSuccess: true,
        }
      ),
    };
  },
  methods: {
    getPercentage(value) {
      return (100 * value) / 10;
    },
    showDialog() {
      this.showForm = true;
      this.form.reset();
    },
    store() {
      if (this.update) {
        this.form.put(
          route("skill.update", {
            skill: this.modelToUpdate,
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
      this.form.post(route("skill.store"), {
        preserveScroll: true,
        onSuccess: (data) => {
          if (_.isEmpty(data.props.errors)) {
            this.waitLitle();
          }
        },
      });
    },
    edit(skill) {
      this.update = true;
      this.modelToUpdate = skill.id;
      this.showForm = true;
      this.form.name = skill.name;
      this.form.level = skill.level;
    },
    waitLitle(time = 500) {
      return setTimeout(() => {
        this.showForm = false;
      }, time);
    },
  },
};
</script>