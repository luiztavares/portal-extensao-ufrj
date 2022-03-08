<template>
  <q-card flat vertical class="my-card"
    v-on:click="window.open(videoURL)">
    <q-card-section class="q-pa-none video_wrapper bg-black" height="500px">
      <img
        v-bind:src= dados_video.snippet.thumbnails.medium.url
        title="YouTube video"
      >
    </q-card-section>

    <q-card-section height="150px">
      <div class="text-h6 titulo">{{ dados_video.snippet.title }}</div>
      <div class="text-subtitle2">{{ formatDate(dados_video.snippet.publishTime) }}</div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      {{ dados_video.snippet.description }}
    </q-card-section>
  </q-card>
</template>

<script>
import { defineComponent } from "vue";
import moment from 'moment'


export default defineComponent({
  setup() {
  },

  props: ["dados_video"],

  data: function() {
    return {
      url: "https://i.ytimg.com/vi/EqLeMkdnDqQ/default.jpg",
      window: window
    }
  },

  computed: {
    videoURL: function () { 
      return 'https://www.youtube.com/watch?v=' + this.dados_video.id.videoId
    }
  },

  methods: {
    formatDate: function (date) {
      return moment(date).format('DD/MM/YYYY')
    }
  }
});
</script>

<style scoped>
.my-card {
  background-color: HoneyDew;
  width: 100%;
  max-width: 320px;
  min-width: 260px;
  height: 400px;
  border-style: outset;
  border-color: green;
}

.video_wrapper {
  position: relative;
  padding-bottom: 56.25%; /* 16:9, for an aspect ratio of 1:1 change to this value to 100% */
}

.titulo {
  letter-spacing: 0em;
  font-size: 1.2rem;
}

img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>