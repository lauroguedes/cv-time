<template>
  <div class="text-center">
    <h2 class="uppercase mb-5 mt-8 flex items-center justify-center">
      <i class="far fa-circle text-gray-400 text-xs mr-2"></i>
      <span class="text-gray-800 text-xl">{{ title }}</span>
      <i class="far fa-circle text-gray-400 text-xs ml-2"></i>
    </h2>
    <ul class="list-none mb-2">
      <li>{{ user.profile.hobbies }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    user: Object,
    title: String,
  },
};
</script>