<template>
  <div class="text-center">
    <h2 class="uppercase mb-5 mt-8 flex items-center justify-center">
      <i class="far fa-circle text-gray-400 text-xs mr-2"></i>
      <span class="text-gray-800 text-xl">{{ title }}</span>
      <i class="far fa-circle text-gray-400 text-xs ml-2"></i>
    </h2>
    <ul class="list-none mb-2">
      <li>{{ user.profile.city_uf }}</li>
      <li>{{ user.profile.phone }}</li>
      <li>{{ user.email }}</li>
    </ul>
    <div>
      <h3 class="text-gray-500">Date of Birth</h3>
      <div>
        <i class="fas fa-birthday-cake text-indigo-400"></i>
        {{ user.profile.date_birth | moment("DD/MM/YYYY") }}
      </div>
    </div>
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