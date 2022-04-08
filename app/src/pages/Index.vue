<template>
    <q-page class="hero">
      <p class='text-h5 text-bold q-px-md q-my-sm'><span style='color: magenta;'>>></span> Em destaque</p>
      <q-carousel
        v-model="slide"
        transition-prev="jump-right"
        transition-next="jump-left"
        swipeable
        animated
        control-color="white"
        prev-icon="arrow_left"
        next-icon="arrow_right"
        navigation-icon="radio_button_unchecked"
        navigation
        padding
        arrows
        class="bg-purple shadow-1 "
      >
        <q-carousel-slide
          name="style"
          img-src="images/comunica-01-2022.png"
          class="row no-wrap slideimage"
        >
          <div class="q-ma-xl custom-caption absolute-bottom-right ">
            <q-btn color='purple' label='Inscrever' :to="{ name: 'Comunica'}"> </q-btn>
        </div>

        </q-carousel-slide>
          <q-carousel-slide
          name="podcast"
          img-src="images/podcast.jpg"
          class="slideimage row no-wrap"
        >
          <div class="q-ma-xl custom-caption absolute-bottom-left">
              <q-btn
                class="col-1"
                flat
                icon="img:https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg"
              />
              <q-btn
                class="col-1"
                flat
                icon="img:https://upload.wikimedia.org/wikipedia/commons/e/e7/Podcasts_%28iOS%29.svg"
              />
            </div>


        </q-carousel-slide>
      
      </q-carousel>
    </q-page>

    <q-page ref="destaque" id="destaque" class=" ">
      <p class="q-px-md q-my-md  text-h5 text-bold"> <span style='color: magenta;'>>></span> Descubra o que fazer em ABRIL</p>
      <div class="col row q-pa-sm justify-around">
        <div class="col-auto q-ma-sm" v-for="(projeto, index) in projetos" :key="projeto">
          <home-card :vaga='false' :acao="projeto" :index='index'> </home-card>
        </div>
      </div>
      <q-btn
        v-on:click="this.$router.push('/acoes')"
        class="col-1"
        label="Veja todas as ações"
      ></q-btn>
    </q-page>

    <q-page class="column bg-yellow q-pa-xl">
      <span class="col-1 text-h2">Vagas em Destaque</span>
      <div class="col row q-pa-sm justify-around">
        <div class="col-auto q-ma-sm" v-for="(projeto, index) in vagas" :key="projeto">
          <home-card :vaga='true' :acao="projeto" :index='index'> </home-card>
        </div>
      </div>
      <q-btn
        v-on:click="this.$router.push('/acoes')"
        class="col-1 q-mt-xl"
        label="Veja todas as vagas"
      ></q-btn>
    </q-page>

    <q-page class="column bg-green q-pa-xl">
      <span class="col-1 text-h2">Lives em Destaque</span>
      <q-tabs class="col-1">
        <q-tab>Ao vivo</q-tab>
        <q-tab>Próximas</q-tab>
        <q-tab>Passadas</q-tab>
      </q-tabs>
      <div class="col row q-pa-xl  justify-around">
        <div class="col-3 q-ma-xl" v-for="acao in acoes" :key="acao">
          <q-card
            flat
            vertical
            class="my-card"
            :style="'border-color: ' + acao.cor"
          >
            <iframe
              width="400"
              height="315"
              src="https://www.youtube.com/embed/Xz3bMCj6BFI"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            ></iframe>

            <q-card-section>
              <div class="text-h6">{{ acao.titulo }}</div>
              <div class="text-subtitle2">{{ acao.coordenador }}</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
              {{ acao.descricao }}
            </q-card-section>
          </q-card>
        </div>
      </div>
      <q-btn
        v-on:click="this.$router.push('/lives')"
        class="col-1"
        label="Veja todas as Lives"
      ></q-btn>
    </q-page>
</template>

<script>
import { defineComponent } from "vue";
import "@quasar/extras/fontawesome-v5";
import axios from "axios";
import HomeCard from "../components/HomeCard.vue";
import json from "../../public/home.json";

export default defineComponent({
  components: { HomeCard },
  name: "PageIndex",
  data: function () {
    return {
      slide: "style",
      projetos: [],
      vagas:[],

      acoes: [
        {
          titulo: "América Latina Póscolonial: estudos de caso.",
          coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
          modalidade: "Curso",
          cor: "red",
          descricao:
            "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
        },
        {
          titulo: "América Latina Póscolonial: estudos de caso.",
          coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
          modalidade: "Evento",
          cor: "green",

          descricao:
            "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
        },
        {
          titulo: "América Latina Póscolonial: estudos de caso.",
          coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
          modalidade: "Projeto",
          cor: "blue",

          descricao:
            "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
        },
      ],
    };
  },
  created(){
    this.windowHeight = window.innerHeight + 'px'
  },
  methods: {
    getProjetos() {
      axios.get("http://127.0.0.1:8000/home/").then((response) => {
        (this.projetos = response.data.data), console.log(this.projetos);
        this.vagas = response.data.data.slice(0,3)
      });
    },
    getProjetosLocal(){
      this.projetos = json.data
      this.vagas = this.projetos.slice(0,3)
    },
  },
  mounted() {
    this.getProjetosLocal();
  },
});
</script>

<style scoped>

.q-carousel {
  min-height: inherit;
  min-width: inherit;
}

.rounded-borders {
  border-radius: 5%;
}

.my-card {
  width: 100%;
  min-width: 400px;
  min-height: 400px;
}

.text-shadow-black{
  text-shadow: 1px 1px 2px black;
}


.slideimage{
    background-size:cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
