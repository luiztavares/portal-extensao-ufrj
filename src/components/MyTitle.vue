<template>
  <p
    class="q-pt-xl q-px-sm text-h5 text-bold row"
    style="text-shadow: 3px 3px 6px #00000030"
  >
    <span> <span style="color: magenta">>>&nbsp;</span> {{ text }} </span>
  </p>
</template>

<script setup>
import { toRefs } from 'vue';

const props = defineProps({
  text: String,
});

const { text } = toRefs(props);
</script>

<style scoped>
p {
  font-size: 40px;
}
</style>
