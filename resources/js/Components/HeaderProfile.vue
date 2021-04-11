<template>
  <div class="text-center">
    <img
      class="inline h-32 w-32 rounded-full object-cover"
      :src="user.profile_photo_url"
      alt="Foto"
    />
    <h1 class="text-3xl uppercase mt-5 mb-3">
      {{ user.name }}
      <a
        :href="route('profile.show')"
        class="ml-3 transition duration-100 ease-in-out text-indigo-200 hover:text-indigo-400"
      >
        <i class="fas fa-pencil-alt"></i>
      </a>
    </h1>
    <h2
      v-if="user.employment_histories.length"
      class="inline-block py-1 px-3 bg-gray-100 text-gray-600 uppercase rounded-2xl mb-5 font-light"
    >
      {{ getPresentEmployment.title }}
      <span class="lowercase font-bold">at</span>
      {{ getPresentEmployment.company }}
    </h2>
    <div>
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
    getPresentEmployment() {
      let employments = _.orderBy(
        this.user.employment_histories,
        ["end_date"],
        ["desc"]
      );
      return _.head(employments);
    },
  },
};
</script>