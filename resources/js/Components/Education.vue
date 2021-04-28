<template>
    <div>
        <h2
            id="education"
            class="my-7 text-xl flex justify-between items-center"
        >
            <div>
                <i class="fas fa-graduation-cap mr-3 text-orange-400"></i>
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
            <li v-for="education in orderList" :key="education.id">
                <div class="ml-2 pb-5 pl-6 border-l-4 border-indigo-400">
                    <h3 class="text-lg text-gray-600 mb-1 font-bold relative">
                        <!-- <i class="far fa-circle text-gray-400 text-lg mr-1 absolute -left-5"></i> -->
                        <span>{{ education.college }} </span>
                        <a
                            href="#"
                            @click.prevent="edit(education)"
                            class="ml-3 transition duration-100 ease-in-out text-indigo-200 hover:text-indigo-400"
                        >
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <destroy-action
                            title="Delete Education"
                            :description="
                                `Are you sure to delete '${education.college}'? Confirm below.`
                            "
                            action="education.destroy"
                            :modelId="education.id"
                        />
                    </h3>
                    <div class="mb-2 text-gray-600">
                        <span>{{
                            education.start_date | moment("MMM [at] YYYY")
                        }}</span>
                        <span class="text-indigo-400 font-bold"> to </span>
                        <span v-if="education.end_date">{{
                            education.end_date | moment("MMM [at] YYYY")
                        }}</span>
                        <span v-else>Present</span>
                        <span
                            v-if="education.end_date"
                            class="text-indigo-400 font-bold"
                            >({{ getTimeHistory(education) }})</span
                        >
                    </div>
                    <div class="text-gray-400">
                        <span class="mr-2 font-bold"
                            >Course: {{ education.course }}</span
                        ><span
                            v-html="getSituation(education.situation)"
                        ></span>
                    </div>
                    <div v-if="education.description" class="text-gray-400">
                        {{ education.description }}
                    </div>
                </div>
            </li>
        </ul>
        <no-result :obj="educations" />
        <jet-dialog-modal-form-section
            :show="showForm"
            @close="showForm = false"
            @submitted="store"
        >
            <template #title> Add Education </template>
            <template #form>
                <div class="col-span-6 md:col-span-3">
                    <jet-label for="college" value="College" />
                    <jet-input
                        id="college"
                        type="text"
                        class="mt-1 w-full"
                        v-model="form.college"
                        autocomplete="college"
                    />
                    <jet-input-error
                        :message="form.error('college')"
                        class="mt-2"
                    />
                </div>
                <div class="col-span-6 md:col-span-3">
                    <jet-label for="course" value="Course" />
                    <jet-input
                        id="course"
                        type="text"
                        class="mt-1 w-full"
                        v-model="form.course"
                        autocomplete="course"
                    />
                    <jet-input-error
                        :message="form.error('course')"
                        class="mt-2"
                    />
                </div>
                <div class="col-span-6">
                    <h3 class="m-1 font-bold text-center">Course Situation</h3>
                    <div class="flex justify-center">
                        <jet-label
                            class="mr-2"
                            for="situation-complete"
                            value="Complete"
                        />
                        <input
                            id="situation-complete"
                            type="radio"
                            value="2"
                            class="mt-1 mr-3"
                            v-model="form.situation"
                        />
                        <jet-label
                            class="mr-2"
                            for="situation-in-progress"
                            value="In Progress"
                        />
                        <input
                            id="situation-in-progress"
                            type="radio"
                            value="1"
                            class="mt-1 mr-3"
                            v-model="form.situation"
                        />
                        <jet-label
                            class="mr-2"
                            for="situation-locked"
                            value="Locked"
                        />
                        <input
                            id="situation-locked"
                            type="radio"
                            value="0"
                            class="mt-1"
                            v-model="form.situation"
                        />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3">
                    <jet-label for="start_date" value="Start Date" />
                    <date-picker
                        v-model="form.start_date"
                        type="month"
                        format="MM/YYYY"
                        input-class="form-input rounded-md shadow-sm mt-1 w-full"
                    ></date-picker>
                    <jet-input-error
                        :message="form.error('start_date')"
                        class="mt-2"
                    />
                </div>
                <div class="col-span-6 md:col-span-3">
                    <jet-label for="end_date" value="End Date" />
                    <date-picker
                        v-model="form.end_date"
                        type="month"
                        format="MM/YYYY"
                        input-class="form-input rounded-md shadow-sm mt-1 w-full"
                    ></date-picker>
                    <jet-input-error
                        :message="form.error('end_date')"
                        class="mt-2"
                    />
                </div>
                <div class="col-span-6 md:col-span-6">
                    <jet-label for="description" value="Description" />
                    <textarea
                        v-model="form.description"
                        rows="5"
                        class="form-input rounded-md shadow-sm mt-1 w-full"
                    ></textarea>
                    <jet-input-error
                        :message="form.error('description')"
                        class="mt-2"
                    />
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
        educations: Array,
        title: String
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
        NoResult
    },
    computed: {
        orderList() {
            return _.orderBy(this.educations, ["end_date"], ["desc"]);
        }
    },
    data() {
        return {
            showForm: false,
            update: false,
            modelToUpdate: null,
            form: this.$inertia.form(
                {
                    _method: "POST",
                    college: null,
                    start_date: null,
                    end_date: null,
                    course: null,
                    situation: 2,
                    description: null
                },
                {
                    bag: "store",
                    resetOnSuccess: true
                }
            )
        };
    },
    methods: {
        showDialog() {
            this.showForm = true;
            this.form.reset();
        },
        getSituation(situation) {
            switch (situation) {
                case 0:
                    return '<i title="Locked" class="fas fa-lock text-red-400"></i>';
                case 1:
                    return '<i title="In progress" class="fas fa-clock text-blue-400"></i>';
                case 2:
                    return '<i title="Complete" class="fas fa-check-circle text-green-400"></i>';
            }
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
                    route("education.update", {
                        education: this.modelToUpdate
                    }),
                    {
                        preserveScroll: true,
                        onSuccess: data => {
                            if (_.isEmpty(data.props.errors)) {
                                this.modelToUpdate = null;
                                this.update = false;
                                this.waitLitle();
                            }
                        }
                    }
                );
                return;
            }
            this.form.post(route("education.store"), {
                preserveScroll: true,
                onSuccess: data => {
                    if (_.isEmpty(data.props.errors)) {
                        this.waitLitle();
                    }
                }
            });
        },
        edit(education) {
            this.update = true;
            this.showForm = true;
            this.modelToUpdate = education.id;
            this.form.college = education.college;
            this.form.start_date = this.$moment(education.start_date).toDate();
            this.form.end_date = this.$moment(education.end_date).toDate();
            this.form.course = education.course;
            this.form.situation = education.situation;
            this.form.description = education.description;
        },
        waitLitle(time = 500) {
            return setTimeout(() => {
                this.showForm = false;
            }, time);
        },
        isEmpty(obj) {
            return _.isEmpty(obj);
        }
    }
};
</script>
