<template>
  <div>
    <q-page class="hero">
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
        class="bg-purple shadow-1"
      >
        <q-carousel-slide name="style" class="row no-wrap">
          <div class="col-7 column justify-center">
            <p class="col text-h2 text-white">Conheça a Newsletter Comunica Extensão</p>
            <p class="col text-h5 text-white q-pa-md">
A Comunica Extensão é uma newsletter mensal, produzida pela Pró-Reitoria de Extensão da UFRJ, que reúne os principais informes, chamadas-públicas, eventos e notícias da universidade e que envolvem toda a comunidade extensionista. Além disso, faz uma curadoria das ações de extensão que estão com vagas abertas para estudantes e divulga as principais novidades da Extensão UFRJ.            </p>
            <q-btn
              flat
              class="col-1"
              label="Inscreva-se Aqui"
              color="green"
            ></q-btn>
          </div>
          <q-img
            id="comunica-img"
            class="col-5 rounded-borders"
            src="images/comunica-01-2022.png"
            fit="fill"
          >
          </q-img>
        </q-carousel-slide>
        <q-carousel-slide name="podcast" class="row no-wrap">
          <div class="col-7 column justify-center">
            <p class="col text-h2 text-white">Conheça o Comunica Extensão Podcast</p>
            <p class="col text-h5 text-white q-pa-md">
O podcast Comunica Extensão é um programa da Pró-Reitoria de Extensão da UFRJ, em parceria com a Rádio UFRJ, que te ajuda a acompanhar as ações extensionistas da universidade. Você encontra novidades e entrevistas que promovem debates entre a Extensão e o Estado do Rio de Janeiro, com todo o seu circuito cultural, formativo e econômico. 
</p>
            <div class="row col-1 no-wrap"><p class="col-4 text-h3 text-white">Ouça em: </p>
            <q-btn class='col-1' flat icon="img:https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg" />
            <q-btn class='col-1' flat icon="img:https://upload.wikimedia.org/wikipedia/commons/e/e7/Podcasts_%28iOS%29.svg" />

</div>
          </div>
          <q-img
            id="comunica-img"
            class="col-5 rounded-borders"
            src="images/podcast.jpg"
            fit="fill"
          >
          </q-img>
        </q-carousel-slide>
      </q-carousel>
    </q-page>

    <q-page ref='destaque' id='destaque' class="column q-pa-xl">
      <span class="col-1 text-h2">Ações em Destaque</span>
      <div class="col row q-pa-xl justify-around">
        <div class="col-3 q-ma-md" v-for="projeto in projetos" :key="projeto">
          <home-card  :acao="projeto">
          </home-card>
        </div>
      </div>
      <q-btn v-on:click="this.$router.push('/acoes')" class="col-1" label="Veja todas as ações"></q-btn>
    </q-page>

    <q-page class="column bg-yellow q-pa-xl">
      <span class="col-1 text-h2">Vagas em Destaque</span>
      <div class="col row q-pa-xl items-center">
        <div class="col" v-for="acao in acoes" :key="acao">
          <q-card
            flat
            vertical
            class="my-card"
            :style="'border-color: ' + acao.cor"
          >
            <img src="https://cdn.quasar.dev/img/mountains.jpg" />

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
      <q-btn class="col-1" label="Veja todas as vagas"></q-btn>
    </q-page>

    <q-page class="column bg-green q-pa-xl">
      <span class="col-1 text-h2">Lives em Destaque</span>
      <q-tabs class="col-1">
        <q-tab>Ao vivo</q-tab>
        <q-tab>Próximas</q-tab>
        <q-tab>Passadas</q-tab>
      </q-tabs>
      <div class="col row q-pa-xl items-center">
        <div class="col" v-for="acao in acoes" :key="acao">
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
      <q-btn v-on:click="this.$router.push('/lives')" class="col-1" label="Veja todas as Lives"></q-btn>
    </q-page>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import '@quasar/extras/fontawesome-v5'
import axios from "axios";
import HomeCard from "../components/HomeCard.vue";



export default defineComponent({
  components: { HomeCard },
  name: "PageIndex",
  data: function () {
    return {
      slide: "style",
      projetos: [],

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
  methods:{
    getProjetos(){
      axios.get(
          "http://192.168.100.10:8000/home/",
        ).then(response => {this.projetos = response.data.data,
          console.log(this.projetos)
        })
    },


  },
    mounted() {
    this.getProjetos();
  },
});
</script>

<style scoped>
.hero {
  background-size: 100% 100%;
}

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
  border-style: outset;
}
</style>
