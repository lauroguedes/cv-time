<template>
  <div class="text-center">
    <h2 class="uppercase mb-5 mt-8 flex items-center justify-center">
      <i class="far fa-circle text-gray-400 text-xs mr-2"></i>
      <span class="text-gray-800 text-xl">{{ title }}</span>
      <i class="far fa-circle text-gray-400 text-xs ml-2"></i>
    </h2>
    <ul class="list-none mb-2">
      <li
        v-for="skill in skills"
        class="mb-3"
        :key="skill.id"
        :title="`${getPercentage(skill.level)}%`"
      >
        <div>{{ skill.name.toUpperCase() }}</div>
        <div class="relative pt-1">
          <div
            class="overflow-hidden h-1 mb-4 text-xs flex rounded bg-orange-100"
          >
            <div
              :style="`width: ${getPercentage(skill.level)}%`"
              class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-orange-400"
            ></div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    skills: Array,
    title: String,
  },
  methods: {
    getPercentage(value) {
      return (100 * value) / 10;
    },
  },
};
</script>