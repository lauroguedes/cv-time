<template>
  <div class="text-center">
    <h2 class="uppercase my-7 flex items-center justify-center">
      <i class="far fa-circle text-gray-400 text-xs mr-2"></i>
      <span class="text-gray-800 text-xl">{{ title }}</span>
      <i class="far fa-circle text-gray-400 text-xs ml-2"></i>
    </h2>
    <ul class="list-none mb-2">
      <li>{{ user.profile.city_uf }}</li>
      <li>{{ user.profile.phone }}</li>
      <li>{{ user.profile.email }}</li>
    </ul>
    <div>
      <h3 class="text-gray-500">Date of Birth</h3>
      <div>{{ user.profile.date_birth | moment('DD/MM/YYYY') }}</div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      user: Object,
      title: String
    }
  }
</script>