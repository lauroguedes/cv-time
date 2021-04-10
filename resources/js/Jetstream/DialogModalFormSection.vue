<template>
  <modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="close"
  >
    <form @submit.prevent="$emit('submitted')">
      <div class="px-6 py-4">
        <div class="text-lg">
          <slot name="title"> </slot>
        </div>

        <div class="mt-4">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-2">
              <slot name="form"></slot>
            </div>
          </div>
        </div>
      </div>

      <div class="px-6 py-4 bg-gray-100 text-right">
        <slot name="actions"></slot>
      </div>
    </form>
  </modal>
</template>

<script>
import Modal from "./Modal";

export default {
  components: {
    Modal,
  },

  props: {
    show: {
      default: false,
    },
    maxWidth: {
      default: "2xl",
    },
    closeable: {
      default: true,
    },
  },

  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>