<template>
  <div class="inline">
    <a
      href="#"
      @click.prevent="confirmModelDeletion"
      class="ml-3 transition duration-100 ease-in-out text-red-200 hover:text-red-400"
    >
      <i class="fas fa-trash-alt"></i>
    </a>
    <jet-dialog-modal
      :show="confirmingModelDeletion"
      @close="confirmingModelDeletion = false"
    >
      <template #title>{{ title }}</template>

      <template #content>
        {{ description }}
        <div class="mt-4">
          <jet-input
            type="cofirm"
            class="mt-1 block w-3/4"
            :placeholder="`Write ${confirmWordCheck}`"
            ref="confirm"
            v-model="confirm"
            @keyup.enter.native="deleteItem"
            v-if="confirmMode"
          />
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click.native="confirmingModelDeletion = false">
          Cancel
        </jet-secondary-button>

        <jet-danger-button
          class="ml-2"
          @click.native="deleteItem"
          :class="{
            'opacity-25':
              form.processing || (confirm != confirmWordCheck && confirmMode),
          }"
          :disabled="
            form.processing || (confirm != confirmWordCheck && confirmMode)
          "
        >
          Delete
        </jet-danger-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetInput from "@/Jetstream/Input";

export default {
  props: {
    title: {
      type: String,
    },
    description: {
      type: String,
    },
    action: {
      type: String,
      required: true,
    },
    modelId: {
      type: Number,
      required: true,
    },
    confirmMode: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    JetDialogModal,
    JetSecondaryButton,
    JetDangerButton,
    JetInput,
  },
  data() {
    return {
      confirmingModelDeletion: false,
      confirm: "",
      confirmWordCheck: "CONFIRM",
      form: this.$inertia.form(
        {
          _method: "DELETE",
        },
        {
          bag: "deleteItem",
        }
      ),
    };
  },
  methods: {
    confirmModelDeletion() {
      this.confirm = "";

      this.confirmingModelDeletion = true;

      if (this.confirmMode) {
        setTimeout(() => {
          this.$refs.confirm.focus();
        }, 250);
      }
    },

    deleteItem() {
      this.form
        .delete(route(this.action, this.modelId), {
          preserveScroll: true,
        })
        .then((response) => {
          if (!this.form.hasErrors()) {
            this.confirmingModelDeletion = false;
          }
        });
    },
  },
};
</script>
