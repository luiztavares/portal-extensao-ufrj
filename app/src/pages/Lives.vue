<template>
  <q-page class="column bg-green q-pa-none">
    <span class="col-1 text-h2 q-my-lg q-ml-xl text-white"
      >Lives da Extensão UFRJ</span
    >
    <q-tabs class="col-1 bg-green-7 text-white" v-model="panel">
      <q-tab name="live" :disable="this.dadosVideos['live'].length == 0"
        >Ao vivo</q-tab
      >
      <q-tab name="upcoming" :disable="this.dadosVideos['upcoming'].length == 0"
        >Próximas</q-tab
      >
      <q-tab name="completed">Passadas</q-tab>
    </q-tabs>

    <q-tab-panels v-model="panel" animated class="shadow-2 q-mb-xl">
      <q-tab-panel name="live">
        <div class="col row q-pa-none lives">
          <div
            class="card_wrapper"
            v-for="video in dadosVideos['live']"
            :key="video"
          >
            <YoutubeCard v-bind:dados_video="video" />
          </div>
        </div>
      </q-tab-panel>

      <q-tab-panel name="upcoming">
        <div class="col row q-pa-none lives">
          <div
            class="card_wrapper"
            v-for="video in dadosVideos['upcoming']"
            :key="video"
          >
            <YoutubeCard v-bind:dados_video="video" />
          </div>
        </div>
      </q-tab-panel>

      <q-tab-panel name="completed">
        <div class="col row q-pa-none lives">
          <div
            class="card_wrapper"
            v-for="video in dadosVideos['completed']"
            :key="video"
          >
            <YoutubeCard v-bind:dados_video="video" />
          </div>
          <q-btn
            outline
            no-caps
            color="primary"
            class="btn"
            v-on:click="window.open(channelURL)"
          >
            Veja todas as lives passadas no canal da Extensão UFRJ no YouTube
          </q-btn>
        </div>
      </q-tab-panel>
    </q-tab-panels>
  </q-page>
</template>


<script>
import { defineComponent, ref } from "vue";
import YoutubeCard from "components/YoutubeCard.vue";
import axios from "axios";

export default defineComponent({
  setup() {
    return {
      panel: ref("completed"),
    };
  },

  components: {
    YoutubeCard,
  },

  methods: {
    getLives: async function () {
      const videoTypes = ["live", "completed", "upcoming"];
      for (const t of videoTypes) {
        const response = await axios.get(
          "https://youtube.googleapis.com/youtube/v3/search?" +
            "part=snippet" +
            "&channelId=" + this.channelId +
            "&eventType=" + t +
            "&type=video" +
            "&order=date" +
            "&maxResults=16" +
            "&key=" +
            process.env.GOOGLE_API_KEY
        );

        this.dadosVideos[t] = response.data.items;
      }
    },
  },

  beforeMount() {
    this.getLives();
  },

  data: function () {
    return {
      slide: "style",
      channelId: "UCvMAg03W-Z34vAvrmeHEivg",
      channelURL: "https://www.youtube.com/c/Extens%C3%A3oUFRJ",
      dadosVideos: {
        live: [],
        completed: [],
        upcoming: [],
      },
      window: window,
    };
  },
});
</script>

<style scoped>
.card_wrapper {
  margin: 20px;
  flex-grow: 1;
  padding-left: auto;
}

.q-card {
  margin: auto;
}

.btn {
  max-width: 1600px;
  width: 100%;
  margin-top: 40px;
}

.lives {
  align-items: center;
  margin-left: auto;
  margin-right: auto;
  display: flex;
  flex-basis: auto;
  max-width: 1600px;
}
</style>
