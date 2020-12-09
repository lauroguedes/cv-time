<template>
  <div>
    <h2 class="my-7 text-xl flex justify-between items-center">
      <div>
        <i class="fas fa-hard-hat mr-3 text-orange-400"></i>
        <span class="uppercase text-orange-400">{{ title }}</span>
      </div>
      <button type="button" class="transition duration-100 ease-in-out bg-green-400 hover:bg-green-500 text-white py-1 px-3 rounded text-sm">
        <i class="fas fa-plus"></i>
      </button>
    </h2>
    <jet-form-section @submitted="store">
      <template #form>
        <div class="col-span-12">
          <jet-label for="title" value="Title" />
          <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" autocomplete="title" />
          <jet-input-error :message="form.error('title')" class="mt-2" />
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
    <ul class="list-none">
      <li v-for="employmentHistory in employmentHistories" :key="employmentHistory.id">
        <div class="ml-2 pb-5 pl-6 border-l-4 border-indigo-400">
            <h3 class="text-lg text-gray-600 mb-1 font-bold relative">
              <!-- <i class="far fa-circle text-gray-400 text-lg mr-1 absolute -left-5"></i> -->
              <span>{{ employmentHistory.title }}</span>  
              <a href="#" class="ml-3 transition duration-100 ease-in-out text-indigo-200 hover:text-indigo-400">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <a href="#" class="ml-3 transition duration-100 ease-in-out text-red-200 hover:text-red-400">
                <i class="fas fa-trash-alt"></i>
              </a>
            </h3>
            <div class="mb-2 text-gray-600">
              <span>{{ employmentHistory.start_date }}</span>
              <span v-if="employmentHistory.end_date">{{ employmentHistory.end_date }}</span>
              <span v-else>to Present</span>
            </div>
            <div v-if="employmentHistory.description" class="text-gray-400">{{ employmentHistory.description }}</div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
  import JetButton from '@/Jetstream/Button'
  import JetFormSection from '@/Jetstream/FormSection'
  import JetInput from '@/Jetstream/Input'
  import JetInputError from '@/Jetstream/InputError'
  import JetLabel from '@/Jetstream/Label'
  import JetActionMessage from '@/Jetstream/ActionMessage'

  export default {
    props: {
      employmentHistories: Array,
      title: String
    },
    components: {
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
            '_method': 'POST',
            title: null,
        }, {
            bag: 'store',
            resetOnSuccess: false,
        }),
      }
    },
    methods: {
      store() {
        console.log('saved');
      }
    }
  }
</script>