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
        @click="showDialog()"
        class="transition duration-100 ease-in-out bg-green-400 hover:bg-green-500 text-white py-1 px-3 rounded text-sm"
      >
        <i class="fas fa-plus"></i>
      </button>
    </h2>
    <ul class="list-none">
      <li v-for="employmentHistory in orderList" :key="employmentHistory.id">
        <div class="ml-2 pb-5 pl-6 border-l-4 border-indigo-400">
          <h3 class="text-lg text-gray-600 mb-1 font-bold relative">
            <!-- <i class="far fa-circle text-gray-400 text-lg mr-1 absolute -left-5"></i> -->
            <span
              >{{ employmentHistory.title }} <span>at</span>
              <span class="text-gray-400">{{
                employmentHistory.company
              }}</span></span
            >
            <a
              href="#"
              @click.prevent="edit(employmentHistory)"
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
              employmentHistory.start_date | moment("MMM [at] YYYY")
            }}</span>
            <span class="text-indigo-400 font-bold"> to </span>
            <span v-if="employmentHistory.end_date">{{
              employmentHistory.end_date | moment("MMM [at] YYYY")
            }}</span>
            <span v-else>Present</span>
            <span
              v-if="employmentHistory.end_date"
              class="text-indigo-400 font-bold"
              >({{ getTimeHistory(employmentHistory) }})</span
            >
          </div>
          <div v-if="employmentHistory.description" class="text-gray-400">
            {{ employmentHistory.description }}
          </div>
        </div>
      </li>
    </ul>
    <no-result :obj="employmentHistories" />
    <jet-dialog-modal-form-section
      :show="showForm"
      @close="showForm = false"
      @submitted="store"
    >
      <template #title> Add Employment History </template>
      <template #form>
        <div class="col-span-6 md:col-span-3">
          <jet-label for="title" value="Title" />
          <jet-input
            id="title"
            type="text"
            class="mt-1 w-full"
            v-model="form.title"
            autocomplete="title"
          />
          <jet-input-error :message="form.error('title')" class="mt-2" />
        </div>
        <div class="col-span-6 md:col-span-3">
          <jet-label for="company" value="Company" />
          <jet-input
            id="company"
            type="text"
            class="mt-1 w-full"
            v-model="form.company"
            autocomplete="company"
          />
          <jet-input-error :message="form.error('company')" class="mt-2" />
        </div>
        <div class="col-span-6 md:col-span-3">
          <jet-label for="start_date" value="Start Date" />
          <date-picker
            v-model="form.start_date"
            type="month"
            format="MM/YYYY"
            input-class="form-input rounded-md shadow-sm mt-1 w-full"
          ></date-picker>
          <jet-input-error :message="form.error('start_date')" class="mt-2" />
        </div>
        <div class="col-span-6 md:col-span-3">
          <jet-label for="end_date" value="End Date" />
          <date-picker
            v-model="form.end_date"
            type="month"
            format="MM/YYYY"
            input-class="form-input rounded-md shadow-sm mt-1 w-full"
          ></date-picker>
          <jet-input-error :message="form.error('end_date')" class="mt-2" />
        </div>
        <div class="col-span-6 md:col-span-6">
          <jet-label for="description" value="Description" />
          <textarea
            v-model="form.description"
            rows="5"
            class="form-input rounded-md shadow-sm mt-1 w-full"
          ></textarea>
          <jet-input-error :message="form.error('description')" class="mt-2" />
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
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetDialogModalFormSection,
    DestroyAction,
    DatePicker,
    NoResult,
  },
  computed: {
    orderList() {
      return _.orderBy(this.employmentHistories, ["end_date"], ["desc"]);
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
          company: null,
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
    getTimeHistory(obj) {
      if (obj.start_date && obj.end_date) {
        let start = this.$moment(obj.start_date);
        let end = this.$moment(obj.end_date);
        let result = end.diff(start, "years");
        if (!result) {
          return "less than 1 year";
        }
        return result + " year" + (result > 1 ? "s" : "");
      }
    },
    store() {
      if (this.update) {
        this.form.put(
          route("employment-history.update", {
            employmentHistory: this.modelToUpdate,
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
      this.form.post(route("employment-history.store"), {
        preserveScroll: true,
        onSuccess: (data) => {
          if (_.isEmpty(data.props.errors)) {
            this.waitLitle();
          }
        },
      });
    },
    edit(employmentHistory) {
      this.update = true;
      this.showForm = true;
      this.modelToUpdate = employmentHistory.id;
      this.form.title = employmentHistory.title;
      this.form.start_date = this.$moment(
        employmentHistory.start_date
      ).toDate();
      this.form.end_date = this.$moment(employmentHistory.end_date).toDate();
      this.form.description = employmentHistory.description;
      this.form.company = employmentHistory.company;
    },
    waitLitle(time = 500) {
      return setTimeout(() => {
        this.showForm = false;
      }, time);
    },
    isEmpty(obj) {
      return _.isEmpty(obj);
    },
  },
};
</script>