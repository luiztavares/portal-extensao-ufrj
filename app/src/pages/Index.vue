<template>
  <q-container>
    <q-page class="hero">
      <p
        class="text-h5 text-bold q-px-xl q-my-md"
        style="text-shadow: 3px 3px 6px #00000030"
      >
        <span style="color: magenta">>></span> Em destaque
      </p>
      <q-carousel
        v-model="slide"
        transition-prev="jump-right"
        transition-next="jump-left"
        swipeable
        animated
        control-color="black"
        prev-icon="arrow_left"
        next-icon="arrow_right"
        navigation-icon="radio_button_unchecked"
        navigation
        padding
        arrows
        class="bg-purple shadow-1"
      >
        <q-carousel-slide
          name="info"
          :img-src="$q.screen.gt.sm ? 'images/Slide 01.png' : 'images/Slide 01 - 1080x1080.png'"
          class="row no-wrap slideimage"
        >
        </q-carousel-slide>
        <q-carousel-slide
          name="festival"
          :img-src="$q.screen.gt.md ? 'images/Slider Festival 2022-1920x1080.png' : 'images/Slide Festival 2022 - 1080x1080.png'"
          class="row no-wrap slideimage "
        >
        <div class="q-ma-xl custom-caption absolute-bottom">
<q-btn color="red" label="Veja o festival aqui" :to="{ name: 'Festival' }">
        </q-btn>
          </div> 

        </q-carousel-slide>
        <q-carousel-slide
          name="newsletter"
          :img-src="$q.screen.gt.md ? 'images/News-header-16x9.png': 'images/news-header-1x1.png'"
          class="row no-wrap slideimage "
        >
          <div class="q-ma-xl custom-caption absolute-bottom-right">
            <q-btn color="purple" label="Leia" :to="{ name: 'Leia' }">
            </q-btn>
            <q-btn class="q-ml-xl" color="purple" label="Assine" :to="{ name: 'Comunica' }">
            </q-btn>
          </div>
        </q-carousel-slide>
        <q-carousel-slide
          name="podcast"
          :img-src="$q.screen.gt.md ?  'images/podcast-16x9.png' : 'images/podcast-1x1.png'"
          class="slideimage row no-wrap "
        >
          <div class="q-ma-xl custom-caption absolute-bottom-left">
            <q-btn
              class="col-1"
              size="lg"
              flat
              icon="img:https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg"
              :to="{ name: 'Spotify' }"
            />
            <!-- <q-btn
              class="col-1"
                            size="lg"

              flat
              icon="img:https://upload.wikimedia.org/wikipedia/commons/e/e7/Podcasts_%28iOS%29.svg"
            /> -->
          </div>
        </q-carousel-slide>

        
      </q-carousel>
    </q-page>

    <q-page ref="destaque" id="destaque" class="q-pa-xl">
      <p
        class="q-px-sm text-h5 text-bold row"
        style="text-shadow: 3px 3px 6px #00000030"
      >
        <span style="color: magenta">>> </span> Descubra o que fazer em
        {{ month }}
        <q-space></q-space>
        <!-- <q-input v-model="search" rounded outlined type="search">
        <template v-slot:append>
          <q-icon name="search" />
        </template>
      </q-input> -->
        <q-btn-toggle
          class="float-right"
          v-model="toggleAcoes"
          toggle-color="primary"
          flat
          :options="[
            { slot: 'one', value: 'one' },
            { slot: 'two', value: 'two' },
          ]"
        >
          <template v-slot:one>
            <div class="row items-center no-wrap">
              <q-icon name="list" />
              <div class="text-center">Lista</div>
            </div>
          </template>

          <template v-slot:two>
            <div class="row items-center no-wrap">
              <q-icon name="grid_view" />
              <div class="text-center">Grade</div>
            </div>
          </template>
        </q-btn-toggle>
      </p>

      <q-list v-if="toggleAcoes == 'one'" responsive class="q-mx-xl">
        <section
          class="col-auto q-ma-md"
          v-for="(projeto, index) in filteredList3"
          :key="projeto"
        >
          <home-list :vaga="false" :acao="projeto" :index="index"> </home-list>
        </section>
      </q-list>
      <vue-horizontal v-if="toggleAcoes == 'two'" responsive class="q-mx-xl">
        <section
          class="col-auto q-ma-md"
          v-for="(projeto, index) in filteredList3"
          :key="projeto"
        >
          <home-card :vaga="false" :acao="projeto" :index="index"> </home-card>
        </section>
      </vue-horizontal>

      <p
        class="q-px-sm text-h5 text-bold q-mt-xl"
        style="text-shadow: 3px 3px 6px #00000030"
      >
        <span style="color: magenta">>></span> VAGAS em Ações de Extensão
        <q-btn-toggle
          class="float-right"
          v-model="toggleVagas"
          toggle-color="primary"
          flat
          :options="[
            { slot: 'one', value: 'one' },
            { slot: 'two', value: 'two' },
          ]"
        >
          <template v-slot:one>
            <div class="row items-center no-wrap">
              <q-icon name="list" />
              <div class="text-center">Lista</div>
            </div>
          </template>

          <template v-slot:two>
            <div class="row items-center no-wrap">
              <q-icon name="grid_view" />
              <div class="text-center">Grade</div>
            </div>
          </template>
        </q-btn-toggle>
      </p>
      <q-list v-if="toggleVagas == 'one'" responsive class="q-mx-xl">
        <section
          class="col-auto q-ma-md"
          v-for="(projeto, index) in vagas"
          :key="projeto"
        >
          <vagas-list :vaga="false" :acao="projeto" :index="index"> </vagas-list>
        </section>
      </q-list>

      <vue-horizontal v-if="toggleVagas == 'two'"  responsive class="q-mx-xl">
        <div
          class="col-auto q-ma-md"
          v-for="(projeto, index) in vagas"
          :key="projeto"
        >
          <vagas-card :vaga="false" :acao="projeto" :index="index">
          </vagas-card>
        </div>
      </vue-horizontal>

      <a
        href="https://www.youtube.com/watch?v=pucam0lCHzI"
        target="_blank"
        class="text-red q-px-xl text-center text-h6"
      >
        Estudantes, vejam aqui tutorial sobre como obter creditação das suas horas de extensão 
      </a>

      <!-- <q-input class="q-pa-xl" style="max-width: 500px"
        v-model="acoessearch"
        debounce="1000"
        filled
        placeholder="Pesquise sua ação"
      >
        <template v-slot:append>
          <q-icon name="search" />
        </template>
      </q-input>

    <div class="col row q-pa-sm justify-around">
    <q-btn flat
      v-on:click="this.$router.push('/acoes')"
      class=""
      label="Veja todas as ações"
    ><span style="color:blue" class="q-px-sm"> V</span> </q-btn>
    </div> -->
    </q-page>
  </q-container>

  <!-- <q-page class="column bg-lime q-pa-xl">
    <div class="row">
    <p class="col q-px-sm text-h5 text-bold" style="text-shadow: 3px 3px 6px #00000030">
      <span style="color: magenta">>></span> Lives em Destaque
    </p>
        <q-tabs class="col">
      <q-tab>Ao vivo</q-tab>
      <q-tab>Próximas</q-tab>
      <q-tab>Passadas</q-tab>
    </q-tabs>
    </div>


    <div class="col row q-pa-xl justify-around">
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
    <q-btn flat
      v-on:click="this.$router.push('/lives')"
      class="col-1"
      label="Carregar mais"
    ></q-btn>
  </q-page> -->
