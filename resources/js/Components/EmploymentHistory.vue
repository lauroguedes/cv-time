<template>
  <div>
    <h2
      id="employmentHistory"
      class="my-7 text-xl flex justify-between items-center"
    >
      <div>
        <i class="fas fa-hard-hat mr-3 text-orange-400"></i>
        <span class="uppercase text-orange-400">{{ title }}</span>
      </div>
      <button
        type="button"
        @click="showForm = true"
        :disabled="showForm"
        :class="{ 'opacity-50 cursor-not-allowed': showForm }"
        class="transition duration-100 ease-in-out bg-green-400 hover:bg-green-500 text-white py-1 px-3 rounded text-sm"
      >
        <i class="fas fa-plus"></i>
      </button>
    </h2>
    <transition
      leave-active-class="transition ease-out duration-200"
      leave-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <jet-form-section @submitted="store" v-if="showForm">
        <template #form>
          <div class="col-span-6">
            <jet-label for="title" value="Title" />
            <jet-input
              id="title"
              type="text"
              class="mt-1 w-full"
              v-model="form.title"
              autocomplete="title"
            />
            <jet-input-error :message="formErrors.title" class="mt-2" />
          </div>
          <div class="col-span-3">
            <jet-label for="start_date" value="Start Date" />
            <date-picker
              v-model="form.start_date"
              format="DD/MM/YYYY"
              input-class="form-input rounded-md shadow-sm mt-1 w-full"
            ></date-picker>
            <jet-input-error :message="formErrors.start_date" class="mt-2" />
          </div>
          <div class="col-span-3">
            <jet-label for="end_date" value="End Date" />
            <date-picker
              v-model="form.end_date"
              format="DD/MM/YYYY"
              input-class="form-input rounded-md shadow-sm mt-1 w-full"
            ></date-picker>
            <jet-input-error :message="formErrors.end_date" class="mt-2" />
          </div>
          <div class="col-span-6">
            <jet-label for="description" value="Description" />
            <textarea
              v-model="form.description"
              rows="5"
              class="form-input rounded-md shadow-sm mt-1 w-full"
            ></textarea>
            <jet-input-error :message="formErrors.description" class="mt-2" />
          </div>
        </template>
        <template #actions>
          <jet-action-message :on="form.recentlySuccessful" class="mr-3">
            <span class="text-green-400" v-if="isEmpty(formErrors)"
              >Saved!</span
            >
          </jet-action-message>
          <button
            type="button"
            @click="showForm = false"
            class="transition duration-100 ease-in-out bg-transparent uppercase text-gray-600 hover:text-red-400 py-1 px-3 mr-3 text-sm"
          >
            Cancel
          </button>
          <jet-button
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Save
          </jet-button>
        </template>
      </jet-form-section>
    </transition>
    <ul class="list-none">
      <li
        v-for="employmentHistory in employmentHistories"
        :key="employmentHistory.id"
      >
        <div class="ml-2 pb-5 pl-6 border-l-4 border-indigo-400">
          <h3 class="text-lg text-gray-600 mb-1 font-bold relative">
            <!-- <i class="far fa-circle text-gray-400 text-lg mr-1 absolute -left-5"></i> -->
            <span>{{ employmentHistory.title }}</span>
            <a
              href="#"
              @click.prevent="edit(employmentHistory.id)"
              class="ml-3 transition duration-100 ease-in-out text-indigo-200 hover:text-indigo-400"
            >
              <i class="fas fa-pencil-alt"></i>
            </a>
            <destroy-action
              title="Delete Employment History"
              :description="`Are you sure to delete '${employmentHistory.title}'? Confirm below.`"
              action="employment-history.destroy"
              :modelId="employmentHistory.id"
            />
          </h3>
          <div class="mb-2 text-gray-600">
            <span>{{
              employmentHistory.start_date | moment("DD/MM/YYYY")
            }}</span>
            <span class="text-indigo-400 font-bold"> to </span>
            <span v-if="employmentHistory.end_date">{{
              employmentHistory.end_date | moment("DD/MM/YYYY")
            }}</span>
            <span v-else>Present</span>
          </div>
          <div v-if="employmentHistory.description" class="text-gray-400">
            {{ employmentHistory.description }}
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import DestroyAction from "./DestroyAction";

import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";

export default {
  props: {
    employmentHistories: Array,
    title: String,
  },
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    DatePicker,
    DestroyAction,
  },
  computed: {
    formErrors() {
      return this.form.__inertia.page.props.errors;
    },
  },
  data() {
    return {
      showForm: false,
      update: false,
      modelToUpdate: null,
      form: this.$inertia.form(
        {
          _method: "POST",
          title: null,
          start_date: null,
          end_date: null,
          description: null,
        },
        {
          bag: "store",
          resetOnSuccess: true,
        }
      ),
    };
  },
  methods: {
    store() {
      if (this.update) {
        this.form.put(
          route("employment-history.update", {
            employmentHistory: this.modelToUpdate,
          }),
          {
            preserveScroll: true,
            onSuccess: () => {
              if (_.isEmpty(this.formErrors)) {
                this.modelToUpdate = null;
                this.update = false;
                setTimeout(() => {
                  this.showForm = false;
                }, 1000);
              }
            },
          }
        );
        return;
      }
      this.form.post(route("employment-history.store"), {
        preserveScroll: true,
        onSuccess: () => {
          if (_.isEmpty(this.formErrors)) {
            setTimeout(() => {
              this.showForm = false;
            }, 1000);
          }
        },
      });
      return;
    },
    edit(id) {
      let employmentHistory = _.find(this.employmentHistories, ["id", id]);

      this.form.title = employmentHistory.title;
      this.form.start_date = this.$moment(
        employmentHistory.start_date
      ).toDate();
      this.form.end_date = this.$moment(employmentHistory.end_date).toDate();
      this.form.description = employmentHistory.description;

      this.modelToUpdate = id;
      this.update = true;
      this.showForm = true;
      window.location.href = "#employmentHistory";
    },
    isEmpty(obj) {
      return _.isEmpty(obj);
    },
  },
};
</script>
