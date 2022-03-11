<template>
  <q-page class="column bg-green q-pa-none">
  </q-page>
</template>

<script>
import { defineComponent, ref } from "vue";
import axios from "axios";

export default defineComponent({
  setup() {
    return {
      panel: ref("completed"),
    };
  },

  components: {
  },

  methods: {
  },

  data: function () {
    return {
    };
  },
});
</script>

<style scoped>
</style>
