<template>
  <div class="text-center">
    <img class="inline rounded-full" :src="user.profile_photo_url" alt="Foto" />
    <h1 class="text-2xl uppercase my-5">{{ user.name }}</h1>
    <span class="border-r px-2"
      ><i class="fas fa-birthday-cake text-indigo-400"></i>
      {{ getYearsOld }} years</span
    >
    <span class="border-r px-2 uppercase"
      ><i class="fas fa-map-marker-alt text-indigo-400"></i>
      {{ user.profile.city_uf }}</span
    >
    <span class="px-2"
      ><i class="fas fa-mobile-alt text-indigo-400"></i>
      {{ user.profile.phone }}</span
    >
  </div>
</template>

<script>
export default {
  props: {
    user: Object,
  },
  computed: {
    getYearsOld() {
      return this.$moment().diff(this.user.profile.date_birth, "years");
    },
  },
};
</script>