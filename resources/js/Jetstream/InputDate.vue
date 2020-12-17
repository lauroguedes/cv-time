<template>
  <date-picker v-model="value"></date-picker>
</template>

<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

export default {
  props: ["value"],
  components: {
    DatePicker,
  },
};
</script>