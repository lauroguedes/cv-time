<template>
  <button
    :type="type"
    class="transition duration-100 ease-in-out bg-transparent uppercase text-gray-600 hover:text-red-400 py-1 px-3 mr-3 text-sm"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: "button",
    },
  },
};
</script>
