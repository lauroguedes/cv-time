<template>
  <div v-if="!obj.length" class="text-center uppercase text-gray-300 mb-2">
    <i class="fas fa-inbox block text-2xl"></i> No Result
  </div>
</template>

<script>
export default {
  props: {
    obj: Array,
  },
};
</script>