</template>

<script>
import { defineComponent } from "vue";
import "@quasar/extras/fontawesome-v5";
import axios from "axios";
import HomeCard from "../components/HomeCard.vue";
import HomeList from "../components/HomeList.vue";
import VagasList from "../components/VagasList.vue";
import VagasCard from "../components/VagasCard.vue";
import vagasJson from "../../public/vagas-13-05-2022.json";
import acoesJson from "../../public/acoes-13-05-2022.json";
import VueHorizontal from "vue-horizontal";
import { useQuasar } from 'quasar'
import { computed } from 'vue'

export default defineComponent({
  components: { HomeCard, VagasCard, HomeList,VagasList, VueHorizontal },
  name: "PageIndex",
  setup () {
    const $q = useQuasar()
  },
  data: function () {
    return {
      divulgar: ["Curso", "Evento"],
      modalidade: ["Online", "Presencial"],
      search: "",
      toggleAcoes: "two",
      toggleVagas: "two",
      acoessearch: "",
      slide: "info",
      projetos: [],
      vagas: [],
      items: [...Array(20).keys()].map((i) => {
        return { title: `Item ${i}`, content: `🚀 Content ${i}` };
      }),
    };
  },
  created() {
    this.windowHeight = window.innerHeight + "px";
  },
  methods: {
    getProjetos() {
      axios.get("http://127.0.0.1:8000/home/").then((response) => {
        (this.projetos = response.data.data), console.log(this.projetos);
        this.vagas = response.data.data.slice(0, 3);
      });
    },
    getProjetosLocal() {
      for (var acao of acoesJson) {
        var dtstring = acao["Período de realização - Data de Início"];
        var dia = dtstring.substring(0, 2);
        var mes = dtstring.substring(3, 5);
        var ano = dtstring.substring(6, 10);

        var dtstringend = acao["Período de realização - Data de Término"];
        var diaend = dtstringend.substring(0, 2);
        var mesend = dtstringend.substring(3, 5);
        var anoend = dtstringend.substring(6, 10);
        if (
          new Date() >= new Date(ano, mes, dia) &&
          new Date() <= new Date(anoend, mesend, diaend)
        )
          this.projetos.push(acao);
      }

      for (var acao of vagasJson) {
        var dtstring2 = acao["Período de inscrições - Data de Início"];
        var dia2 = dtstring2.substring(0, 2);
        var mes2 = dtstring2.substring(3, 5);
        var ano2 = dtstring2.substring(6, 10);

        var dtstringend2 = acao["Período de Inscrições - Data de Término"];
        var diaend2 = dtstringend2.substring(0, 2);
        var mesend2 = dtstringend2.substring(3, 5);
        var anoend2 = dtstringend2.substring(6, 10);
        if (
          new Date() >= new Date(ano2, mes2, dia2) &&
          new Date() <= new Date(anoend2, mesend2, diaend2)
        ) {
          this.vagas.push(acao);
          console.log(Date(anoend2, mesend2, diaend2));
        }
      }
      this.projetos = this.projetos.reverse();
      //this.projetos = acoesJson.reverse();
      this.vagas = this.vagas.reverse();
    },
  },
  computed: {
    month() {
      return new Date().toLocaleString("pt-BR", { month: "long" });
    },
    filteredList() {
      return this.projetos.filter(
        (data) =>
          JSON.stringify(data)
            .toLowerCase()
            .indexOf(this.search.toLowerCase()) !== -1
      );
    },
    filteredList2() {
      return this.filteredList.filter((data) =>
        this.divulgar.includes(data["O que você deseja divulgar?"])
      );
    },
    filteredList3() {
      return this.filteredList2.filter((data) =>
        this.modalidade.includes(data["Modalidade"])
      );
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
  min-width: 400px;
  min-height: 400px;
  max-width: 400px;
}

.text-shadow-black {
  text-shadow: 1px 1px 2px black;
}

.slideimage {
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
  background-color: white;
}
</style>
