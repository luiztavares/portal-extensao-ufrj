<template>
  <q-card flat vertical class="my-card" :style="'border-color: ' + acao.cor">
    <q-card-section class="q-pa-none video_wrapper" height="500px">
      <iframe
        src="https://www.youtube.com/embed/Xz3bMCj6BFI"
        title="YouTube video player"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
      ></iframe>
    </q-card-section>

    <q-card-section>
      <div class="text-h6">{{ acao.titulo }}</div>
      <div class="text-subtitle2">{{ acao.coordenador }}</div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      {{ acao.descricao }}
    </q-card-section>
  </q-card>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  setup() {},

  props: ["acao"],
});
</script>

<style scoped>
.my-card {
  width: 100%;
  max-width: 400px;
  min-width: 300px;
  border-style: outset;
}

.video_wrapper {
  position: relative;
  padding-bottom: 56.25%; /* 16:9, for an aspect ratio of 1:1 change to this value to 100% */
}

iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>